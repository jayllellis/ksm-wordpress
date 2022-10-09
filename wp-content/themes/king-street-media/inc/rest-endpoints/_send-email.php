<?php
add_action( 'rest_api_init', function () {
  register_rest_route( 'v1', 'send-email', array(
		'methods' => 'GET, POST',
		'callback' => 'ksm_send_email',
  ) );
} );

function ksm_send_email( WP_REST_Request $request ) {
$params = $request->get_params();

  $data = [
    'fullname' => $params['fullname'],
    'email' => $params['email'],
    'subject' => $params['subject'],
    'message' => $params['message'],
  ];

  if( empty($params['fullname']) || empty($params['email']) || empty($params['subject']) || empty($params['message']) ) {
    return array(
      'status' => 'error',
      'message' => 'There was an error sending your email.',
    );
  }

  $email = $data['email'];
  $fullname = $data['fullname'];
//   $subject = 'Contact Form Submission';
  $subject = $data['subject'];
  $to = 'hello@kingstreetmedia.ca';
  
  $message = '<div style="border-top:5px solid #000; border-bottom:1px solid #999; background:#fff; padding:30px 5px 5px 5px; font: 10pt/1.5 Arial, Helvetica, sans-serif">';

  $message .= '<p style="font: 10pt/1.5 Arial, Helvetica, sans-serif;">';
  $message .= '<strong>Name:</strong> '.$fullname.'<br>';
  $message .= '<strong>Email:</strong> '.$email.'<br>';
  $message .= '<br><strong>Message:</strong><br>';
  $message .= nl2br($data['message']);// Get message
  $message .= '</p>';

  $message .= '<p style="font: 7pt/1.5 Arial, Helvetica, sans-serif; color:#ccc">';
  $message .= '--';
  $message .= 'This e-mail was sent from a contact form on '.get_bloginfo('name');
  $message .= '<p>';
  $message .= '</div>';
  
  // $message = nl2br($data['message']);// Get message

  // $headers[] = 'MIME-Version: 1.0' . "\r\n";
  $headers[] = "Content-type: text/html; charset=UTF-8 \r\n";
  // $headers[] = "X-Mailer: PHP \r\n";
  // $headers[] = "From: $fullname <$email> \r\n";
  $headers[] = "From: No Reply <noreply@kingstreetmedia.ca> \r\n";
  $headers[] = "Reply-To: $fullname <$email> \r\n";
  $headers[] = "Bcc: submissions@jasonellis.ca \r\n";

  $sent = wp_mail( $to, $subject, $message, $headers);

  if( $sent ) {
    return array(
      'status' => 'success',
      'message' => 'Email sent successfully!',
    );
  }
  else{
    return array(
      'status' => 'error',
      'message' => 'There was an error sending your email.',
    );
  }
}
