<?php 
include 'functions/connect.php';
class functions extends Database{
    public function __construct(){
        $this->db = $this->dbconn();
        $this->errors   = array();
    }

// REGISTER USER
public function register(){

	if (isset($_POST['register_btn'])) {
	// receive all input values from the form. Call the e() function
    // defined below to escape form values
	 $username     = $_POST['username'];
	 $email        = $_POST['email'];
     $gender       = $_POST['gender'];
     $year         = $_POST['birthdate'];
     $location     = $_POST['location'];
     $user_type    = "User";
     $relationship = $_POST['relationship'];
     $about        = $_POST['about'];
     $ip = $_SERVER['REMOTE_ADDR'];
	 $password_1   = $_POST['password_1'];
	 $password_2   = $_POST['password_2'];
	// form validation: ensure that the form is correctly filled
	if (empty($username)) { 
		echo "<div class='error'>";
		echo "Username is required";
		echo "</div>";
		array_push($this->errors, " "); 
	}
	if (empty($email)) {
		echo "<div class='error'>";
		echo "Email is required";
		echo "</div>"; 
		array_push($this->errors, " "); 
	}
	if (empty($password_1)) {
		echo "<div class='error'>";
		echo "Password is required";
		echo "</div>"; 
		array_push($this->errors, " "); 
	}
	if ($password_1 != $password_2) {
		
		echo "<div class='error'>";
		echo "The two Passwords do not match";
		echo "</div>";
		array_push($this->errors, " ");
	}
        $query1 = "SELECT * FROM yxerz WHERE username = :user";
		$stmt = $this->db->prepare($query1);
		$stmt->bindValue('user',$username,PDO::PARAM_STR);
		$stmt->execute();
        $row1 = $stmt->fetch();
  
  if ($row1) { // if user exists
    if ($usrs = $row1['username'] == $username) {
		echo "<div class='error'>";
		echo "Username already exists";
		echo "</div>";
      array_push($this->errors, " ");
    }

}

        $query4 = "SELECT * FROM yxerz WHERE email = :email";
		$stmt = $this->db->prepare($query4);
		$stmt->bindValue('email',$email,PDO::PARAM_STR);
		$stmt->execute();
        $row4 = $stmt->fetch();

		if ($row4) { // if email exists
			if ($emal = $row4['email'] == $email) {
				echo "<div class='error'>";
				echo "Email already exists";
				echo "</div>";
			  array_push($this->errors, " ");
			}
		
		}

		$email_regex = "/([a-zA-Z0-9!#$%&’?^_`~-])+@(gmail)+(.com)+/";
        if(preg_match($email_regex,$email)){

        }else{

			echo "<div class='error'>";
			echo "Please input your Gmail";
			echo "</div>";
		  array_push($this->errors, " ");
       }
			
			
	// register user if there are no errors in the form
	if (count($this->errors) == 0) {
		$password = md5($password_1);//encrypt the password before saving in the database

			$stmt = $this->db->prepare("INSERT INTO yxerz (username, email, gender, user_type, password,location,relationship,about,birthdate,ipaddress) 
		    VALUES(:user,:email,:gender,:usert,:pass,:loc,:rel,:abo,:yea,:ip)");
			$stmt->bindParam('user',$username);
			$stmt->bindParam('email',$email);
			$stmt->bindParam('gender',$gender);
			$stmt->bindParam('usert',$user_type);
			$stmt->bindParam('pass',$password);
			$stmt->bindParam('loc',$location);
			$stmt->bindParam('rel',$relationship);
			$stmt->bindParam('abo',$about);
			$stmt->bindParam('yea',$year);
			$stmt->bindParam('ip',$ip);
			$stmt->execute();

			$id = $this->db->LastInsertId();

			$query2 = "SELECT * FROM yxerz WHERE id = :di";
	        $stmt = $this->db->prepare($query2);
	        $stmt->bindValue('di',$id,PDO::PARAM_STR);
	        $stmt->execute();
	        $user = $stmt->fetch();

			$_SESSION['username'] = $user; // put logged in user in session
			$_SESSION['success']  = "You are now logged in";
			header('location: directing.php');
	
	}
	}
}


public function logout(){
	if (isset($_GET['logout'])) {

	header("location: logout.php");

}
}




// LOGIN USER
public function login(){
	if (isset($_POST['login_btn'])) {

	// grap form values
	$username = $_POST['username'];
	$password = $_POST['password'];
	$password1 = md5($password);

	$query = "SELECT * FROM yxerz WHERE username = :user";
	$stmt = $this->db->prepare($query);
	$stmt->bindValue('user',$username,PDO::PARAM_STR);
	$stmt->execute();


		
		if($stmt->rowCount() > 0){
			$row = $stmt->fetch();
            //echo $accesscommand;
			if ($row['password'] == $password1) {
				$_SESSION['username'] = $row;
				$_SESSION['success']  = "You are now logged in";
				header('location: index');
                
			}else{
						echo "<div class='error'>Invalid Login Details</div>";
			}


		}else{
					echo "<div class='error'>Username Doesnt Exist</div>";
		}

	
 }
	}
}




?>