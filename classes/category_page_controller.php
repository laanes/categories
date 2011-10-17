<?php require_once('modules/3rdparty/page_init/classes/page_model.php');  

class Category_Page_Controller extends Page_Model {

	/* Product properties */
	public  $image_paths 	= array();
	public  $product_links 	= array();
	public  $stock_levels 	= array();
	public  $productCount;


	/* cat properties */
	public 	$cat_name;
	public  $cat_id;


	public function __construct( $context = "" ) {

	parent::$context = $context;

		parent::$context_id = $_GET['catId'];

			$this->set_cat_properties();

				parent::__construct();

					if( !empty( $this->products ) ) {

						$this->setup();

				}

	}

	public function setup() {
		
		$this->countProds();

		$this->set_product_properties();
		
		$this->create_product_links();

	}

	private function set_cat_properties() {
		
	$data = $this->get_data_by_id( array( 'cat_name', 'cat_desc' ), 'CubeCart_category', 'cat_id', parent::$context_id );

		foreach( $data as $field_name => $value ):

			if( property_exists( $this, $field_name )) {

			$this->$field_name = $value;

			}

		endforeach;

	}
	
	private function countProds() {
		
		$this->productCount = count( $this->getProducts( false ) );

	}

	private function set_product_properties() {

		global $glob;
			
		foreach($this->products as $key => $value):

			$image_path[] = $glob['storeURL'] . "/images/uploads/productImages/" . str_replace('productImages/', '', $value['image']);;

			$stock_levels[] = ($value['stock_level'] !== 0) ? "In Stock" : false;

			$cat_name[] = $value['cat_name'];

		endforeach;

		$this->image_paths 	= $image_path;

		$this->stock_levels = $stock_levels;

		$this->cat_name = $cat_name;

	}

	private function create_product_links() {

	global $glob;
		
		foreach($this->products as $key => $product):

			$link[] = $glob['storeURL'];

			$father = $this->cat_father_by_id($product['cat_father_id']);

			$grand_father = $this->cat_father_by_id($father[0]['cat_father_id']);

				if($grand_father[0]['cat_name']) {

					$link[] = $grand_father[0]['cat_name'];

				}

				$link[] = $father[0]['cat_name'];

				$link[] = $product['cat_name'];

				$link[] = $product['name'];

				$link[] = "prod_" . $product['productId'] . ".html";

				$link_chain[] = implode('/', $link);

				unset($link);

		endforeach;

	$this->product_links = $link_chain;

	}

}

?>