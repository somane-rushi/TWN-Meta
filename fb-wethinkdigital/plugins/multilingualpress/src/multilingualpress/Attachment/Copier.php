<?php # -*- coding: utf-8 -*-
/*
 * This file is part of the MultilingualPress package.
 *
 * (c) Inpsyde GmbH
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Inpsyde\MultilingualPress\Attachment;

/**
 * MultilingualPress Attachment Copier
 */
class Copier
{
    /**
     * @var \wpdb
     */
    private $wpdb;

    /**
     * Copier constructor
     * @param \wpdb $wpdb
     */
    public function __construct(\wpdb $wpdb)
    {
        $this->wpdb = $wpdb;
    }

    /**
     * Copy attachments from source site to the give remote site using a list of attachment ids
     *
     * @param int $sourceSiteId
     * @param int $remoteSiteId
     * @param array $sourceAttachmentIds
     * @return array
     */
    public function copyById(
        int $sourceSiteId,
        int $remoteSiteId,
        array $sourceAttachmentIds
    ): array {

        if ($sourceSiteId === $remoteSiteId) {
            return [];
        }

        $sourceUploadDir = wp_upload_dir()['basedir'] ?? '';
        if (!$sourceUploadDir) {
            return [];
        }

        $sourceAttachmentIds = $this->ensureAttachmentIds($sourceAttachmentIds);
        $sourceAttachments = $this->sourceAttachments($sourceAttachmentIds, $sourceUploadDir);
        if (!$sourceAttachments) {
            return [];
        }

        return $this->copyToRemoteSite($remoteSiteId, ...$sourceAttachments);
    }

    /**
     * Copy attachment file to the remote upload dir and create a new attachment post
     *
     * @param int $remoteSiteId
     * @param AttachmentData[] $sourceAttachmentsData
     * @return array
     */
    private function copyToRemoteSite(
        int $remoteSiteId,
        AttachmentData ...$sourceAttachmentsData
    ): array {

        $originalSite = $this->maybeSwitchSite($remoteSiteId);

        $remoteAttachments = [];
        $uploadDir = wp_upload_dir();
        $uploadPath = $uploadDir['path'] ?? '';
        $uploadUrl = $uploadDir['url'] ?? '';

        if (!$uploadPath || !$uploadUrl || !wp_mkdir_p($uploadDir['path'])) {
            $this->maybeRestoreSite($originalSite);

            return [];
        }

        foreach ($sourceAttachmentsData as $sourceAttachmentData) {
            $sourceAttachmentPath = $sourceAttachmentData->filePath();
            $sourceAttachmentBaseName = wp_basename($sourceAttachmentPath);
            $remoteAttachmentRealPath = "{$uploadPath}/{$sourceAttachmentBaseName}";
            $remoteAttachmentUrl = "{$uploadUrl}/{$sourceAttachmentBaseName}";
            $existingAttachmentId = $this->existingAttachmentId($sourceAttachmentBaseName);

            if ($existingAttachmentId) {
                $updatedId = $this->updateAttachmentPostMeta(
                    $sourceAttachmentData,
                    $existingAttachmentId
                );
                $updatedId and $remoteAttachments[] = $updatedId;
                continue;
            }

            if (!file_exists($sourceAttachmentPath) || !is_readable($sourceAttachmentPath)) {
                continue;
            }

            if (!copy($sourceAttachmentPath, $remoteAttachmentRealPath)) {
                continue;
            }

            $remoteAttachments[] = $this->createAttachmentPostByPath(
                $sourceAttachmentData,
                $remoteAttachmentRealPath,
                $remoteAttachmentUrl
            );
        }

        $this->maybeRestoreSite($originalSite);

        return array_filter($remoteAttachments);
    }

    /**
     * Update the remote attachment post meta data with data provided by the given source attachment
     *
     * @param AttachmentData $sourceAttachmentData
     * @param int $remoteAttachmentId
     * @return int
     */
    private function updateAttachmentPostMeta(
        AttachmentData $sourceAttachmentData,
        int $remoteAttachmentId
    ): int {

        $data = $sourceAttachmentData->post()->to_array();
        $data['ID'] = $remoteAttachmentId;

        $id = wp_update_post($data);
        if ($id instanceof \WP_Error) {
            return 0;
        }

        $this->copyMetaFromSourceAttachment($sourceAttachmentData, $remoteAttachmentId);

        return $id;
    }

    /**
     * Create an attachment post by the attachment path
     *
     * @param AttachmentData $sourceAttachmentData
     * @param string $remoteAttachmentRealPath
     * @param string $remoteAttachmentUrl
     * @return int
     */
    private function createAttachmentPostByPath(
        AttachmentData $sourceAttachmentData,
        string $remoteAttachmentRealPath,
        string $remoteAttachmentUrl
    ): int {

        $sourceAttachment = $sourceAttachmentData->post();
        $filetype = wp_check_filetype($remoteAttachmentRealPath);
        $remoteAttachmentData = [
            'post_mime_type' => $filetype['type'] ?? '',
            'guid' => $remoteAttachmentUrl,
            'post_title' => $sourceAttachment->post_title,
            'post_excerpt' => $sourceAttachment->post_excerpt,
            'post_content' => $sourceAttachment->post_content,
            'post_author' => get_current_user_id(),
        ];

        $this->requireAttachmentFunctions();

        $remoteAttachmentId = wp_insert_attachment(
            $remoteAttachmentData,
            $remoteAttachmentRealPath
        );
        if ($remoteAttachmentId instanceof \WP_Error) {
            return 0;
        }

        wp_update_attachment_metadata(
            $remoteAttachmentId,
            wp_generate_attachment_metadata($remoteAttachmentId, $remoteAttachmentRealPath)
        );

        $this->copyMetaFromSourceAttachment($sourceAttachmentData, $remoteAttachmentId);

        return $remoteAttachmentId;
    }

