<?php
/**
 * Getting Started
 *
 * @package REQUEST_A_QUOTE
 * @since WPAS 5.3
 */
if (!defined('ABSPATH')) exit;
add_action('request_a_quote_getting_started', 'request_a_quote_getting_started');
/**
 * Display getting started information
 * @since WPAS 5.3
 *
 * @return html
 */
function request_a_quote_getting_started() {
	global $title;
	list($display_version) = explode('-', REQUEST_A_QUOTE_VERSION);
?>
<style>
.about-wrap img{
max-height: 200px;
}
div.comp-feature {
    font-weight: 400;
    font-size:20px;
}
.edition-com {
    display: none;
}
.green{
color: #008000;
font-size: 30px;
}
#nav-compare:before{
    content: "\f179";
}
#emd-about .nav-tab-wrapper a:before{
    position: relative;
    box-sizing: content-box;
padding: 0px 3px;
color: #4682b4;
    width: 20px;
    height: 20px;
    overflow: hidden;
    white-space: nowrap;
    font-size: 20px;
    line-height: 1;
    cursor: pointer;
font-family: dashicons;
}
#nav-getting-started:before{
content: "\f102";
}
#nav-release-notes:before{
content: "\f348";
}
#nav-resources:before{
content: "\f118";
}
#nav-features:before{
content: "\f339";
}
#emd-about .embed-container { 
	position: relative; 
	padding-bottom: 56.25%;
	height: 0;
	overflow: hidden;
	max-width: 100%;
	height: auto;
	} 

#emd-about .embed-container iframe,
#emd-about .embed-container object,
#emd-about .embed-container embed { 
	position: absolute;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
	}
#emd-about ul li:before{
    content: "\f522";
    font-family: dashicons;
    font-size:25px;
 }
#gallery {
	margin: auto;
}
#gallery .gallery-item {
	float: left;
	margin-top: 10px;
	margin-right: 10px;
	text-align: center;
	width: 48%;
        cursor:pointer;
}
#gallery img {
	border: 2px solid #cfcfcf; 
height: 405px;  
}
#gallery .gallery-caption {
	margin-left: 0;
}
#emd-about .top{
text-decoration:none;
}
#emd-about .toc{
    background-color: #fff;
    padding: 25px;
    border: 1px solid #add8e6;
    border-radius: 8px;
}
#emd-about h3,
#emd-about h2{
    margin-top: 0px;
    margin-right: 0px;
    margin-bottom: 0.6em;
    margin-left: 0px;
}
#emd-about p,
#emd-about .emd-section li{
font-size:18px
}
#emd-about a.top:after{
content: "\f342";
    font-family: dashicons;
    font-size:25px;
text-decoration:none;
}
#emd-about .toc a,
#emd-about a.top{
vertical-align: top;
}
#emd-about li{
list-style-type: none;
line-height: normal;
}
#emd-about ol li {
    list-style-type: decimal;
}
#emd-about .quote{
    background: #fff;
    border-left: 4px solid #088cf9;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    margin-top: 25px;
    padding: 1px 12px;
}
#emd-about .tooltip{
    display: inline;
    position: relative;
}
#emd-about .tooltip:hover:after{
    background: #333;
    background: rgba(0,0,0,.8);
    border-radius: 5px;
    bottom: 26px;
    color: #fff;
    content: 'Click to enlarge';
    left: 20%;
    padding: 5px 15px;
    position: absolute;
    z-index: 98;
    width: 220px;
}
</style>

<?php add_thickbox(); ?>
<div id="emd-about" class="wrap about-wrap">
<div id="emd-header" style="padding:10px 0" class="wp-clearfix">
<div style="float:right"><img src="https://emd-plugins.s3.amazonaws.com/request-a-quote-arch-320x200.gif"></div>
<div style="margin: .2em 200px 0 0;padding: 0;color: #32373c;line-height: 1.2em;font-size: 2.8em;font-weight: 400;">
<?php printf(__('Welcome to Request a quote Community %s', 'request-a-quote') , $display_version); ?>
</div>

<p class="about-text">
<?php printf(__("Request a quote provides an easy to use request a quote form, stores and displays quote requests from customers. It also has fully customizable notification system for customers and admin.", 'request-a-quote') , $display_version); ?>
</p>

<?php
	$tabs['getting-started'] = __('Getting Started', 'request-a-quote');
	$tabs['release-notes'] = __('Release Notes', 'request-a-quote');
	$tabs['resources'] = __('Resources', 'request-a-quote');
	$tabs['features'] = __('Features', 'request-a-quote');
	$active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'getting-started';
	echo '<h2 class="nav-tab-wrapper wp-clearfix">';
	foreach ($tabs as $ktab => $mytab) {
		$tab_url[$ktab] = esc_url(add_query_arg(array(
			'tab' => $ktab
		)));
		$active = "";
		if ($active_tab == $ktab) {
			$active = "nav-tab-active";
		}
		echo '<a href="' . esc_url($tab_url[$ktab]) . '" class="nav-tab ' . $active . '" id="nav-' . $ktab . '">' . $mytab . '</a>';
	}
	echo '</h2>';
?>
<?php echo '<div class="tab-content" id="tab-getting-started"';
	if ("getting-started" != $active_tab) {
		echo 'style="display:none;"';
	}
	echo '>';
