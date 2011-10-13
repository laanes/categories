<?php 

class Category_Nav_Box_Model {

	public static $data;
	public static $data_count;
	public static $navigation;
	
	public static function initialize() {

	self::set_data();
	self::count_data();
	self::build_navigation();
		
	}

	private static function set_data() {
		
	self::$data = get_categories();

	}

	private static function get_categories( $where = "" ) {

		global $db;
			
			$sql = 
			"SELECT cat_id, cat_father_id, cat_name 
			FROM CubeCart_category";

			if(!empty( $where )):

			$sql .= " WHERE " . $where; 

			endif;

			if($db->select($sql)):

			return $db->select($sql);

			endif;

	}

	private static function get_cat_by_condition( $field, $value ) {

	$where = $field . " = " . $value;
		
	$father = self::get_categories( $where );

	return $father;

	}

	public static function build_navigation() {

	$output = "<ul>";
		
		foreach(self::$data as $index => $data):

			$output .= "<li>";

				if($data['cat_father_id'] == 0):

				$child = self::get_cat_by_condition('cat_father_id', $data['cat_id']);

				$output .= "<ul><li>";

				$output .= $data['cat_name'];

				$output .= "<ul><li>";

				$output .= $child[0]['cat_name'];

				$grand_child = self::get_cat_by_condition('cat_father_id', $child['cat_id']);

					if($grand_child[0]['cat_id']):

					$output .= "<ul><li>";

					$output .= $grand_child[0]['cat_name'];

					$output .= "</li></ul>";

					else:

					$output .= "</li></ul>";

					$output .= "</li></ul>";

					endif;

						else:

							$father = self::get_cat_by_condition("cat_id", $data['cat_father_id']);

							if($father[0]['cat_father_id'] == 0):

							$output .= "<ul><li>";

							$output .= $father[0]['cat_name'];

							$output .= "<ul><li>";

							$output .= $data[0]['cat_name'];

							$output .= "</li></ul>";

							$output .= "</li></ul>";

								else:

									$grand_father = self::get_cat_by_condition("cat_id", $father[0]['cat_father_id']);

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

	self::$navigation = $output;

	}

	public static function count_data() {
		
	self::$data_count = count(self::$data);

	}

}

?>