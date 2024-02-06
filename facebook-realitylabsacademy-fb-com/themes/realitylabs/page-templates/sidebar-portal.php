<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package realitylabs
 */


?>

<div class="sidebar padding-bottom padding-top padding-right padding-left">
	<div class="div100 hidden-lg hidden-md hidden-sm">
		<p class="txtDarkGrey font16 text-right margin-bottom-no">
            <a class="btn btn-flat collapsed waves-attach fontXtraLight" data-toggle="collapse" href="#sideNav">
                <span class="collapsed-hide">Collapse Module Menu&nbsp;&nbsp;<span class="icon">close</span></span>
                <span class="collapsed-show">Expand Module Menu&nbsp;&nbsp;<span class="icon">drag_handle</span></span>
            </a>
		</p>
        <div class="sideBarBottomBorder margin-bottom margin-top"></div>								
	</div>
    <div class="div100 collapsible-region collapse in" id="sideNav">
		<div class="div100">									
			<a href="<?php echo esc_url( get_site_url() ); ?>" class="txtGrey">
				<p class="txtGrey fontXtraLight font16 margin-bottom margin-top" style="display: flex; align-items: center;">									
					<span class="icon icon-lg margin-right">home</span>&nbsp;Home&nbsp;									
				</p>
			</a>
			<div class="sideBarBottomBorder margin-bottom-no margin-top"></div>
		</div>
        <ul class="nav margin-bottom-sm margin-top-sm collapsible-region nav-sidebar">
			<li class="margin-bottom margin-top">
				<a class="waves-attach txtDarkGrey fontXtraLight font14 padding-left-no padding-right-no" data-toggle="collapse" href="#m1">
                	<div class="mainnav"> 
                    	Introduction to <br /> Spark AR&nbsp;
					</div>											
					<span class="icon margin-left-lg">keyboard_arrow_down</span>
				</a>
				<ul class="menu-collapse collapse margin-left-no" id="m1">
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14 margin-bottom-sm" href="<?php echo esc_url( get_site_url() ); ?>/course/about/">About this Course</a>
					</li>
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14 margin-bottom-sm" href="<?php echo esc_url( get_site_url() ); ?>/course/course-requirements/">Course Requirements</a>
					</li>
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14 margin-bottom-sm" href="<?php echo esc_url( get_site_url() ); ?>/course/introduction-to-augmented-reality/">Introduction to Augmented Reality</a>
					</li>
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14 margin-bottom-sm" href="<?php echo esc_url( get_site_url() ); ?>/course/introduction-to-spark-ar/">Introduction to <br /> Spark AR</a>
					</li>
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14 margin-bottom-sm" href="<?php echo esc_url( get_site_url() ); ?>/course/getting-started-with-spark-ar/">Getting Started with <br /> Spark AR</a>
					</li>
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14 margin-bottom-sm" href="<?php echo esc_url( get_site_url() ); ?>/course/troubleshooting-tips/">Troubleshooting Tips</a>
					</li>
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14 margin-bottom-sm" href="<?php echo esc_url( get_site_url() ); ?>/course/introduction-to-the-patch-editor/">Introduction to Patch Editor</a>
					</li>
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14 margin-bottom-sm" href="<?php echo esc_url( get_site_url() ); ?>/course/introduction-to-2d-3d-elements-materials/">Introduction to 2D and 3D Assets & Materials</a>
					</li>
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14 margin-bottom-sm" href="<?php echo esc_url( get_site_url() ); ?>/course/introduction-to-audio-in-spark-ar/">Introduction to Audio in <br /> Spark AR</a>
					</li>							
				</ul>
			</li><!--1-->
            <li class="margin-bottom margin-top">
				<a class="waves-attach txtDarkGrey fontXtraLight font14 padding-left-no padding-right-no" data-toggle="collapse" href="#m2">
					<div class="mainnav">
						Storytelling with <br /> Spark AR&nbsp;
					</div>
					<span class="icon margin-left-lg">keyboard_arrow_down</span>
				</a>
				<ul class="menu-collapse collapse margin-left-no" id="m2">
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14 margin-bottom-sm" href="<?php echo esc_url( get_site_url() ); ?>/course/why-ar/">Why AR?</a>
					</li>
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14 margin-bottom-sm" href="<?php echo esc_url( get_site_url() ); ?>/course/discovery/">Discovery</a>
					</li>					
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14 margin-bottom-sm" href="<?php echo esc_url( get_site_url() ); ?>/course/conceptualisations/">Conceptualizations</a>
					</li>
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14 margin-bottom-sm" href="<?php echo esc_url( get_site_url() ); ?>/course/considerations/">Considerations</a>
					</li>
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14 margin-bottom-sm" href="<?php echo esc_url( get_site_url() ); ?>/course/case-studies/">Case Studies</a>
					</li>
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14 margin-bottom-sm" href="<?php echo esc_url( get_site_url() ); ?>/course/other-case-studies/">Other Case Studies</a>
					</li>							
				</ul>
			</li><!--2-->
            <li class="margin-bottom margin-top">
				<a class="waves-attach txtDarkGrey fontXtraLight font14 padding-left-no padding-right-no" data-toggle="collapse" href="#m3">
					<div class="mainnav">
						Spark AR Policies&nbsp;
					</div>
					<span class="icon margin-left-lg">keyboard_arrow_down</span>
				</a>
				<ul class="menu-collapse collapse margin-left-no" id="m3">
					<li>
                    	<a class="waves-attach txtGrey fontXtraLight font14 margin-bottom-sm" href="<?php echo esc_url( get_site_url() ); ?>/course/spark-ar-publishing-guidelines/">Spark AR Publishing Guidelines</a>
					</li>
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14 margin-bottom-sm" href="<?php echo esc_url( get_site_url() ); ?>/course/spark-ar-policies/">Spark AR Policies</a>
					</li>							
				</ul>
			</li><!--3-->
            <li class="margin-bottom margin-top">
				<a class="waves-attach txtDarkGrey fontXtraLight font14 padding-left-no padding-right-no" data-toggle="collapse" href="#m4">
					<div class="mainnav">
						Face Effects&nbsp;		
					</div> 
					<span class="icon margin-left-lg">keyboard_arrow_down</span>
				</a>
				<ul class="menu-collapse collapse margin-left-no" id="m4">
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14 margin-bottom-sm" href="<?php echo esc_url( get_site_url() ); ?>/course/introduction-to-face-effects/">Introduction to Face Effects</a>
					</li>
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14 margin-bottom-sm" href="<?php echo esc_url( get_site_url() ); ?>/course/case-study-1-2/">Case study #1</a>
					</li>
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14 margin-bottom-sm" href="<?php echo esc_url( get_site_url() ); ?>/course/case-study-2-2/">Case study #2</a>
					</li>
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14 margin-bottom-sm" href="<?php echo esc_url( get_site_url() ); ?>/course/introduction-to-face-tracker/">Introduction to Face Tracker</a>
					</li>
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14 margin-bottom-sm" href="<?php echo esc_url( get_site_url() ); ?>/course/adding-assets-to-project/">Adding Assets to a Face Effect project</a>
					</li>
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14 margin-bottom-sm" href="<?php echo esc_url( get_site_url() ); ?>/course/adding-face-mesh-materials-and-textures/">Adding Face Mesh, Materials, and Textures</a>
					</li>
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14 margin-bottom-sm" href="<?php echo esc_url( get_site_url() ); ?>/course/attaching-2d-objects-to-face/">Adding 2D Objects onto a Face</a>
					</li>
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14 margin-bottom-sm" href="<?php echo esc_url( get_site_url() ); ?>/course/attaching-3d-assets-to-face/">Adding 3D Objects onto a Face</a>
					</li>
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14 margin-bottom-sm" href="<?php echo esc_url( get_site_url() ); ?>/course/testing-ar-effects/">Testing AR Effects </a>
					</li>
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14 margin-bottom-sm" href="<?php echo esc_url( get_site_url() ); ?>/course/project-settings/">Project Settings</a>
					</li>
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14 margin-bottom-sm" href="<?php echo esc_url( get_site_url() ); ?>/course/grouping-assets/">Grouping Assets</a>
					</li>
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14 margin-bottom-sm" href="<?php echo esc_url( get_site_url() ); ?>/course/introduction-to-occlusion/">Introduction to Occlusion</a>
					</li>
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14 margin-bottom-sm" href="<?php echo esc_url( get_site_url() ); ?>/course/adding-layers/">Adding Layers</a>
					</li>
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14 margin-bottom-sm" href="<?php echo esc_url( get_site_url() ); ?>/course/background-segmentation/">Background Segmentation</a>
					</li>
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14 margin-bottom-sm" href="<?php echo esc_url( get_site_url() ); ?>/course/introduction-to-image-sequences/">Introduction to Image Sequences </a>
					</li>
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14 margin-bottom-sm" href="<?php echo esc_url( get_site_url() ); ?>/course/animation-using-image-sequences/">Animation using Image Sequences</a>
					</li>
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14 margin-bottom-sm" href="<?php echo esc_url( get_site_url() ); ?>/course/adding-foreground-stickers/">Adding Foreground Stickers</a>
					</li>
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14 margin-bottom-sm" href="<?php echo esc_url( get_site_url() ); ?>/course/animating-the-foreground/">Animating the Foreground </a>
					</li>
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14 margin-bottom-sm" href="<?php echo esc_url( get_site_url() ); ?>/course/particle-systems/">Particle Systems</a>
					</li>
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14 margin-bottom-sm" href="<?php echo esc_url( get_site_url() ); ?>/course/particle-trigger-patch/">Particle Trigger Patch</a>
					</li>
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14 margin-bottom-sm" href="<?php echo esc_url( get_site_url() ); ?>/course/animation-using-sprite-sheets/">Animation using Sprite Sheets</a>
					</li>
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14 margin-bottom-sm" href="<?php echo esc_url( get_site_url() ); ?>/course/adding-sounds-to-your-face-effect/">Adding sounds to your Face Effect</a>
					</li>							
				</ul>
			</li><!--4-->
            <li class="margin-bottom margin-top">
				<a class="waves-attach txtDarkGrey fontXtraLight font14 padding-left-no padding-right-no" data-toggle="collapse" href="#m5">
					<div class="mainnav">
						Randomizers&nbsp;
					</div>
					<span class="icon margin-left-lg">keyboard_arrow_down</span>
				</a>
				<ul class="menu-collapse collapse margin-left-no" id="m5">
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14 margin-bottom-sm" href="<?php echo esc_url( get_site_url() ); ?>/course/introduction-to-randomizer/">Introduction to Randomizer</a>
					</li>
                    <li>
						<a class="waves-attach txtGrey fontXtraLight font14 margin-bottom-sm" href="<?php echo esc_url( get_site_url() ); ?>/course/case-study-1/">Case Study #1</a>
					</li>
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14 margin-bottom-sm" href="<?php echo esc_url( get_site_url() ); ?>/course/adding-3d-objects/">Adding 3D Objects from the Asset Package</a>
					</li>							
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14 margin-bottom-sm" href="<?php echo esc_url( get_site_url() ); ?>/course/3d-assets-from-the-asset-library/">Exploring 3D Assets in the Asset Library</a>
					</li>
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14 margin-bottom-sm" href="<?php echo esc_url( get_site_url() ); ?>/course/creating-your-own-3d-assets/">Creating your own 3D Assets</a>
					</li>							
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14 margin-bottom-sm" href="<?php echo esc_url( get_site_url() ); ?>/course/adding-3d-text/"> Adding 3D text</a>
					</li>
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14 margin-bottom-sm" href="<?php echo esc_url( get_site_url() ); ?>/course/logic-of-the-randomizer/">Logic of the Randomizer </a>
					</li>							
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14 margin-bottom-sm" href="<?php echo esc_url( get_site_url() ); ?>/course/creating-randomizer/">Creating the Randomizer</a>
					</li>
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14 margin-bottom-sm" href="<?php echo esc_url( get_site_url() ); ?>/course/creating-gradient-backgrounds/">Creating Gradient Backgrounds</a>
					</li>							
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14 margin-bottom-sm" href="<?php echo esc_url( get_site_url() ); ?>/course/creating-multiple-randomizer-backgrounds/">Creating Multiple Randomizer Backgrounds</a>
					</li>
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14 margin-bottom-sm" href="<?php echo esc_url( get_site_url() ); ?>/course/creating-a-default-background-for-the-randomizer/">Creating a Default Background for the Randomizer</a>
					</li>
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14 margin-bottom-sm" href="<?php echo esc_url( get_site_url() ); ?>/course/visibility-of-3d-text-title/">Making 3D Text Visible in a Randomizer</a>
					</li>							
				</ul>
			</li><!--5-->
            <li class="margin-bottom margin-top">
				<a class="waves-attach txtDarkGrey fontXtraLight font14 padding-left-no padding-right-no" data-toggle="collapse" href="#m6">
					<div class="mainnav">
						Plane Trackers&nbsp;
					</div>
					<span class="icon margin-left-lg">keyboard_arrow_down</span>
				</a>
				<ul class="menu-collapse collapse margin-left-no" id="m6">
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14 margin-bottom-sm" href="<?php echo esc_url( get_site_url() ); ?>/course/introduction-to-plane-trackers/">Introduction to Plane Trackers</a>
					</li>
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14 margin-bottom-sm" href="<?php echo esc_url( get_site_url() ); ?>/course/case-study-1-3/">Case study #1</a>
					</li>							
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14 margin-bottom-sm" href="<?php echo esc_url( get_site_url() ); ?>/course/case-study-2-3/">Case study #2</a>
					</li>
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14 margin-bottom-sm" href="<?php echo esc_url( get_site_url() ); ?>/course/placing-assets-in-world-space/">Placing Assets in World Space</a>
					</li>							
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14 margin-bottom-sm" href="<?php echo esc_url( get_site_url() ); ?>/course/adding-drop-shadow/">Adding a Drop Shadow</a>
					</li>
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14 margin-bottom-sm" href="<?php echo esc_url( get_site_url() ); ?>/course/animation-3d-object/">Animation for 3D Objects</a>
					</li>							
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14 margin-bottom-sm" href="<?php echo esc_url( get_site_url() ); ?>/course/animation-for-3d-particles/">Animation for 3D Particles</a>
					</li>
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14 margin-bottom-sm" href="<?php echo esc_url( get_site_url() ); ?>/course/introduction-to-ui-picker/">Introduction to the Native UI Picker</a>
					</li>							
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14 margin-bottom-sm" href="<?php echo esc_url( get_site_url() ); ?>/course/custom-interactions-and-instructions-for-the-native-ui-picker/">Custom Interactions and Instructions for the Native UI Picker</a>
					</li>							
				</ul>
			</li><!--6-->
            <li class="margin-bottom margin-top">
				<a class="waves-attach txtDarkGrey fontXtraLight font14 padding-left-no padding-right-no" data-toggle="collapse" href="#m7">
					<div class="mainnav">
						Portal Effects&nbsp;
					</div>
					<span class="icon margin-left-lg">keyboard_arrow_down</span>
				</a>
				<ul class="menu-collapse collapse margin-left-no" id="m7">
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14 margin-bottom-sm" href="<?php echo esc_url( get_site_url() ); ?>/course/creating-an-environment/">Creating an Environment</a>
					</li>
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14 margin-bottom-sm" href="<?php echo esc_url( get_site_url() ); ?>/course/creating-a-portal-2/">Creating a Portal</a>
					</li>							
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14 margin-bottom-sm" href="<?php echo esc_url( get_site_url() ); ?>/course/case-study-1-4/">Case Study #1</a>
					</li>							
				</ul>
			</li><!--7-->
            <li class="margin-bottom margin-top">
				<a class="waves-attach txtDarkGrey fontXtraLight font14 padding-left-no padding-right-no" data-toggle="collapse" href="#m8">
					<div class="mainnav">
					Target Trackers&nbsp;
					</div>
					<span class="icon margin-left-lg">keyboard_arrow_down</span>
				</a>
				<ul class="menu-collapse collapse margin-left-no" id="m8">
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14 margin-bottom-sm" href="<?php echo esc_url( get_site_url() ); ?>/course/introduction-to-target-tracking-2/">Introduction to Target Tracking</a>
					</li>
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14 margin-bottom-sm" href="<?php echo esc_url( get_site_url() ); ?>/course/case-study-1-5/">Case Study #1 </a>
					</li>
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14 margin-bottom-sm" href="<?php echo esc_url( get_site_url() ); ?>/course/case-study-2-4/">Case Study #2</a>
					</li>
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14 margin-bottom-sm" href="<?php echo esc_url( get_site_url() ); ?>/course/initiating-the-target-tracker/">Initiating the Target Tracker </a>
					</li>
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14 margin-bottom-sm" href="<?php echo esc_url( get_site_url() ); ?>/course/enabling-custom-instructions-in-your-target-tracker/">Enabling Custom Instructions in your Target Tracker</a>
					</li>
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14 margin-bottom-sm" href="<?php echo esc_url( get_site_url() ); ?>/course/creating-the-environment/">Creating the Environment using the Target Tracker</a>
					</li>
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14 margin-bottom-sm" href="<?php echo esc_url( get_site_url() ); ?>/course/adding-2d-objects/">Adding 2D Objects</a>
					</li>
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14 margin-bottom-sm" href="<?php echo esc_url( get_site_url() ); ?>/course/adding-3d-objects-2/">Adding 3D Objects</a>
					</li>
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14 margin-bottom-sm" href="<?php echo esc_url( get_site_url() ); ?>/course/animation-of-2d-and-3d-objects/">Animation of 2D and 3D Objects</a>
					</li>
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14 margin-bottom-sm" href="<?php echo esc_url( get_site_url() ); ?>/course/adjusting-the-particles/">Adjusting the Particles</a>
					</li>							
				</ul>
			</li><!--8-->
            <li class="margin-bottom margin-top">
				<a class="waves-attach txtDarkGrey fontXtraLight font14 padding-left-no padding-right-no" data-toggle="collapse" href="#m9">
					<div class="mainnav">
						Adding Audio&nbsp;
					</div>
					<span class="icon margin-left-lg">keyboard_arrow_down</span>
				</a>
				<ul class="menu-collapse collapse margin-left-no" id="m9">
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14 margin-bottom-sm" href="<?php echo esc_url( get_site_url() ); ?>/course/considerations-for-audio-in-ar/">Considerations for Audio in AR</a>
					</li>
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14 margin-bottom-sm" href="<?php echo esc_url( get_site_url() ); ?>/course/adding-audio-into-your-effect/">Adding Audio into your AR Effect</a>
					</li>							
				</ul>
			</li><!--9-->
            <li class="margin-bottom margin-top">
				<a class="waves-attach txtDarkGrey fontXtraLight font14 padding-left-no padding-right-no" data-toggle="collapse" href="#m10">
					<div class="mainnav">
						Publishing your Spark <br /> AR Effects &nbsp;
					</div>
					<span class="icon margin-left-lg">keyboard_arrow_down</span>
				</a>
				<ul class="menu-collapse collapse margin-left-no" id="m10">
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14 margin-bottom-sm" href="<?php echo esc_url( get_site_url() ); ?>/course/custom-instructions/">Custom Instructions</a>
					</li>
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14 margin-bottom-sm" href="<?php echo esc_url( get_site_url() ); ?>/course/export-your-ar-effects/">Export your AR Effects</a>
					</li>							
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14 margin-bottom-sm" href="<?php echo esc_url( get_site_url() ); ?>/course/publishing-your-ar-effects/">Publishing your Effect</a>
					</li>
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14 margin-bottom-sm" href="<?php echo esc_url( get_site_url() ); ?>/course/permission-groups-for-spark-ar-effects/">Permission Groups for <br /> Spark AR Effects</a>
					</li>							
				</ul>
			</li><!--10-->
            
            
		</ul><!--sideBar Nav-->
        
        <div class="sideBarBottomBorder margin-bottom margin-top-no"></div>
        <a href="<?php echo esc_url( get_site_url() ); ?>/glossary" class="txtGrey">
            <p class="txtGrey fontXtraLight font16 margin-bottom margin-top" style="display: flex; align-items: center;">									
            	<span class="icon icon-lg margin-right">sort</span>&nbsp;Glossary
            </p>
        </a>
	</div><!--SideBar Full Div-->							
</div><!--sideBar-->
