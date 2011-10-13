<?php

if($_GET['_a'] == 'viewCat' && strpos($_SERVER['REQUEST_URI'], "added=1")) {
	
header('Location: ' . $_SERVER['HTTP_REFERER']);

}

if (isset($_GET['catId'])) {

$view_range = new XTemplate ('content'.CC_DS.'viewCat.tpl');

require_once('modules'.CC_DS.'3rdparty'.CC_DS.'categories'.CC_DS.'classes'.CC_DS.'category_page_controller.php');

$page  = Page_Model::$page  = isset($_GET['page']) ? (int)sanitizeVar($_GET['page']) : 0;
$limit = Page_Model::$limit = /*$config['productPages']*/ 6 ;

$range_products = new Category_Page_Controller( "range" );

$view_range->assign('HOME_HREF', $glob['storeURL']);

$view_range->assign('RANGE_ID',   		  $range_products->range_id);
$view_range->assign('RANGE_NAME', 		  $range_products->range_name);
$view_range->assign('RANGE_DESCRIPTION',  $range_products->range_description);


/* Range title */
if($range_products->range_title) {

$view_range->assign('RANGE_TITLE', $range_products->range_title);

}

else {
	
$view_range->assign('RANGE_TITLE', $range_products->range_name . " products");

}

$total_products = $range_products->productCount;

if($total_products) {

$view_range->assign('TOTAL_PRODUCTS', "<span class=\"page_total_products\">" . $total_products . " products</span>");

$pagination = paginate($total_products, $limit, $page, 'page', 'txtLink', 4);
	
if(strlen($pagination) > 6) {
$view_range->assign("PAGINATION", "<div class=\"pagination\">".$pagination."</div>");
}


$view_range->assign("CURRENT_URL", $_SERVER['REQUEST_URI']);

	for($i=0; $i<=$limit-1; $i++) {

		if($range_products->products[$i]['productId']) {

			$image_path = $range_products->image_paths[$i];

			$productId  = $range_products->products[$i]['productId'];

			$view_range->assign('NAME', $range_products->products[$i]['name']);

			$view_range->assign('PRICE', $range_products->products[$i]['price']);

			$view_range->assign('STOCK', $range_products->stock_levels[$i]);

			$view_range->assign('ID', $productId);

			$view_range->assign('HREF', $range_products->product_links[$i]);

			$view_range->assign('IMAGE', $image_path);

			$view_range->parse('product_ranges.products_true.product_loop');

		}

	 }

$view_range->parse('product_ranges.products_true');

}

else {
	
$view_range->assign('NO_PRODUCTS_MSG', "There are currently no " . $range_products->range_name . " products. Browse by category instead: ");

require_once'modules'.CC_DS.'3rdparty'.CC_DS.'Homepage_Categories'.CC_DS.'boxes'.CC_DS.'Homepage_Categories.inc.php';

if($categories->data) {

$view_range->assign('HOMEPAGE_CATEGORIES', $box_content);

}

$view_range->parse('product_ranges.products_false');

}

$view_range->parse('product_ranges');

$page_content = $view_range->text('product_ranges');

}


?>