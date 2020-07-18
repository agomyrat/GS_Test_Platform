<?php 
/**
	 * 
	 */
class Signup_Model extends Model{

	public function __construct(){	
		parent::__construct();
	}
	
	public function check_database_for_sign_up_input(){
    	if(isset($_POST['column_name'])){

        $sql = 'SELECT COUNT(*) FROM users WHERE '.$_POST['column_name'].' = ?';
        $query = $this->db->prepare($sql);
        $query->execute([$_POST['text']]);
        echo !$query->fetch()[0];
    }

	}

	public function registrate_user($array=null){

			//print_r($_POST['user']);

			$firstname = $array['user']['firstname'];
			$lastname = $array['user']['lastname'];
			$username = $array['user']['username'];
			$country = $array['user']['country'];
			$phoneNumber = $array['user']['phoneNumber'];
			$birthDate = $array['user']['birthDate'];//duzetmeli (int-int-int) formada gechirmeli
			$email = $array['user']['email'];
			$password = md5($array['user']['password']);

			// $sql="INSERT INTO `test_platform`.`users`(`FIRST_NAME`, `SURNAME`, `E_MAIL`, `USER_NAME`, `BIRTH_DATE`, `PHONE_NUMBER`, `COUNTRY`, `CITY`, `ACTIVE`, `IMAGE`, `GENDER`, `JOB`, `STATUS`, `ISADMIN`,`PASSWORD`,`VERIFY_CODE`)"
			// ." VALUES ('$firstname', '$lastname', '$email', '$username', '$birthDate', '$phoneNumber', '$country', '', 0, '', 0, '', 0, 0, '$password', UUID());";
			// $this->db->exec($sql);

			$sql="INSERT INTO `test_platform`.`users`(`FIRST_NAME`, `SURNAME`, `E_MAIL`, `USER_NAME`, `BIRTH_DATE`, `PHONE_NUMBER`, `COUNTRY`, `CITY`, `ACTIVE`, `IMAGE`, `GENDER`, `JOB`, `STATUS`, `ISADMIN`,`PASSWORD`,`VERIFY_CODE`)"
			." VALUES (:firstname, :lastname, :email, :username, :birthDate, :phoneNumber, :country, '', 0, '', 0, '', 0, 0, :password, UUID());";
			$query = $this->db->prepare($sql);
			$query->execute([
				':firstname'=>$firstname,
				':lastname'=>$lastname,
				':email'=>$email,
				':username'=>$username,
				':birthDate'=>$birthDate,
				':phoneNumber'=>$phoneNumber,
				':country'=>$country,
				':password'=>$password]);

			echo "INSERT EDILDI";
			return $email;
	}

	public function getVerifyCodeByMail($mail){
        $sql = 'SELECT VERIFY_CODE FROM users WHERE E_MAIL= ?';
        $query = $this->db->prepare($sql);
        $query->execute([$mail]);
		echo "verify code:";

		//$this->db =null; //close db connection
		return $query->fetch()[0];
	}
}	

 ?>