?>
<div style="height:25px" id="rtop"></div><div class="toc"><h3 style="color:#0073AA;text-align:left;">Quickstart</h3><ul><li><a href="#gs-sec-264">Live Demo Site</a></li>
<li><a href="#gs-sec-266">Need Help?</a></li>
<li><a href="#gs-sec-267">Learn More</a></li>
<li><a href="#gs-sec-265">Installation, Configuration & Customization Service</a></li>
<li><a href="#gs-sec-53">Request a Quote Introduction</a></li>
<li><a href="#gs-sec-55">EMD CSV Import Export Extension allows getting your quote requests in and out of WordPress quickly</a></li>
<li><a href="#gs-sec-54">EMD Advanced Filters and Columns Extension for finding what's important faster</a></li>
<li><a href="#gs-sec-130">EMD MailChimp Extension for building email list through Request a quote Community</a></li>
<li><a href="#gs-sec-190">EMD Incoming Email Addon to get RFQ or RFI from customer emails</a></li>
</ul></div><div class="quote">
<p class="about-description">The secret of getting ahead is getting started - Mark Twain</p>
</div>
<div id="gs-sec-264"></div><div style="color:white;background:#0000003b;padding:5px 10px;font-size: 1.4em;font-weight: 600;">Live Demo Site</div><div class="changelog emd-section getting-started-264" style="margin:0;background-color:white;padding:10px"><div id="gallery" class="wp-clearfix"></div><div class="sec-desc"><p>Feel free to check out our <a target="_blank" href="https://requestaquote.emdplugins.com//?pk_campaign=request-a-quote-gettingstarted&pk_kwd=request-a-quote-livedemo">live demo site</a> to learn how to use Request a quote Community starter edition. The demo site will always have the latest version installed.</p>
<p>You can also use the demo site to identify possible issues. If the same issue exists in the demo site, open a support ticket and we will fix it. If a Request a quote Community feature is not functioning or displayed correctly in your site but looks and works properly in the demo site, it means the theme or a third party plugin or one or more configuration parameters of your site is causing the issue.</p>
<p>If you'd like us to identify and fix the issues specific to your site, purchase a work order to get started.</p>
<p><a target="_blank" style="
    padding: 16px;
    background: coral;
    border: 1px solid lightgray;
    border-radius: 12px;
    text-decoration: none;
    color: white;
    margin: 10px 0;
    display: inline-block;" href="https://emdplugins.com/expert-service-pricing/?pk_campaign=request-a-quote-gettingstarted&pk_kwd=request-a-quote-livedemo">Purchase Work Order</a></p></div></div><div style="margin-top:15px"><a href="#rtop" class="top">Go to top</a></div><hr style="margin-top:40px"><div id="gs-sec-266"></div><div style="color:white;background:#0000003b;padding:5px 10px;font-size: 1.4em;font-weight: 600;">Need Help?</div><div class="changelog emd-section getting-started-266" style="margin:0;background-color:white;padding:10px"><div id="gallery" class="wp-clearfix"></div><div class="sec-desc"><p>There are many resources available in case you need help:</p>
