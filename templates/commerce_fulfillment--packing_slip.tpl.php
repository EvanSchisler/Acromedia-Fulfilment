<?php
$total = 0;
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
  if(isset($vars['count'])) {
    $pack_count = $vars['count'];
  }
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
  <div>
    <table>
      <tr>
        <th>Item #:</th>
        <th>Item Name:</th>
        <th>Quantity:</th>
        <th>Price:</th>
        <th>Item Total:</th>
      </tr>
      <?php
      $count = 0;
      if($products !== NULL){
      foreach($products as $line_item){?>
      <tr>
        <?php
        $line_item_wrapper = entity_metadata_wrapper('commerce_line_item', $line_item);
          ?>
          <td>
            <?php print t($line_item_wrapper->line_item_label->value()); ?>
          </td>
          <td>
            <?php
              $com_product = commerce_product_load($line_item_wrapper->commerce_product->product_id->value());
              $com_product_wrapper = entity_metadata_wrapper('commerce_product', $com_product);
              print t($com_product_wrapper->title->value());
            ?>
          </td>
          <td>
            <?php print t($line_item_wrapper->quantity->value()); ?>
          </td>
          <td>
            <?php
            $price = $line_item_wrapper->commerce_unit_price->amount->value();
            $length = strlen($price);
            $price = substr_replace($price, '.', $length - 2, 0);
            print t('$@price', array('@price' => $price));
            ?>
          </td>
          <td>
            <?php
            $price = $line_item_wrapper->commerce_total->amount->value();
            $length = strlen($price);
            $price = substr_replace($price, '.', $length - 2, 0);
            print t('$@price', array('@price' => $price));
            $total += $line_item_wrapper->commerce_total->amount->value();
            $count++;
            ?>
          </td>
        </tr>
        <?php } }
        $count = 20 - $count;
        for($i = $count; $i>0; $i--){
        ?>
      <tr>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
      </tr>
      <?php } ?>
    </table>
    <div class="package-info">
      <span class="package-count">
        <?php print t('Package: 1 of @count', array('@count' => $pack_count)); ?>
      </span>
      <span class="package-total">
        <?php print t('Total: @total', array('@total' => $total)); ?>
      </span>
    </div>
  </div>
  </body>
</html>