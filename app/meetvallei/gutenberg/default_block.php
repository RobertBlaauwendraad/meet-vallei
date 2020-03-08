<?php

function voedingsstoffen($block) {
  global $wpdb;
  $userid = get_current_user_id();
  $date = date("Ymd");
  $block["Energie"] = 0;
  $block["Vetten"] = 0;
  $block["Verzadigd-vet"] = 0;
  $block["Koolhydraten"] = 0;
  $block["Suiker"] = 0;
  $block["Vezels"] = 0;
  $block["Eiwitten"] = 0;
  $block["Natrium"] = 0;
  $queryList = "
      SELECT * 
      FROM foodlog
      WHERE 1=1
      AND (foodlog.user LIKE '%{$userid}%')
      AND (foodlog.date='{$date}')
  ";
  $results = $wpdb->get_results( $queryList, ARRAY_A );

  foreach( $results as $result ) {
    $productid = $result["product"];
    $productcount = $result["amount"];
    $user="user_".$userid ;

    while( have_rows('voedingsstoffen', $user ) ) : the_row();
      $count = count(get_sub_field('voedingsstoffenSelect', $user));
      for($i = 0; $i < $count; $i++){
        $name = get_sub_field('voedingsstoffenSelect', $user)[$i];
        $block[$name] = $block[$name] + $productcount * get_field($name, $productid);
      }
    endwhile;
  };

  return $block;
}
add_filter('sage/blocks/foodlog/data', __NAMESPACE__ . '\voedingsstoffen', 10, 3);
add_filter('sage/blocks/bar-chart/data', __NAMESPACE__ . '\voedingsstoffen', 10, 3);
add_filter('sage/blocks/pie-chart/data', __NAMESPACE__ . '\voedingsstoffen', 10, 3);