<ul>
<li>Search our <a target="_blank" href="https://emdplugins.com/support">knowledge base</a></li>
<li><a href="https://emdplugins.com/kb_tags/request-a-quote" target="_blank">Browse our Request a quote Community articles</a></li>
<li><a href="https://docs.emdplugins.com/docs/request-a-quote-community-documentation" target="_blank">Check out Request a quote Community documentation for step by step instructions.</a></li>
<li><a href="https://emdplugins.com/emdplugins-support-introduction/" target="_blank">Open a support ticket if you still could not find the answer to your question</a></li>
</ul>
<p>Please read <a href="https://emdplugins.com/questions/what-to-write-on-a-support-ticket-related-to-a-technical-issue/" target="_blank">"What to write to report a technical issue"</a> before submitting a support ticket.</p></div></div><div style="margin-top:15px"><a href="#rtop" class="top">Go to top</a></div><hr style="margin-top:40px"><div id="gs-sec-267"></div><div style="color:white;background:#0000003b;padding:5px 10px;font-size: 1.4em;font-weight: 600;">Learn More</div><div class="changelog emd-section getting-started-267" style="margin:0;background-color:white;padding:10px"><div id="gallery" class="wp-clearfix"></div><div class="sec-desc"><p>The following articles provide step by step instructions on various concepts covered in Request a quote Community.</p>
<ul><li>
<a target="_blank" href="https://docs.emdplugins.com/docs/request-a-quote-community-documentation/#article401">Concepts</a>
</li>
<li>
<a target="_blank" href="https://docs.emdplugins.com/docs/request-a-quote-community-documentation/#article449">Quick Start</a>
</li>
<li>
<a target="_blank" href="https://docs.emdplugins.com/docs/request-a-quote-community-documentation/#article402">Working with Quotes</a>
</li>
<li>
<a target="_blank" href="https://docs.emdplugins.com/docs/request-a-quote-community-documentation/#article403">Standards</a>
</li>
<li>
<a target="_blank" href="https://docs.emdplugins.com/docs/request-a-quote-community-documentation/#article404">Forms</a>
</li>
<li>
<a target="_blank" href="https://docs.emdplugins.com/docs/request-a-quote-community-documentation/#article405">Notifications</a>
</li>
<li>
<a target="_blank" href="https://docs.emdplugins.com/docs/request-a-quote-community-documentation/#article406">Administration</a>
</li>
<li>
<a target="_blank" href="https://docs.emdplugins.com/docs/request-a-quote-community-documentation/#article410">Screen Options</a>
</li>
<li>
<a target="_blank" href="https://docs.emdplugins.com/docs/request-a-quote-community-documentation/#article409">Localization(l10n)</a>
</li>
<li>
<a target="_blank" href="https://docs.emdplugins.com/docs/request-a-quote-community-documentation/#article408">Creating Shortcodes</a>
</li>
<li>
<a target="_blank" href="https://docs.emdplugins.com/docs/request-a-quote-community-documentation/#article407">Help Screens</a>
</li>
<li>
<a target="_blank" href="https://docs.emdplugins.com/docs/request-a-quote-community-documentation/#article411">Customizations</a>
</li>
<li>
<a target="_blank" href="https://docs.emdplugins.com/docs/request-a-quote-community-documentation/#article412">Glossary</a>
</li></ul>
</div></div><div style="margin-top:15px"><a href="#rtop" class="top">Go to top</a></div><hr style="margin-top:40px"><div id="gs-sec-265"></div><div style="color:white;background:#0000003b;padding:5px 10px;font-size: 1.4em;font-weight: 600;">Installation, Configuration & Customization Service</div><div class="changelog emd-section getting-started-265" style="margin:0;background-color:white;padding:10px"><div id="gallery" class="wp-clearfix"></div><div class="sec-desc"><p>Get the peace of mind that comes from having Request a quote Community properly installed, configured or customized by eMarket Design.</p>
<p>Being the developer of Request a quote Community, we understand how to deliver the best value, mitigate risks and get the software ready for you to use quickly.</p>
<p>Our service includes:</p>
<ul>
<li>Professional installation by eMarket Design experts.</li>
<li>Configuration to meet your specific needs</li>
<li>Installation completed quickly and according to best practice</li>
<li>Knowledge of Request a quote Community best practices transferred to your team</li>
</ul>
<p>Pricing of the service is based on the complexity of level of effort, required skills or expertise. To determine the estimated price and duration of this service, and for more information about related services, purchase a work order.  
<p><a target="_blank" style="
    padding: 16px;
    background: coral;
    border: 1px solid lightgray;
    border-radius: 12px;
    text-decoration: none;
    color: white;
    margin: 10px 0;
    display: inline-block;" href="https://emdplugins.com/expert-service-pricing/?pk_campaign=request-a-quote-gettingstarted&pk_kwd=request-a-quote-livedemo">Purchase Work Order</a></p></div></div><div style="margin-top:15px"><a href="#rtop" class="top">Go to top</a></div><hr style="margin-top:40px"><div id="gs-sec-53"></div><div style="color:white;background:#0000003b;padding:5px 10px;font-size: 1.4em;font-weight: 600;">Request a Quote Introduction</div><div class="changelog emd-section getting-started-53" style="margin:0;background-color:white;padding:10px"><div class="emd-yt" data-youtube-id="13gGmII_SM4" data-ratio="16:9">loading...</div><div class="sec-desc"><p>Watch Request a Quote Introduction video to learn about the plugin features and configuration.</p></div></div><div style="margin-top:15px"><a href="#rtop" class="top">Go to top</a></div><hr style="margin-top:40px"><div id="gs-sec-55"></div><div style="color:white;background:#0000003b;padding:5px 10px;font-size: 1.4em;font-weight: 600;">EMD CSV Import Export Extension allows getting your quote requests in and out of WordPress quickly</div><div class="changelog emd-section getting-started-55" style="margin:0;background-color:white;padding:10px"><div class="emd-yt" data-youtube-id="tJDQbU3jS0c" data-ratio="16:9">loading...</div><div class="sec-desc"><p>EMD CSV Import Export Extension helps bulk import, export, update quote requests information from/to CSV files. You can also reset(delete) all data and start over again without modifying database. The export feature is also great for backups and archiving old or obsolete data.</p>
