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

$nav_box = new XTemplate ('boxes'.CC_DS.'category_nav_box.tpl');

$first = $categories->get_categories('cat_father_id = 0'); 

$output .= '<ul id="nav">';

for($i=0; $i<=count($first)-1; $i++) { 

$second = $categories->get_categories('cat_father_id =' . $first[$i]['cat_id']); 

$output .= "<li>" . "<a>" . $first[$i]['cat_name'] . "</a>"; 

for($j=0; $j<=count($second)-1; $j++) { 

$output .= "<ul><li>" . "<a>" . $second[$j]['cat_name'] . "</a>"; 

$third = $categories->get_categories('cat_father_id = ' . $second[$j]['cat_id']);

for($k=0; $k<=count($third)-1; $k++) {

$output .= "<ul><li>" . "<a>" . $third[$k]['cat_name'] . "</a>" . "</li></ul>"; } 

$output .= "</li></ul>";

 } 

$output .= "</li>";

 } 

$output .= "</ul>";

$nav_box->assign('CATEGORY_NAVIGATION', $output);
		
$nav_box->parse('categories');

$nav_box = $nav_box->text('categories');

}

?>

<ul>