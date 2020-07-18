<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load PHPMailer Composer's autoloader
require 'vendor/autoload.php';

class Signup extends Controller
{
	
	function __construct()
	{
		parent::__construct();
        $this->view->layout = "signup";
	}

	public function index(){
		$this->view->render('signup/index');
	}

	public function error(){
		$this->view->msg='There is no such method';
		$this->view->render('error/index');
	}

	public function check_database_for_sign_up_input(){//$_POST arrayi controllerin ichinde barlap son gechirmeli
		$this->model->check_database_for_sign_up_input();
	}

	
	public function registrate_user(){
		if(isset($_POST)){
			$mail = $this->model->registrate_user($_POST); //registrate edilen userin mailini return edyar
			$verifyCode = $this->model->getVerifyCodeByMail($mail);//emaili berilen userin verifyCode return edyar

			//$this->sendMail($mail,$verifyCode);
		}
	}

	public function sendMail($mail_verification_array){
		 
		 $mail = $mail_verification_array[0];
		 $verifyCode = $mail_verification_array[1]; 
		echo "verify code: ".$verifyCode;
		echo "<br>";
		echo "email: ".$mail;

		$mail = new PHPMailer(true);

    	try {
       		//Server settings
        	//$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
        	$mail->isSMTP();                                            // Send using SMTP
			$mail->Host       = '185.46.123.38';                    // Set the SMTP server to send through
			$mail->SMTPAuth   = true;                                   
			$mail->Username   = 'test@geekspace.timar-tm.com';                     // SMTP username
			$mail->Password   = '123123123aa'; 
			$mail->SMTPSecure = 'ssl';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
			$mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

			//Recipients
			$mail->setfrom('agamyrat.chariyev@gmail.com', 'Mailer');
			// $mail->addaddress('agamyrat.chariyev@gmail.com', 'Joe User');     // Add a recipient
			// $mail->addaddress('mr.parahat28@gmail.com', 'Joe User');     // Add a recipient
			//$mail->addaddress('erejepow00@mail.ru', 'Erkin Rejepow');     // Add a recipient
			$mail->addaddress('agamyrat.chariyev@gmail.com', 'Erkin Rejepow');     // Add a recipient
			$mail->addaddress($mail, 'Eric');     // Add a recipient
			
			$link = 'http://localhost/TestPlatform/GS_Test_Platform/welcome/activateUser/';
			$random = $verifyCode;
			
			// $mail->addaddress('ellen@example.com');               // Name is optional
			// $mail->addreplyto('info@example.com', 'Information');
			// $mail->addcc('cc@example.com');
			// $mail->addbcc('bcc@example.com');

			// Attachments
			// $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
			// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

			// Content
			$mail->isHTML(true);                                  // Set email format to HTML
			$mail->Subject = 'Accountynyzy activ etmek ucin';
			$mail->Body    = '<h1>This is head</h1>
			<p> Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti magni natus amet sed obcaecati at quia molestiae et iste quas, fugit, non expedita, autem recusandae. Voluptates ab deleniti maiores consequuntur.
			</p>

			<a style="box-sizing: border-box;text-decoration: none;background-color: #0366d6;border-radius: 5px;color: #ffffff;display: inline-block;font-size: 14px;font-weight: bold;cursor: pointer;margin: 0;padding: 10px 20px;border: 1px solid #0366d6;" href="'.$link.$random.'" target="_blank" rel=" noopener noreferrer">Confirm</a>';
			$mail->AltBody = 'Bashmasan activ bolmaz hahaha';

			$mail->send();
			echo 'Message has been sent';
		} catch (Exception $e) {
			echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    	}	
	}

	
}

 ?>