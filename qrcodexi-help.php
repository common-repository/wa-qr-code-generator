<?php ?>
<div class="wrap">
  <div id="icon-edit" class="icon32 icon32-posts-post"></div>
    <h2><?php _e('EMI calculator Help file', 'emi-calculator'); ?></h2>
    <div class="tool-box">
	<div style="height:5px;"></div>
	
        <div>In order to use QR code XI you have to add following code.
            <p>
                    <div class="update-nag">[qrcode]</div> It will current page url  
                <br/>
                <h2>OR</h2>
                If you want to add custome content in QR Code Then use conent attribute as follows
                <br/>
                <b><div class="update-nag">[qrcode content="Put your content for QR code" size="80" alt="ALT_TEXT" class="classname"]</div></b>
            <ul>
                <li>size = Size is given for the size of QR Code it should be in Pixel</li>
                <li>alt = tool tip on Generated QR code => Default Value "Scan the QR Code"</li>
                <li>Classname = it will user defined class to Captcha for better css controll</li>
                <li> Shadow  = true</li>
            </ul>
                 <h2>OR</h2>
                 Place below function in your theme file where you want to display QR code.<br/>
                 <div class="update-nag"> &lt;?php   echo <b>qrcode_xi_shortcode(</b>array('content'=>'your custom content','size'=>75)<b>)</b> ?&gt;</div>
            </p>
        </div>
    </div>
</div>        