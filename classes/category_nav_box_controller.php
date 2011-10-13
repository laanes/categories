<?php require_once('category_nav_box_model.php');

class Category_Nav_Box_Controller extends Category_Nav_Box_Model {
	
	public function __construct() {
		
		parent::__construct();

	}

}

$categories = new Category_Nav_Box_Controller();

?>