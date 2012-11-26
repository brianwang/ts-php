<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EMail
 *
 * @author brian
 */
require_once dirname(__FILE__) . '/phpmailer/class.phpmailer.php';

class EMail {

    //put your code here
    public static function sendmail($from, 
            $to, $cc, 
            $reply='', $subject='', $body='', $attach='') {

        $mail = new PHPMailer(); // defaults to using php "mail()"

        $mail->IsSendmail(); // telling the class to use SendMail transport
        try {
            if (is_array($to)) {
                foreach ($to as $e => $n) {
                    $mail->AddAddress($e, $n);
                }
            } else if($to != ''){
                $mail->AddAddress($to);
            }
            if (is_array($cc)) {
                foreach ($cc as $e => $n) {
                    $mail->AddCC($e, $n);
                }
            } else if($cc != '') {
                $mail->AddCC($cc);
            }
            if (is_array($reply)) {
                foreach ($reply as $e => $n) {
                    $mail->AddReplyTo($e, $n);
                }
            } else if($reply != '') {
                $mail->AddReplyTo($reply);
            }
            $mail->SetFrom($from, 'First Last');
            $mail->Subject = $subject;
            $mail->MsgHTML($body);
            if ($attach != '' && is_array($attach) ) {
                foreach ($attach as $at) {
                    $mail->AddAttachment($at);      // attachment
                }
            }
            $mail->Send();
        } catch (phpmailerException $e) {
            echo $e->errorMessage(); //Pretty error messages from PHPMailer
        } catch (Exception $e) {
            echo $e->getMessage(); //Boring error messages from anything else!
        }
    }

}

?>
