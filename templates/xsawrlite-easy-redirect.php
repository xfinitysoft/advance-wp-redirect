<?php 
/**
* Layout of Easy Redirect
*
*
*/
if ( ! defined( 'ABSPATH' ) ) {
    exit;

}
?>

<div class="mdl-tabs__panel is-active" id="xsawrlite-redirect">
    <div class="section">
        <form method="post" id="xsawrlite_redirect">
        	<h4><?php esc_html_e( 'Add New Redirects' , XSAWRLITE_DOMAIN ) ?></h4>
			<div class="section__block mdl-grid">
				<div class="mdl-cell mdl-cell--6-col mdl-cell--middle xsawrlite-col">
					<p class="xsawrlite_p" title="<?php esc_attr_e('Add attribute in source url rel="nofollow"' , XSAWRLITE_DOMAIN ); ?>">
						<b><?php esc_html_e( "Make this url No Follow" , XSAWRLITE_DOMAIN ); ?></b>
					</p>
					<label class="mdl-switch mdl-js-switch mdl-js-ripple-effect " for="xsawrlite-nf">
						<input type="checkbox" id="xsawrlite-nf" class="mdl-switch__input" name="xsawrlite_easy_redirect[nf]" value="1" />
					</label>
				</div>
				<div class="mdl-cell mdl-cell--6-col mdl-cell--middle xsawrlite-col">
					<p class="xsawrlite_p" title="<?php esc_attr_e('Add attribute in source url Target="_blank"' , XSAWRLITE_DOMAIN ); ?>">
						<b><?php esc_html_e( "Open this URL in new Tab" , XSAWRLITE_DOMAIN ); ?></b>
					</p>
					<label class="mdl-switch mdl-js-switch mdl-js-ripple-effect " for="xsawrlite-nw">
						<input type="checkbox" id="xsawrlite-nw" class="mdl-switch__input" name="xsawrlite_easy_redirect[nw]" value="1" />
					</label>
				</div>
			</div>
			<div class="section__block mdl-grid">
				<div class="mdl-cell mdl-cell--6-col mdl-cell--middle xsawrlite-col-2">
					<p class="xsawrlite_p-2">
						<b><?php esc_html_e( "Request URL" , XSAWRLITE_DOMAIN ); ?></b>
					</p>
					<div class="mdl-textfield mdl-js-textfield xsawrlite-input">
	        			<input class="mdl-textfield__input" type="text" id="xsawrlite-rurl"  name="xsawrlite_easy_redirect[rurl]" placeholder="<?php esc_attr_e("Enter request URL you want to redirect" , XSAWRLITE_DOMAIN) ?>" />
					</div>
				</div>
				<div class="mdl-cell mdl-cell--6-col mdl-cell--middle xsawrlite-col-2">
					<p class="xsawrlite_p-2">
						<b><?php esc_html_e( "Query Parameters" , XSAWRLITE_DOMAIN ); ?></b>
					</p>
					<div class="mdl-textfield mdl-js-textfield getmdl-select xsawrlite-input">
						<?php $master_options = get_option("xsawrlite-masteroptions"); ?> 
				       <select class="mdl-textfield__input" name="xsawrlite_easy_redirect[qp]">
							<option  <?php esc_attr_e( (isset($master_options['mq_redirect']) && $master_options['mq_redirect'] == 'exact')? "selected":"" );?> value="exact">
								<?php esc_html_e( "Exact Match" , XSAWRLITE_DOMAIN ); ?>
							</option>
							<option <?php esc_attr_e( ( isset($master_options['mq_redirect']) && $master_options['mq_redirect'] == 'ignore')? "selected":"" ); ?> disabled value="ignore">
								<?php esc_html_e( "Ignore all query parameters(pro version)" , XSAWRLITE_DOMAIN ); ?>
							</option>
							<option <?php esc_attr_e( (isset($master_options['mq_redirect']) && $master_options['mq_redirect'] == 'ignore-and-pass')? "selected":"" ); ?> disabled value="ignore-and-pass">
								<?php esc_html_e( "Ignore and pass all query parameters(pro version)" , XSAWRLITE_DOMAIN ); ?>
							</option>
						</select> 
				    </div>
				</div>
			</div>
			<div class="section__block mdl-grid">
				<div class="mdl-cell mdl-cell--6-col mdl-cell--middle xsawrlite-col-2">
					<p class="xsawrlite_p-2">
						<b><?php esc_html_e( "Title" , XSAWRLITE_DOMAIN ); ?></b>
					</p>
					<div class="mdl-textfield mdl-js-textfield xsawrlite-input">
				       <input class="mdl-textfield__input" type="text" id="xsawrlite-title"  name="xsawrlite_easy_redirect[title]" placeholder="<?php esc_attr_e("(optional) Description  of this redirect", XSAWRLITE_DOMAIN) ?>" />
				    </div>
				</div>
				<div class="mdl-cell mdl-cell--6-col mdl-cell--middle xsawrlite-col-2">
					<p class="xsawrlite_p-2">
						<b><?php esc_html_e( "Match" , XSAWRLITE_DOMAIN ); ?></b>
					</p>
					<div class="mdl-textfield mdl-js-textfield xsawrlite-input">
	        			<select class="mdl-textfield__input" name="xsawrlite_easy_redirect[match]" id="xsawrlite-murl-0">
							<option value="durl">
								<?php esc_html_e( "URL Only" , XSAWRLITE_DOMAIN ); ?>
							</option>
							<option disabled value="url_login">
								<?php esc_html_e( "URL and login status(pro version)" , XSAWRLITE_DOMAIN ); ?>
							</option>
							<option disabled value="url_role">
								<?php esc_html_e( "URL and Role(pro version)" , XSAWRLITE_DOMAIN ); ?>
							</option>
							<option disabled value="url_ip">
								<?php esc_html_e( "URL and IP(pro version)" , XSAWRLITE_DOMAIN ); ?>
							</option>
						</select>
					</div>
				</div>
			</div>
			<div class="section__block mdl-grid">
				<div class="mdl-cell mdl-cell--6-col mdl-cell--middle xsawrlite-col-2">
					<p class="xsawrlite_p-2">
						<b><?php esc_html_e( "Matched" , XSAWRLITE_DOMAIN ); ?></b>
					</p>
					<div class="mdl-textfield mdl-js-textfield xsawrlite-input">
	        			<select class="mdl-textfield__input" id="xsawrlite-matched-0" name="xsawrlite_easy_redirect[matched]">
							<option value="redirect_url">
								<?php esc_html_e( "Redirect to URL" , XSAWRLITE_DOMAIN ); ?>
							</option>
							<option disabled value="random_post">
								<?php esc_html_e( "Redirect to Random Post(pro version)" , XSAWRLITE_DOMAIN ); ?>
							</option>
							<option disabled value="pass_through">
								<?php esc_html_e( "Pass-Through(pro version)" , XSAWRLITE_DOMAIN ); ?>
							</option>
							<option disabled value="404">
								<?php esc_html_e( "Error 404(pro version)" , XSAWRLITE_DOMAIN ); ?>
							</option>
							<option disabled value="nothing">
								<?php esc_html_e( "Do Nothing(ignore)(pro version)" , XSAWRLITE_DOMAIN ); ?>
							</option>
						</select>
					</div>
				</div>
				<div class="mdl-cell mdl-cell--6-col mdl-cell--middle xsawrlite-col-2" id="http-code-0" >
					<p class="xsawrlite_p-2">
						<b><?php esc_html_e( "HTTP code" , XSAWRLITE_DOMAIN ); ?></b>
					</p>
					<div class="mdl-textfield mdl-js-textfield xsawrlite-input" >
	        			<select class="mdl-textfield__input" id="xsawrlite-qp-0" name="xsawrlite_easy_redirect[qp_rule]">
							<option  value="301">
								<?php esc_html_e( "301 - Moved Permanently " , XSAWRLITE_DOMAIN ); ?>
							</option>
							<option value="302" selected>
								<?php esc_html_e( "302 - Found" , XSAWRLITE_DOMAIN ); ?>
							</option>
							<option value="303">
								<?php esc_html_e( "303 - See Other" , XSAWRLITE_DOMAIN ); ?>
							</option>
							<option value="304">
								<?php esc_html_e( "304 - Not Modified" , XSAWRLITE_DOMAIN ); ?>
							</option>
							<option value="307">
								<?php esc_html_e( "307 - Redirect Temporary" , XSAWRLITE_DOMAIN ); ?>
							</option>
							<option value="308">
								<?php esc_html_e( "308 - Redirect Permanent" , XSAWRLITE_DOMAIN ); ?>
							</option>
						</select>
					</div>
				</div>
			</div>
			<div class="section__block mdl-grid">
				<div class="mdl-cell mdl-cell--6-col mdl-cell--middle xsawrlite-col-2" id="durl-0">
					<p class="xsawrlite_p-2" id='xsawrlite_pdurl-0'>
							<b><?php esc_html_e( "Target URL" , XSAWRLITE_DOMAIN ); ?></b>
					</p>
        			<div class="mdl-textfield mdl-js-textfield xsawrlite-input" id='xsawrlite_inputdurl-0' >
	        			<input class="mdl-textfield__input" type="text" id="xsawrlite-durl"  name="xsawrlite_easy_redirect[durl]" placeholder="<?php esc_attr_e("Target URL you want to redirect if matched", XSAWRLITE_DOMAIN) ?>" />
					</div>
				</div>
			</div>
	        <div class="mdl-grid xsawrlite-button">
	        	<?php submit_button(esc_html__("Add New Redirect" , XSAWRLITE_DOMAIN ), 'primary' , 'xsawrlite_addredirects' ); ?>
	        </div>
	        <div class="xsawrlite-message"></div>
	    </form>
	    <h4><?php esc_html_e( 'Existing Redirects' , XSAWRLITE_DOMAIN ) ?></h4>
	    <table class="mdl-data-table mdl-js-data-table xsawrlite-table" id='xsawrlite-table'>
		        <thead>
		        	<tr>
		        		<th class="mdl-data-table__cell--non-numeric">ID</th>
						<th class="mdl-data-table__cell--non-numeric">
							<?php esc_html_e( 'URL' , XSAWRLITE_DOMAIN ); ?>
						</th>	
						<th class="mdl-data-table__cell--non-numeric">
							<?php esc_html_e( 'Type' , XSAWRLITE_DOMAIN ); ?>	
						</th>
						<th class="mdl-data-table__cell--non-numeric">
							<?php esc_html_e( 'Actions' , XSAWRLITE_DOMAIN ); ?>
						</th>
					</tr>
		        </thead>
		        <tbody id="xsawrlite-refresh">
		        <?php	$xsawrlite_eredirect = get_option('xsawrlite_easy_redirect');
		        	if(!empty($xsawrlite_eredirect)):
			     	foreach($xsawrlite_eredirect as $xsawrlite_key=>$val):
			     	?>
			     	<tr id='xsawrlite-row-<?php esc_html_e($xsawrlite_key) ; ?>'>
			     		<td class="mdl-data-table__cell--non-numeric"><?php esc_html_e( $xsawrlite_key) ; ?></td>
			     		<td class="mdl-data-table__cell--non-numeric">
			     			<?php 
			     			    if($val['title'] != ""){
			     			    	esc_html_e( $val['title'] );
			     			    }else{
			     			    	esc_html_e( $val['rurl'] );
			     			    }
			     			    if( isset( $val['durl'] ) &&  $val['durl'] != "") {
			     			    	echo '<br>'. esc_html__($val['durl']);
			     			    }	
			     				
			     			?> 
			     		</td>
			     		<td class="mdl-data-table__cell--non-numeric"><?php esc_html_e( $val['qp_rule'] ) ;?></td>
			     		<td class="mdl-data-table__cell--non-numeric">
			     			<span id='<?php esc_html_e( $xsawrlite_key) ; ?>' title="<?php esc_attr_e("Edit" , XSAWRLITE_DOMAIN) ?>"  class="dashicons dashicons-edit xsawrlite-edit">
			     			</span>
							<span id="<?php esc_html_e( $xsawrlite_key ); ?>" title="<?php esc_attr_e("Delete" ,XSAWRLITE_DOMAIN)?>" class="dashicons dashicons-trash xsawrlite-del">
							</span>
			     		</td>	
			     	</tr>
			     	<?php endforeach;?>
			     <?php endif; ?>
		        </tbody>
		</table>
		<div class="xsawrlite-scroll-down">
		</div>
		<dialog class="mdl-dialog">
		    <h4 class="mdl-dialog__title"><?php esc_html_e( "Delete" , XSAWRLITE_DOMAIN ); ?></h4>
		    <div class="mdl-dialog__content">
		      <p>
		        <?php esc_html_e( "Do you really want to delete?", XSAWRLITE_DOMAIN); ?>
		      </p>
		    </div>
		    <div class="mdl-dialog__actions">
		      <button type="button" class="mdl-button xsawrlite-yes"><?php esc_html_e("Yes",XSAWRLITE_DOMAIN); ?></button>
		      <button type="button" class="mdl-button xsawrlite-close"><?php esc_html_e("No", XSAWRLITE_DOMAIN); ?></button>
		    </div>
		</dialog>
	</div>
</div>