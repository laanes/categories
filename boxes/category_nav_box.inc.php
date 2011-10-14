<?php
// /*

// +--------------------------------------------------------------------------

// |	category_nav_box.inc.php

// |   ========================================

// |	Category navigation module for displaying category navigation links.

// +--------------------------------------------------------------------------

// */

/* Import classes */
require_once('modules'.CC_DS.'3rdparty'.CC_DS.'categories'.CC_DS.'classes'.CC_DS.'category_nav_box_controller.php');

if($categories->data) {

$open_list  = "<ul><li>";
$close_list = "</ul></li>";

$nav_box = new XTemplate ('boxes'.CC_DS.'category_nav_box.tpl');

	$first_level = $categories->get_categories('cat_father_id = 0');

	$output = "";

	for($i=0; $i<=count($first_level)-1; $i++) {

	$second_level = $categories->get_categories('cat_father_id =' . $first_level[$i]['cat_id']);

		$output .= $open_list . $first_level[$i]['cat_name'];


	for($j=0; $j<=count($second_level)-1; $j++) { 

	$third_level = $categories->get_categories('cat_father_id = ' . $second_level[$j]['cat_id']);

		$output .= $open_list . $second_level[$j]['cat_name'];

	
	for($k=0; $k<=count($third_level)-1; $k++) {

		$output .= $open_list . $third_level[$k]['cat_name'] . $close_list;

	}

		$output .= $close_list;
	}

		$output .= $close_list;
	}

$nav_box->assign('CATEGORY_NAVIGATION', $output);
		
$nav_box->parse('categories');

$nav_box = $nav_box->text('categories');

}

?>