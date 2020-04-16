<?php $real_post = $post;
$ent_attrs = get_option('request_a_quote_attr_list');
?>
<div id="single-emd-quote-<?php echo get_the_ID(); ?>" class="emd-container emd-quote-wrap single-wrap">
<?php $is_editable = 0; ?>
<div class="notfronteditable">
    <div style="padding-bottom:10px;clear:both;text-align:right;" id="modified-info-block" class=" modified-info-block">
        <div class="textSmall text-muted modified" style="font-size:75%"><span class="last-modified-text"><?php _e('Last modified', 'request-a-quote'); ?> </span><span class="last-modified-author"><?php _e('by', 'request-a-quote'); ?> <?php echo get_the_modified_author(); ?> - </span><span class="last-modified-datetime"><?php echo human_time_diff(strtotime(get_the_modified_date() . " " . get_the_modified_time()) , current_time('timestamp')); ?> </span><span class="last-modified-dttext"><?php _e('ago', 'request-a-quote'); ?></span></div>
    </div>
    <div class="panel panel-info" >
        <div class="panel-heading" style="position:relative; ">
            <div class="panel-title">
                <div class='single-header header'>
                    <h1 class='single-entry-title entry-title' style='color:inherit;padding:0;margin-bottom: 15px;border:0 none;word-break:break-word;font-size:24px;'>
                        <?php if (emd_is_item_visible('ent_contact_id', 'request_a_quote', 'attribute', 0)) { ?><span class="single-content ent-contact-id"><?php echo esc_html(emd_mb_meta('emd_contact_id')); ?>
</span><?php
} ?>
                    </h1>
                </div>
            </div>
        </div>
        <div class="panel-body" style="clear:both">
            <div class="single-well well emd-quote">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="slcontent emdbox">
                            <div class="segment-block ent-contact-first-name">
                                <div class="segtitle"><?php _e('Name', 'request-a-quote'); ?></div>
                                <div class="segvalue tagfunc"><?php echo esc_html(emd_mb_meta('emd_contact_first_name')); ?>
 <?php echo esc_html(emd_mb_meta('emd_contact_last_name')); ?>
