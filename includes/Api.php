<?php // phpcs:ignore

namespace MastodonWP;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Api.
 */
class Api {
	/**
	 * Construct.
	 */
	public function __construct() {

	}

	/**
	 * Use cURL to make request.
	 *
	 * @param string $endpoint Endpoint.
	 *
	 * @return mixed
	 */
	public function make_request( $endpoint ) {
		$curl = curl_init();

		curl_setopt_array(
			$curl,
			array(
				CURLOPT_URL            => 'https://mstdn.social/api/v1/' . $endpoint,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING       => '',
				CURLOPT_MAXREDIRS      => 10,
				CURLOPT_TIMEOUT        => 0,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST  => 'GET',
			)
		);

		$response = curl_exec( $curl );
		curl_close( $curl );

		if ( $response ) {
			$response = json_decode( $response );
		}

		if ( is_object( $response ) && property_exists( $response, 'error' ) ) {
			return false;
		}

		return $response;
	}

	/**
	 * Get account ID from username.
	 *
	 * @param string $username Username.
	 * @return string ID.
	 */
	public function id_lookup( $username ) {
		$response = $this->make_request( 'accounts/lookup?acct=' . $username );

		return $response->id;
	}

	/**
	 * Get account statuses.
	 *
	 * @param string $id Account ID.
	 * @return array Statuses.
	 */
	public function get_statuses( $id ) {
		$response = $this->make_request( 'accounts/' . $id . '/statuses' );

		return $response;
	}
}
