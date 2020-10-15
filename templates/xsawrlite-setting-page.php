<?php
/**
* Settings Page of Advance WP Redirect
*
*
*/
// Exit if directly access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
function xsawrlite_page(){
	?>
	<div class="xsawrlite">
		<div class="mdl-grid">
			<div id='xsawrlite-overlay'>
				<div class="xsawrlite-loader-warp">
					<div class="xsawrlite-loader"></div>
				</div>
			</div>
			<div id='xsawrlite-snackbar'></div>
			<div class='mdl-cell mdl-cell--12-col mdl-cell--4-offset'>
				<h3><?php esc_html_e("Advance WP Redirect" , XSAWRLITE_DOMAIN) ?></h3>
			</div>
			<div class="mdl-grid">
				<div class='mdl-cell mdl-cell--9-col'>
					<a class="xsawrlite-pro-link" href="https://codecanyon.net/item/advance-wp-redirect/24178351?s_rank=1" target="_blank">
		                <h6 class="xsawrlite-pro">
		                    <?php esc_html_e('If you want to use full functionality kindly buy our pro version ' , XSAWRLITE_DOMAIN ); ?>
		                </h6>
		        	</a>
	        	</div>
	        	<div class="mdl-cell mdl-cell--3-col">
	        		<a class="xsawrlite-pro-link" href="https://codecanyon.net/item/advance-wp-redirect/24178351?s_rank=1" target="_blank">
	        			<?php submit_button(esc_html__("Advance WP Redirect" , XSAWRLITE_DOMAIN ), 'secondary' ); ?>
	        		</a>
	        	</div>
        	</div>
		</div>
		<?php settings_errors(); ?>
		<div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
			<div class="mdl-tabs__tab-bar xsawrlite-tabs nav-tab-wrapper">
				<a href="?page=xsawrlite_page&tab=Easy Redirect" class="mdl-tabs__tab <?php esc_html_e( ($_GET['tab'] == 'Easy Redirect' || !isset($_GET['tab']) )? 'is-active' :'' ) ?>">
					<?php esc_html_e( 'Easy Redirect' , XSAWRLITE_DOMAIN ) ;?>
				</a>
				<a href="?page=xsawrlite_page&tab=Options" class="mdl-tabs__tab <?php esc_html_e( $_GET['tab'] == 'Options' ? 'is-active' :'' ) ?>">
					<?php esc_html_e( 'Options' , XSAWRLITE_DOMAIN ); ?>		
				</a>
			</div>
			<?php
			if( !isset($_GET['tab'] ) || $_GET['tab'] == 'Easy Redirect' ) {
				include_once XSAWRLITE_ABSPATH . '/templates/xsawrlite-easy-redirect.php'; 
			}
			
			if( (isset($_GET['tab']) ) && ( $_GET['tab'] == 'Options' ) ):?>
			<div class="mdl-tabs__panel <?php esc_html_e( $_GET['tab'] == 'Options' ? 'is-active' :'' ) ?>" id="xsawrlite-options">
				<form method="post" action="options.php">
					<?php 
		        	settings_fields('xsawrlite_options') ;
		            do_settings_sections('xsawrlite_options') ;
		            ?> 
					<div class="section">
						<h4><?php esc_html_e( 'Master Override Options' , XSAWRLITE_DOMAIN ) ?></h4>
						<?php $master_options = get_option("xsawrlite-masteroptions"); ?> 
						<div class="section__block mdl-grid">
							<div class="mdl-cell mdl-cell--4-col mdl-cell--middle">
								<p class="xsawrlite_p" title="<?php esc_attr_e('Off the all redirects' , XSAWRLITE_DOMAIN ); ?>">
									<?php esc_html_e( "Turn OFF All Redirects" , XSAWRLITE_DOMAIN ); ?>
								</p>
							</div>
							<div class="mdl-cell mdl-cell--2-col mdl-cell--middle">
								<label class="mdl-switch mdl-js-switch mdl-js-ripple-effect " for="xsawrlite-off-redirect">
									<input type="checkbox" id="xsawrlite-off-redirect" class="mdl-switch__input" name="xsawrlite-masteroptions[off-redirect]" value="1" <?php xsawrlite_check_option("xsawrlite-masteroptions" , "off-redirect" ); ?>/>
								</label>
							</div>
							<div class="mdl-cell mdl-cell--4-col mdl-cell--middle">
								<p class="xsawrlite_p" title="<?php esc_attr_e('All 404 page move to homepage' , XSAWRLITE_DOMAIN ); ?>">
									<?php esc_html_e( "All 404 Error Redirects To Homepage" , XSAWRLITE_DOMAIN ); ?>
								</p>
							</div>
							<div class="mdl-cell mdl-cell--2-col mdl-cell--middle">
								<label class="mdl-switch mdl-js-switch mdl-js-ripple-effect " for="xsawrlite-404-redirect">
									<input type="checkbox" id="xsawrlite-404-redirect" class="mdl-switch__input" name="xsawrlite-masteroptions[404-redirect]" value="1" <?php xsawrlite_check_option("xsawrlite-masteroptions" , "404-redirect" ); ?>/>
								</label>
							</div>
						</div>
						<div class="section__block mdl-grid">
							<div class="mdl-cell mdl-cell--4-col mdl-cell--middle">
								<p class="xsawrlite_p" title="<?php esc_attr_e('Add attribute in source url rel="_nofollow"' , XSAWRLITE_DOMAIN ); ?>">
									<?php esc_html_e( "Make All Redirects Have (rel='nofollow')" , XSAWRLITE_DOMAIN ); ?>
								</p>
								
							</div>
							<div class="mdl-cell mdl-cell--2-col mdl-cell--middle">
								<label class="mdl-switch mdl-js-switch mdl-js-ripple-effect " for="xsawrlite-nf-redirect">
									<input type="checkbox" id="xsawrlite-nf-redirect" class="mdl-switch__input" name="xsawrlite-masteroptions[nf-redirect]" value="1"<?php xsawrlite_check_option("xsawrlite-masteroptions" , "nf-redirect" ); ?> />
								</label>
							</div>
							<div class="mdl-cell mdl-cell--4-col mdl-cell--middle">
								<p class="xsawrlite_p" title="<?php esc_attr_e('Add attribute in source url target="_blank"' , XSAWRLITE_DOMAIN ); ?>">
									<?php esc_html_e( "Make All Redirects Have New Window" , XSAWRLITE_DOMAIN ); ?>
								</p>
							</div>
							<div class="mdl-cell mdl-cell--2-col mdl-cell--middle">
								<label class="mdl-switch mdl-js-switch mdl-js-ripple-effect " for="xsawrlite-nw-redirect">
									<input type="checkbox" id="xsawrlite-nw-redirect" class="mdl-switch__input" name="xsawrlite-masteroptions[nw-redirect]" value="1" <?php xsawrlite_check_option("xsawrlite-masteroptions" , "nw-redirect" ); ?> />
								</label>
							</div>
						</div>
						<div class="section__block mdl-grid">
							<div class="mdl-cell mdl-cell--2-col mdl-cell--middle">
								<p class="xsawrlite_p" title="<?php esc_attr_e('Applies to all redirects unless you configure them otherwise' , XSAWRLITE_DOMAIN ); ?>">
									<?php esc_html_e( "Default Query Matching" , XSAWRLITE_DOMAIN ); ?>
								</p>
							</div>
							<div class="mdl-cell mdl-cell--4-col mdl-cell--middle">
								<div class="mdl-textfield mdl-js-textfield getmdl-select">
							       <select name="xsawrlite-masteroptions[mq_redirect]">
										<option selected value="exact">
											<?php esc_html_e( "Exact Match" , XSAWRLITE_DOMAIN ); ?>
										</option>
										<option disabled value="ignore">
											<?php esc_html_e( "Ignore all query parameters(pro version)" , XSAWRLITE_DOMAIN ); ?>
										</option>
										<option disabled value="ignore-and-pass">
											<?php esc_html_e( "Ignore and pass all query parameters(pro version)" , XSAWRLITE_DOMAIN ); ?>
										</option>
									</select> 
							    </div>
							</div>
							<div class="mdl-cell mdl-cell--6-col mdl-cell--middle">
								<p>
									<?php esc_html_e( "Exact - matches the query parameters exactly defined in your source, in any order" , XSAWRLITE_DOMAIN ); ?><br>
									<?php esc_html_e( "Ignore - as exact, but ignores any query parameters not in your source" , XSAWRLITE_DOMAIN ); ?><br>
									<?php esc_html_e( "Pass - as ignore, but also copies the query parameters to the target" , XSAWRLITE_DOMAIN ); ?>
								</p>
							</div>
						</div>
					</div>
					<div class="mdl-grid">
						<?php submit_button(); ?>
					</div>
				</form>
			</div>
			<?php endif ?>		
		</div>
	</div>
<?php
}
?>