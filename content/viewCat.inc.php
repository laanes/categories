<?php

if($_GET['_a'] == 'viewCat' && strpos($_SERVER['REQUEST_URI'], "added=1")) {
	
header('Location: ' . $_SERVER['HTTP_REFERER']);

}

if (isset($_GET['catId'])) {

$view_cat = new XTemplate ('content'.CC_DS.'viewCat.tpl');

require_once('modules'.CC_DS.'3rdparty'.CC_DS.'categories'.CC_DS.'classes'.CC_DS.'category_page_controller.php');

$page  = Page_Model::$page  = isset($_GET['page']) ? (int)sanitizeVar($_GET['page']) : 0;
$limit = Page_Model::$limit = /*$config['productPages']*/ 6 ;

$cat_products = new Category_Page_Controller( "cat" );

$view_cat->assign('HOME_HREF', $glob['storeURL']);

$view_cat->assign('CAT_ID',   $_GET['catId']);
$view_cat->assign('CAT_NAME', $cat_products->cat_name);
$view_cat->assign('CAT_DESC', $cat_products->cat_desc);

/* Range title */
if($cat_products->cat_title) {

$view_cat->assign('CAT_TITLE', $cat_products->cat_title);

}

else {
	
$view_cat->assign('CAT_TITLE', $cat_products->cat_name . " products");

}

$total_products = $cat_products->productCount;

if($total_products) {

$view_cat->assign('TOTAL_PRODUCTS', "<span class=\"page_total_products\">" . $total_products . " products</span>");

$pagination = paginate($total_products, $limit, $page, 'page', 'txtLink', 4);
	
if(strlen($pagination) > 6) {
$view_cat->assign("PAGINATION", "<div class=\"pagination\">".$pagination."</div>");
}


$view_cat->assign("CURRENT_URL", $_SERVER['REQUEST_URI']);

	for($i=0; $i<=$limit-1; $i++) {

		if($cat_products->products[$i]['productId']) {

			$image_path = $cat_products->image_paths[$i];

			$productId  = $cat_products->products[$i]['productId'];

			$view_cat->assign('NAME', $cat_products->products[$i]['name']);

			$view_cat->assign('PRICE', $cat_products->products[$i]['price']);

			$view_cat->assign('STOCK', $cat_products->stock_levels[$i]);

			$view_cat->assign('ID', $productId);

			$view_cat->assign('HREF', $cat_products->product_links[$i]);

			$view_cat->assign('IMAGE', $image_path);

			$view_cat->parse('product_cats.products_true.product_loop');

		}

	 }

$view_cat->parse('product_cats.products_true');

}

else {
	
$view_cat->assign('NO_PRODUCTS_MSG', "There are currently no " . $cat_products->cat_name . " products. Try looking into the following categories: ");

require_once'modules'.CC_DS.'3rdparty'.CC_DS.'Homepage_Categories'.CC_DS.'boxes'.CC_DS.'Homepage_Categories.inc.php';

if($categories->data) {

$view_cat->assign('HOMEPAGE_CATEGORIES', $box_content);

}

$view_cat->parse('product_cats.products_false');

}

$view_cat->parse('product_cats');

$view_cat = $view_cat->text('product_cats');

}


?>