<html>
  <head>
    <?php print $page['css']; ?>
  </head>
  <body>
    <div class="shipping-wrapper">
      <div id="shipping-header">
        <div class="shipping-company">
          <img src="<?php print $image; ?>" />
          <p class="shipping-company-info">
            <?php
              print '<strong>' . t($company) . '</strong><br>' . t($address) . '<br>' . t('Phone: @phone', array('@phone' => $phone));
            ?>
          </p>
        </div>
        <div class="tracking-number">
          <p>
            <strong>Tracking Number: </strong>
            <?php print $tracking_number ?>
          </p>
        </div>
      </div>
      <div class="customer-shipping-info">
        <p>
        <span class="customer-label">
            <Strong>Ship To:</strong>
        </span>
          <br>
          <?php
          if($shipping !== NULL) {
            print t($shipping[0]) . ' ' . t($shipping[1]) . '<br>';
            print t('@ship_add, @ship_city @ship_state', array('@ship_add' => $shipping[2], '@ship_city' => $shipping[3], '@ship_state' => $shipping[4])) . '<br>';
            print t('@ship_zip, @ship_country', array('@ship_zip' => $shipping[5], '@ship_country' => $shipping[6]));
          }
          ?>
        </p>
      </div>
    </div>
  </body>
</html>