    /**
     * Retrieve the attachments post and files path
     * The items contains the post and the real path of the attachment
     *
     * @param int[] $attachmentIds
     * @param string $uploadDir
     * @return \stdClass[]
     */
    private function sourceAttachments(array $attachmentIds, string $uploadDir): array
    {
        $sourceAttachments = [];
        foreach ($attachmentIds as $attachmentId) {
            $attachment = get_post($attachmentId);
            if (!$attachment || !$this->isLocalAttachment($attachment)) {
                continue;
            }

            $attachmentPath = $this->attachmentPath($attachmentId);
            if (!$attachmentPath) {
                continue;
            }

            $sourceAttachments[$attachmentId] = new AttachmentData(
                $attachment,
                $this->attachmentMeta($attachment),
                "{$uploadDir}/{$attachmentPath}"
            );
        }

        return $sourceAttachments;
    }

    /**
     * Copy the attachment meta from the source give post to the remote attachment
     *
     * @param AttachmentData $sourceAttachmentData
     * @param int $remoteAttachmentId
     */
    private function copyMetaFromSourceAttachment(
        AttachmentData $sourceAttachmentData,
        int $remoteAttachmentId
    ) {

        foreach ($sourceAttachmentData->meta() as $attachmentKey => $sourceAttachmentMeta) {
            update_post_meta($remoteAttachmentId, $attachmentKey, $sourceAttachmentMeta);
        }
    }

    /**
     * Retrieve the meta by the given attachment post
     *
     * @param \WP_Post $attachment
     * @return array
     */
    private function attachmentMeta(\WP_Post $attachment): array
    {
        $altMeta = (string)get_post_meta($attachment->ID, '_wp_attachment_image_alt', true);

        return [
            '_wp_attachment_image_alt' => sanitize_text_field($altMeta),
        ];
    }

    /**
     * Check if an attachment post is a valid attachment
     *
     * @param \WP_Post $attachment
     * @return bool
     */
    private function isLocalAttachment(\WP_Post $attachment): bool
    {
        return is_local_attachment(get_permalink($attachment));
    }

    /**
     * Retrieve the path by the give attachment id
     *
     * @param int $attachmentId
     * @return string
     */
    private function attachmentPath(int $attachmentId): string
    {
        $attachmentPath = (string)get_post_meta($attachmentId, '_wp_attached_file', true);

        if (!$attachmentPath) {
            $meta = (array)(wp_get_attachment_metadata($attachmentPath) ?: []);
            $attachmentPath = $meta['file'] ?? '';
        }

        return $attachmentPath;
    }

    /**
     * Switch blog if needed
     *
     * @param int $remoteSiteId
     * @return int
     */
    private function maybeSwitchSite(int $remoteSiteId): int
    {
        $currentSite = get_current_blog_id();
        if ($currentSite !== $remoteSiteId) {
            switch_to_blog($remoteSiteId);

            return $currentSite;
        }

        return -1;
    }

    /**
     * Restore blog if needed
     *
     * @param int $originalSiteId
     * @return bool
     */
    private function maybeRestoreSite(int $originalSiteId): bool
    {
        if ($originalSiteId < 0) {
            return false;
        }

        restore_current_blog();

        $currentSite = get_current_blog_id();
        if ($currentSite !== $originalSiteId) {
            switch_to_blog($originalSiteId);
        }

        return true;
    }

    /**
     * Ensure attachment ids are valid integer values
     *
     * @param array $attachmentIds
     * @return array
     */
    private function ensureAttachmentIds(array $attachmentIds): array
    {
        $attachmentIds = array_map('intval', $attachmentIds);
        $attachmentIds = array_filter($attachmentIds, function (int $id): bool {
            return $id > 0;
        });

        return array_filter($attachmentIds);
    }

    /**
     * Require functions to work with attachments
     *
     * @return void
     */
    private function requireAttachmentFunctions()
    {
        if (!function_exists('wp_generate_attachment_metadata')) {
            require_once ABSPATH . 'wp-admin/includes/image.php';
        }
    }

    /**
     * Retrieve the attachment id of the existing attachment based on the file name
     *
     * @param string $attachmentPath
     * @return int
     */
    private function existingAttachmentId(string $attachmentPath): int
    {
        $sql = <<<SQL
SELECT meta_value, post_id 
FROM {$this->wpdb->postmeta} 
WHERE meta_key = '_wp_attached_file' 
AND meta_value LIKE '%s'
SQL;

        $result = $this->wpdb->get_row(
            $this->wpdb->prepare($sql, '%' . $this->wpdb->esc_like($attachmentPath) . '%')
        );

        $attachmentId = $result->post_id ?? 0;

        return (int)$attachmentId;
    }
}
