<?php
session_start();
if ( ! empty( $_POST ) ) 
{
	if ( isset( $_POST['mailuid'] ) && isset( $_POST['pwd'] ) ) 
	{
		// Getting submitted user data from database
		require 'dbh.inc.php';
		
		// Get username and password entered in text boxes
		$mailuid = $_POST['mailuid'];
		$pwd = $_POST['pwd'];
		$temp = password_hash($pwd, PASSWORD_DEFAULT);
		if (empty($mailuid) || empty($pwd))
		{
			//Didn't enter user or password
			header("Location: ../index.php?error=emptyfields&uid=".$mailuid);
			exit();
		}
		
		// send query to database and get result
		$result = $conn->query("SELECT * FROM users WHERE uid ='" . $mailuid . "'");
		$user = $result->fetch_object();
		
		if ($user === NULL)
		{
			//Couldn't find user
			header("Location: ../index.php?error=incorrectfields&uid=".$temp);
			exit();
		}
		
		//Verify user password and set $_SESSION
		$pwdCheck = password_verify( $pwd, $user->pwd);
		if ( $pwdCheck == false ) {
			header("Location: ../index.php?error=incorrectfields&uid=".$mailuid);
			exit();
		} else if ( $pwdCheck = true ) {
			session_start();
			$_SESSION['userHASH'] = hash('sha384', $user->idNUM);
			header("Location: ../index.php?login=success");
			exit();
		} else {
			header("Location: ../index.php?error=incorrectfields&uid=".$mailuid);
			exit();
		}
		$mysqli->close();
	}
}
?>