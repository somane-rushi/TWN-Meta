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
			<div class="sideBarBottomBorder margin-bottom margin-top"></div>
		</div>
        <ul class="nav margin-bottom-sm margin-top-sm collapsible-region">
			<li class="margin-bottom-sm margin-top-sm">
				<a class="waves-attach txtDarkGrey fontXtraLight font14 padding-left-no padding-right-no sideNavFlex" data-toggle="collapse" href="#m1">
                	<div class=""> 
                    	<span class="icon txtNavBlue margin-right-sm">check_circle</span>Introduction Module&nbsp;
					</div>											
					<span class="icon margin-left-lg">keyboard_arrow_down</span>
				</a>
				<ul class="menu-collapse collapse margin-left" id="m1">
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14" href="#">Introduction (Part I)</a>
					</li>
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14" href="#">Introduction (Part II)</a>
					</li>							
				</ul>
			</li><!--1-->
            <li class="margin-bottom-sm margin-top-sm">
				<a class="waves-attach txtDarkGrey fontXtraLight font14 padding-left-no padding-right-no sideNavFlex" data-toggle="collapse" href="#m2">
					<div class="">
						<span class="icon txtNavBlue margin-right-sm">check_circle</span>Audio&nbsp;
					</div>
					<span class="icon margin-left-lg">keyboard_arrow_down</span>
				</a>
				<ul class="menu-collapse collapse margin-left" id="m2">
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14" href="#">Audio (Part I)</a>
					</li>
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14" href="#">Audio (Part II)</a>
					</li>							
				</ul>
			</li><!--2-->
            <li class="margin-bottom-sm margin-top-sm">
				<a class="waves-attach txtDarkGrey fontXtraLight font14 padding-left-no padding-right-no sideNavFlex" data-toggle="collapse" href="#m3">
					<div class="">
						<span class="icon txtNavBlue margin-right-sm">check_circle</span>Facebook Policies&nbsp;
					</div>
					<span class="icon margin-left-lg">keyboard_arrow_down</span>
				</a>
				<ul class="menu-collapse collapse margin-left" id="m3">
					<li>
                    	<a class="waves-attach txtGrey fontXtraLight font14" href="#">Facebook Policies (Part I)</a>
					</li>
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14" href="#">Facebook Policies (Part II)</a>
					</li>							
				</ul>
			</li><!--3-->
            <li class="margin-bottom-sm margin-top-sm">
				<a class="waves-attach txtDarkGrey fontXtraLight font14 padding-left-no padding-right-no sideNavFlex" data-toggle="collapse" href="#m4">
					<div class="">
						<span class="icon txtNavBlue margin-right-sm">check_circle</span>Publishing Your Effect&nbsp;		
					</div> 
					<span class="icon margin-left-lg">keyboard_arrow_down</span>
				</a>
				<ul class="menu-collapse collapse margin-left" id="m4">
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14" href="#">Publishing Your Effect (Part I)</a>
					</li>
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14" href="#">Publishing Your Effect (Part II)</a>
					</li>							
				</ul>
			</li><!--4-->
            <li class="margin-bottom-sm margin-top-sm">
				<a class="waves-attach txtDarkGrey fontXtraLight font14 padding-left-no padding-right-no sideNavFlex" data-toggle="collapse" href="#m5">
					<div class="">
						<span class="icon txtNavBlue margin-right-sm">check_circle</span>Face Effect&nbsp;
					</div>
					<span class="icon margin-left-lg">keyboard_arrow_down</span>
				</a>
				<ul class="menu-collapse collapse margin-left" id="m5">
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14" href="#">Face Effect (Part I)</a>
					</li>
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14" href="#">Face Effect (Part II)</a>
					</li>							
				</ul>
			</li><!--5-->
            <li class="margin-bottom-sm margin-top-sm">
				<a class="waves-attach txtDarkGrey fontXtraLight font14 padding-left-no padding-right-no sideNavFlex" data-toggle="collapse" href="#m6">
					<div class="">
						<span class="icon txtNavBlue margin-right-sm">check_circle</span>Case Study #1&nbsp;
					</div>
					<span class="icon margin-left-lg">keyboard_arrow_down</span>
				</a>
				<ul class="menu-collapse collapse margin-left" id="m6">
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14" href="#">Case Study #1 (Part I)</a>
					</li>
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14" href="#">Case Study #1 (Part II)</a>
					</li>							
				</ul>
			</li><!--6-->
            <li class="margin-bottom-sm margin-top-sm">
				<a class="waves-attach txtDarkGrey fontXtraLight font14 padding-left-no padding-right-no sideNavFlex" data-toggle="collapse" href="#m7">
					<div class="">
						<span class="icon txtNavBlue margin-right-sm">check_circle</span>Case Study #2&nbsp;
					</div>
					<span class="icon margin-left-lg">keyboard_arrow_down</span>
				</a>
				<ul class="menu-collapse collapse margin-left" id="m7">
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14" href="#">Case Study #2 (Part I)</a>
					</li>
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14" href="#">Case Study #2 (Part II)</a>
					</li>							
				</ul>
			</li><!--7-->
            <li class="margin-bottom-sm margin-top-sm">
				<a class="waves-attach txtDarkGrey fontXtraLight font14 padding-left-no padding-right-no sideNavFlex" data-toggle="collapse" href="#m8">
					<div class="">
						<span class="icon txtNavBlue margin-right-sm">check_circle</span>Introduction To Face Tracker &nbsp;
					</div>
					<span class="icon margin-left-lg">keyboard_arrow_down</span>
				</a>
				<ul class="menu-collapse collapse margin-left" id="m8">
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14" href="#">Introduction To Face Tracker  (Part I)</a>
					</li>
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14" href="#">Introduction To Face Tracker  (Part II)</a>
					</li>							
				</ul>
			</li><!--8-->
            <li class="margin-bottom-sm margin-top-sm">
				<a class="waves-attach txtDarkGrey fontXtraLight font14 padding-left-no padding-right-no sideNavFlex" data-toggle="collapse" href="#m9">
					<div class="">
						<span class="icon txtNavBlue margin-right-sm">check_circle</span>Adding Assets To Project&nbsp;
					</div>
					<span class="icon margin-left-lg">keyboard_arrow_down</span>
				</a>
				<ul class="menu-collapse collapse margin-left" id="m9">
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14" href="#">Adding Assets To Project (Part I)</a>
					</li>
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14" href="#">Adding Assets To Project (Part II)</a>
					</li>							
				</ul>
			</li><!--9-->
            <li class="margin-bottom-sm margin-top-sm">
				<a class="waves-attach txtDarkGrey fontXtraLight font14 padding-left-no padding-right-no sideNavFlex" data-toggle="collapse" href="#m10">
					<div class="">
						<span class="icon txtNavBlue margin-right-sm">check_circle</span>Face Tracker&nbsp;
					</div>
					<span class="icon margin-left-lg">keyboard_arrow_down</span>
				</a>
				<ul class="menu-collapse collapse margin-left" id="m10">
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14" href="#">Face Tracker (Part I)</a>
					</li>
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14" href="#">Face Tracker (Part II)</a>
					</li>							
				</ul>
			</li><!--10-->
			<li class="margin-bottom-sm margin-top-sm">
				<a class="waves-attach txtDarkGrey fontXtraLight font14 padding-left-no padding-right-no sideNavFlex" data-toggle="collapse" href="#m11">
					<div class="">
						<span class="icon txtNavBlue margin-right-sm">check_circle</span>Animation : Sprite Sheets&nbsp;
					</div>
					<span class="icon margin-left-lg">keyboard_arrow_down</span>
				</a>
				<ul class="menu-collapse collapse margin-left" id="m11">
					<li>
                    	<a class="waves-attach txtGrey fontXtraLight font14" href="#">Animation : Sprite Sheets (Part I)</a>
					</li>
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14" href="#">Animation : Sprite Sheets (Part II)</a>
					</li>							
				</ul>
			</li><!--11-->
			<li class="margin-bottom-sm margin-top-sm">
				<a class="waves-attach txtDarkGrey fontXtraLight font14 padding-left-no padding-right-no sideNavFlex" data-toggle="collapse" href="#m12">
					<div class="">
						<span class="icon txtNavBlue margin-right-sm">check_circle</span>Randomiser&nbsp;
					</div>
					<span class="icon margin-left-lg">keyboard_arrow_down</span>
				</a>
				<ul class="menu-collapse collapse margin-left" id="m5">
					<li>
                    	<a class="waves-attach txtGrey fontXtraLight font14" href="#">Randomiser (Part I)</a>
					</li>
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14" href="#">Randomiser (Part II)</a>
					</li>							
				</ul>
			</li><!--12-->
            <li class="margin-bottom-sm margin-top-sm">
				<a class="waves-attach txtDarkGrey fontXtraLight font14 padding-left-no padding-right-no sideNavFlex" data-toggle="collapse" href="#m13">
					<div class="">
						<span class="icon txtNavBlue margin-right-sm">check_circle</span>Plane Tracker&nbsp;
					</div>
					<span class="icon margin-left-lg">keyboard_arrow_down</span>
				</a>
				<ul class="menu-collapse collapse margin-left" id="m13">
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14" href="#">Plane Tracker (Part I)</a>
					</li>
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14" href="#">Plane Tracker (Part II)</a>
					</li>							
				</ul>
			</li><!--13-->
			<li class="margin-bottom-sm margin-top-sm">
				<a class="waves-attach txtDarkGrey fontXtraLight font14 padding-left-no padding-right-no sideNavFlex" data-toggle="collapse" href="#m14">
					<div class="">
						<span class="icon txtDarkGrey margin-right-sm">add_circle_outline</span>Portal Effect&nbsp;
					</div>
					<span class="icon margin-left-lg">keyboard_arrow_down</span>
				</a>
				<ul class="menu-collapse collapse in margin-left" id="m14">
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14 margin-bottom-sm" href="#">What is ‘portal’ in AR?<br/>
						- Case studies [World Environment Day 2021, Among Us]</a>
					</li>
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14 margin-bottom-sm" href="#">Creating a portal:<br/>- Creating a ‘door’ portal</a>
					</li>							
				</ul>
			</li><!--14-->
            <li class="margin-bottom-sm margin-top-sm">
				<a class="waves-attach txtDarkGrey fontXtraLight font14 padding-left-no padding-right-no sideNavFlex" data-toggle="collapse" href="#m15">
					<div class="">
						<span class="icon txtDarkGrey margin-right-sm">add_circle_outline</span>Image Tracker&nbsp;
					</div>
					<span class="icon margin-left-lg">keyboard_arrow_down</span>
				</a>
				<ul class="menu-collapse collapse margin-left" id="m15">
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14" href="#">Image Tracker (Part I)</a>
					</li>
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14" href="#">Image Tracker (Part II)</a>
					</li>							
				</ul>
			</li><!--15-->
			<li class="margin-bottom-sm margin-top-sm">
				<a class="waves-attach txtDarkGrey fontXtraLight font14 padding-left-no padding-right-no sideNavFlex" data-toggle="collapse" href="#m16">
					<div class="">
						<span class="icon txtDarkGrey margin-right-sm">add_circle_outline</span>Storytelling&nbsp;
					</div>
					<span class="icon margin-left-lg">keyboard_arrow_down</span>
				</a>
				<ul class="menu-collapse collapse margin-left" id="m16">
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14" href="#">Storytelling (Part I)</a>
					</li>
					<li>
						<a class="waves-attach txtGrey fontXtraLight font14" href="#">Storytelling (Part II)</a>
					</li>							
				</ul>
			</li><!--16-->
		</ul><!--sideBar Nav-->
	</div><!--SideBar Full Div-->							
</div><!--sideBar-->
