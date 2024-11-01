=== Plugin Name ===
Contributors: (vkt005)
Donate link: http://webassistance24x7.com/
Tags: barcode, qrcode
Requires at least: 2.0.5
Tested up to: 4.5.3
Stable tag: 1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Use Wa QRcode generate to put QR code to you post, page or content area or widget area without editing your theme files

== Description ==

Use Wa QRcode  as shortcode in post content or widget area without editing your theme files

USAGE:
Use [qrcode] 
OR 
[qrcode content="Put your content for QR code" size="80" alt="ALT_TEXT" class="classname"] 

shortcode in your post content to show the QR Code without editing your theme files

EXAMPLE:
[qrcode] it will qr code of   current page url 
OR 
[qrcode content="Put your content for QR code" size="80" alt="ALT_TEXT" class="classname"]

size = Size is given for the size of QR Code it should be in Pixel

alt = tool tip on Generated QR code => Default Value "Scan the QR Code"

Classname = it will user defined class to Captcha for better css controll

Shadow = true

OR

Place below function in your theme file where you want to display QR code.

<?php
 echo qrcode_xi_shortcode(array('content'=>'your custom content','size'=>75)) 
?>

OR

By using QR code button in Editor

== Installation ==

1. Upload all plugin file to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress

= Our Other Plugins =
1. <a href="https://wordpress.org/plugins/os-emi-calculator/" target="_blank" title="Emi Calculator">Emi Calculator</a>

== Screenshots ==

1. This screen shot description corresponds to screenshot-1.(png|jpg|jpeg|gif). Note that the screenshot is taken from
the /assets directory or the directory that contains the stable readme.txt (tags or trunk). Screenshots in the /assets 
directory take precedence. For example, `/assets/screenshot-1.png` would win over `/tags/4.3/screenshot-1.png` 
(or jpg, jpeg, gif).
2. This is the second screen shot

== Changelog ==

= 1.0 =
* This is first release of WA QRcode generator suggestion are requested in order to enhance this plugin

