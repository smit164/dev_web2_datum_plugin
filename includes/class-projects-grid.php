<?php
	if(!class_exists('WP_List_Table')){
	   require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
	}
?>
<?php
	class Project_Table extends Wp_List_Table {
		
		function __construct() {
	       	parent::__construct(array(
		      'singular' => 'project',
		      'plural'   => 'project',
		      'ajax'     => false
		    ));
	    }

	    public function projectStaus(){
			return $project = array(
						'Look' => 'Look',
						'logo'  => 'Logo',
					);
	    }

	    public static function get_project($per_page = 5, $page_number = 1) {

			global $wpdb;
			$sql = "SELECT * FROM {$wpdb->prefix}project";

			if (!empty($_REQUEST['s'])) {
				$sql .= ' WHERE `name` LIKE "%'. esc_sql($_REQUEST['s']). '%"';
			}

			if (!empty($_REQUEST['orderby'])) {
				$sql .= ' ORDER BY ' . esc_sql( $_REQUEST['orderby'] );
				$sql .= !empty( $_REQUEST['order'] ) ? ' ' . esc_sql( $_REQUEST['order'] ) : ' ASC';
			}

			$sql .= " LIMIT $per_page";
			$sql .= ' OFFSET ' . ($page_number - 1) * $per_page;

			$result = $wpdb->get_results($sql);
			return $result;
		}

		public static function delete_project($id) {
			global $wpdb;
			$wpdb->query("DELETE FROM `{$wpdb->prefix}project` WHERE `id` = $id ");
		}

		public static function record_count() {
			global $wpdb;

			$sql = "SELECT COUNT(*) FROM `{$wpdb->prefix}project`";

			return $wpdb->get_var($sql);
		}

		function column_is_active($item) {
			echo ($item->position) ? 'Yes' : 'No';
		}		

		public function column_default( $item, $column_name ) {
			switch ($column_name) {
				case 'client_id':
					if($item->{$column_name}){
						$user_id = $item->{$column_name};
						$user_meta = get_userdata($user_id);
						$user_nicename = $user_meta->data->user_nicename;
						$user_link = site_url().'/cardealer/'.$user_meta->data->user_login;
						//$user_name    = getUserassociationName($user_id);
						return '<a href="'.get_edit_user_link($user_id).'">'.$user_nicename.'</a>';
					}else{
						return;
					}
				break;	
				default:
					return $item->{$column_name};
					# code...
					break;
			}
			return $item->{$column_name};
		}
		
		function column_cb($item) {
			return sprintf(
				'<input type="checkbox" name="bulk-delete[]" value="%s" />', $item->id
			);
		}

	    function get_columns() {
		   	return $columns = array(
		      'id'         				=> __('ID'),
		      'name'  					=> __('Name'),
		      'client_id'  				=> __('Client Name'),
		      'created_date'		    => __('Created Date'),
		   );
		}

		function get_sortable_columns() {
		   	return $sortable = array(
		      'id'         => array('id', true),
		      'sort_order' => array('sort_order', true),
		   );
		}

		public function get_bulk_actions() {
			$actions = [
				'bulk-delete' => 'Delete'
			];

			return $actions;
		}

		public function prepare_items() {

			$this->_column_headers = $this->get_column_info();

			$this->process_bulk_action();

			$per_page     = $this->get_items_per_page('project_per_page', 10);
			$current_page = $this->get_pagenum();
			$total_items  = self::record_count();

			$this->set_pagination_args([
				'total_items' => $total_items,
				'per_page'    => $per_page 
			]);

			$columns  = $this->get_columns();
			$hidden   = array();
			$sortable = $this->get_sortable_columns();

			$this->_column_headers = array($columns, $hidden, $sortable);

			$this->items = self::get_project($per_page, $current_page);
			

		}

		public function process_bulk_action() {
			if ('delete' === $this->current_action()) {
				$nonce = esc_attr($_REQUEST['_wpnonce']);

				if (!wp_verify_nonce($nonce, 'delete_project')) {
					die( 'Can not delete.' );
				}
				else {
					self::delete_project(absint($_GET['project']));
					wp_redirect(esc_url(add_query_arg()));
					exit;
				}
			}

			if ((isset($_POST['action']) && $_POST['action'] == 'bulk-delete')
			   || (isset($_POST['action2']) && $_POST['action2'] == 'bulk-delete')
			) {
				$delete_ids = $_POST['bulk-delete'];
				// loop over the array of record IDs and delete them
				foreach ( $delete_ids as $id ) {
					self::delete_project($id);
				}
			}
		}

		function get_default_primary_column_name() {
			return 'title';
		}
	}
?>