</div>
                            </div>
                            <?php if (emd_is_item_visible('ent_quote_closed', 'request_a_quote', 'attribute', 0)) { ?>
                            <div class="segment-block ent-quote-closed">
                                <div style="font-size:95%" class="segtitle"><?php _e('Quote Closed', 'request-a-quote'); ?></div>
                                <div class="segvalue"><span><?php echo ((emd_mb_meta('emd_quote_closed')) ? "☑" : "☐"); ?></span></div>
                            </div>
                            <?php
} ?>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="srcontent emdbox">
                            <?php if (emd_is_item_visible('ent_contact_email', 'request_a_quote', 'attribute', 0)) { ?>
                            <div class="segment-block ent-contact-email">
                                <div style="font-size:95%" class="segtitle"><?php _e('Email', 'request-a-quote'); ?></div>
                                <div class="segvalue">
                                    <span><a href='mailto:<?php echo antispambot(esc_html(emd_mb_meta('emd_contact_email'))); ?>'><?php echo antispambot(esc_html(emd_mb_meta('emd_contact_email'))); ?></a></span>
                                </div>
                            </div>
                            <?php
} ?><?php if (emd_is_item_visible('ent_contact_phone', 'request_a_quote', 'attribute', 0)) { ?>
                            <div class="segment-block ent-contact-phone">
                                <div style="font-size:95%" class="segtitle"><?php _e('Phone', 'request-a-quote'); ?></div>
                                <div class="segvalue">
                                    <span><a href='tel:<?php echo esc_html(emd_mb_meta('emd_contact_phone')); ?>
'><?php echo esc_html(emd_mb_meta('emd_contact_phone')); ?>
</a></span>
                                </div>
                            </div>
                            <?php
} ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="emd-body-content">
                <div class="tab-container emd-quote-tabcontainer" style="padding:0 5px 60px;">
                    <ul class="nav nav-tabs" role="tablist" style="margin: 20px 0px 10px;visibility: visible;padding-bottom:0px;">
                        <li class=" active "><a id="details-tablink" href="#details" role="tab" data-toggle="tab"><?php _e('Details', 'request-a-quote'); ?></a></li>
                    </ul>
                    <div class="tab-content emd-quote-tabcontent">
                        <div class="tab-pane fade in active" id="details">
                            <?php if (emd_is_item_visible('ent_contact_address', 'request_a_quote', 'attribute', 0)) { ?>
                            <div class="segment-block ent-contact-address">
                                <div data-has-attrib="false" class="row">
                                    <div class="col-sm-6 ">
                                        <div class="segtitle"><?php _e('Address', 'request-a-quote'); ?></div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="segvalue"> <?php echo esc_html(emd_mb_meta('emd_contact_address')); ?>
</div>
                                    </div>
                                </div>
                            </div>
                            <?php
} ?> <?php if (emd_is_item_visible('ent_contact_city', 'request_a_quote', 'attribute', 0)) { ?>
                            <div class="segment-block ent-contact-city">
                                <div data-has-attrib="false" class="row">
                                    <div class="col-sm-6 ">
                                        <div class="segtitle"><?php _e('City', 'request-a-quote'); ?></div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="segvalue"><?php echo esc_html(emd_mb_meta('emd_contact_city')); ?>
</div>
                                    </div>
                                </div>
                            </div>
                            <?php
} ?> <?php if (emd_is_item_visible('ent_contact_zip', 'request_a_quote', 'attribute', 0)) { ?>
                            <div class="segment-block ent-contact-zip">
                                <div data-has-attrib="false" class="row">
                                    <div class="col-sm-6 ">
                                        <div class="segtitle"><?php _e('Zipcode', 'request-a-quote'); ?></div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="segvalue"><?php echo esc_html(emd_mb_meta('emd_contact_zip')); ?>
</div>
                                    </div>
                                </div>
                            </div>
                            <?php
} ?> <?php if (emd_is_item_visible('ent_contact_state', 'request_a_quote', 'attribute', 0)) { ?>
                            <div class="segment-block ent-contact-state">
                                <div data-has-attrib="false" class="row">
                                    <div class="col-sm-6 ">
                                        <div class="segtitle"><?php _e('State', 'request-a-quote'); ?></div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="segvalue"><?php echo emd_get_attr_val('request_a_quote', $post->ID, 'emd_quote', 'emd_contact_state'); ?></div>
                                    </div>
                                </div>
                            </div>
                            <?php
} ?> <?php if (emd_is_item_visible('ent_contact_pref', 'request_a_quote', 'attribute', 0)) { ?>
                            <div class="segment-block ent-contact-pref">
                                <div data-has-attrib="false" class="row">
                                    <div class="col-sm-6 ">
                                        <div class="segtitle"><?php _e('Contact Preference', 'request-a-quote'); ?></div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="segvalue"><?php echo emd_get_attr_val('request_a_quote', $post->ID, 'emd_quote', 'emd_contact_pref'); ?></div>
                                    </div>
                                </div>
                            </div>
                            <?php
} ?> <?php if (emd_is_item_visible('ent_contact_callback_time', 'request_a_quote', 'attribute', 0)) { ?>
                            <div class="segment-block ent-contact-callback-time">
                                <div data-has-attrib="false" class="row">
                                    <div class="col-sm-6 ">
                                        <div class="segtitle"><?php _e('Callback Time', 'request-a-quote'); ?></div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="segvalue"><?php echo emd_get_attr_val('request_a_quote', $post->ID, 'emd_quote', 'emd_contact_callback_time'); ?></div>
                                    </div>
                                </div>
                            </div>
                            <?php
} ?> <?php if (emd_is_item_visible('ent_contact_budget', 'request_a_quote', 'attribute', 0)) { ?>
                            <div class="segment-block ent-contact-budget">
                                <div data-has-attrib="false" class="row">
                                    <div class="col-sm-6 ">
                                        <div class="segtitle"><?php _e('Budget', 'request-a-quote'); ?></div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="segvalue"><?php echo esc_html(emd_mb_meta('emd_contact_budget')); ?>
</div>
                                    </div>
                                </div>
                            </div>
                            <?php
} ?> <?php if (emd_is_item_visible('ent_contact_extrainfo', 'request_a_quote', 'attribute', 0)) { ?>
                            <div class="segment-block ent-contact-extrainfo">
                                <div data-has-attrib="false" class="row">
                                    <div class="col-sm-6 ">
                                        <div class="segtitle"><?php _e('Additional details', 'request-a-quote'); ?></div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="segvalue"><?php echo esc_html(emd_mb_meta('emd_contact_extrainfo')); ?>
</div>
                                    </div>
                                </div>
                            </div>
                            <?php
} ?> <?php if (emd_is_item_visible('ent_contact_attachment', 'request_a_quote', 'attribute', 0)) { ?>
                            <div class="segment-block ent-contact-attachment">
                                <div data-has-attrib="false" class="row">
                                    <div class="col-sm-6 ">
                                        <div class="segtitle"><?php _e('Attachments', 'request-a-quote'); ?></div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="segvalue"><?php
	add_thickbox();
	$emd_mb_file = emd_mb_meta('emd_contact_attachment', 'type=file');
	if (!empty($emd_mb_file)) {
		echo '<div class="clearfix">';
		foreach ($emd_mb_file as $info) {
			emd_get_attachment_layout($info);
		}
		echo '</div>';
	}
?>
</div>
                                    </div>
                                </div>
                            </div>
                            <?php
} ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-footer">
            <?php if (emd_is_item_visible('tax_raq_services', 'request_a_quote', 'taxonomy', 0)) { ?>
            <div class="footer-segment-block"><span style="margin-right:2px" class="footer-object-title label label-info"><?php _e('Service', 'request-a-quote'); ?></span><span class="footer-object-value"><?php echo emd_get_tax_vals(get_the_ID() , 'raq_services'); ?></span></div>
            <?php
} ?> 
        </div>
    </div>
</div>
</div><!--container-end-->