<?php # -*- coding: utf-8 -*-
/*
 * This file is part of the MultilingualPress package.
 *
 * (c) Inpsyde GmbH
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Function files loader.
 */
declare(strict_types=1);

namespace Inpsyde\MultilingualPress;

if (defined(__NAMESPACE__ . '\\FUNCTIONS_LOADED')) {
    return;
}

const FUNCTIONS_LOADED = 1;

require_once __DIR__ . '/utils.php';
require_once __DIR__ . '/api.php';
