<?php 

class Category_Nav_Box_Model {

	public $data;
	public $data_count;
	public $navigation;

	public function __construct() {
		
	$this->initialize();

	}
	
	public function initialize() {

	$this->set_data();
	$this->count_data();
	// $this->build_navigation();
		
	}

	public function set_data() {

	// $cache = new cache( LANG_FOLDER. '.boxes.nav_box' );

	// $this->data = $cache->readCache();

	// if ( !$cache->cacheStatus ) {

	$this->data = $this->get_categories();

	// $cache->writeCache( $this->data );

	}

	public function get_categories( $where = "" ) {

		global $db;
			
			$sql = 
			"SELECT DISTINCT(cat_name), cat_id, cat_father_id 
			FROM CubeCart_category";

			if(!empty( $where )):

			$sql .= " WHERE " . $where; 

			endif;

			$sql .= " ORDER BY cat_name";

			if($cats = $db->select($sql)):

			return $cats;

			endif;

	}

	public function get_cat_by_condition( $field, $value ) {

	$where = $field . " = '" . $value . "'";
		
	$father = $this->get_categories( $where );

	return $father;

	}

	public function build_navigation() {

	$output = "<ul>";
		
		foreach($this->data as $index => $data):

			$output .= "<li>";

				if($data['cat_father_id'] == 0):

				$child = $this->get_cat_by_condition('cat_father_id', (string)$data['cat_id']);

				$output .= "<ul><li>";

				$output .= $data['cat_name'];

				$output .= "<ul><li>";

				$output .= $child[0]['cat_name'];

				$grand_child = $this->get_cat_by_condition('cat_father_id', (string)$child['cat_id']);

					if($grand_child[0]['cat_id']):

					$output .= "<ul><li>";

					$output .= $grand_child[0]['cat_name'];

					$output .= "</li></ul>";

					else:

					$output .= "</li></ul>";

					$output .= "</li></ul>";

					endif;

						else:

							$father = $this->get_cat_by_condition("cat_id", (string)$data['cat_father_id']);

							if($father[0]['cat_father_id'] == 0):

							$output .= "<ul><li>";

							$output .= $father[0]['cat_name'];

							$output .= "<ul><li>";

							$output .= $data[0]['cat_name'];

							$output .= "</li></ul>";

							$output .= "</li></ul>";

								else:

									$grand_father = $this->get_cat_by_condition("cat_id", (string)$father[0]['cat_father_id']);

									if($grand_father[0]['cat_father_id'] == 0):

									$output .= "<ul><li>";

									$output .= $grand_father[0]['cat_name'];

									$output .= "<ul><li>";

									$output .= $father[0]['cat_name'];

									$output .= "<ul><li>";

									$output .= $data[0]['cat_name'];

									$output .= "</li></ul>";

									$output .= "</li></ul>";

									$output .= "</li></ul>";
		
									endif;

							endif;

				endif;

			$output .= "</li>";

		endforeach;

	$output .= "</ul>";

	$this->navigation = $output;

	}

	public function count_data() {
		
	$this->data_count = count($this->data);

	}

}

?>