<?php

// require 'config.php';
// for user login
class Login {

	private $email;
	private $pass;
	private $conn;

	public function loginData($email,$pass) {

		$conn = new dbClass();
		$this->conn = $conn;
		$this->email = $email;
		$this->pass = $pass;

		$result = $conn->getData("SELECT * FROM `tbl_admin` WHERE `email` = '$email' AND `password` = '$pass' AND `status` = '1'");

		if($result!=''){

			$conn->updateExecute("UPDATE `tbl_admin` SET  `login_ip` = '".$_SERVER['REMOTE_ADDR']."', `login_date` = now() WHERE `email` = '$email'");

			$_SESSION['ADMIN_USER'] = $result['username'];
			$_SESSION['ADMIN_USER_ID'] = $result['id'];
			$_SESSION['ADMIN_USER_TYPE'] = $result['type'];
			$_SESSION['ADMIN_USER_IP'] = $_SERVER['REMOTE_ADDR'];

			return true; 

		} else {

			return false;
		}
	}
}


// for reset password
class ForgetPass{

  private $email;
  private $conn;

  function forgetPass($email){     

  		$conn = new dbClass();
		$this->email = $email;
		$this->conn = $conn;

		$result = $conn->getData("SELECT * FROM `tbl_admin` WHERE `email` = '$email'");

		if($result!='')
		{
			$to = $result['email'];
			$subject = 'Forget Password';
			$from = 'imrankhan599594@gmail.com';

			$query = "<table width='100%'>";
			$query = $query . "<tr><td colspan='3' align='left'><strong>Recover Password</strong></td></tr>";
			$query = $query  . "<tr><td colspan='3' align='left'><strong>Dear ".ucwords($result['username'])."</strong></td></tr>";
			$query = $query . "<tr><td>Admin login password is <strong>".$result['password']."</strong></td></tr>";
			$query = $query . "</table>";

			mail($to, $subject, $query, "From: <$from>\r\nContent-type: text/html\r\n");

			return true;
		}
		else
            $conn->disconnect();
			return false;
	}
}



// for logout

class SignOut {

	public function Logout() {

		unset($_SESSION['ADMIN_USER']);
		unset($_SESSION['ADMIN_USER_ID']);
		unset($_SESSION['ADMIN_USER_TYPE']);
		unset($_SESSION['ADMIN_USER_IP']);
		session_destroy();

		echo "<script>window.location.href='index.php'</script>";

	}	
}

?>