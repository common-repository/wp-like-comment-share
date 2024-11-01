<?php 
// Provide a admin area view for the plugin
class Fblcs_Admin_Display {	
	// All navigation menu
	public function fblcs_tab () {
		$query_string 	=	esc_html ( $_GET['page'] );		
		?>
		<h2 class="nav-tab-wrapper">	        	
			<a href="?page=fblcs" class="fblcs nav-tab <?php echo $query_string == 'fblcs' ? 'active' : ''; ?> ">
            	<?php _e( 'Comment Settings', 'wp-like-comment-share' ); ?>
        	</a>        	
			<a href="?page=fblcs-like-settings" class="fblcs nav-tab <?php echo $query_string == 'fblcs-like-settings' ? 'active' : ''; ?> ">
            	<?php _e( 'Like Settings', 'wp-like-comment-share' ); ?>
        	</a>
        	<a href="?page=fblcs-share-settings" class="fblcs nav-tab <?php echo $query_string == 'fblcs-share-settings' ? 'active' : ''; ?> ">
            	<?php _e( 'Share Settings', 'wp-like-comment-share' ); ?>
        	</a>
        </h2>
		<?php
	}

	// show the comment settings form 
	public function show_setting_form ( $fblcs_c_title, $fblcs_c_title_size, $fblcs_how_to_show, $fblcs_hide_post_form, $fblcs_hide_page_form, $fblcs_disable_comments_and_form, $fblcs_c_color, $fblcs_c_mobile_optimize, $fblcs_c_num_of_post, $fblcs_c_order_by, $fblcs_c_width ) {
		?>
		<div class="wrap">		
			<h2><?php _e( 'WP Comment Settings', 'wp-like-comment-share'); ?></h2>
			<!-- get the tab -->
	       	<?php $this->fblcs_tab();  ?>
			<div class="fblcs-container">
				<form id="fblcs_ajax_form_id">
			        <table class="widefat fixed" cellspacing="0">
			        	<tr>
			        		<td>
			        			<?php _e( 'Title', 'wp-like-comment-share' ); ?>
			        			<br>
			        			<small>
			        				<?php _e ( 'Set the title above the comment box', 'wp-like-comment-share' ); ?>
			        			</small>
			        		</td>
			        		<td>
			        			<input type="text" name="fblcs_c_title" value="<?php echo esc_html ( $fblcs_c_title ); ?>" placeholder="<?php echo _e ( 'Title', 'wp-like-comment-share' ); ?>">
			        		</td>
			        	</tr>
			        	<tr>
			        		<td>
			        			<?php _e( 'Title Size', 'wp-like-comment-share' ); ?>
			        			<br>
			        			<small>
			        				<?php _e ( 'Set the title size e.g h1, h2 h3', 'wp-like-comment-share' ); ?>
			        			</small>
			        		</td>
			        		<td>
			        			<select name="fblcs_c_title_size">
			        				<option value="">
			        					<?php _e ( '--Select---', 'wp-like-comment-share' ) ; ?>
			        				</option>
			        				<?php 
			        				for ( $size = 1; $size <= 6; $size++ ) { 
			        					if ( $fblcs_c_title_size == 'h'.$size )  {
			        						$selected 	=	'selected';
			        					} else {
			        						$selected 	=	'';
			        					}
			        					echo "<option $selected value='h{$size}'>h{$size}</option>";	
			        				}
			        				?>			        				
			        			</select>
			        		</td>
			        	</tr>
			        	<tr>
			        		<td>
			        			<?php _e( 'How do you want to show the facebook comment box?', 'wp-like-comment-share' ); ?>
			        		</td>
			        		<td>
			        			<input type="checkbox" checked disabled>&nbsp;
			        			<?php _e( 'Using Shortcode (default). Use ', 'wp-like-comment-share' ); ?>
			        			<code>[fb_comment_btn]</code>
							</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>
			        			<input type="checkbox" <?php checked( $fblcs_how_to_show, 1, true ); ?> class="fblcs_c_option" name="fblcs_how_to_show" value="1">&nbsp;
			        			<?php _e( 'Show below the comment box of each blog post', 'wp-like-comment-share' ); ?>
			        		</td>
			        	</tr>
			        	<tr class="fblcs_hide_post_form">
			        		<td>&nbsp;</td>
			        		<td>
			        			<input type="checkbox" <?php checked( $fblcs_hide_post_form, 1, true ); ?> name="fblcs_hide_post_form" value="1">&nbsp;
			        			<?php _e( 'Disable/hide comment form for the blog post', 'wp-like-comment-share' ); ?>
			        		</td>			        		
			        	</tr>			        	
			        	<tr class="fblcs_disable_comments_and_form">
			        		<td>&nbsp;</td>
			        		<td>
			        			<input type="checkbox" <?php checked( $fblcs_disable_comments_and_form, 1, true ); ?> name="fblcs_disable_comments_and_form" value="1">&nbsp;
			        			<?php echo _e( 'Disable comment form and hide all existing comments.', 'wp-like-comment-share' ); ?>
			        		</td>
			        	</tr>
			        	<tr>
			        		<td>			        			
		        				<?php _e( 'Color', 'wp-like-comment-share' ); ?> <br/> 
		        				<small>
		        					<?php _e( 'The color scheme used by the comments plugin. Can be "light" or "dark".', 'wp-like-comment-share' ); ?>
		        				</small>
			        		</td>	        	
			        		<td>
			        			<select name="fblcs_c_color">
			        				<option value="">
			        					<?php _e( '--Select--', 'wp-like-comment-share' ); ?>
									</option>
			        				<option selected value="light">
			        					<?php _e( 'light', 'wp-like-comment-share' ); ?>
			        				</option>
			        				<option <?php selected ( $fblcs_c_color, 'dark' ); ?> value="dark">
			        					<?php _e( 'Dark', 'wp-like-comment-share' );?>
			        				</option>
			        			</select>
			        		</td>
			        	</tr>
			        	<tr>
			        		<td>			        			
		        				<?php _e( 'Mobile Optimize', 'wp-like-comment-share' ); ?> <br/> 
		        				<small>
		        					<?php _e( 'A boolean value that specifies whether to show the mobile-optimized version or not.', 'wp-like-comment-share' ); ?>
		        				</small>
			        		</td>	        	
			        		<td>
			        			<select name="fblcs_c_mobile_optimize" id="fblcs_c_mobile_optimize">
			        				<option value="">
			        					<?php _e( '--Select--', 'wp-like-comment-share' ); ?>
			        				</option>
			        				<option selected value="true">
			        					<?php _e( 'True', 'wp-like-comment-share' ); ?>
			        				</option>
			        				<option <?php selected ( $fblcs_c_mobile_optimize, 'false' ); ?> value="false">
			        					<?php _e( 'False', 'wp-like-comment-share' );?>
			        				</option>
			        			</select>
			        		</td>
			        	</tr>
			        	<tr>
			        		<td>			        			
		        				<?php _e( 'Number of Comments', 'wp-like-comment-share' ); ?> <br/> 
		        				<small>
		        					<?php _e( 'The number of comments to show by default.', 'wp-like-comment-share' ); ?>
		        				</small>			        			
			        		</td>	        	
			        		<td>
			        			<input type="number" name="fblcs_c_num_of_post" value="<?php if ( $fblcs_c_num_of_post ) { echo esc_html ( $fblcs_c_num_of_post ); } else echo 10 ; ?>">
			        		</td>
			        	</tr>
			        	<tr>
			        		<td>
		        				<?php _e( 'Order By', 'wp-like-comment-share' ); ?> <br/> 
		        				<small>
		        					<?php _e( 'The order to use when displaying comments.', 'wp-like-comment-share' ); ?>
		        				</small>
			        		</td>	        	
			        		<td>
			        			<select name="fblcs_c_order_by">
			        				<option value="">
			        					<?php _e( '--Select--', 'wp-like-comment-share' ); ?>
			        				</option>
			        				<option selected value="social">
			        					<?php _e( 'Social', 'wp-like-comment-share' ); ?>
			        				</option>
			        				<option <?php selected ( $fblcs_c_order_by, 'reverse_time' );  ?> value="reverse_time">
			        					<?php _e( 'Reverse Time', 'wp-like-comment-share' );?>
			        				</option>
			        				<option <?php selected ( $fblcs_c_order_by, 'time' );  ?> value="time">
			        					<?php _e( 'Time', 'wp-like-comment-share' );?>
			        				</option>
			        			</select>	        			
			        		</td>
			        	</tr>
			        	<tr>
			        		<td colspan="2">
			        			<p>
		        					<b>
		        						<?php _e( 'social (default)', 'wp-like-comment-share' );?>
		        					</b>
		        					<?php _e( 'This is also known as "Top". The comments plugin uses social signals to surface the highest quality comments. Comments are ordered so that the most relevant comments from friends and friends of friends are shown first, as well as the most-liked or active discussion threads.', 'wp-like-comment-share' ); ?></p>
		        				<p>
		        					
	        					<p>
	        						<b>
	        							<?php _e( 'reverse_time', 'wp-like-comment-share' ); ?>
	        						</b>
									<?php _e( 'Comments are shown in the opposite order that they were posted, with the newest comments at the top and the oldest at the bottom.', 'wp-like-comment-share' ); ?>
								</p>

								<p>
									<b>
										<?php _e( 'time', 'wp-like-comment-share' ); ?>
									</b>
									<?php _e( 'Comments are shown in the order that they were posted, with the oldest comments at the top and the newest at the bottom.', 'wp-like-comment-share' ); ?>
								</p>
			        		</td>
			        	</tr>
			        	<tr id="fblcs_c_width">
			        		<td>
			        			<p>
			        				<?php _e( 'Width', 'wp-like-comment-share' ); ?> <br/> 
			        				<small>
			        					<?php _e( 'The width of the comments plugin on the webpage. This can be either a pixel value or a percentage (such as 100%) for fluid width.', 'wp-like-comment-share' ); ?>
			        				</small>
			        			</p>
			        		</td>	        	
			        		<td>
			        			<input type="text" name="fblcs_c_width" placeholder="e.g: 100px or 50%" value="<?php echo $fblcs_c_width; ?>">
			        		</td>
			        	</tr>
			        	<tr>
			        		<td>
			        			<input type="submit" id="fblcs_submit_btn" name="submit" value="Save Change" class="button-primary">
			        			<?php wp_nonce_field( 'fblcs_c_setting_action', 'fblcs_s_nonce' ); ?>
			        			<input type="hidden" name="fblcs_action_name" id="fblcs_action_name" value="fblcs_c_setting_action">
			        		</td>
			        	</tr>
			        </table>
			    </form>
		        <div class="fblcs_ajax_result"></div>
		     </div>
	    </div>
		<?php
	}

