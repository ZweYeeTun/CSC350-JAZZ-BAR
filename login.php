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
        $adminQuery = "SELECT * FROM users WHERE email = '$email' AND pass = '$password'";
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
<!-- <h1>Change Your Password</h1> -->
<form action="" class="big_form">
        <!-- Pills navs -->
        <!-- <ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="tab-login" data-mdb-pill-init href="#pills-login" role="tab"
                    aria-controls="pills-login" aria-selected="true">Login</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="tab-register" data-mdb-pill-init href="#pills-register" role="tab"
                    aria-controls="pills-register" aria-selected="false">Register</a>
            </li>
        </ul> -->
        <!-- Pills navs -->

        <!-- Pills content -->
        <div class="tab-content">
            <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
                <form>
                    <div class="text-center mb-3">
                        <p>Sign in with:</p>
                        <button type="button" data-mdb-button-init data-mdb-ripple-init
                            class="btn btn-link btn-floating mx-1">
                            <i class="fab fa-facebook-f"></i>
                        </button>

                        <button type="button" data-mdb-button-init data-mdb-ripple-init
                            class="btn btn-link btn-floating mx-1">
                            <i class="fab fa-google"></i>
                        </button>

                        <button type="button" data-mdb-button-init data-mdb-ripple-init
                            class="btn btn-link btn-floating mx-1">
                            <i class="fab fa-twitter"></i>
                        </button>

                        <button type="button" data-mdb-button-init data-mdb-ripple-init
                            class="btn btn-link btn-floating mx-1">
                            <i class="fab fa-github"></i>
                        </button>
                    </div>

                    <p class="text-center">or:</p>

                    <!-- Email input -->
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="email" id="loginName" class="form-control inp" />
                        <label class="form-label inp" for="loginName">Email address</label><?php if (isset($_POST['email'])) echo $_POST['email']; ?>
                    </div>

                    <!-- Password input -->
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="password" id="loginPassword" class="form-control inp" />
                        <label class="form-label inp" for="loginPassword">Password</label><?php if (isset($_POST['pass'])) echo $_POST['pass']; ?>
                    </div>

                    <!-- 2 column grid layout -->
                    <div class="row mb-4">
                        <div class="col-md-6 d-flex justify-content-center">
                            <!-- Checkbox -->
                            <div class="form-check mb-3 mb-md-0">
                                <input class="form-check-input" type="checkbox" value="" id="loginCheck" checked />
                                <label class="form-check-label" for="loginCheck"> Remember me </label>
                            </div>
                        </div>

                        <div class="col-md-6 d-flex justify-content-center">
                            <!-- Simple link -->
                            <a href="#!">Forgot password?</a>
                        </div>
                    </div>

                    <!-- Submit button -->
                    <button type="submit" data-mdb-button-init data-mdb-ripple-init
                        class="btn btn-primary btn-block mb-4">Sign in</button>

                    <!-- Register buttons -->
                    <div class="text-center">
                        <p>Not a member? <a href="#!">Register</a></p>
                    </div>
                </form>
            </div>
        </div>
        <!-- Pills content -->
    </form>

<?php include ('includes/footer.html'); ?>