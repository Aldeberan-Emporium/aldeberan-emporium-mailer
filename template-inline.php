<?php

  $userEmail = $_GET['email'];
  $userName = $_GET['name'];
  $orderID = $_GET['order_id'];
  require "cleardb.php";
  $getOrders = "SELECT * FROM orders o
                  LEFT JOIN order_address oa
                  ON oa.order_id = o.order_id
                  WHERE order_id = '$orderID'";
  $result = mysqli_query($conn, $query);
  if (mysqli_num_rows($result) > 0) {
      while($row = mysqli_fetch_assoc($result)){
          $orderRef = $row['order_reference'];
          $orderDate = $row['order_date'];
          $recipient = $row['address_recipient'];
          $contact = $row['address_contact'];
          $line1 = $row['address_line1'];
          $line2 = $row['address_line2'];
          $code = $row['address_code'];
          $city = $row['address_city'];
          $state = $row['address_state'];
      }
  }

  echo '<html>
        <body style="font-family: "Roboto", sans-serif;">
            <div id="wrapper" style="padding-left: 150px; padding-right: 150px; display: flex; justify-content: center; align-items: center;">
                <div id="content" style="background: #F3F5E3;">
                    <div id="title" style="margin: 1em; display: flex; justify-content: center; align-content: center; text-align: center;">
                        <span><img src="https://i.imgur.com/YnDcc8J.png" style="width: 10%; border-radius: 50px;"/></span>
                    </div>
                    <div style="margin: 1em;">
                        <span>
                            Dear <b>'.$username.'</b>,<br/>
                            Here are your order details for Order <b>'.$orderRef.'</b>:
                        </span>
                    </div>
                    <div id="details" style="margin: 1em;">
                        <span>
                            Date: <b>'.$orderDate.'</b> <br/><br/> 
                            Recipient Address:<br/>
                            <b>'.$recipient.' '.$contact.'</b><br/>
                            <b>'.$line1.', '.$line2.'</b><br/>
                            <b>'.$code.', '.$city.', '.$state.'.</b><br/><br/> 
                            Item(s) Purchased:<br/>   
                        </span>
                    </div>
                    <div id="itemTable" style="margin: 1em;">
                        <table style="width: 100%; text-align: center;" cellspacing="0" cellpadding="0">
                            <thead>
                              <tr>
                                <th scope="col" style="padding: 10px 0px; background: #C7B198; color: #F3F5E3;">Thumbnail</th>
                                <th scope="col" style="padding: 10px 0px; background: #C7B198; color: #F3F5E3;">Name</th>
                                <th scope="col" style="padding: 10px 0px; background: #C7B198; color: #F3F5E3;">Quantity</th>
                                <th scope="col" style="padding: 10px 0px; background: #C7B198; color: #F3F5E3;">Unit Price</th>
                              </tr>
                            </thead>
                            <tbody>';
      $getOrderItems = "SELECT * FROM order_items WHERE order_id = '$orderID'";
      $result = mysqli_query($conn, $query);
      if (mysqli_num_rows($result) > 0) {
          while($row = mysqli_fetch_assoc($result)){
              $prodName = $row['product_name'];
              $prodQuantity = $row['product_quantity'];
              $prodPrice = $row['product_price'];
              $prodImg = $row['product_img'];
              echo '<tr>
                <th style="padding: 10px 0px; background: #EFE4D6; color: #675B4A;"><img src="'.$prodImg.'" style="width: 5%;"/></th>
                <td style="padding: 10px 0px; background: #EFE4D6; color: #675B4A;">'.$prodName.'</td>
                <td style="padding: 10px 0px; background: #EFE4D6; color: #675B4A;">'.$prodQuantity.'</td>
                <td style="padding: 10px 0px; background: #EFE4D6; color: #675B4A;">RM '.$prodPrice.'</td>
              </tr>';
          }
      }
    echo '</tbody>
                          </table>
                    </div>
                    <div id="graditude" style="margin: 1em;">
                        <span>
                            Thank you for purchasing with Aldeberan Emporium! Hope you have a nice day!<br/><br/>
                            Best regards,<br/>
                            Aldeberan Emporium Team. <br/>
                        </span>
                    </div>
                    <div id="footer" style="margin: 1em; padding-top: 3em; text-align: center;">
                        <span>
                        <span id="facebook"><a href="https://www.facebook.com/Aldeberan-Emporium-107635728356122" target="_blank" style="font-size: 30px; text-decoration: none; color: #C7B198;"><img src="http://assets.stickpng.com/thumbs/584ac2d03ac3a570f94a666d.png" style="width:5%; color: #C7B198;"/></a></span><br/>
                        <span id="copyright" style="font-size: 10px;">©Copyright 2021 Aldeberan Emporium. All Right Reserved.</span>
                        </span>
                    </div>
                </div>
            </div>
        </body>
    </html>';
?>