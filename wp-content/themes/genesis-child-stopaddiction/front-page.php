<?php
// Template Name: Full Width

add_filter( 'genesis_attr_site-inner', 'be_site_inner_attr' );
/**
 * Adds the attributes from 'entry', since this replaces the main entry.
 *
 * @author Bill Erickson
 * @link http://www.billerickson.net/full-width-landing-pages-in-genesis/
 *
 * @param array $attributes Existing attributes.
 * @return array Amended attributes.
 */
function be_site_inner_attr( $attributes ) {

    // Adds a class of 'full' for styling this .site-inner differently
    $attributes['class'] .= ' full';

    // Adds an id of 'genesis-content' for accessible skip links
    $attributes['id'] = 'genesis-content';

    // Adds the attributes from .entry, since this replaces the main entry
    $attributes = wp_parse_args( $attributes, genesis_attributes_entry( array() ) );

    return $attributes;
}

// Displays Header.
get_header();
?>
This Worked
<div class="green_block aligncenter light_green">
	<div class="wrap">

			<div class="green_top_title clearfix"><h2 class="green_title">What Can You Do to Stop Addiction?</h2></div>
			<div class="one-third first"><img src="/wp-content/themes/genesis-child-stopaddiction/images/info_graphic.png"/>
			<h4>Get Informed</h4>
			<p>Signs and symptoms of drug use, abuse and addiction, resource guides and more.</p>
			</div>
			<div class="one-third"><img src="/wp-content/themes/genesis-child-stopaddiction/images/helping_hands.png"/>
			<h4>Get Help</h4>
			<p>Get help for yourself or a loved one. Get in touch with an experienced specialist.</p>
			</div>
			<div class="one-third"><img src="/wp-content/themes/genesis-child-stopaddiction/images/raised_hands.png"/>
			<h4>Get Involved</h4>
			<p>The bet way to stop addiction is to fight back. Find out how you can get involved.</p>
			</div>

	</div>
</div>
<div class="green_block aligncenter">
	<div class="wrap">
		<p class="under_green">Resources</p>
		<div class="green_top_title clearfix">
			<div class="one-half first">
				<h2 style="text-align:left" class="green_title">For Parents,</h2>
				<h2 style="text-align:left" class="green_title">Family, &amp; Friends</h2>
			</div>
			<div class="one-half"></div>
		</div>
		<div class="green_top_content clearfix">
			<div class="one-half first">
				<p style="text-align:left" class="has-regular-font-size"><strong>Guides &amp; Helpful Resources</strong></p>
				<p style="text-align:left">How can you help a loved one with addiction? What do you do or say? Browse the articles and resources to find answers to common questions.</p>
			</div>

			<div class="one-half">
				<p style="text-align:left" class="has-regular-font-size"><strong>Drug Information</strong></p>
				<p style="text-align:left">Heroin and opioids, cocaine, marijuana, alcohol, and other drugs—find out the facts and education your self on the signs, symptoms, short and long term effects of drugs.</p>
			</div>
		</div>
	</div>
</div>
<div class="white_block aligncenter">
	<div class="wrap">
		<p class="under_white">Stories</p>
		<div class="green_top_title clearfix">
			<div class="one-half first">
				<h2 style="text-align:left" class="green_title">by Parents,</h2>
				<h2 style="text-align:left" class="green_title">Family, &amp; Friends</h2>
				<div class="white_content_img">
					<p style="text-align:left" class="has-regular-font-size"><strong>Hear it from other families</strong></p>
					<p style="text-align:left">Addiction does not discriminate, it knows no racial, social, religious or economic boundaries. When addiction happens in your family, it is devastating. Draw strength and inspiration from parents, husbands, wives, sisters, brothers and friends who have lived through it.</p>
				</div>
			</div>
			<div class="one-half">
			<img src="http://nnmockup.wpengine.com/wp-content/uploads/2018/09/stories-1.png"/>

			</div>
		</div>
	</div>
</div>
<div class="grey_block aligncenter">
	<div class="wrap">
		<p class="under_grey">Get Involved</p>
		<div class="green_top_title clearfix">
			<div class="one-half first">
				<h2 style="text-align:left" class="green_title">You can help.</h2>
			</div>
			<div class="one-half"></div>
		</div>
		<div class="green_top_content clearfix">
			<div class="one-half first">
				<p style="text-align:left" class="has-regular-font-size"><strong>Share your story.</strong></p>
				<p style="text-align:left">You’ve lived through the heartbreak, tears, fear and triumph over addiction. A story can help give strength and inspiration to others—tell yours. Working together we can stop addiction.</p>
			</div>

			<div class="one-half">
				<p style="text-align:left" class="has-regular-font-size"><strong>Donate.</strong></p>
				<p style="text-align:left">Donations are used to help get the word out. Arming enough people with the facts so they can take action, will make a change. Donations are also used for scholarships to help those families and individuals who have the desire to get help, but not the means. Find out how your contributions can help.</p>
			</div>
		</div>
	</div>
</div>



<?php
// Displays Content.
//the_post(); // sets the 'in the loop' property to true. Needed for Beaver Builder but not Elementor.
the_content();


// Displays Footer.
get_footer();
