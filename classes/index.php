<?php require_once('category_nav_box_model_local.php'); 

$categories = $cat->get_categories('cat_father_id = 0');

$output = "<ul>";

for($i=0; $i<=count($categories)-1; $i++) { 

$second = $cat->get_categories('cat_father_id = ' . $categories[$i]['cat_id']); 

$output .= "<li>" . $categories[$i]['cat_name'];

if(isset($second[$i]['cat_id'])) {

$output .= "<ul>";

for($j=0; $j<=count($second)-1; $j++) { 

$output .= "<li>" . $second[$j]['cat_name'];

$third = $cat->get_categories('cat_father_id = ' . $second[$j]['cat_id']);

if(isset($third[$j]['cat_id'])) {

$output .= "<ul>";

for($k=0; $k<=count($third)-1; $k++) {

$output .= "<li>" . $third[$k]['cat_name'] . "</li>";

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

echo $output;

?>

