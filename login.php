<?php # Script 9.7 - password.php
// This page lets a user change their password.

$page_title = 'login page';
include ('includes/header.html');

// Check for form submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	require ('../ch09/mysqli_connect.php'); // Connect to the db.
    $errors = array(); // Initialize an error array.
	
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $password =sha1($pass);

    // Sanitize inputs
    if (empty($_POST['email'])) {
		$errors[] = 'You forgot to enter your email address.';
	} else {
		$e = mysqli_real_escape_string($dbc, trim($_POST['email']));
	}

	// Check for the current password:
	if (empty($_POST['pass'])) {
		$errors[] = 'You forgot to enter your current password.';
	} else {
		$p = mysqli_real_escape_string($dbc, trim($_POST['pass']));
	}
    if(empty($errors)){
        $adminQuery = "SELECT * FROM admins WHERE email = '$email' AND pass = '$password'";
        echo $adminQuery;
    $adminResult = $dbc->query($adminQuery);

    // Query to check in the 'musician' table
    $musicianQuery = "SELECT * FROM musician WHERE email = '$email' AND pass = '$password'";
    $musicianResult = $dbc->query($musicianQuery);

    if ($adminResult->num_rows > 0) {
        echo "Welcome, Admin!";
        header('Location: PROJECT/admin.html');
        exit();
        
        // Redirect to admin dashboard
        // header('Location: admin_dashboard.php');
        // exit();
    } elseif ($musicianResult->num_rows > 0) {
        echo "Welcome, Musician!";
        header('Location: PROJECT/musician.html');
        // Redirect to musician dashboard
        // header('Location: musician_dashboard.php');
        exit();
    } else {
        echo "Invalid email or password!";
    }       
    

    }
    else { // Report the errors.

		echo '<h1>Error!</h1>
		<p class="error">The following error(s) occurred:<br />';
		foreach ($errors as $msg) { // Print each error.
			echo " - $msg<br />\n";
		}
		echo '</p><p>Please try again.</p><p><br /></p>';
	
	} // End of if (empty($errors)) IF.

    
    

	mysqli_close($dbc); // Close the database connection.
		
} // End of the main Submit conditional.
?>
<h1>Login with your respective credentials</h1>
<form action="login.php" method="post">
	<p>Email Address: <input type="text" name="email" size="20" maxlength="60" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>"  /> </p>
	<p> Password: <input type="password" name="pass" size="10" maxlength="20" value="<?php if (isset($_POST['pass'])) echo $_POST['pass']; ?>"  /></p>
	<p><input type="submit" name="submit" value="Login" /></p>
</form>
<?php include ('includes/footer.html'); ?>