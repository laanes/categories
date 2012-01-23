<?php require_once('category_nav_box_model.php');

class Category_Nav_Box_Controller extends Category_Nav_Box_Model {

	public $navigation;
	
	public function __construct() {
		
		parent::__construct();

		$this->set_navigation();

	}

	public function set_navigation() {

		if($this->data) {
			
			$first_level = $this->get_categories( "cat_father_id = '0'" );

			$output = '<ul id="nav">';

			$output .= $this->loop( $first_level );

			$output .= "</ul>";

			$this->navigation = $output;

		}

	}

	public function loop( $first_level ) {
		
	for( $i=0; $i<=count( $first_level ) -1; $i++ ) {

		$second = $this->get_categories( 'cat_father_id = \'' . $first_level[$i]['cat_id'] . '\'' ); 

		$output .= $this->create_link( $first_level[$i]['cat_name'], $first_level[$i]['cat_id'] );

			if( isset( $second[$i]['cat_id'] ) ) {

			$output .= "<ul>";

				for( $j=0; $j<count($second); $j++ ) {

				$cat_name = array( 

				$first_level[$i]['cat_name'], 
				$second[$j]['cat_name'] 

				);

				$output .= $this->create_link( $cat_name, $second[$j]['cat_id'] );

				$third = $this->get_categories( 'cat_father_id = \'' . $second[$j]['cat_id'] . '\'');

					if( isset( $second[$j]['cat_id'] ) ) {

					$output .= "<ul>";

						for( $k=0; $k<=count( $third )-1; $k++ ) {



						$cat_name = array( 

						$first_level[$i]['cat_name'], 
						$second[$j]['cat_name'], 
						$third[$k]['cat_name'] 

						);

						$output .= $this->create_link( $cat_name,  $third[$k]['cat_id'] );

						if( $k == count( $third ) -1 ) { $output .= "</ul>"; }

						}

					}

					else {
						
					$output .= "</li>";

					}

				if( $j == count( $second ) -1 ) { $output .= "</ul>"; }

				}

			}

			else {
				
			$output .= "</li>";

			}

		}

		return $output;

	}

	private function create_link( $cat_name, $cat_id ) {

	global $glob;

	$link = '<li><a href="' . $glob['storeURL'] . '/';

	if( is_array( $cat_name ) ) {

	$formated_cat = array_map( 'urlencode', $cat_name );

	$cat_string = implode( '/', $formated_cat ); 

	$link .= $cat_string . '/cat_' . $cat_id . '.html">';

	$name = $cat_name[ ( count( $cat_name ) -1 ) ];

	$link .= ucwords( $name );

	} else {
		
	$link .= urlencode( $cat_name ) . '/cat_' . $cat_id . '.html">' . ucwords( $cat_name );

	}

	$link .= '</a>';

	return $link;

	}

}

$category_navigation = new Category_Nav_Box_Controller();

?>