	// show like settings form
	public function fblcs_like_setting_form ( $fblcs_l_title, $fblcs_l_title_size, $fblcs_l_href_auto, $fblcs_l_href, $fblcs_l_color, $fblcs_l_layout, $fblcs_l_size, $fblcs_l_faces, $fblcs_l_share, $fblcs_l_action, $fblcs_l_width, $fblcs_l_height, $fblcs_l_border, $fblcs_l_border_style, $fblcs_l_border_color, $fblcs_l_background, $fblcs_l_padding, $fblcs_l_margin ) {		
		?>
		<div class="wrap">		
			<h2><?php _e( 'WP Like Settings', 'wp-like-comment-share'); ?></h2>
	      	<!-- get the tab -->
	       	<?php $this->fblcs_tab();  ?>  
			<div class="fblcs-container">
				<form id="fblcs_ajax_form_id">
			        <table class="widefat fixed" cellspacing="0">			        	
			        	<tr>
			        		<td colspan="2">
			        			<b><?php _e( 'Use shortcode', 'wp-like-comment-share' ); ?></b><code>[fb_like_btn]</code> <b><?php _e( 'to show the like button.', 'wp-like-comment-share' ); ?></b>
			        		</td>
			        	</tr>
			        	<tr>
			        		<td>
			        			<?php _e( 'Title', 'wp-like-comment-share' ); ?>
			        			<br>
			        			<small>
			        				<?php _e ( 'Set the title above the like box', 'wp-like-comment-share' ); ?>
			        			</small>
			        		</td>
			        		<td>
			        			<input type="text" name="fblcs_l_title" value="<?php echo esc_html ( $fblcs_l_title ); ?>" placeholder="<?php echo _e ( 'Title', 'wp-like-comment-share' ); ?>">
			        		</td>
			        	</tr>
			        	<tr>
			        		<td>
			        			<?php _e( 'Title Size', 'wp-like-comment-share' ); ?>
			        			<br>
			        			<small>
			        				<?php _e ( 'Set the title size e.g h1, h2 h3', 'wp-like-comment-share' ); ?>
			        			</small>
			        		</td>
			        		<td>
			        			<select name="fblcs_l_title_size">
			        				<option value="">
			        					<?php _e ( '--Select---', 'wp-like-comment-share' ) ; ?>
			        				</option>
			        				<?php 
			        				for ( $size = 1; $size <= 6; $size++ ) { 
			        					if ( $fblcs_l_title_size == 'h'.$size )  {
			        						$selected 	=	'selected';
			        					} else {
			        						$selected 	=	'';
			        					}
			        					echo "<option $selected value='h{$size}'>h{$size}</option>";	
			        				}
			        				?>			        				
			        			</select>
			        		</td>
			        	</tr>
			        	<tr>
			        		<td>
			        			<?php _e( 'URL', 'wp-like-comment-share' ); ?>
			        			<br/>
			        			<small>
			        				<?php _e( 'The absolute URL of the page that will be liked.', 'wp-like-comment-share' ); ?>
			        			</small>
			        		</td>
			        		<td>
			        			<select name="fblcs_l_href_auto" class="fblcs_l_href_auto">
			        				<option value="">
			        					<?php _e( '--Select--', 'wp-like-comment-share' ); ?>
			        				</option>
			        				<option value="auto" <?php selected( $fblcs_l_href_auto, 'auto' ); ?> >
			        					<?php _e( 'Auto detect the current page URL', 'wp-like-comment-share' ); ?>
			        				</option>
			        				<option value="given" <?php selected( $fblcs_l_href_auto, 'given' ); ?>>
			        					<?php _e( 'Let me give it', 'wp-like-comment-share' ); ?>
			        				</option>
			        			</select>			        			
			        		</td>
			        	</tr>
			        	<tr id="let_me_give_it">
			        		<td>&nbsp;</td>
			        		<td>
			        			<input type="text" name="fblcs_l_href" placeholder="<?php _e( 'Enter the URL', 'wp-like-comment-share' ); ?>" value="<?php echo esc_url ( $fblcs_l_href ); ?>">
			        		</td>
			        	</tr>
			        	<tr>
			        		<td>
			        			<?php _e( 'Color', 'wp-like-comment-share' ); ?>
			        			<br/> 
			        			<small>
			        				<?php _e( 'The color scheme used by the plugin for any text outside of the button itself.', 'wp-like-comment-share' ); ?>
			        			</small>
			        		</td>
			        		<td>
			        			<select name="fblcs_l_color">
			        				<option value="">
			        					<?php _e( '--Select--', 'wp-like-comment-share' ); ?>
			        				</option>
			        				<option selected value="light" <?php selected( $fblcs_l_color, 'light' ); ?> >
			        					<?php _e( 'Light', 'wp-like-comment-share' ); ?>
			        				</option>
			        				<option value="dark" <?php selected( $fblcs_l_color, 'dark' ); ?> >
			        					<?php _e( 'Dark', 'wp-like-comment-share' ); ?>
			        				</option>
			        			</select>
			        		</td>
			        	</tr>
			        	<tr>
			        		<td>
			        			<?php _e( 'Layout', 'wp-like-comment-share' ); ?>
			        			<br/>
			        			<small>
			        				<?php _e( 'Selects one of the different layouts that are available for the plugin.', 'wp-like-comment-share' ); ?>			        				
			        			</small>
			        		</td>
			        		<td>
			        			<select name="fblcs_l_layout">
			        				<option value="">
			        					<?php _e( '--Select Layout--', 'wp-like-comment-share' ); ?>
			        				</option>
			        				<option selected value="standard" <?php selected( $fblcs_l_layout, 'standard' ); ?> >
			        					<?php _e( 'Standard', 'wp-like-comment-share' ); ?>
			        				</option>
			        				<option value="button_count" <?php selected( $fblcs_l_layout, 'button_count' ); ?> >
			        					<?php _e( 'Button Count', 'wp-like-comment-share' ); ?>
			        				</option>
			        				<option value="button" <?php selected( $fblcs_l_layout, 'button' ); ?> >
			        					<?php _e( 'Button', 'wp-like-comment-share' ); ?>
			        				</option>
			        				<option value="box_count"  <?php selected( $fblcs_l_layout, 'box_count' ); ?> >
			        					<?php _e( 'Box Count', 'wp-like-comment-share' ); ?>
			        				</option>
			        			</select>
			        		</td>
			        	</tr>
			        	<tr>
			        		<td>
			        			<?php _e( 'Size', 'wp-like-comment-share' ); ?><br/>
			        			<small>
			        				<?php _e( 'The button is offered in 2 sizes', 'wp-like-comment-share' ); ?>
			        			</small>
			        		</td>
			        		<td>
			        			<select name="fblcs_l_size">			        				
			        				<option value="">
			        					<?php _e( '--Select--', 'wp-like-comment-share' ); ?>
			        				</option>
			        				<option value="large" <?php selected( $fblcs_l_size, 'large' ); ?> >
			        					<?php _e( 'Large', 'wp-like-comment-share' ); ?>
			        				</option>
			        				<option value="small" <?php selected( $fblcs_l_size, 'small' ); ?>>
			        					<?php _e( 'Small', 'wp-like-comment-share' ); ?>
			        				</option>
			        			</select>			        			
			        		</td>
			        	</tr>
			        	<tr>
			        		<td>
			        			<?php _e( 'Show Faces', 'wp-like-comment-share' ); ?><br/>
			        			<small>
			        				<?php _e( 'Specifies whether to display profile photos below the button (standard layout only).', 'wp-like-comment-share' ); ?>
			        			</small>
			        		</td>
			        		<td>
			        			<select name="fblcs_l_faces">
			        				<option value="">
			        					<?php _e( '--Select--', 'wp-like-comment-share' ); ?>
			        				</option>
			        				<option value="true" <?php selected( $fblcs_l_faces, 'true'); ?> >
			        					<?php _e( 'True', 'wp-like-comment-share' ); ?>
			        				</option>
			        				<option value="false" <?php selected( $fblcs_l_faces, 'false'); ?> >
			        					<?php _e( 'False', 'wp-like-comment-share' ); ?>
			        				</option>
			        			</select>
			        			<br/>
			        			<small class="fblcs-info-red">
			        				<?php _e( 'Only work for standard layout', 'wp-like-comment-share' ); ?>
			        			</small>
			        		</td>
			        	</tr>
			        	<tr>
			        		<td>
			        			<?php _e( 'Show share button', 'wp-like-comment-share' ) ?>
			        			<br/>
			        			<small>
			        				<?php _e( 'Specifies whether to include a share button beside the Like button.', 'wp-like-comment-share' ); ?>
			        			</small>
			        		</td>
			        		<td>
			        			<select name="fblcs_l_share">
			        				<option value="">
			        					<?php _e( '--Select--', 'wp-like-comment-share' ); ?>
			        				</option>
			        				<option value="true" <?php selected( $fblcs_l_share, 'true' ); ?> >
			        					<?php _e( 'True', 'wp-like-comment-share' ); ?>
			        				</option>
			        				<option value="false" <?php selected( $fblcs_l_share, 'false' ); ?> >
			        					<?php _e( 'False', 'wp-like-comment-share' ); ?>
			        				</option>
			        			</select>
			        		</td>
			        	</tr>
			        	<tr>
			        		<td>
			        			<?php _e( 'Action', 'wp-like-comment-share' ); ?>
			        			<br/>
			        			<small>
			        				<?php _e( 'The verb to display on the button. ', 'wp-like-comment-share' ); ?>
			        			</small>
			        		</td>
			        		<td>
			        			<select name="fblcs_l_action">
			        				<option value="">
			        					<?php _e( '--Select--', 'wp-like-comment-share' ); ?>
			        				</option>
			        				<option value="like" <?php selected( $fblcs_l_action, 'like' ); ?> >
			        					<?php _e( 'Like', 'wp-like-comment-share' ); ?>
			        				</option>
			        				<option value="recommend" <?php selected( $fblcs_l_action, 'recommend' ); ?>>
			        					<?php _e( 'Recommend', 'wp-like-comment-share' ); ?>
			        				</option>
			        			</select>
			        		</td>
			        	</tr>	
			        	<tr>
			        		<td>
			        			<?php _e( 'Width', 'wp-like-comment-share' ); ?><br/>
			        			<small>
			        				<?php _e( 'The width of the whole plugin area', 'wp-like-comment-share' ); ?>
			        			</small>
			        		</td>
			        		<td>
			        			<input type="number" name="fblcs_l_width" class="fblcs-small-input" placeholder="<?php _e( 'px', 'wp-like-comment-share'); ?>" value="<?php echo esc_html ( $fblcs_l_width ); ?>">
			        		</td>
			        	</tr>
			        	<tr>
			        		<td>
			        			<?php _e( 'Height', 'wp-like-comment-share' ); ?>
			        			<br/>
			        			<small>
			        				<?php _e( 'The height of the whole plugin area', 'wp-like-comment-share' ); ?>
			        			</small>
			        		</td>
			        		<td>
			        			<input type="number" name="fblcs_l_height" class="fblcs-small-input" placeholder="<?php _e( 'px', 'wp-like-comment-share'); ?>" value="<?php echo esc_html ( $fblcs_l_height ); ?>">			        			
			        		</td>
			        	</tr>
			        	<tr>
			        		<td>
			        			<?php _e( 'Border', 'wp-like-comment-share' ); ?>
			        			<br/>
			        			<small>
			        				<?php _e( 'Border of the whole plugin area e.g 15px', 'wp-like-comment-share' ); ?>
			        			</small>
			        		</td>
			        		<td>
			        			<input type="number" name="fblcs_l_border" class="fblcs-small-input" placeholder="<?php _e( 'px', 'wp-like-comment-share' ); ?>" value="<?php echo esc_html ( $fblcs_l_border ); ?>">
			        			<select name="fblcs_l_border_style">
			        				<option value=""><?php _e( '-- Border Style--', 'wp-like-comment-share' ); ?></option>
			        				<?php 
			        				$fblcs_border_style_arrary = array(
			        					'none', 'hidden', 'dotted', 'dashed', 'solid', 'double', 'groove', 'ridge', 'inset', 'outset', 'initial', 'inherit'
			        				);
			        				foreach ( $fblcs_border_style_arrary as $border_style ) {
			        					if ( $fblcs_l_border_style == $border_style ) {
			        						$selected 	=	"selected='selected'";
			        					} else{
			        						$selected 	= 	'';
			        					}
			        					echo "<option $selected value='$border_style'>$border_style</option>";
			        				}
			        				?>			        				
			        			</select>
			        			<input type="color" name="fblcs_l_border_color" class="fblcs-small-input" value="<?php echo esc_html ( $fblcs_l_border_color ); ?>">
			        		</td>
			        	</tr>
			        	<tr>
			        		<td>
			        			<?php _e( 'Background Color', 'wp-like-comment-share' ); ?>
			        			<br/>
			        			<small>
			        				<?php _e( 'The background of the whole plugin area', 'wp-like-comment-share' ); ?>
			        			</small>
			        		</td>
			        		<td>
			        			<input type="color" name="fblcs_l_background" value="<?php if ( !empty ( $fblcs_l_background ) ) { echo esc_html ( $fblcs_l_background ); } else echo '#ffffff'; ?>">
			        		</td>
			        	</tr>
			        	<tr>
			        		<td>
			        			<?php _e( 'Padding', 'wp-like-comment-share' ); ?>
			        			<br/>
			        			<small>
			        				<?php _e( 'Padding of the full plugin area.', 'wp-like-comment-share' ); ?>
			        			</small>			        				
							</td>
			        		<td>
			        			<?php 	

			        			$fblcs_padding_placeholde 	=	array( 'top', 'right', 'bottom', 'left' );
			        			if ( !$fblcs_l_padding ) {
			        				$fblcs_l_padding			=	array ( 0, 0, 0, 0 );
			        			} else {
			        				$fblcs_l_padding			=	$fblcs_l_padding;	
			        			}			        			

			        			foreach ( $fblcs_l_padding as $fblcs_keys => $fblcs_each_padding ) {
			        				if ( isset( $fblcs_each_padding ) ) {
			        					$fblcs_each_padding		=	$fblcs_each_padding;
			        				} else {
			        					$fblcs_each_padding		=	0;
			        				}
			        				$placeholder 				=	$fblcs_padding_placeholde[$fblcs_keys];
			        				?>
			        				<input type="number" name="fblcs_l_padding[]" class="fblcs-small-input" placeholder="<?php _e( $placeholder, 'wp-like-comment-share' ); ?>" value="<?php echo $fblcs_each_padding; ?>">
			        				<?php
			        			}
			        			?>			        			
			        		</td>
			        	</tr>
			        	<tr>
			        		<td>
			        			<?php _e( 'Margin', 'wp-like-comment-share' ); ?>			        				
			        			<br/>
			        			<small>
			        				<?php _e( 'Margin of the full plugin area.', 'wp-like-comment-share' ); ?>
			        			</small>			        				
							</td>
			        		<td>
			        			<?php 	
			        			$fblcs_margin_placeholde 	=	array( 'top', 'right', 'bottom', 'left' );
			        			if ( !$fblcs_l_margin ) {
			        				$fblcs_l_margin				=	array( 0, 0, 0, 0);
			        			} else {
			        				$fblcs_l_margin				=	$fblcs_l_margin;	
			        			}

			        			foreach ( $fblcs_l_margin as $fblcs_keys => $fblcs_each_margin ) {
			        				if( isset( $fblcs_each_margin ) ) {
			        					$fblcs_each_margin		=	$fblcs_each_margin;
			        				} else {
			        					$fblcs_each_margin		=	0;
			        				}
			        				$placeholder 				=	$fblcs_margin_placeholde[$fblcs_keys];
			        				?>
			        				<input type="number" name="fblcs_l_margin[]" class="fblcs-small-input" placeholder="<?php _e( $placeholder, 'wp-like-comment-share' ); ?>" value="<?php echo $fblcs_each_margin; ?>">
			        				<?php
			        			}
			        			?>		
			        		</td>
			        	</tr>
			        	
			        	<tr>
			        		<td>
			        			<input type="submit" id="fblcs_submit_btn" name="submit" value="Save Change" class="button-primary">
			        			<?php wp_nonce_field( 'fblcs_l_setting_action', 'fblcs_s_nonce' ); ?>
			        			<input type="hidden" name="fblcs_action_name" id="fblcs_action_name" value="fblcs_l_setting_action">
			        		</td>
			        	</tr>
			        </table>
			    </form>
		        <div class="fblcs_ajax_result"></div>
		     </div>
	    </div>
	    <?php
	}

