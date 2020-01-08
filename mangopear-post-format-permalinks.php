<?php

	/**
	 * Plugin Name: Mangopear: Post format permalinks
	 * Plugin URI: https://github.com/MangopearUK/Mangopear-Post-format-permalinks
	 * Description: Include the post format slug in your permalinks. Simply use the <code>%post_format%</code> tag as part of your custom permalink.
	 * Version: 1.3.0
	 * Author: Andi North (@MangopearUK)
	 * Author URI: https://mangopear.co.uk
	 */
	

	/**
	 * [1]  Set up string replacement function
	 *
	 *      @since 1.3.0
	 *
	 *      [a] If we're not using the %post_format% tag in our permalinks, bail early
	 *      [b] Get the post object
	 *      [c]	Get post format slug
	 *      [d]	Set the slug for standard posts
	 *      [e]	Apply the post format slug to the permalink
	 *      [f]	Add filter for it all to, you know, actually work...
	 */
	
	function mangopear_post_format_permalink($permalink, $post_id) {
		if (strpos($permalink, '%post_format%') === FALSE) return $permalink;	// [a]


		$post = get_post($post_id);												// [b]
		if (! $post) return $permalink;											// [b]


		$format = get_post_format($post->ID);									// [c]


		if (empty($format)) {													// [d]
			$format = apply_filters('post_format_standard_slug', 'standard');	// [d]
		}																		// [d]


		return str_replace('%post_format%', $format, $permalink);				// [e]
	}


	add_filter('post_link',      'mangopear_post_format_permalink', 10, 2);		// [f]
	add_filter('post_type_link', 'mangopear_post_format_permalink', 10, 2);		// [f]