<p><a href="https://emdplugins.com/plugin-features/request-a-quote-importexport-addon/?pk_campaign=emdimpexp-buybtn&pk_kwd=raq-resources"><img src="https://emd-plugins.s3.amazonaws.com/button_buy-now.png"></a></p></div></div><div style="margin-top:15px"><a href="#rtop" class="top">Go to top</a></div><hr style="margin-top:40px"><div id="gs-sec-54"></div><div style="color:white;background:#0000003b;padding:5px 10px;font-size: 1.4em;font-weight: 600;">EMD Advanced Filters and Columns Extension for finding what's important faster</div><div class="changelog emd-section getting-started-54" style="margin:0;background-color:white;padding:10px"><div class="emd-yt" data-youtube-id="JDIHIibWyR0" data-ratio="16:9">loading...</div><div class="sec-desc"><p>EMD Advanced Filters and Columns Extension for "Request a Quote" WordPress Plugin allows to:</p><ul><li>filter of sales quote requests</li><li>save frequently used filters</li><li>sort quote request columns</li><li>change the display order of columns</li><li>export search results to PDF or CSV</li></ul><div style="margin:25px"><a href="https://emdplugins.com/plugin-features/request-a-quote-smart-search-addon/?pk_campaign=emd-afc-buybtn&pk_kwd=raq-resources"><img src="https://emd-plugins.s3.amazonaws.com/button_buy-now.png"></a></div></div></div><div style="margin-top:15px"><a href="#rtop" class="top">Go to top</a></div><hr style="margin-top:40px"><div id="gs-sec-130"></div><div style="color:white;background:#0000003b;padding:5px 10px;font-size: 1.4em;font-weight: 600;">EMD MailChimp Extension for building email list through Request a quote Community</div><div class="changelog emd-section getting-started-130" style="margin:0;background-color:white;padding:10px"><div class="emd-yt" data-youtube-id="Oi_c-0W1Sdo" data-ratio="16:9">loading...</div><div class="sec-desc"><p>EMD MailChimp Extension helps you build MailChimp email list based on the contact information collected through Request a quote Community form.</p><div style="margin:25px"><a href="https://emdplugins.com/plugin-features/request-a-quote-mailchimp-addon/?pk_campaign=emd-mailchimp-buybtn&pk_kwd=request-a-quote-resources"><img src="https://emd-plugins.s3.amazonaws.com/button_buy-now.png"></a></div></div></div><div style="margin-top:15px"><a href="#rtop" class="top">Go to top</a></div><hr style="margin-top:40px"><div id="gs-sec-190"></div><div style="color:white;background:#0000003b;padding:5px 10px;font-size: 1.4em;font-weight: 600;">EMD Incoming Email Addon to get RFQ or RFI from customer emails</div><div class="changelog emd-section getting-started-190" style="margin:0;background-color:white;padding:10px"><div id="gallery" class="wp-clearfix"></div><div class="sec-desc"><p>EMD Incoming Email Addon helps you get  request for quotation (RFQ) or request for information (RFI) from customer emails to your site.</p><div style="margin:25px"><a href="https://emdplugins.com/plugin-features/request-a-quote-incoming-email-addon/?pk_campaign=emd-mailchimp-buybtn&pk_kwd=request-a-quote-resources"><img src="https://emd-plugins.s3.amazonaws.com/button_buy-now.png"></a></div></div></div><div style="margin-top:15px"><a href="#rtop" class="top">Go to top</a></div><hr style="margin-top:40px">

<?php echo '</div>'; ?>
<?php echo '<div class="tab-content" id="tab-release-notes"';
	if ("release-notes" != $active_tab) {
		echo 'style="display:none;"';
	}
	echo '>';
?>
<p class="about-description">This page lists the release notes from every production version of Request a quote Community.</p>