	// show share settings form
	public function fblcs_share_setting_form ( $fblcs_s_title, $fblcs_s_title_size, $fblcs_s_href_auto, $fblcs_s_href, $fblcs_s_layout, $fblcs_s_size ) {
		?>
		<div class="wrap">		
			<h2><?php _e( 'WP Share Settings', 'wp-like-comment-share'); ?></h2>
			<!-- get the tab -->
	       	<?php $this->fblcs_tab();  ?>
			<div class="fblcs-container">
				<form id="fblcs_ajax_form_id">
			        <table class="widefat fixed" cellspacing="0">	
			        	<tr>
			        		<td colspan="2">
			        			<b><?php _e( 'Use shortcode', 'wp-like-comment-share' ); ?></b><code>[fb_share_btn]</code> <b><?php _e( 'to show the share button.', 'wp-like-comment-share' ); ?></b>
			        		</td>
			        	</tr>
			        	<tr>
			        		<td>
			        			<?php _e( 'Title', 'wp-like-comment-share' ); ?>
			        			<br>
			        			<small>
			        				<?php _e ( 'Set the title above the share box', 'wp-like-comment-share' ); ?>
			        			</small>
			        		</td>
			        		<td>
			        			<input type="text" name="fblcs_s_title" value="<?php echo esc_html ( $fblcs_s_title ); ?>" placeholder="<?php echo _e ( 'Title', 'wp-like-comment-share' ); ?>">
			        		</td>
			        	</tr>
			        	<tr>
			        		<td>
			        			<?php _e( 'Title Size', 'wp-like-comment-share' ); ?>
			        			<br>
			        			<small>
			        				<?php _e ( 'Set the title size e.g h1, h2 h3', 'wp-like-comment-share' ); ?>
			        			</small>
			        		</td>
			        		<td>
			        			<select name="fblcs_s_title_size">
			        				<option value="">
			        					<?php _e ( '--Select---', 'wp-like-comment-share' ) ; ?>
			        				</option>
			        				<?php 
			        				for ( $size = 1; $size <= 6; $size++ ) { 
			        					if ( $fblcs_s_title_size == 'h'.$size )  {
			        						$selected 	=	'selected';
			        					} else {
			        						$selected 	=	'';
			        					}
			        					echo "<option $selected value='h{$size}'>h{$size}</option>";	
			        				}
			        				?>			        				
			        			</select>
			        		</td>
			        	</tr>
			        	<tr>
			        		<td>
			        			<?php _e( 'URL', 'wp-like-comment-share' ); ?>
			        			<br/>
			        			<small>
			        				<?php _e( 'The absolute URL of the page that will be shared.', 'wp-like-comment-share' ); ?>
			        			</small>
			        		</td>
			        		<td>
			        			<select name="fblcs_s_href_auto" class="fblcs_s_href_auto">
			        				<option value="">
			        					<?php _e( '--Select--', 'wp-like-comment-share' ); ?>
			        				</option>
			        				<option selected value="auto" <?php selected( $fblcs_s_href_auto, 'auto' ); ?> >
			        					<?php _e( 'Auto detect the current page URL', 'wp-like-comment-share' ); ?>
			        				</option>
			        				<option value="given" <?php selected( $fblcs_s_href_auto, 'given' ); ?>>
			        					<?php _e( 'Let me give it', 'wp-like-comment-share' ); ?>
			        				</option>
			        			</select>			        			
			        		</td>
			        	</tr>
			        	<tr id="let_me_give_it_s">
			        		<td>&nbsp;</td>
			        		<td>
			        			<input type="text" name="fblcs_s_href" placeholder="<?php _e( 'Enter the URL', 'wp-like-comment-share' ); ?>" value="<?php echo esc_url( $fblcs_s_href ); ?>">
			        		</td>
			        	</tr>
			        	<tr>
			        		<td>
			        			<?php _e( 'Layout', 'wp-like-comment-share' ); ?>
			        			<br/>
			        			<small>
			        				<?php _e( 'Selects one of the different layouts that are available for the plugin.', 'wp-like-comment-share' ); ?>			        				
			        			</small>
			        		</td>
			        		<td>
			        			<select name="fblcs_s_layout">
			        				<option value="">
			        					<?php _e( '--Select Layout--', 'wp-like-comment-share' ); ?>
			        				</option>
			        				<option selected value="button_count" <?php selected( $fblcs_s_layout, 'button_count' ); ?> >
			        					<?php _e( 'Button Count', 'wp-like-comment-share' ); ?>
			        				</option>			        				
			        				<option value="box_count"  <?php selected( $fblcs_s_layout, 'box_count' ); ?> >
			        					<?php _e( 'Box Count', 'wp-like-comment-share' ); ?>
			        				</option>
			        				<option value="button" <?php selected( $fblcs_s_layout, 'button' ); ?> >
			        					<?php _e( 'Button', 'wp-like-comment-share' ); ?>
			        				</option>
			        			</select>
			        		</td>
			        	</tr>	
			        	<tr>
			        		<td>
			        			<?php _e( 'Size', 'wp-like-comment-share' ); ?><br/>
			        			<small>
			        				<?php _e( 'The button is offered in 2 sizes', 'wp-like-comment-share' ); ?>
			        			</small>
			        		</td>
			        		<td>
			        			<select name="fblcs_s_size">			        				
			        				<option value="">
			        					<?php _e( '--Select--', 'wp-like-comment-share' ); ?>
			        				</option>
			        				<option value="large" <?php selected( $fblcs_s_size, 'large' ); ?> >
			        					<?php _e( 'Large', 'wp-like-comment-share' ); ?>
			        				</option>
			        				<option value="small" <?php selected( $fblcs_s_size, 'small' ); ?>>
			        					<?php _e( 'Small', 'wp-like-comment-share' ); ?>
			        				</option>
			        			</select>			        			
			        		</td>
			        	</tr>	        	
			        	<tr>
			        		<td>
			        			<input type="submit" id="fblcs_submit_btn" name="submit" value="Save Change" class="button-primary">
			        			<?php wp_nonce_field( 'fblcs_s_setting_action', 'fblcs_s_nonce' ); ?>
			        			<input type="hidden" name="fblcs_action_name" id="fblcs_action_name" value="fblcs_s_setting_action">
			        		</td>
			        	</tr>
			        </table>
			    </form>
		        <div class="fblcs_ajax_result"></div>
		     </div>
	    </div>
		<?php
	}
}