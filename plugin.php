<?php
/**
 * Plugin Name: The Events Calendar Extension: Abbreviate Days of the Week in Month View
 * Description: Convert the full-length days of the week in the Month View to their three-letter abbreviations.
 * Version: 1.0.0
 * Author: Modern Tribe, Inc.
 * Author URI: http://m.tri.be/1971
 * License: GPLv2 or later
 */

defined( 'WPINC' ) or die;

class Tribe__Extension___Abbreviate_Days_of_Week_in_Month_View {

    /**
     * The semantic version number of this extension; should always match the plugin header.
     */
    const VERSION = '1.0.0';

    /**
     * Each plugin required by this extension
     *
     * @var array Plugins are listed in 'main class' => 'minimum version #' format
     */
    public $plugins_required = array(
        'Tribe__Events__Main' => '4.2'
    );

    /**
     * The constructor; delays initializing the extension until all other plugins are loaded.
     */
    public function __construct() {
        add_action( 'plugins_loaded', array( $this, 'init' ), 100 );
    }

    /**
     * Extension hooks and initialization; exits if the extension is not authorized by Tribe Common to run.
     */
    public function init() {

        // Exit early if our framework is saying this extension should not run.
        if ( ! function_exists( 'tribe_register_plugin' ) || ! tribe_register_plugin( __FILE__, __CLASS__, self::VERSION, $this->plugins_required ) ) {
            return;
        }

        add_filter( 'tribe_events_get_days_of_week', array( $this, 'tribe_abbreviate_month_view_day_names' ), 100 );
    }

    /**
     * Convert the full-length days of the week in the Month View to their three-letter abbreviations.
     *
     * @param array $days_of_week
     * @return array
     */
    public function tribe_abbreviate_month_view_day_names( $days_of_week ) {

        global $wp_locale;

        if ( ! tribe_is_month() ) {
            return $days_of_week;
        }

        foreach ( $days_of_week as $key => $day ) {
            $days_of_week[ $key ] = $wp_locale->get_weekday_abbrev( $day );
        }

        return $days_of_week;
    }
}

new Tribe__Extension___Abbreviate_Days_of_Week_in_Month_View();