<h3 style="font-size: 18px;font-weight:700;color: white;background: #708090;padding:5px 10px;width:155px;border: 2px solid #fff;border-radius:4px;text-align:center">1.9.6 changes</h3>
<div class="wp-clearfix"><div class="changelog emd-section whats-new whats-new-899" style="margin:0">
<h3 style="font-size:18px;" class="tweak"><div  style="font-size:110%;color:#33b5e5"><span class="dashicons dashicons-admin-settings"></span> TWEAK</div>
misc. library updates and improve compatibility with the latest WordPress version</h3>
<div ></a></div></div></div><hr style="margin:30px 0">
<h3 style="font-size: 18px;font-weight:700;color: white;background: #708090;padding:5px 10px;width:155px;border: 2px solid #fff;border-radius:4px;text-align:center">1.9.5 changes</h3>
<div class="wp-clearfix"><div class="changelog emd-section whats-new whats-new-852" style="margin:0">
<h3 style="font-size:18px;" class="tweak"><div  style="font-size:110%;color:#33b5e5"><span class="dashicons dashicons-admin-settings"></span> TWEAK</div>
Emd templating system to match modern web standards</h3>
<div ></a></div></div></div><hr style="margin:30px 0"><div class="wp-clearfix"><div class="changelog emd-section whats-new whats-new-851" style="margin:0">
<h3 style="font-size:18px;" class="new"><div style="font-size:110%;color:#00C851"><span class="dashicons dashicons-megaphone"></span> NEW</div>
Created a new shortcode page which displays all available shortcodes. You can access this page under the plugin settings.</h3>
<div ></a></div></div></div><hr style="margin:30px 0">
<h3 style="font-size: 18px;font-weight:700;color: white;background: #708090;padding:5px 10px;width:155px;border: 2px solid #fff;border-radius:4px;text-align:center">1.9.1 changes</h3>
<div class="wp-clearfix"><div class="changelog emd-section whats-new whats-new-775" style="margin:0">
<h3 style="font-size:18px;" class="tweak"><div  style="font-size:110%;color:#33b5e5"><span class="dashicons dashicons-admin-settings"></span> TWEAK</div>
Getting started add on links have been changed to point the plugin page.</h3>
<div ></a></div></div></div><hr style="margin:30px 0">
<h3 style="font-size: 18px;font-weight:700;color: white;background: #708090;padding:5px 10px;width:155px;border: 2px solid #fff;border-radius:4px;text-align:center">1.9.0 changes</h3>
<div class="wp-clearfix"><div class="changelog emd-section whats-new whats-new-755" style="margin:0">
<h3 style="font-size:18px;" class="new"><div style="font-size:110%;color:#00C851"><span class="dashicons dashicons-megaphone"></span> NEW</div>
Quote pages which accessible by administrator and subscriber users</h3>
<div ></a></div></div></div><hr style="margin:30px 0"><div class="wp-clearfix"><div class="changelog emd-section whats-new whats-new-754" style="margin:0">
<h3 style="font-size:18px;" class="remove"><div  style="font-size:110%;color:#ff4444"><span class="dashicons dashicons-editor-removeformatting"></span> REMOVE</div>
access to quote requests by site visitors for privacy concerns. Only WordPress administrators can see the quote requests.</h3>
<div ></a></div></div></div><hr style="margin:30px 0"><div class="wp-clearfix"><div class="changelog emd-section whats-new whats-new-753" style="margin:0">
<h3 style="font-size:18px;" class="tweak"><div  style="font-size:110%;color:#33b5e5"><span class="dashicons dashicons-admin-settings"></span> TWEAK</div>
misc. library updates</h3>
<div ></a></div></div></div><hr style="margin:30px 0">
<h3 style="font-size: 18px;font-weight:700;color: white;background: #708090;padding:5px 10px;width:155px;border: 2px solid #fff;border-radius:4px;text-align:center">1.8.2 changes</h3>
<div class="wp-clearfix"><div class="changelog emd-section whats-new whats-new-752" style="margin:0">
<h3 style="font-size:18px;" class="remove"><div  style="font-size:110%;color:#ff4444"><span class="dashicons dashicons-editor-removeformatting"></span> REMOVE</div>
access to quote requests by site visitors for privacy concerns. Only WordPress administrators can see the quote requests.</h3>
<div ></a></div></div></div><hr style="margin:30px 0"><div class="wp-clearfix"><div class="changelog emd-section whats-new whats-new-751" style="margin:0">
<h3 style="font-size:18px;" class="tweak"><div  style="font-size:110%;color:#33b5e5"><span class="dashicons dashicons-admin-settings"></span> TWEAK</div>
misc. library updates</h3>
<div ></a></div></div></div><hr style="margin:30px 0">
<h3 style="font-size: 18px;font-weight:700;color: white;background: #708090;padding:5px 10px;width:155px;border: 2px solid #fff;border-radius:4px;text-align:center">1.8.0 changes</h3>
<div class="wp-clearfix"><div class="changelog emd-section whats-new whats-new-606" style="margin:0">
<h3 style="font-size:18px;" class="tweak"><div  style="font-size:110%;color:#33b5e5"><span class="dashicons dashicons-admin-settings"></span> TWEAK</div>
library updates</h3>
<div ></a></div></div></div><hr style="margin:30px 0"><div class="wp-clearfix"><div class="changelog emd-section whats-new whats-new-605" style="margin:0">
<h3 style="font-size:18px;" class="new"><div style="font-size:110%;color:#00C851"><span class="dashicons dashicons-megaphone"></span> NEW</div>
Ability to limit max size, max number of files and file types of quote attachments</h3>
<div ></a></div></div></div><hr style="margin:30px 0"><div class="wp-clearfix"><div class="changelog emd-section whats-new whats-new-604" style="margin:0">
<h3 style="font-size:18px;" class="new"><div style="font-size:110%;color:#00C851"><span class="dashicons dashicons-megaphone"></span> NEW</div>
Add ability to attach files to quotes</h3>
<div ></a></div></div></div><hr style="margin:30px 0">
<h3 style="font-size: 18px;font-weight:700;color: white;background: #708090;padding:5px 10px;width:155px;border: 2px solid #fff;border-radius:4px;text-align:center">1.7.0 changes</h3>
<div class="wp-clearfix"><div class="changelog emd-section whats-new whats-new-355" style="margin:0">
<h3 style="font-size:18px;" class="tweak"><div  style="font-size:110%;color:#33b5e5"><span class="dashicons dashicons-admin-settings"></span> TWEAK</div>
Updated codemirror libraries for custom CSS and JS options in plugin settings page</h3>
<div ></a></div></div></div><hr style="margin:30px 0"><div class="wp-clearfix"><div class="changelog emd-section whats-new whats-new-354" style="margin:0">
<h3 style="font-size:18px;" class="fix"><div  style="font-size:110%;color:#c71585"><span class="dashicons dashicons-admin-tools"></span> FIX</div>
PHP 7 compatibility</h3>
<div ></a></div></div></div><hr style="margin:30px 0"><div class="wp-clearfix"><div class="changelog emd-section whats-new whats-new-353" style="margin:0">
<h3 style="font-size:18px;" class="new"><div style="font-size:110%;color:#00C851"><span class="dashicons dashicons-megaphone"></span> NEW</div>
Added container type field in the plugin settings</h3>
<div ></a></div></div></div><hr style="margin:30px 0"><div class="wp-clearfix"><div class="changelog emd-section whats-new whats-new-352" style="margin:0">
<h3 style="font-size:18px;" class="new"><div style="font-size:110%;color:#00C851"><span class="dashicons dashicons-megaphone"></span> NEW</div>
Added custom JavaScript option in plugin settings under Tools tab</h3>
<div ></a></div></div></div><hr style="margin:30px 0">
<h3 style="font-size: 18px;font-weight:700;color: white;background: #708090;padding:5px 10px;width:155px;border: 2px solid #fff;border-radius:4px;text-align:center">1.6.0 changes</h3>
<div class="wp-clearfix"><div class="changelog emd-section whats-new whats-new-216" style="margin:0">
<h3 style="font-size:18px;" class="fix"><div  style="font-size:110%;color:#c71585"><span class="dashicons dashicons-admin-tools"></span> FIX</div>
WP Sessions security vulnerability</h3>
<div ></a></div></div></div><hr style="margin:30px 0"><div class="wp-clearfix"><div class="changelog emd-section whats-new whats-new-215" style="margin:0">
<h3 style="font-size:18px;" class="new"><div style="font-size:110%;color:#00C851"><span class="dashicons dashicons-megaphone"></span> NEW</div>
Added support for EMD MailChimp extension</h3>
<div ></a></div></div></div><hr style="margin:30px 0">
<h3 style="font-size: 18px;font-weight:700;color: white;background: #708090;padding:5px 10px;width:155px;border: 2px solid #fff;border-radius:4px;text-align:center">1.5.0 changes</h3>
<div class="wp-clearfix"><div class="changelog emd-section whats-new whats-new-52" style="margin:0">
<h3 style="font-size:18px;" class="new"><div style="font-size:110%;color:#00C851"><span class="dashicons dashicons-megaphone"></span> NEW</div>
Added support for EMD Advanced Filters and Columns extension</h3>
<div ></a></div></div></div><hr style="margin:30px 0"><div class="wp-clearfix"><div class="changelog emd-section whats-new whats-new-56" style="margin:0">
<h3 style="font-size:18px;" class="new"><div style="font-size:110%;color:#00C851"><span class="dashicons dashicons-megaphone"></span> NEW</div>
Ability to limit quote entry forms to logged-in users only from plugin settings.</h3>
<div ></a></div></div></div><hr style="margin:30px 0"><div class="wp-clearfix"><div class="changelog emd-section whats-new whats-new-55" style="margin:0">
<h3 style="font-size:18px;" class="new"><div style="font-size:110%;color:#00C851"><span class="dashicons dashicons-megaphone"></span> NEW</div>
Ability to add custom CSS in plugin's frontend pages</h3>
<div ></a></div></div></div><hr style="margin:30px 0"><div class="wp-clearfix"><div class="changelog emd-section whats-new whats-new-54" style="margin:0">
<h3 style="font-size:18px;" class="new"><div style="font-size:110%;color:#00C851"><span class="dashicons dashicons-megaphone"></span> NEW</div>
Ability enable/disable any field and taxonomy from backend and/or frontend</h3>
<div ></a></div></div></div><hr style="margin:30px 0"><div class="wp-clearfix"><div class="changelog emd-section whats-new whats-new-53" style="margin:0">
<h3 style="font-size:18px;" class="new"><div style="font-size:110%;color:#00C851"><span class="dashicons dashicons-megaphone"></span> NEW</div>
EMD Widget area to include sidebar widgets in plugin pages</h3>
<div ></a></div></div></div><hr style="margin:30px 0"><div class="wp-clearfix"><div class="changelog emd-section whats-new whats-new-50" style="margin:0">
<h3 style="font-size:18px;" class="new"><div style="font-size:110%;color:#00C851"><span class="dashicons dashicons-megaphone"></span> NEW</div>
Added unique key for quotes, removed uniqueness for quote email</h3>
<div ></a></div></div></div><hr style="margin:30px 0"><div class="wp-clearfix"><div class="changelog emd-section whats-new whats-new-58" style="margin:0">
<h3 style="font-size:18px;" class="new"><div style="font-size:110%;color:#00C851"><span class="dashicons dashicons-megaphone"></span> NEW</div>
Added ability to recreate installation pages from plugin settings</h3>
<div ></a></div></div></div><hr style="margin:30px 0"><div class="wp-clearfix"><div class="changelog emd-section whats-new whats-new-57" style="margin:0">
<h3 style="font-size:18px;" class="new"><div style="font-size:110%;color:#00C851"><span class="dashicons dashicons-megaphone"></span> NEW</div>
Added ability to permanently delete plugin related data from plugin settings</h3>
<div ></a></div></div></div><hr style="margin:30px 0"><div class="wp-clearfix"><div class="changelog emd-section whats-new whats-new-49" style="margin:0">
<h3 style="font-size:18px;" class="new"><div style="font-size:110%;color:#00C851"><span class="dashicons dashicons-megaphone"></span> NEW</div>
Ability to set page template for quote single pages. Options are sidebar on left, sidebar on right or full width</h3>
<div ></a></div></div></div><hr style="margin:30px 0">
<?php echo '</div>'; ?>
<?php echo '<div class="tab-content" id="tab-resources"';
	if ("resources" != $active_tab) {
		echo 'style="display:none;"';
	}
	echo '>';
