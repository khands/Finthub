<?php

class BSKPDFManagerCategory {

	var $_categories_db_tbl_name = '';
	var $_pdfs_db_tbl_name = '';
	var $_pdfs_upload_path = '';
	var $_pdfs_upload_folder = '';
	var $_bsk_categories_page_name = '';
	
	var $_plugin_pages_name = array();
	var $_open_target_option_name = '';
	var $_show_category_title_when_listing_pdfs = '';
	var $_pdf_order_by_option_name = '';
	var $_pdf_order_option_name = '';	
   
	public function __construct( $args ) {
		global $wpdb;
		
		$this->_categories_db_tbl_name = $args['categories_db_tbl_name'];
	    $this->_pdfs_db_tbl_name = $args['pdfs_db_tbl_name'];
		$this->_pdfs_upload_path = $args['pdf_upload_path'];
	    $this->_pdfs_upload_folder = $args['pdf_upload_folder'];
		$this->_plugin_pages_name = $args['pages_name_A'];
		$this->_open_target_option_name = $args['open_target_option_name'];
		$this->_show_category_title_when_listing_pdfs = $args['show_category_title'];
		$this->_pdf_order_by_option_name = $args['pdf_order_by'];
		$this->_pdf_order_option_name = $args['pdf_order'];		
		
		$this->_bsk_categories_page_name = $this->_plugin_pages_name['category'];
		$this->_pdfs_upload_path = $this->_pdfs_upload_path.$this->_pdfs_upload_folder;
		
		add_action('bsk_pdf_manager_category_save', array($this, 'bsk_pdf_manager_category_save_fun'));
		add_shortcode('bsk-pdf-manager-list-category', array($this, 'bsk_pdf_manager_list_pdfs_by_cat') );
	}
	
	function bsk_pdf_manager_category_edit( $category_id = -1 ){
		global $wpdb;
		
		$cat_title = '';
		$cat_date = date( 'Y-m-d', current_time('timestamp') );
		if ($category_id > 0){
			$sql = 'SELECT * FROM '.$this->_categories_db_tbl_name.' WHERE id = %d';
			$sql = $wpdb->prepare( $sql, $category_id );
			$category_obj_array = $wpdb->get_results( $sql );
			if (count($category_obj_array) > 0){
				$cat_title = $category_obj_array[0]->cat_title;
				$cat_date = date( 'Y-m-d', strtotime($category_obj_array[0]->last_date) );
			}
		}
		
		$str = '<div class="bsk_pdf_manager_category_edit">';
		$str .='<h4>Category Title</h4>';
		$str .='<p><input type="text" name="cat_title" id="cat_title_id" value="'.$cat_title.'" maxlength="512" style="width:350px;"/></p>';
		$str .='<h4>Date</h4>';
		$str .='<p><input type="text" name="cat_date" id="cat_date_id" value="'.$cat_date.'" class="bsk-date" style="width:350px;"/></p>';
		$str .='<p>
					<input type="hidden" name="bsk_pdf_manager_action" value="category_save" />
					<input type="hidden" name="bsk_pdf_manager_category_id" value="'.$category_id.'" />'.
					wp_nonce_field( plugin_basename( __FILE__ ), 'bsk_pdf_manager_category_save_oper_nonce', true, false ).'
				</p>
				</div>';
		
		echo $str;
	}
	
	function bsk_pdf_manager_category_save_fun( $data ){
		global $wpdb;
		
		//check nonce field
		if ( !wp_verify_nonce( $data['bsk_pdf_manager_category_save_oper_nonce'], plugin_basename( __FILE__ ) ) ){
			return;
		}
		
		if ( !isset($data['bsk_pdf_manager_category_id']) ){
			return;
		}
		$id = $data['bsk_pdf_manager_category_id'];
		$title = trim($data['cat_title']);
		$last_date = trim($data['cat_date']);
		$last_date = $last_date ? $last_date.' 00:00:00' : date( 'Y-m-d 00:00:00', current_time('timestamp') );
		
		$quotes_sybase = strtolower(ini_get('magic_quotes_sybase'));
		if (get_magic_quotes_gpc() || empty($quotes_sybase) || $quotes_sybase === 'off'){
			$title = stripcslashes($title); 
		}
		
		if ( $id > 0 ){
			$wpdb->update( $this->_categories_db_tbl_name, array( 'cat_title' => $title, 'last_date' => $last_date), array( 'id' => $id ) );
		}else if($id == -1){
			//insert
			$wpdb->insert( $this->_categories_db_tbl_name, array( 'cat_title' => $title, 'last_date' => $last_date) );
		}
		
		$redirect_to = admin_url( 'admin.php?page='.$this->_bsk_categories_page_name );
		wp_redirect( $redirect_to );
		exit;
	}
	
