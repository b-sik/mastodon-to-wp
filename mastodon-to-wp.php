<?php // phpcs:ignore
/**
 * Plugin Name: Mastodon to WP
 * Plugin URI: https://bsik.dev
 * Description: Automatically create WordPress posts from your Mastodon posts/toots.
 * Version: 0.0.1
 * Author: Brian Siklinski
 *
 * @package MastodonToWP
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once __DIR__ . '/vendor/autoload.php';

use MastodonWP\Api;

/**
 * Mastodon To WP.
 */
class MastodonToWP {

	/**
	 * Construct.
	 */
	public function __construct() {

	}

	public function init() {
		$api = new Api();
		$id  = $api->id_lookup( 'bsik' );
		if ( $id ) {
			$statuses = $api->get_statuses( $id );
			dd( $statuses );
		}

	}
}

$mastodon_to_wp = new MastodonToWP();
$mastodon_to_wp->init();
