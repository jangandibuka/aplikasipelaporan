<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class PHPMailer extends CI_Controller {

    function test_mail() {
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'ibnuzamrud@gmail.com',
            'smtp_pass' => 'Ibnu@1973!',
            'mailtype' => 'html',
            'charset' => 'iso-8859-1'
        );

        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");

        $mail = $this->email;

        $mail->from('ibnuzamrud@gmail.com', 'Ibnu');
        $mail->to('ibnuzamrud@gmail.com');
        $mail->cc('ibnuzamrud@gmail.com');
   
        $mail->subject('Mail Test');
        $mail->message('Testing the mail class dari aplikasi absendi.');

        if (!$mail->send()) {
            echo "Mailer Error: " . $mail->print_debugger();
        } else {
            echo "Message sent!";
        }
    }

}
