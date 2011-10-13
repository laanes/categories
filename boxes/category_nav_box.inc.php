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
		


}

$nav_box->parse('categories');

$nav_box = $nav_box->text('categories');

?>