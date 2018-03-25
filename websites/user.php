<?php
/**
* Created by Anoj 
*/
include "../config/config.php";

class User {

	public $db;

	public function __construct()
	{
		try {
            $this->db = mysqli_connect(Init::get('mysqli/host'), Init::get('mysqli/username'), Init::get('mysqli/password'), Init::get('mysqli/db'));
        } 
        catch(PDOException $e) 
        {
            die($e->getMessage());
        }

	}			//public function __construct()

	/*** for registration process ***/
	public function reg_user($name,$username,$password,$email)
	{

		$password = md5($password);
		$sql="SELECT * FROM users WHERE uname='$username' OR uemail='$email'";

		//checking if the username or email is available in db
		$check =  $this->db->query($sql) ;
		$count_row = $check->num_rows;

		//if the username is not in db then insert to the table
		if ($count_row == 0){
			$sql1="INSERT INTO users SET uname='$username', upass='$password', fullname='$name', uemail='$email'";
			$result = mysqli_query($this->db,$sql1) or die(mysqli_connect_errno()."Data cannot inserted");
    		return $result;
		}
		else { return false;}
	}

	/*** for login process ***/
	public function check_login($emailusername, $password)
	{
    	$password = md5($password);
		$sql2="SELECT id from users WHERE uemail='$emailusername' or uname='$emailusername' and upass='$password'";

		//checking if the username is available in the table
    	$result    = mysqli_query($this->db,$sql2);
    	$user_data = mysqli_fetch_array($result);
    	$count_row = $result->num_rows;
    	
        if ($count_row == 1) {
            // this login var will use for the session thing
            $_SESSION['login'] = true;
            $_SESSION['uid']   = $user_data['id'];
            return true;
        }
        else{
		    return false;
		}
	}

	/*** for showing the username or fullname ***/
	public function get_fullname($uid)
	{
		$sql3="SELECT fullname FROM users WHERE id = $uid";
        $result = mysqli_query($this->db,$sql3);
        $user_data = mysqli_fetch_array($result);
        echo $user_data['fullname'];
	}

	/*** starting the session ***/
    public function get_session()
    {
        return $_SESSION['login'];
    }

    public function user_logout() 
    {
        $_SESSION['login'] = FALSE;
        session_destroy();
    }

    public function check_user($parameter)
    {
        $returnValues = "";

        $sql = "SELECT * FROM users WHERE uname='$parameter' OR uemail='$parameter'";

		//checking if the username or email is available in db
		$check =  $this->db->query($sql) ;
		$count_row = $check->num_rows;

		//if the username is not in db then insert to the table
		if ($count_row == 0)
		{
	        $returnValues['status'] = "success";
	        if (!filter_var($parameter, FILTER_VALIDATE_EMAIL)) {
			    // invalid emailaddress, its username
			    $returnValues['param_type'] = "username";
	        	$returnValues['msg']        = "success";
			}
			else
			{
			    $returnValues['param_type'] = "email";				
	        	$returnValues['msg']        = "success";
			}
		}
		else 
		{ 
	        $returnValues['status'] = "error";

			if (!filter_var($parameter, FILTER_VALIDATE_EMAIL)) {
			    // invalid emailaddress, its username
			    $returnValues['param_type'] = "username";
	        	$returnValues['msg']        = "Username already exists!";
			}
			else
			{
			    $returnValues['param_type'] = "email";				
	        	$returnValues['msg']        = "Email already exists!";
			}
		}

        return $returnValues;

    }			//public function check_user()

}			//class User 
?>