<?php 

class Category_Nav_Box_Model {

	public $data;
	public $data_count;
	public $navigation;

	public $child_cats;
	public $father_cats;
	public $grand_father_cats;

	public function __construct() {
		
	$this->initialize();

	}
	
	public function initialize() {

	$this->set_data();
	$this->count_data();
	// $this->build_navigation();
		
	}

	public function set_data() {
		
	$this->data = $this->get_categories();

	}

	public function get_categories( $where = "" ) {

		global $db;
			
			$sql = 
			"SELECT DISTINCT(cat_name), cat_id, cat_father_id 
			FROM CubeCart_category";

			if(!empty( $where )):

			$sql .= " WHERE " . $where; 

			endif;

			// $sql .= " GROUP BY cat_name";

			if($db->select($sql)):

			return $db->select($sql);

			endif;

	}

	public function get_cat_by_condition( $field, $value ) {

	$where = $field . " = " . $value;
		
	$father = $this->get_categories( $where );

	return $father;

	}

	public function count_data() {
		
	$this->data_count = count($this->data);

	}

}

?>