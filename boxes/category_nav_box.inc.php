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

$nav_box = new XTemplate ('boxes'.CC_DS.'category_nav_box.tpl');

if($categories->data) {
		
foreach($categories->data as $index => $data):

	// echo "<pre>";

	// print_r($data);

	// echo "</pre>";

	if($data['cat_father_id'] == 0):
															
	$child = $categories->get_cat_by_condition('cat_father_id', $data['cat_id']); 

	$nav_box->assign('CAT_NAME', $data[0]['cat_name']); ## ACCESS CONTROL

	$nav_box->assign('CHILD_CAT_NAME', $child[0]['cat_name']); ## SALTO

	$grand_child = $categories->get_cat_by_condition('cat_father_id', $child[0]['cat_id']);

		if($grand_child[0]['cat_id']):

			for($i=0; $i<=count($grand_child)-1; $i++):

			$nav_box->assign('GRAND_CHILD_CAT_NAME', $grand_child[$i]['cat_name']);

			$nav_box->parse('categories.category_loop.has_no_father.grand_child');

			endfor;

		endif;

		$nav_box->parse('categories.category_loop.has_no_father');

		else:

		$father = $categories->get_cat_by_condition("cat_id", $data['cat_father_id']);

		// echo "<pre>";

		// print_r($father);

		// echo "</pre>";

			if($father[0]['cat_father_id'] == 0):

			$nav_box->assign('FATHER_CAT_NAME', $father[0]['cat_name']);

			$nav_box->assign('CAT_NAME', $data[0]['cat_name']);

			$nav_box->parse('categories.category_loop.has_father.has_no_grand_father');

			else:

			$grand_father = $categories->get_cat_by_condition("cat_id", $father[0]['cat_father_id']);

				if($grand_father[0]['cat_father_id'] == 0):

				$nav_box->assign('GRAND_FATHER_CAT_NAME', $grand_father[0]['cat_name']);

				$nav_box->assign('FATHER_CAT_NAME', $father[0]['cat_name']);

				$nav_box->assign('CAT_NAME', $data[0]['cat_name']);

				$nav_box->parse('categories.category_loop.has_father.has_grand_father');

				endif;

			endif;

			$nav_box->parse('categories.category_loop.has_father');

		endif;

$nav_box->parse('categories.category_loop');

endforeach;

}

$nav_box->parse('categories');

$nav_box = $nav_box->text('categories');

?>