?>
<div style="color:white;background:#0000003b;padding:5px 10px;font-size: 1.4em;font-weight: 600;">Extensive documentation is available</div><div class="emd-section changelog resources resources-51" style="margin:0;background-color:white;padding:10px"><div style="height:40px" id="gs-sec-51"></div><div id="gallery" class="wp-clearfix"></div><div class="sec-desc"><a href="https://docs.emdplugins.com/docs/request-a-quote-community-documentation">Request a Quote Community Edition Documentation</a></div></div><div style="margin-top:15px"><a href="#ptop" class="top">Go to top</a></div><hr style="margin-top:40px"><div style="color:white;background:#0000003b;padding:5px 10px;font-size: 1.4em;font-weight: 600;">How to customize WP App Studio generated plugins</div><div class="emd-section changelog resources resources-57" style="margin:0;background-color:white;padding:10px"><div style="height:40px" id="gs-sec-57"></div><div class="emd-yt" data-youtube-id="4wcFcIfHhPA" data-ratio="16:9">loading...</div><div class="sec-desc"><p><strong><span class="dashicons dashicons-arrow-up-alt"></span> Watch the customization video to familiarize yourself with the customization options. </strong>. The video shows one of our plugins as an example. The concepts are the same and all our plugins have the same settings.</p>
<p>Request a quote Community is designed and developed using <a href="https://wpappstudio.com">WP App Studio (WPAS) Professional WordPress Development platform</a>. All WPAS plugins come with extensive customization options from plugin settings without changing theme template files. Some of the customization options are listed below:</p>
<ul>
	<li>Enable or disable all fields, taxonomies and relationships from backend and/or frontend</li>
        <li>Use the default EMD or theme templating system</li>
	<li>Set slug of any entity and/or archive base slug</li>
	<li>Set the page template of any entity, taxonomy and/or archive page to sidebar on left, sidebar on right or no sidebar (full width)</li>
	<li>Hide the previous and next post links on the frontend for single posts</li>
	<li>Hide the page navigation links on the frontend for archive posts</li>
	<li>Display or hide any custom field</li>
	<li>Display any sidebar widget on plugin pages using EMD Widget Area</li>
	<li>Set custom CSS rules for all plugin pages including plugin shortcodes</li>
