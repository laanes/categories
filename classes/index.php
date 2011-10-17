<?php require_once('category_nav_box_model_local.php'); 

$categories = $cat->get_categories('cat_father_id = 0');

$output = '<ul id="nav">';

for($i=0; $i<=count($categories)-1; $i++) { 

$second = $cat->get_categories('cat_father_id = ' . $categories[$i]['cat_id']); 

$output .= "<li><a href='#'>" . $categories[$i]['cat_name']."</a>";

if(isset($second[$i]['cat_id'])) {

$output .= "<ul>";

for($j=0; $j<=count($second)-1; $j++) { 

$output .= "<li><a href='#'>" . $second[$j]['cat_name']."</a>";

$third = $cat->get_categories('cat_father_id = ' . $second[$j]['cat_id']);

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

?>

<html>
<head>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js" type="text/javascript" charset="utf-8"></script>

	<link rel="stylesheet" href="css/style.css" type="text/css" />
 	<!--[if lt IE 8]>
		<script src ="http://ie7-js.googlecode.com/svn/version/2.1(beta2)/IE8.js"></script>
	<![endif]-->	
</head>
	<title>Navigation</title>
</head>
<body>

<script src="http://jquery-ui.googlecode.com/svn/tags/latest/ui/jquery.effects.core.js" type="text/javascript"></script>

<script type="text/javascript" src="js/scripts.js"></script>

<?php echo $output; ?>
	
</body>
</html>
