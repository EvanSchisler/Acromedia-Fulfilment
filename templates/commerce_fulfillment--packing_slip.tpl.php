<?php
if(isset($vars)) {

  if(isset($vars['$image_obj_url'])){
    $image = $vars['$image_obj_url'];
  }
  else{
    $image = 'Company Logo';
  }
  if(isset($vars['company'])) {
    $company = $vars['company'];
  }
  else{
    $company = '[Company Name]';
  }
  if(isset($vars['address'])) {
    $address = $vars['address'];
  }
  else{
    $address = '[Company Address]';
  }
  if(isset($vars['phone'])) {
    $phone = $vars['phone'];
  }
  else{
    $address = '[Company Phone Number]';
  }
  if(isset($vars['products'])){
    $products = $vars['products'];
  }
  else{
    $products = NULL;
  }
  if(isset($vars['shipping'])){
    $shipping = $vars['shipping'];
  }
  else{
    $shipping = NULL;
  }
  if(isset($vars['page'])){
    $page = $vars['page'];
  }
  $count = $vars['count'];
}

?>
<html>
  <head>
    <?php print $page['css']?>
  </head>
  <body>
    <div id="header">
      <div class="company-info">
        <?php
        if($image !== NULL){
        ?>
        <img src=" <?php print $image; ?> " />
        <?php } else { ?>
          <p class="image-place">Company Logo </p>
        <?php } ?>
        <p>
        <?php
          print '<strong>' . t($company) . '</strong><br>' . t($address) . '<br>'. t('Phone: @phone', array('@phone' => $phone));
        ?>
        </p>
      </div>
      <div class="slip-head">
        <h1>Packing Slip</h1>
        <p>Date: <?php print date('y/m/d');?></p>
      </div>
    </div>
  <div class="customer-info">
    <p>
      <span class="customer-label">
          Ship To:
      </span>
      <br>
      <?php
        if($shipping !== NULL) {
          print t($shipping[0]) . ' ' . t($shipping[1]) . '<br>';
          print t('@ship_add, @ship_city @ship_state', array('@ship_add'=>$shipping[2], '@ship_city'=>$shipping[3], '@ship_state'=>$shipping[4])) . '<br>';
          print t('@ship_zip, @ship_country', array('@ship_zip'=>$shipping[5], '@ship_country'=>$shipping[6]));
        }
      ?>
    </p>
  </div>
  </body>
</html>