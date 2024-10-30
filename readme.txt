=== Contact Form Zero ===

Contributors: bhadaway
Donate link: https://calmestghost.com/donate
Tags: contact form, email, feedback, quote, anti-spam, shortcode, widget
Requires at least: 5.0
Tested up to: 6.4
Stable tag: 1.3
License: GPL
License URI: https://www.gnu.org/licenses/gpl.html

Add a stupidly simple and lightweight contact form to your website with `[contact-form-zero]`.

== Description ==

**Zero** Difficulty. **Zero** Spam.

Add a stupidly simple and lightweight contact form to your website in any page, post, or text widget with this shortcode:

`[contact-form-zero]`

The entire point of this plugin is to be completely hands-free, easy, and just work straight out-of-the-box. Simply plug and play without any settings to adjust.

If you're looking for the exact opposite of that, that is, a form you can custom build with advanced options, I recommend [Contact Form 7](https://wordpress.org/plugins/contact-form-7/).

### Features ###

* The most lightweight contact form plugin available for WordPress (no settings to adjust or forms to create)
* Name, Email, Phone, and Message form fields (phone field is optional for your visitors)
* Automatically sends emails to the email address set under *Settings > General > Administration Email Address*
* Highly effective and hidden anti-spam measures (no annoying CAPTCHAs required)
* Enable Google reCAPTCHA for additional protection if you like (usually no annoying CAPTCHAs required)
* Enable hCaptcha for additional protection if you like (CAPTCHAs required — only paid accounts offer invisible options)
* Fully compatible with all the protections of [Stop Spammers](https://wordpress.org/plugins/stop-spammer-registrations-plugin/)
* Easy to customize with CSS (please ask for help if you need it — I'm happy to write custom code for you to copy/paste)

### Optional Shortcode Attributes ###

`[contact-form-zero email="email@example.com"]` — Set a custom email address for form submissions to be sent to.

`[contact-form-zero accent="#000"]` — Change the accent color for the form.

`[contact-form-zero unstyled="yes"]` — Form is left naked for you or your theme to style.

`[contact-form-zero g-key="SITE KEY HERE"]` — Add your API key (google.com/recaptcha/admin/create) to enable Google reCAPTCHA.

`[contact-form-zero h-key="SITE KEY HERE"]` — Add your API key (dashboard.hcaptcha.com/sites/new) to enable hCaptcha.

== Installation ==

There are no settings to adjust. Simply use the `[contact-form-zero]` shortcode on any page, post, or text widget or in your theme code, use `<?php echo do_shortcode( '[contact-form-zero]' ); ?>`.

== Frequently Asked Questions ==

= Why am I not receiving emails? =

I'm using the built-in `wp_mail` function. Most hosting environments (even shared hosts like Bluehost and GoDaddy) can handle email, but not very well out-of-the-box and require being optimized. It actually takes quite a bit of work to make sure your emails are deliverable. Some recommendations:

* Check that your SPF, DKIM, and other email records are set up correctly ([mail-tester.com](https://www.mail-tester.com/) is a great all-around tool for checking and fixing common email deliverability issues)
* Even on shared hosts, you should be able to add a dedicated IP to your account for very cheap (which allows you to get away from shared IPs that have a bad reputation because your neighbors are spamming)
* If all else fails, you can abandon using your own server for mail altogether, and host offsite with a free or paid third-party service like Gmail (check out the [WP Mail SMTP](https://wordpress.org/plugins/wp-mail-smtp/) plugin to go that route)

= Why is the CAPTCHA not appearing on my form? =

The modern versions of Google reCAPTCHA and hCaptcha are relatively invisible. Be sure to send yourself a test message through your form.

== Changelog ==

= 1.3 =
* Added support for hCaptcha

= 1.2 =
* Added support for Google reCAPTCHA

= 1.1 =
* Minor code cleanup

= 1.0 =
* Translation-ready
* Various improvements

= 0.7 =
* Improved sanitization

= 0.6 =
* Improved spam protection even more

= 0.5 =
* Added optional shortcode attributes for customizing the form

= 0.4 =
* Improved spam protection

= 0.3 =
* PHP notice fix

= 0.2 =
* Added placeholders for form fields

= 0.1 =
* New