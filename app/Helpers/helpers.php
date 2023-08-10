<?php
use App\Models\User;

function pr($data){
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}

function sendEmail($to, $subject, $message, $from_email='mrmamun20212022@gmail.com', $from_name='rocker'){

    require base_path().'/PHPMailer/vendor/autoload.php';

    $mail = new PHPMailer(true);

    try {
   
        $mail->SMTPDebug  = 0;   
        $mail->isSMTP();                                           
        $mail->Host = 'smtp.gmail.com';                  
        $mail->SMTPAuth   = true;                                  
        $mail->Username  = 'mrmamun20212022@gmail.com';                 
        $mail->Password   = 'qzgoozhgkcwmgilo';                               
        $mail->Port = 587;                               
        $mail->setFrom($from_email, $from_name);
        $mail->addAddress($to);   

        $mail->isHTML(true);                                
        $mail->Subject = $subject;
        $mail->Body    = $message;
        $mail->send();
    } catch (Exception $e) {
      
    }
    return true;

}


