<?php require_once('category_nav_box_model.php');

class Category_Nav_Box_Controller extends Category_Nav_Box_Model {

	public $navigation;
	
	public function __construct() {
		
		parent::__construct();

		$this->set_navigation();

	}

	public function set_navigation() {

		if($this->data) {
			
			$cats = $this->get_categories('cat_father_id = 0');

			$output = '<ul id="nav">';

				for($i=0; $i<=count($cats)-1; $i++) { 

				$second = $this->get_categories('cat_father_id = ' . $cats[$i]['cat_id']); 

				$output .= "<li><a href='#'>" . $cats[$i]['cat_name']."</a>";

					if(isset($second[$i]['cat_id'])) {

					$output .= "<ul>";

						for($j=0; $j<=count($second)-1; $j++) { 

						$output .= "<li><a href='#'>" . $second[$j]['cat_name']."</a>";

						$third = $this->get_categories('cat_father_id = ' . $second[$j]['cat_id']);

							if(isset($third[$j]['cat_id'])) {

							$output .= "<ul>";

								for($k=0; $k<=count($third)-1; $k++) {

								$output .= "<li><a href='#'>" . $third[$k]['cat_name'] . "</a></li>";

								if($k == count($third)-1) { $output .= "</ul>"; }

								}

							}

							else {
								
							$output .= "</li>";

							}

						if($j == count($second)-1) { $output .= "</ul>"; }

						}

					}

					else {
						
					$output .= "</li>";

					}

				}

			$output .= "</ul>";

			$this->navigation = $output;

		}

	}

}

$categories = new Category_Nav_Box_Controller();

?>