	function bsk_pdf_manager_list_pdfs_by_cat($atts, $content){
		global $wpdb;
		
		extract( shortcode_atts( array('id' => '', 
									   'orderby' => '', 
									   'order' => '', 
									   'target' => '', 
									   'showcattitle' => '',
									   'dropdown' => 'false',
									   'showdate' => 'false',
									   'dateformat' => 'd/m/Y',
									   'mosttop' => 0,
									   'nofollowtag' => 'false',
									   'orderedlist' => '' ),
								  $atts ) );
		$show_cat_title = false;
		if( $showcattitle && is_string($showcattitle) ){
			if( strtoupper($showcattitle) == "YES" || strtoupper($showcattitle) == "TRUE" ){
			$show_cat_title = true;
		}
		}else if( is_bool($showcattitle) ){
			$show_cat_title = $showcattitle;
		}
		
		//organise id array
		$ids_array = array();
		$ids_string = trim($id);
		if( !$ids_string ){
			return '';
		}
		if( $ids_string && is_string($ids_string) ){
			$ids_array = explode(',', $ids_string);
			foreach($ids_array as $key => $pdf_id){
				$pdf_id = intval(trim($pdf_id));
				if( is_int($pdf_id) == false ){
					unset($ids_array[$key]);
				}
				$ids_array[$key] = $pdf_id;
			}
		}
		if( !is_array($ids_array) || count($ids_array) < 1 ){
			return '';
		}
	
		$sql = 'SELECT * FROM `'.$this->_categories_db_tbl_name.'` WHERE id IN('.implode(',', $ids_array).') ORDER BY `cat_title` ASC';
		$categories = $wpdb->get_results($sql);
		if( !$categories || !is_array($categories) || count($categories) < 1 ){
			return '';
		}
		
		//organise category by id
		$categories_id_as_key = array();
		foreach( $categories as $category_obj ){
			$categories_id_as_key[$category_obj->id] = $category_obj;
		}

		//process open target
		$open_target_str = '';
		if( $target == '_blank' ){
			$open_target_str = 'target="_blank"';
		}
		//process order
		$order_by_str = ' ORDER BY `title`'; //default set to title
		$order_str = ' ASC';
		if( $orderby == 'title' ){
			//default
		}else if( $orderby == 'filename' ){
			$order_by_str = ' ORDER BY `file_name`';
		}else if( $orderby == 'date' ){
			$order_by_str = ' ORDER BY `last_date`';
		}
		if( trim($order) == 'DESC' ){
			$order_str = ' DESC';
		}
		//show date in title
		$show_date_in_title = false;
		if( $showdate && is_string($showdate) ){
			$show_date_in_title = strtoupper($showdate) == 'YES' ? true : false;
			if( strtoupper($showdate) == 'TRUE' ){
				$show_date_in_title = true;
			}
		}else if( is_bool($showdate) ){
			$show_date_in_title = $showdate;
		}
		//date format
		$date_format_str = 'd/m/Y';
		if( $dateformat && is_string($dateformat) ){
			$date_format_str = $dateformat;
		}
		//dropdown
		$output_as_dropdown = false;
		if( $dropdown && is_string($dropdown) ){
			$output_as_dropdown = strtoupper($dropdown) == 'TRUE' ? true : false;
			if( strtoupper($dropdown) == 'YES' ){
				$output_as_dropdown = true;
			}
		}else if( is_bool($dropdown) ){
			$output_as_dropdown = $dropdown;
		}
		//most recent count
		$most_recent_count = intval($mosttop);
		if( $most_recent_count < 1 ){
			$most_recent_count = 99999;
		}
		//anchor nofollow tag
		$nofollow_tag = false;
		if( $nofollowtag && is_string($nofollowtag) ){
			$nofollow_tag = strtoupper($nofollowtag) == 'YES' ? true : false;
			if( strtoupper($nofollowtag) == 'TRUE' ){
				$nofollow_tag = true;
			}
		}else if( is_bool($nofollowtag) ){
			$nofollow_tag = $nofollowtag;
		}
		//show as ordered list
		$show_as_ordered_list = false;
		if( $orderedlist && is_string($orderedlist) ){
			$show_as_ordered_list = strtoupper($orderedlist) == 'YES' ? true : false;
			if( strtoupper($orderedlist) == 'TRUE' ){
				$show_as_ordered_list = true;
			}
		}else if( is_bool($orderedlist) ){
			$show_as_ordered_list = $orderedlist;
		}

		$home_url = site_url();
		$forStr = '';
		foreach( $ids_array as $category_id ){ //order category by id sequence
			
			if( !isset($categories_id_as_key[$category_id]) ){
				continue;
			}
			$forStr .=	'<div class="bsk-pdf-category cat-'.$category_id.'">'."\n";
			
			if( $show_cat_title ){
				$forStr .=	'<h2>'.$categories_id_as_key[$category_id]->cat_title.'</h2>'."\n";
			}
			
			//get pdf items in the category
			$sql = 'SELECT * FROM `'.$this->_pdfs_db_tbl_name.'` '.
				   'WHERE `cat_id` = %d '.
				   $order_by_str.$order_str.' '.
			   	   'LIMIT 0, %d';
			$sql = $wpdb->prepare( $sql, $category_id, $most_recent_count );
			$pdf_items_results = $wpdb->get_results( $sql );
			if( !$pdf_items_results || !is_array($pdf_items_results) || count($pdf_items_results) < 1 ){
				$forStr .=  '</div>'."\n";
				continue;
			}
			if( $output_as_dropdown == false ){
				if( $show_as_ordered_list ){
					$forStr .= '<ol class="bsk-special-pdfs-container-ordered-list">';
				}else{
					$forStr .= '<ul class="bsk-special-pdfs-container">';
				}
			}else{
				$forStr .= '<select name="bsk_pdf_manager_special_pdfs_select" class="bsk-pdf-manager-pdfs-select cat-'.$category_id.'" attr_target="'.$target.'">';
			}
			foreach($pdf_items_results as $pdf_item_obj ){
				if( $pdf_item_obj->file_name && file_exists($this->_pdfs_upload_path.$pdf_item_obj->file_name) ){
					$file_url = $home_url.'/'.$this->_pdfs_upload_folder.$pdf_item_obj->file_name;
					if( $output_as_dropdown == false ){
						$nofollow_tag_str = $nofollow_tag ? ' rel="nofollow"' : '';
						$link_text = $pdf_item_obj->title;
						if( $show_date_in_title ){
							$link_text .= '<span class="bsk-pdf-manager-pdf-date">'.date($date_format_str, strtotime($pdf_item_obj->last_date)).'</span>';
						}
						$forStr .= '<li><a href="'.$file_url.'" '.$open_target_str.$nofollow_tag_str.'>'.$link_text.'</a></li>'."\n";
					}else{
						$option_text = $pdf_item_obj->title;
						if( $show_date_in_title ){
							$option_text .= '--'.date($date_format_str, strtotime($pdf_item_obj->last_date));
						}
						$forStr .= '<option value="'.$file_url.'">'.$option_text.'</option>'."\n";
					}
				}
			}
			if( $output_as_dropdown == false ){
				if( $show_as_ordered_list ){
					$forStr .= '</ol>';
				}else{
				$forStr .= '</ul>';
				}
			}else{
				$forStr .= '</select>';
			}
			
			$forStr .=  '</div>'."\n";
		}
	
		return $forStr;
	}
}