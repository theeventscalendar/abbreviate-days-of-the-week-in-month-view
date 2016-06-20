<?php
/**
 * Plugin Name: The Events Calendar — Abbreviate Days of the Week in Month View
 * Description: Convert the full-length days of the week in the Month View to their three-letter abbreviations.
 * Version: 1.0.0
 * Author: Modern Tribe, Inc.
 * Author URI: http://m.tri.be/1x
 * License: GPLv2 or later
 */

defined( 'WPINC' ) or die;

function tribe_abbreviate_month_view_day_names( $days_of_week ) {
	global $wp_locale;

	if ( ! tribe_is_month() ) {
		return $days_of_week;
	}

	foreach ( $days_of_week as $key => $day ) {
		$days_of_week[ $key ] = $wp_locale->get_weekday_abbrev( $day );
	}

	return $days_of_week;
}

add_filter( 'tribe_events_get_days_of_week', 'tribe_abbreviate_month_view_day_names', 100 );
