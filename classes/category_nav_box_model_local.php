<?php 

class Category_Nav_Box_Model {

	public $data;
	public $data_count;
	public $navigation;

	public $first_level;
	public $second_level;
	public $third_level;

	public function __construct() {
		
	$this->initialize();

	}
	
	public function initialize() {

	$this->set_data();
	$this->count_data();
	$this->set_properties();
	// $this->build_navigation();
		
	}

	public function set_data() {
		
	$this->data = $this->get_categories();

	}

	public function set_properties() {
		
	$this->first_level = $this->get_categories( "cat_father_id", 0 );

	foreach($this->first_level as $cats) {
		
	$this->second_level =  $this->get_categories( "cat_id", $cats['cat_father_id'] );

	}

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

			if($this->select($sql)):

			return $this->select($sql);

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

		private function exec($query) {

		$link = mysql_connect('localhost', 'root', '');

		mysql_select_db('swansea3_lock-tech-shop', $link);

		return mysql_query($query, $link);

	}

	function select($query, $maxRows = 0, $pageNum = 0) {

		$result = $this->exec($query);

		$max = mysql_num_rows($result);
		if ($max > 0) {
			for ($n = 0; $n < $max; ++$n) {
				$row = mysql_fetch_assoc($result);
				$output[$n] = $row;
			}
			return $output;
		} else {
			return false;
		}
	}

}

$cat = new Category_Nav_Box_Model();

var_dump($cat);

?>