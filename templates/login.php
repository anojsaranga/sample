<?php
session_start();
include_once '../config/config.php';
$title = 'Axent | Login';
include 'header.php';

$user = new User();

if (isset($_REQUEST['submit'])) 
{
	extract($_REQUEST);
    $login = $user->check_login($emailusername, $password);
    
    if ($login) {
        // Registration Success
       header("location:home.php");
    } else {
        // Registration Failed
        echo 'Wrong username or password';
    }
}
?>
<script type="text/javascript" language="javascript">
    function submitlogin() 
    {
        var form = document.login;
		if(form.emailusername.value == "")
		{
			alert( "Enter email or username." );
			return false;
		}
		else if(form.password.value == "")
		{
			alert( "Enter password." );
			return false;
		}
	}
</script>
<div class="limiter">
	<div class="container-login100" style="background-image: url('../assets/Login_v12/images/img-01.jpg');">
		<div class="wrap-login100 p-t-190 p-b-30">
			<form class="login100-form validate-form" method="post" action="">
				<div class="login100-form-avatar">
					<img src="../assets/Login_v12/images/avatar-01.jpg" alt="AVATAR">
				</div>

				<span class="login100-form-title p-t-20 p-b-45">
					John Doe
				</span>

				<div class="wrap-input100 validate-input m-b-10" data-validate = "Username is required">
					<input class="input100" type="text" name="emailusername" placeholder="Username">
					<span class="focus-input100"></span>
					<span class="symbol-input100">
						<i class="fa fa-user"></i>
					</span>
				</div>

				<div class="wrap-input100 validate-input m-b-10" data-validate = "Password is required">
					<input class="input100" type="password" name="password" placeholder="Password">
					<span class="focus-input100"></span>
					<span class="symbol-input100">
						<i class="fa fa-lock"></i>
					</span>
				</div>

				<div class="container-login100-form-btn p-t-10">
					<input class="login100-form-btn" onclick="return(submitlogin());" type="submit" name="submit" value="Login" />
					<!-- <button class="login100-form-btn">
						Login
					</button> -->
				</div>

				<!-- <div class="text-center w-full p-t-25 p-b-230">
					<a href="#" class="txt1">
						Forgot Username / Password?
					</a>
				</div> -->

				<div class="text-center w-full">
					<a class="txt1" href="registration.php">
						Create new account
						<i class="fa fa-long-arrow-right"></i>						
					</a>
				</div>
			</form>
		</div>
	</div>
</div>
<?php include 'footer.php'; ?>