</ul>
<div class="quote">
<p>If your customization needs are more complex, you’re unfamiliar with code/templates and resolving potential conflicts, we strongly suggest you to <a href="https://emdplugins.com/open-a-support-ticket/?pk_campaign=raq-hireme-custom&ticket_topic=pre-sales-questions">hire us</a>, we will get your site up and running in no time.
</p>
</div></div></div><div style="margin-top:15px"><a href="#ptop" class="top">Go to top</a></div><hr style="margin-top:40px"><div style="color:white;background:#0000003b;padding:5px 10px;font-size: 1.4em;font-weight: 600;">How to resolve theme related issues</div><div class="emd-section changelog resources resources-56" style="margin:0;background-color:white;padding:10px"><div style="height:40px" id="gs-sec-56"></div><div id="gallery" class="wp-clearfix"><div class="sec-img gallery-item"><a class="thickbox tooltip" rel="gallery-56" href="https://emdsnapshots.s3.amazonaws.com/emd_templating_system.png"><img src="https://emdsnapshots.s3.amazonaws.com/emd_templating_system.png"></a></div></div><div class="sec-desc"><p>If your theme is not coded based on WordPress theme coding standards, does have an unorthodox markup or its style.css is messing up how plugin pages look and feel, you will see some unusual changes on your site such as sidebars not getting displayed where they are supposed to or random text getting displayed on headers etc. after plugin activation.</p>
<p>The good news is Request a quote Community plugin is designed to minimize theme related issues by providing two distinct templating system. The default templating system is EMD Templating System where the plugin uses its own templates for plugin pages. The second option is letting your theme use its own templates for plugin pages.</p>
<p>If the first option works for you, you do not need to do anything. If you want to use the second option, you need to check "Disable EMD Templating System" option at Settings > Tools tab. Please keep in mind that when you disable EMD templating system, you loose the flexibility of modifying plugin pages without changing theme template files.</p>
<p>If none of the provided options works for you, you may still fix theme related conflicts following the steps in <a href="https://docs.emdplugins.com/docs/request-a-quote-community-documentation/#section1484">Request a quote Community Documentation - Resolving theme related conflicts section.</a></p>

<div class="quote">
<p>If you’re unfamiliar with code/templates and resolving potential conflicts, <a href="https://emdplugins.com/open-a-support-ticket/?pk_campaign=raq-hireme&ticket_topic=pre-sales-questions">hire us</a>. We will get your site up and running in no time.</p>
</div></div></div><div style="margin-top:15px"><a href="#ptop" class="top">Go to top</a></div><hr style="margin-top:40px">
<?php echo '</div>'; ?>
<?php echo '<div class="tab-content" id="tab-features"';
	if ("features" != $active_tab) {
		echo 'style="display:none;"';
	}
	echo '>';
