<?php 
	
	session_start();
	
	if(isset($_REQUEST['logout'])) {
		echo "here";
		unset($_SESSION['access_token']);
		
		session_destroy();
		
		header('Location: ../index.php');
	} 
	
	echo "<h2> Welcome to  Google+ login Page </h2>";
	
	if(isset($_SESSION['access_token']))
		echo "<a class='logout' href='?logout'<button>Logout</button></a>";
