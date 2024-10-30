<?php
/*
Plugin Name: Contact Form Zero
Description: Add a stupidly simple and lightweight contact form to your website with this shortcode: [contact-form-zero].
Version: 1.3
Requires at least: 5.0
Author: Bryan Hadaway
Author URI: https://calmestghost.com/
License: GPL
License URI: https://www.gnu.org/licenses/gpl.html
Text Domain: contact-form-zero
*/

if ( !defined( 'ABSPATH' ) ) {
	http_response_code( 404 );
	die();
}

add_filter( 'widget_text', 'do_shortcode' );
add_shortcode( 'contact-form-zero', 'contact_form_zero_shortcode' );
function contact_form_zero_shortcode( $atts ) {
	$atts = shortcode_atts( array(
		'email'    => '',
		'accent'   => '',
		'unstyled' => '',
		'g-key'	   => '',
		'h-key'	   => '',
	), $atts );
	ob_start();
	if ( $atts['g-key'] ) {
		echo '
		<script src="https://www.google.com/recaptcha/api.js"></script>
		<script>
		function onSubmit(token) {
			document.getElementById("contact-form-zero").submit();
		}
		</script>
		';
	}
	if ( $atts['h-key'] ) {
		echo '
		<script src="https://js.hcaptcha.com/1/api.js"></script>
		<script>
		function onSubmit(token) {
			document.getElementById("contact-form-zero").submit();
		}
		</script>
		';
	}
	echo '
	<script>
	function nospam() {
		var message = document.forms["contact-form-zero"]["message"].value;
		var comment = document.getElementById("comment");
		var link = message.indexOf("http");
		if (link > -1) {
			comment.setCustomValidity("' . esc_html__( 'Links are welcome, but please remove the https:// portion of them.', 'contact-form-zero' ) . '");
			comment.reportValidity();
		} else {
			comment.setCustomValidity("");
			comment.reportValidity();
		}
	}
	</script>
	<form id="contact-form-zero" name="contact-form-zero" method="post" action="#send">
		<p id="name"><input type="text" name="sign" placeholder="' . esc_html__( 'Name', 'contact-form-zero' ) . '" autocomplete="off" size="35" required></p>
		<p id="email"><input type="email" name="email" placeholder="' . esc_html__( 'Email', 'contact-form-zero' ) . '" autocomplete="off" size="35" required></p>
		<p id="phone"><input type="tel" name="phone" placeholder="' . esc_html__( 'Phone (optional)', 'contact-form-zero' ) . '" autocomplete="off" size="35"></p>
		<p id="url"><input type="url" name="url" placeholder="' . esc_html__( 'URL', 'contact-form-zero' ) . '" value="https://example.com/" autocomplete="off" tabindex="-1" size="35" required></p>
		<p id="message"><textarea id="comment" name="message" placeholder="' . esc_html__( 'Message', 'contact-form-zero' ) . '" rows="5" cols="100" onkeyup="nospam()"></textarea></p>
		<p id="submit"><button' . ( esc_attr( $atts['g-key'] ) ? ' class="g-recaptcha" data-sitekey="' . esc_attr( $atts['g-key'] ) . '" data-callback="onSubmit" data-action="submit"' : '' ) . '' . ( esc_attr( $atts['h-key'] ) ? ' class="h-captcha" data-sitekey="' . esc_attr( $atts['h-key'] ) . '" data-callback="onSubmit" data-action="submit"' : '' ) . '>' . esc_html__( 'Submit', 'contact-form-zero' ) . '</button></p>
	</form>
	';
	if ( 'yes' == $atts['unstyled'] ) {
		echo '
		<style>
		#contact-form-zero #url{position:absolute;top:0;left:0;width:0;height:0;opacity:0;z-index:-1}
		#send{text-align:center;padding:5%}
		#send.success{color:green}
		#send.fail{color:red}
		</style>
		';
	} else {
		echo '
		<style>
		#contact-form-zero, #contact-form-zero *{box-sizing:border-box;transition:all 0.5s ease}
		#contact-form-zero input, #contact-form-zero textarea, #contact-form-zero button{width:100%;font-family:arial,sans-serif;font-size:14px;color:#767676;padding:15px;border:1px solid transparent;background:#f6f6f6}
		#contact-form-zero input:focus, #contact-form-zero textarea:focus, #contact-form-zero button:focus{color:#000;border:1px solid ' . ( esc_attr( $atts['accent'] ) ? esc_attr( $atts['accent'] ) : '#007acc' ) . ';outline:0}
		#contact-form-zero #submit input, #contact-form-zero #submit button{display:inline-block;font-size:18px;color:#fff;text-align:center;text-decoration:none;padding:15px 25px;background:' . ( esc_attr( $atts['accent'] ) ? esc_attr( $atts['accent'] ) : '#007acc' ) . ';cursor:pointer}
		#contact-form-zero #submit input:hover, #submit input:focus, #contact-form-zero #submit button:hover, #contact-form-zero #submit button:focus{opacity:0.8}
		#contact-form-zero #url{position:absolute;top:0;left:0;width:0;height:0;opacity:0;z-index:-1}
		#send{text-align:center;padding:5%}
		#send.success{color:green}
		#send.fail{color:red}
		</style>
		';
	}
	$url = isset( $_POST['url'] ) ? $_POST['url'] : '';
	$message = isset( $_POST['message'] ) ? $_POST['message'] : '';
	if ( ( esc_url( $url ) == 'https://example.com/' ) && ( stripos( $message, 'http' ) === false ) ) {
		if ( $atts['email'] ) {
			$to = sanitize_email( $atts['email'] );
		} else {
			$to = sanitize_email( get_option( 'admin_email' ) );
		}
		$subject = esc_html__( 'New Message from ', 'contact-form-zero' ) . esc_html( get_option( 'blogname' ) );
		$name    = sanitize_text_field( $_POST['sign'] );
		$email   = sanitize_email( $_POST['email'] );
		$phone   = sanitize_text_field( $_POST['phone'] );
		$message = sanitize_textarea_field( $_POST['message'] );
		$validated = true;
		if ( !$validated ) {
			print '<p id="send" class="fail">' . esc_html__( 'Message Failed', 'contact-form-zero' ) . '</p>';
			exit;
		}
		$body  = '';
		$body .= esc_html__( 'Name: ', 'contact-form-zero' );
		$body .= wp_unslash( $name );
		$body .= "\n";
		$body .= esc_html__( 'Email: ', 'contact-form-zero' );
		$body .= $email;
		if ( $_POST['phone'] ) {
			$body .= "\n";
			$body .= esc_html__( 'Phone: ', 'contact-form-zero' );
			$body .= $phone;
		}
		$body .= "\n\n";
		$body .= wp_unslash( $message );
		$body .= "\n";
		$success = wp_mail( $to, $subject, $body, esc_html__( 'From: ', 'contact-form-zero' ) . "$name <$email>" );
		if ( $success ) {
			print '<p id="send" class="success">' . esc_html__( 'Message Sent Successfully', 'contact-form-zero' ) . '</p>';
		} else {
			print '<p id="send" class="fail">' . esc_html__( 'Message Failed', 'contact-form-zero' ) . '</p>';
		}
	}
	$output = ob_get_clean();
	return $output;
}