?>
<h3>Make price quoting easy for your team and customers </h3>
<p>Explore the full list of features available in the the latest version of Request a quote. Click on a feature title to learn more.</p>
<table class="widefat features striped form-table" style="width:auto;font-size:16px">
<tr><td><a href="https://emdplugins.com/request-a-quote-spam-protection/?pk_campaign=request-a-quote-com&pk_kwd=getting-started"><img style="width:128px;height:auto" src="https://picky-icons.s3.amazonaws.com/no-spam.png"></a></td><td><a href="https://emdplugins.com/request-a-quote-spam-protection/?pk_campaign=request-a-quote-com&pk_kwd=getting-started">Multi-dimensional spam protection</a></td><td></td></tr>
<tr><td><a href="https://emdplugins.com/request-a-quote-easy-file-uploads/?pk_campaign=request-a-quote-com&pk_kwd=getting-started"><img style="width:128px;height:auto" src="https://picky-icons.s3.amazonaws.com/upload.png"></a></td><td><a href="https://emdplugins.com/request-a-quote-easy-file-uploads/?pk_campaign=request-a-quote-com&pk_kwd=getting-started">Allow clients upload files</a></td><td></td></tr>
<tr><td><a href="https://emdplugins.com/request-a-quote-powerful-admin-pages/?pk_campaign=request-a-quote-com&pk_kwd=getting-started"><img style="width:128px;height:auto" src="https://picky-icons.s3.amazonaws.com/settings.png"></a></td><td><a href="https://emdplugins.com/request-a-quote-powerful-admin-pages/?pk_campaign=request-a-quote-com&pk_kwd=getting-started">Customize most without writing code</a></td><td></td></tr>
<tr><td><a href="https://emdplugins.com/request-a-quote-one-location-for-all-sales-quote-requests/?pk_campaign=request-a-quote-com&pk_kwd=getting-started"><img style="width:128px;height:auto" src="https://picky-icons.s3.amazonaws.com/contacts.png"></a></td><td><a href="https://emdplugins.com/request-a-quote-one-location-for-all-sales-quote-requests/?pk_campaign=request-a-quote-com&pk_kwd=getting-started">One place for all requests for quotes</a></td><td></td></tr>
<tr><td><a href="https://emdplugins.com/request-a-quote-customizable-sales-quote-requests/?pk_campaign=request-a-quote-com&pk_kwd=getting-started"><img style="width:128px;height:auto" src="https://picky-icons.s3.amazonaws.com/customize.png"></a></td><td><a href="https://emdplugins.com/request-a-quote-customizable-sales-quote-requests/?pk_campaign=request-a-quote-com&pk_kwd=getting-started">Customize price quote request form with a few clicks
</a></td><td></td></tr>
<tr><td><a href="https://emdplugins.com/request-a-quote-instant-customizable-emails/?pk_campaign=request-a-quote-com&pk_kwd=getting-started"><img style="width:128px;height:auto" src="https://picky-icons.s3.amazonaws.com/megaphone.png"></a></td><td><a href="https://emdplugins.com/request-a-quote-instant-customizable-emails/?pk_campaign=request-a-quote-com&pk_kwd=getting-started">Customize your and customer email notifications</a></td><td></td></tr>
<tr><td><a href="https://emdplugins.com/request-a-quote-accept-sales-quotes-from-any-device/?pk_campaign=request-a-quote-com&pk_kwd=getting-started"><img style="width:128px;height:auto" src="https://picky-icons.s3.amazonaws.com/responsive.png"></a></td><td><a href="https://emdplugins.com/request-a-quote-accept-sales-quotes-from-any-device/?pk_campaign=request-a-quote-com&pk_kwd=getting-started">Accept requests from anywhere anytime</a></td><td></td></tr>
<tr><td><a href="https://emdplugins.com/request-a-quote-categorize-quote-requests/?pk_campaign=request-a-quote-com&pk_kwd=getting-started"><img style="width:128px;height:auto" src="https://picky-icons.s3.amazonaws.com/shop.png"></a></td><td><a href="https://emdplugins.com/request-a-quote-categorize-quote-requests/?pk_campaign=request-a-quote-com&pk_kwd=getting-started">Categorize requests for quotes for faster searches</a></td><td> - Premium feature included in Starter edition. Pro includes more powerful features)</td></tr>
<tr><td><a href="https://emdplugins.com/request-a-quote-make-it-your-own-with-custom-fields/?pk_campaign=request-a-quote-com&pk_kwd=getting-started"><img style="width:128px;height:auto" src="https://picky-icons.s3.amazonaws.com/custom-fields.png"></a></td><td><a href="https://emdplugins.com/request-a-quote-make-it-your-own-with-custom-fields/?pk_campaign=request-a-quote-com&pk_kwd=getting-started">Add your own fields to better match your need</a></td><td> - Premium feature (included in Pro)</td></tr>
<tr><td><a href="https://emdplugins.com/request-a-quote-mailchimp-addon/?pk_campaign=request-a-quote-com&pk_kwd=getting-started"><img style="width:128px;height:auto" src="https://picky-icons.s3.amazonaws.com/mailchimp.png"></a></td><td><a href="https://emdplugins.com/request-a-quote-mailchimp-addon/?pk_campaign=request-a-quote-com&pk_kwd=getting-started">Sign up customers to your MailChimp list with ease</a></td><td> - Add-on</td></tr>
<tr><td><a href="https://emdplugins.com/request-a-quote-smart-search-addon/?pk_campaign=request-a-quote-com&pk_kwd=getting-started"><img style="width:128px;height:auto" src="https://picky-icons.s3.amazonaws.com/zoomin.png"></a></td><td><a href="https://emdplugins.com/request-a-quote-smart-search-addon/?pk_campaign=request-a-quote-com&pk_kwd=getting-started">Find important requests for quotes faster</a></td><td> - Add-on (included in Pro)</td></tr>
<tr><td><a href="https://emdplugins.com/request-a-quote-importexport-addon/?pk_campaign=request-a-quote-com&pk_kwd=getting-started"><img style="width:128px;height:auto" src="https://picky-icons.s3.amazonaws.com/csv-impexp.png"></a></td><td><a href="https://emdplugins.com/request-a-quote-importexport-addon/?pk_campaign=request-a-quote-com&pk_kwd=getting-started">Move your existing quotes from CSV with ease</a></td><td> - Add-on (included in Pro)</td></tr>
<tr><td><a href="https://emdplugins.com/request-a-quote-incoming-email-addon/?pk_campaign=request-a-quote-com&pk_kwd=getting-started"><img style="width:128px;height:auto" src="https://picky-icons.s3.amazonaws.com/email.png"></a></td><td><a href="https://emdplugins.com/request-a-quote-incoming-email-addon/?pk_campaign=request-a-quote-com&pk_kwd=getting-started">Accept requests for quotes from customer emails</a></td><td> - Add-on</td></tr>
</table>
<?php echo '</div>'; ?>
<?php echo '</div>';
}
