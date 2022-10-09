<?php
add_action( 'rest_api_init', function () {
  register_rest_route( 'v1', 'mailchimp', array(
		'methods' => 'POST',
		'callback' => 'ksm_mailchimp',
  ) );
} );

function ksm_mailchimp( WP_REST_Request $request ) {
	// require_once '/path/to/MailchimpMarketing/vendor/autoload.php';
	require_once ABSPATH.'/../vendor/autoload.php';

	$api_key = 'e66f26b8ec0a2957551720250a732ebc-us20';
	// $list_id = 'cfc877dd10';
	$list_id = 'cd8c34a4d1';
	$server_id = 'us20';

	$client = new MailchimpMarketing\ApiClient();
	$client->setConfig([
		// 'apiKey' => '74f25a8721dd651c84e95ac59de4ddad-us14',
		// 'server' => 'us14',
		'apiKey' => $api_key,
		'server' => $server_id,
	]);

	$params = $request->get_params();

	try {
		$response = $client->lists->addListMember($list_id, [
			"email_address" => $params['email'],
			"status" => "subscribed",
			// "status" => "pending",
		]);
		return $response;
	}
	catch (GuzzleHttp\Exception\ClientException $e) {
		$response = $e->getResponse();
		$responseBodyAsString = $response->getBody()->getContents();
		return json_decode($responseBodyAsString);
	}

	// return json_decode($response);

	/* require_once ABSPATH.'/wp-content/themes/ksm-landing/inc/vendor/MailChimp.php';
	use \DrewM\MailChimp\MailChimp;

	$MailChimp = new MailChimp('74f25a8721dd651c84e95ac59de4ddad-us14');

	$list_id = 'cfc877dd10';

	$result = $MailChimp->post("lists/$list_id/members", [
					'email_address' => 'jayllellis@gmail.com',
					'status'        => 'subscribed',
				]);

	// print_r($result);

	return $result;

	// return ABSPATH.'/wp-content/themes/ksm-landing/inc/vendor/MailChimp.php'; */
}
