<?php
    //For PHP mailer
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    require "vendor/autoload.php";

    $mail = new PHPMailer(true);   
    $userEmail = $_GET['email'];
    $userName = $_GET['name'];
    /*
    $orderRef = $_GET['ref'];
    $orderItems = $_GET['items'];
    $orderAddress = $_GET['address'];
    */
    try {
        //Server settings
        $mail->isSMTP();                                     
        $mail->Host       = 'smtp.gmail.com';               
        $mail->SMTPAuth   = true;                                
        $mail->Username   = getenv("USERNAME");     
        $mail->Password   = getenv("PASSWORD");             
        $mail->SMTPOptions = array(
            'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
            )
        );                         
        $mail->SMTPSecure = 'ssl';                           
        $mail->Port = 465;                                   

        //Send Email
        $mail->setFrom(getenv("USERNAME"), 'Aldeberan Emporium');

        //Recipients           
        $mail->addAddress($userEmail, $userName); 

        //Content
        $mail->isHTML(true); //Set email format to HTML
        $mail->Subject = 'Thank you for purchasing with Aldeberan Emporium!';
        $mail->Body    = ?>
        <!DOCTYPE html>
            <head>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.min.js" integrity="sha512-OvBgP9A2JBgiRad/mM36mkzXSXaJE9BEIENnVEmeZdITvwT09xnxLtT4twkCa8m/loMbPHsvPl0T8lRGVBwjlQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css" integrity="sha512-GQGU0fMMi238uA+a/bdWJfpUGKUkBdgfFdgBm72SUQ6BeyWjoY/ton0tEjH+OSH9iP4Dfh+7HM0I9f5eR0L/4w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
                <link rel="preconnect" href="https://fonts.googleapis.com">
                <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
                <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
                <link rel="stylesheet" href="public/styles/style.css"/>
            </head>
            <body>
                <div class="row col-md-12" id="wrapper">
                    <div class="col-md-12" id="content">
                        <div class="col-md-12" id="title">
                            <img src="public/images/logo.png"/>
                        </div>
                        <div class="col-md-12">
                            <span>
                                Dear '.$userName.',<br/>
                                Here are your order details for Order $orderRef:
                            </span>
                        </div>
                        <div class="col-md-12" id="details">
                            <span>
                                Date: $orderDate <br/><br/> 
                                Recipient Address:<br/>
                                $recipient $contact<br/>
                                $line1, $line2<br/>
                                $code, $city, $state.<br/><br/> 
                                Item(s) Purchased:<br/>   
                            </span>
                        </div>
                        <div class="col-md-12" id="itemTable">
                            <table class="table table-hover table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">Thumbnail</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Unit Price</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>RM ?</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Jacob</td>
                                    <td>Thornton</td>
                                    <td>RM ?</td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td>Larry</td>
                                    <td>the Bird</td>
                                    <td>RM ?</td>
                                </tr>
                                <tr>
                                    <th scope="row"></th>
                                    <td></td>
                                    <th>Total Price</th>
                                    <td>RM ?</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-12" id="graditude">
                            <span>
                                Thank you for purchasing with Aldeberan Emporium! Hope you have a nice day!<br/>
                                Best regards,<br/>
                                Aldeberan Emporium Team. <br/>
                            </span>
                        </div>
                        <div class="col-md-12" id="footer">
                            <span>
                            <span id="facebook"><a href="https://www.facebook.com/Aldeberan-Emporium-107635728356122" target="_blank"><i class="fab fa-facebook-square"></i></a></span><br/>
                            <span id="copyright">©Copyright 2021 Aldeberan Emporium. All Right Reserved.</span>
                            </span>
                        </div>
                    </div>
                </div>
            </body>
        </html><?php;
        $mail->send();
    } catch (Exception $e) {}     
?> 