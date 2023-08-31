<?php
// Exit if directly access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
* Initialization of Advance WP Redirect
* @class XSAWRLITE_Init
* @since 1.0
*/

class XSAWRLITE_Init {
	/**
	* Add menu page of  Advance WP Redirect  
	* @param NULL
	* @return NULLF
	*/
	public function xsawrlite_admin_menu() {
		add_menu_page( 
			esc_html__( 'Advance WP Redirect' , XSAWRLITE_DOMAIN ) , 
			esc_html__( 'Advance WP Redirect' , XSAWRLITE_DOMAIN ), 
			'manage_options' ,
			'xsawrlite_page' ,
			'xsawrlite_page' ,
			'dashicons-external',
			40
		);
		add_submenu_page( 
			'xsawrlite_page',
			esc_html__( 'Support' , 'xsawrlite-domain' ), 
			esc_html__( 'Support' , 'xsawrlite-domain'  ), 
			'manage_options',
			'xsawrlite_support',
			'xsawrlite_support',
		);
	}

	/**
	* Add css and javascript 
	* @param NULL
	* @return NULL
	*/
	public function xsawrlite_load_css_js(){
		
		if(isset($_GET['page']) && ($_GET['page'] == 'xsawrlite_page' || $_GET['page'] == 'xsawrlite_support')){
			wp_register_style( 'material' , plugins_url( "advance-wp-redirect/assets/css/xsawrlite.material.min.css" ) ) ;
			wp_register_style( 'xsawrlite-custom' , plugins_url( "advance-wp-redirect/assets/css/xsawrlite.custom.css" ) ) ;
			wp_register_script( 'material' , plugins_url( "advance-wp-redirect/assets/js/xsawrlite.material.min.js" ) ) ;
			wp_register_script( 'xsawrlite-custom' , plugins_url( "advance-wp-redirect/assets/js/xsawrlite.custom.js" ) ) ;
			wp_enqueue_style( 'material' );
			wp_enqueue_style('materials-icons',"https://fonts.googleapis.com/icon?family=Material+Icons");
			wp_enqueue_style('fontsawesome', 'https://use.fontawesome.com/releases/v5.8.1/css/all.css' ) ;
			wp_enqueue_style( 'xsawrlite-custom' );
			wp_enqueue_script( 'jquery' );
			wp_enqueue_script('material');
			wp_enqueue_script('xsawrlite-custom');

		}
		
	}
	/**
	* for fornt end url js
	*
	*/
	public function xsawrlite_forntend_load_js(){
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'xsawrlite-frontend' , plugins_url( "advance-wp-redirect/assets/js/xsawrlite.frontend.js" ) );
		wp_localize_script( 'xsawrlite-frontend', 'frontend_ajax',
        array( 
	            'ajaxurl' => admin_url( 'admin-ajax.php' ),
	        )
	    );

	}
	 /**
    * Load the text domain
    *
    */
    public function xsawrlite_load_textdomain() {
        load_plugin_textdomain( 'xsawrlite-domain' , false , dirname( XSAWRLITE_BASENAME ) . '/languages' );
    }
	/**
	* register the options
	* @param NULL
	* @return NULL
	*/
	public function xsawrlite_register_settings(){
		register_setting( 'xsawrlite_options' , 'xsawrlite-masteroptions' );
	}

	/**
	* add redirects by ajax call
	* @param NULL
	* @return json array
	*/
	public function xsawrlite_add_redirects(){
		
		$redirects = array();
		$datajson = array();
		$redirects = get_option('xsawrlite_easy_redirect',array());
		
		if(empty($redirects)){
			$index = 0;
		}else{
			end($redirects);
			$index = key($redirects);
		}
		
		$xsawrlite_redirect = array();
		parse_str( $_POST["redirect_data"] , $xsawrlite_redirect );
		$http = $_SERVER["HTTP_ORIGIN"];
		$ser_name = '/'.$_SERVER["SERVER_NAME"];
		$order = array($http,$ser_name,$_SERVER["SERVER_NAME"]);
		$rurl = str_replace($order , '', $xsawrlite_redirect["xsawrlite_easy_redirect"]['rurl']);
		$xsawrlite_redirect["xsawrlite_easy_redirect"]['rurl'] = $rurl;
		$slash = substr($rurl, 0 ,1);
		if( (isset($xsawrlite_redirect["xsawrlite_easy_redirect"]["rurl"]) && empty($xsawrlite_redirect["xsawrlite_easy_redirect"]["rurl"])) || trim($xsawrlite_redirect["xsawrlite_easy_redirect"]["rurl"]) == '' ){
			$datajson['error'] = esc_html__( 'Please Enter Request URL' , XSAWRLITE_DOMAIN ); 
		}
		if($slash != '/'){
			$xsawrlite_redirect["xsawrlite_easy_redirect"]['rurl'] = '/'.$rurl;
		}else{
			$xsawrlite_redirect["xsawrlite_easy_redirect"]['rurl'] = $rurl;
		}
		if( !isset($xsawrlite_redirect["xsawrlite_easy_redirect"]['nw'])){
			if( isset($xsawrlite_redirect["xsawrlite_easy_redirect"]['nf']) ){
				$temp1= $xsawrlite_redirect["xsawrlite_easy_redirect"]['nf'] ;
				unset($xsawrlite_redirect["xsawrlite_easy_redirect"]['nf']);
				$xsawrlite_redirect["xsawrlite_easy_redirect"]['nw']='0';
				$xsawrlite_redirect["xsawrlite_easy_redirect"]['nf'] = $temp1;
			}else{
				$xsawrlite_redirect["xsawrlite_easy_redirect"]['nw']='0';
			}
		}
		if( !isset($xsawrlite_redirect["xsawrlite_easy_redirect"]['nf'])){
			$xsawrlite_redirect["xsawrlite_easy_redirect"]['nf'] = '0';
		}
		
		if(!isset($_POST['redirect_id'])){
			if( in_array($xsawrlite_redirect["xsawrlite_easy_redirect"]['rurl'] , array_column($redirects, 'rurl') ) ){
				$datajson['error'] = esc_html__( "Request URL Already Exist" , XSAWRLITE_DOMAIN );
			}else{
				$redirects[$index+1] = $xsawrlite_redirect["xsawrlite_easy_redirect"];
				$datajson['success'] = esc_html__('Added Redirect Successfully' , XSAWRLITE_DOMAIN );
			}
		}else{
			$xsawr_id = sanitize_text_field($_POST['redirect_id']);
			$pev_redirect = $redirects[$xsawr_id];
			$redirects[$xsawr_id] = $xsawrlite_redirect["xsawrlite_easy_redirect"];
			$datajson['updated'] = esc_html__('Updated Redirect Successfully' , XSAWRLITE_DOMAIN );
		}
		if( (isset($xsawrlite_redirect["xsawrlite_easy_redirect"]["durl"]) && empty($xsawrlite_redirect["xsawrlite_easy_redirect"]["durl"])) || trim($xsawrlite_redirect["xsawrlite_easy_redirect"]["durl"]) == '' ){
			$datajson['error'] = esc_html__( 'Please Enter Target URL' , XSAWRLITE_DOMAIN ); 
		}
		if(!isset($datajson['error'])){
			$redirects =  filter_var_array( $redirects , FILTER_SANITIZE_STRING);
			update_option('xsawrlite_easy_redirect' , $redirects );	
	     	$output='';
			$xsawrlite_eredirect = get_option('xsawrlite_easy_redirect');
			foreach($xsawrlite_eredirect as $xsawrlite_key=>$val){
				$output.= '<tr id="xsawrlite-row-'. esc_html__($xsawrlite_key) .'">';
				$output.=  '<td class="mdl-data-table__cell--non-numeric">'.esc_html__($xsawrlite_key).'</td>';
				$output.= '<td class="mdl-data-table__cell--non-numeric">';	
				if($val['title'] != ""){
			    	$output.= esc_html__($val['title']);
			    }else{
			    	$output.= esc_html__($val['rurl']);
			    }
			    if( isset( $val['durl'] ) &&  $val['durl'] != "") {
			    	$output.= '<br>'. esc_html__($val['durl']);
			    }	
				$output.= '</td>';
				$output.= '<td class="mdl-data-table__cell--non-numeric">' . esc_html__($val['qp_rule']) .'</td>';	
				$output.= '<td class="mdl-data-table__cell--non-numeric">';
				$output.= '<span id="'. esc_html__($xsawrlite_key).'" title="'.esc_attr__("Edit" , XSAWRLITE_DOMAIN ).'" class="dashicons dashicons-edit xsawrlite-edit"></span>';
				$output.= '<span id="'. esc_html__($xsawrlite_key) .'" title="'.esc_attr__("Delete" , XSAWRLITE_DOMAIN ).'" class="dashicons dashicons-trash xsawrlite-del"></span>';
				$output.= '</td>';	
				$output.= '</tr>';
			}
			$datajson['output'] = $output;
		}
		wp_send_json( $datajson );
	}

	/**
	* delete redirect by ajax
	* @param NULL
	* @return NULL
	*/
	public function xsawrlite_del(){
		$data = array();
		if(isset($_POST["redirect_id"])){
			$data = get_option('xsawrlite_easy_redirect');
			$id = sanitize_text_field($_POST['redirect_id']);
			unset($data[$id]);
			update_option('xsawrlite_easy_redirect' , $data );
			$msg['msg'] = esc_html__("Deleted Redirect Successfully" , XSAWRLITE_DOMAIN );
			wp_send_json($msg);
		}
	}

	/**
	* Edit the redirects by ajax call
	*
	*/
	public function xsawrlite_edit_redirects(){
		$id = sanitize_text_field($_POST['redirect_id']);
		$check = '';
		$redirects = get_option('xsawrlite_easy_redirect');
		$data = $redirects[$id];
		?>
		<td><?php esc_html_e($id); ?></td>
		<td class="mdl-data-table__cell--non-numeric" COLSPAN=3>
			<form method="post" id="xsawrlite_redirect_<?php esc_html_e($id); ?>">
				<div class="section__block mdl-grid">
					<div class="mdl-cell mdl-cell--6-col mdl-cell--middle xsawrlite-col">
						<p class="xsawrlite_p">
							<b><?php esc_html_e( "Make this url No Follow" , XSAWRLITE_DOMAIN ); ?></b>
						</p>
						<label class="mdl-switch mdl-js-switch mdl-js-ripple-effect " for="xsawrlite-nf-<?php esc_html_e($id)?>">
							<input type="checkbox" id="xsawrlite-nf-<?php esc_html_e($id)?>" class="mdl-switch__input" name="xsawrlite_easy_redirect[nf]" value="1" <?php esc_html_e( (isset($data['nf']) && $data['nf'] == 1 )? "checked":'') ; ?>/>
						</label>
					</div>
					<div class="mdl-cell mdl-cell--6-col mdl-cell--middle xsawrlite-col">
						<p class="xsawrlite_p">
							<b><?php esc_html_e( "Open this URL in new Tab" , XSAWRLITE_DOMAIN ); ?></b>
						</p>
						<label class="mdl-switch mdl-js-switch mdl-js-ripple-effect " for="xsawrlite-nw-<?php esc_html_e($id)?>">
							<input type="checkbox" id="xsawrlite-nw-<?php esc_html_e($id); ?>" class="mdl-switch__input" name="xsawrlite_easy_redirect[nw]" value="1" <?php esc_html_e( (isset($data['nw']) && $data['nw'] == 1 )? "checked":'') ; ?>/>
						</label>
					</div>
				</div>
				<div class="section__block mdl-grid">
					<div class="mdl-cell mdl-cell--6-col mdl-cell--middle xsawrlite-col-2">
						<p class="xsawrlite_p-2">
							<b><?php esc_html_e( "Request URL" , XSAWRLITE_DOMAIN ); ?></b>
						</p>
						<div class="mdl-textfield mdl-js-textfield xsawrlite-input">
		        			<input class="mdl-textfield__input" type="text" id="xsawrlite-rurl-<?php esc_html_e($id);?>"  name="xsawrlite_easy_redirect[rurl]" placeholder="Enter request URL you want to redirect" value="<?php esc_html_e( (isset($data['rurl']) )?$data['rurl'] :'') ; ?>"  >
						</div>
					</div>
					<div class="mdl-cell mdl-cell--6-col mdl-cell--middle xsawrlite-col-2">
						<p class="xsawrlite_p-2">
							<b><?php esc_html_e( "Query Parameters" , XSAWRLITE_DOMAIN ); ?></b>
						</p>
						<div class="mdl-textfield mdl-js-textfield getmdl-select xsawrlite-input">
					       <select class="mdl-textfield__input" name="xsawrlite_easy_redirect[qp]">
								<option <?php esc_attr_e( ($data["qp"] == "exact")? "selected":'' ); ?> value="exact">
									<?php esc_html_e( "Exact Match" , XSAWRLITE_DOMAIN ); ?>
								</option>
								<option disabled value="ignore">
									<?php esc_html_e( "Ignore all query parameters" , XSAWRLITE_DOMAIN ); ?>
								</option>
								<option disabled value="ignore-and-pass">
									<?php esc_html_e( "Ignore and pass all query parameters" , XSAWRLITE_DOMAIN ); ?>
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
					       <input class="mdl-textfield__input" type="text" id="xsawrlite-title"  name="xsawrlite_easy_redirect[title]" value="<?php esc_html_e( (isset($data['title']) )? $data['title']:''); ?>"  >
					    </div>
					</div>
					<div class="mdl-cell mdl-cell--6-col mdl-cell--middle xsawrlite-col-2">
						<p class="xsawrlite_p-2">
							<b><?php esc_html_e( "Match" , XSAWRLITE_DOMAIN ); ?></b>
						</p>
						<div class="mdl-textfield mdl-js-textfield xsawrlite-input">
		        			<select class="mdl-textfield__input" name="xsawrlite_easy_redirect[match]" id="xsawrlite-murl-<?php esc_html_e($id); ?>">
								<option <?php esc_attr_e( ($data["match"] == "durl" )? "selected":''); ?> value="durl">
									<?php esc_html_e( "URL Only" , XSAWRLITE_DOMAIN ); ?>
								</option>
								<option disabled value="url_login">
									<?php esc_html_e( "URL and login status(pro version)" , XSAWRLITE_DOMAIN ); ?>
								</option>
								<option disabled value="url_role">
									<?php esc_html_e( "URL and Role(pro version)" , XSAWRLITE_DOMAIN ); ?>
								</option>
								<option disabled  value="url_ip">
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
		        			<select class="mdl-textfield__input" id="xsawrlite-matched-<?php esc_html_e( $id ); ?>" name="xsawrlite_easy_redirect[matched]">
								<option <?php esc_attr_e( ($data["matched"] == "redirect_url" )? "selected":''); ?> value="redirect_url">
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
					<div class="mdl-cell mdl-cell--6-col mdl-cell--middle xsawrlite-col-2" id="http-code-<?php esc_html_e( $id ); ?>" >
						<p class="xsawrlite_p-2">
							<b><?php esc_html_e( "HTTP code" , XSAWRLITE_DOMAIN ); ?></b>
						</p>
						<div class="mdl-textfield mdl-js-textfield xsawrlite-input">
		        			<select class="mdl-textfield__input" id="xsawrlite-qp-<?php esc_html_e( $id ); ?>" name="xsawrlite_easy_redirect[qp_rule]">
								<option <?php esc_attr_e( ($data["qp_rule"] == "301" )? "selected":''); ?> value="301">
									<?php esc_html_e( "301 - Moved Permanently " , XSAWRLITE_DOMAIN ); ?>
								</option>
								<option <?php esc_attr_e( ($data["qp_rule"] == "302" )? "selected":''); ?> value="302">
									<?php esc_html_e( "302 - Found" , XSAWRLITE_DOMAIN ); ?>
								</option>
								<option <?php esc_attr_e( ($data["qp_rule"] == "303" )? "selected":''); ?> value="303">
									<?php esc_html_e( "303 - See Other" , XSAWRLITE_DOMAIN ); ?>
								</option>
								<option <?php esc_attr_e( ($data["qp_rule"] == "304" )? "selected":''); ?> value="304">
									<?php esc_html_e( "304 - Not Modified" , XSAWRLITE_DOMAIN ); ?>
								</option>
								<option <?php esc_attr_e( ($data["qp_rule"] == "307" )? "selected":''); ?> value="307">
									<?php esc_html_e( "307 - Redirect Temporary" , XSAWRLITE_DOMAIN ); ?>
								</option>
								<option <?php esc_attr_e( ($data["qp_rule"] == "308" )? "selected":''); ?> value="308">
									<?php esc_html_e( "308 - Redirect Permanent" , XSAWRLITE_DOMAIN ); ?>
								</option>
							</select>
						</div>
					</div>
				</div>
				<div class="section__block mdl-grid">
					<div class="mdl-cell mdl-cell--6-col mdl-cell--middle xsawrlite-col-2" id="xsawrlite_durl-<?php esc_html_e( $id ); ?>" >
						<p class="xsawrlite_p-2" id='xsawrlite_pdurl-<?php esc_html_e( $id ) ?>'>
								<b><?php esc_html_e( "Target URL" , XSAWRLITE_DOMAIN ); ?></b>
						</p>
	        			<div class="mdl-textfield mdl-js-textfield xsawrlite-input" id='xsawrlite_inputdurl-<?php esc_html_e( $id ); ?>' >
		        				<input class="mdl-textfield__input" type="text" id="xsawrlite-durl"  name="xsawrlite_easy_redirect[durl]" value="<?php esc_html_e($data["durl"]); ?>" placeholder="<?php esc_attr_e("Target URL you want to redirect if matched", XSAWRLITE_DOMAIN) ?>" />
						</div>
					</div>
				</div>
				<div class="mdl-grid xsawrlite-button">
	        		<div id='<?php esc_html_e($id) ?>'>
	        			<?php submit_button(esc_html__("Update" , XSAWRLITE_DOMAIN ), 'primary' , 'xsawrlite-save' ); ?>
	        		</div>
	        		<div id='<?php esc_html_e($id) ?>'>
	        			<?php submit_button(esc_html__("Cancel" , XSAWRLITE_DOMAIN ), 'secondary' , 'xsawrlite-cancel'); ?>
	        		</div>
	        	</div>
		    </form>
		</td>
		<?php 
	}

	/**
	* AJax call method for new window or no follow
	* @param NULL
	* @return NULL
	*/
	public function xsawrlite_get_nf_link(){
		$redirects = array();
		$master_options = get_option('xsawrlite-masteroptions');
		if(!isset($master_options['off-redirect'])){
			$redirects["off"] = 0 ;
			$redirects["nf_redirect"]  = (isset($master_options["nf-redirect"])) ? 1: 0 ;
			$redirects["nw_redirect"]  = (isset($master_options["nw-redirect"])) ? 1: 0 ;
			$redirects["all_redirect"] = get_option('xsawrlite_easy_redirect');
			
 		}else{
 			$redirects["off"] = 1;
 		}
 		wp_send_json($redirects);
	}

	/**
	* redirect method
	* @param NULL
	* @return NULL
	*/
	public function xsawrlite_redirect_url(){
		$master_options = get_option('xsawrlite-masteroptions');
		if(!isset($master_options['off-redirect'])){
			$current_url = $_SERVER["REQUEST_URI"];
			$all_redirects = get_option('xsawrlite_easy_redirect');
			if( isset($all_redirects) && !empty($all_redirects) ){
				foreach($all_redirects as $key){
					$case_sensitive = false ;
					$srurl = $key['rurl'].'/'; 
					if( $key['match'] == "durl"){
						$tempdurl = ( isset($key['durl'] ) )?$key['durl']:'';
					}
					if($key['qp'] == "exact"){
						$current_url = $_SERVER["REQUEST_URI"];
					}
					if( $key['rurl'] == $current_url || $srurl == $current_url ){
						if( isset($master_options['gt_redirect']) && $master_options['gt_redirect'] != ''){
							wp_redirect( $master_options['gt_redirect'] );
							exit;
						}else{
							wp_redirect( $tempdurl , $key['qp_rule'] );
							exit;	
						}
					}
				}
			}
 		}
	}

	/**
	* redirect method of all 404 to homepage
	* @param NULL
	* @return NULL
	*/
	public function xsawrlite_redirect_url_404(){
		$master_options = get_option('xsawrlite-masteroptions');
		if(!isset($master_options['off-redirect'])){
			if(is_404()){
				if(isset($master_options['404-redirect'])){
					wp_redirect(home_url());
					exit;
				}
			}
		}

	}

	public function xsawrlite_send_mail(){
				$data = array();
        parse_str($_POST['data'], $data);
        $data['plugin_name'] = 'WP Post Redirection';
        $data['version'] = 'lite';
        $data['website'] = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://".$_SERVER['HTTP_HOST'];
        $to = 'xfinitysoft@gmail.com';
        switch ($data['type']) {
        	case 'report':
        		$subject = 'Report a bug';
        		break;
        	case 'hire':
        		$subject = 'Hire us to customize/develope Plugin/Theme or WordPress projects';
        		break;
        	
        	default:
        		$subject = 'Request a Feature';
        		break;
        }
		
		$body = '<html><body><table>';
		$body .='<tbody>';
		$body .='<tr><th>User Name</th><td>'.$data['xsawrlite_name'].'</td></tr>';
		$body .='<tr><th>User email</th><td>'.$data['xsawrlite_email'].'</td></tr>';
		$body .='<tr><th>Plugin Name</th><td>'.$data['plugin_name'].'</td></tr>';
		$body .='<tr><th>Version</th><td>'.$data['version'].'</td></tr>';
		$body .='<tr><th>Website</th><td><a href="'.$data['website'].'">'.$data['website'].'</a></td></tr>';
		$body .='<tr><th>Message</th><td>'.$data['xsawrlite_message'].'</td></tr>';
		$body .='</tbody>';
		$body .='</table></body></html>';
		$headers = array('Content-Type: text/html; charset=UTF-8');
		$params ="name=".$data['xsawrlite_name'];
		$params.="&email=".$data['xsawrlite_email'];
		$params.="&site=".$data['website'];
		$params.="&version=".$data['version'];
		$params.="&plugin_name=".$data['plugin_name'];
		$params.="&type=".$data['type'];
		$params.="&message=".$data['xsawrlite_message'];
		$sever_response = wp_remote_post("https://xfinitysoft.com/wp-json/plugin/v1/quote/save/?".$params);
        $se_api_response = json_decode( wp_remote_retrieve_body( $sever_response ), true );
		
		if($se_api_response['status']){
			$mail = wp_mail( $to, $subject, $body, $headers );
			wp_send_json(array('status'=>true));
		}else{
			wp_send_json(array('status'=>false));
		}
		wp_die();
	}
}
?>