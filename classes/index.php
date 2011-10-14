<?php require_once('category_nav_box_model_local.php'); 

$categories = $cat->get_categories('cat_father_id = 0'); ?>

<ul>

<?php

for($i=0; $i<=count($categories)-1; $i++) { 

$second = $cat->get_categories('cat_father_id =' . $categories[$i]['cat_id']); ?>

<li> <?php echo $categories[$i]['cat_name']; ?>

<?php for($j=0; $j<=count($second)-1; $j++) { ?>

<ul><li> <?php echo $second[$j]['cat_name']; 

$third = $cat->get_categories('cat_father_id = ' . $second[$j]['cat_id']);

for($k=0; $k<=count($third)-1; $k++) {

echo "<ul><li>" . $third[$k]['cat_name'] .  "</li></ul>";  } ?>

</li></ul>

<?php } ?>

</li></li>

<?php } ?>

</ul>