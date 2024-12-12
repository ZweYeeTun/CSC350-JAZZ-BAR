<?php # Script 9.5 - register.php #2
// This script performs an INSERT query to add a record to the users table.

$page_title = 'Musicians Registerations';
include('includes/header.html');

// Check for form submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	require('../ch09/mysqli_connect.php'); // Connect to the db.

	$errors = array(); // Initialize an error array.

	// Check for a first name:
	if (empty($_POST['first_name'])) {
		$errors[] = 'You forgot to enter your first name.';
	} else {
		$fn = mysqli_real_escape_string($dbc, trim($_POST['first_name']));
	}

	// Check for a last name:
	if (empty($_POST['last_name'])) {
		$errors[] = 'You forgot to enter your last name.';
	} else {
		$ln = mysqli_real_escape_string($dbc, trim($_POST['last_name']));
	}

	// Check for an email address:
	if (empty($_POST['email'])) {
		$errors[] = 'You forgot to enter your email address.';
	} else {
		$e = mysqli_real_escape_string($dbc, trim($_POST['email']));
	}

	// Check for a password and match against the confirmed password:
	if (!empty($_POST['pass1'])) {
		if ($_POST['pass1'] != $_POST['pass2']) {
			$errors[] = 'Your password did not match the confirmed password.';
		} else {
			$p = mysqli_real_escape_string($dbc, trim($_POST['pass1']));
		}
	} else {
		$errors[] = 'You forgot to enter your password.';
	}

	if (empty($errors)) { // If everything's OK.

		// Register the user in the database...

		// Make the query:
		$q = "INSERT INTO users (first_name, last_name, email, pass, registration_date) VALUES ('$fn', '$ln', '$e', SHA1('$p'), NOW() )";
		$r = @mysqli_query($dbc, $q); // Run the query.
		if ($r) { // If it ran OK.

			// Print a message:
			echo '<h1>Thank you!</h1>
		<p>You are now registered. In Chapter 12 you will actually be able to log in!</p><p><br /></p>';

		} else { // If it did not run OK.

			// Public message:
			echo '<h1>System Error</h1>
			<p class="error">You could not be registered due to a system error. We apologize for any inconvenience.</p>';

			// Debugging message:
			echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';

		} // End of if ($r) IF.

		mysqli_close($dbc); // Close the database connection.

		// Include the footer and quit the script:
		include('includes/footer.html');
		exit();

	} else { // Report the errors.

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
<form action="" class="big_form">
	<!-- Pills navs -->
	<ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
		<!-- <li class="nav-item" role="presentation">
			<a class="nav-link active" id="tab-login" data-mdb-pill-init href="#pills-login" role="tab"
				aria-controls="pills-login" aria-selected="true">Login</a>
		</li> -->
		<!-- <li class="nav-item" role="presentation">
			<a class="nav-link" id="tab-register" data-mdb-pill-init href="#pills-register" role="tab"
				aria-controls="pills-register" aria-selected="false">Register</a>
		</li>-->
	</ul> 
	<!-- Pills navs -->

	<!-- Pills content -->

		<div class="tab-pane fade show active" id="pills-register" role="tabpanel" aria-labelledby="tab-register">
			<form>
				<div class="text-center mb-3">
					
					<p>Sign up with:</p>
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

				<!-- Name input -->
				<div data-mdb-input-init class="form-outline mb-4">
					<input type="text" id="registerFirstName" class="form-control inp" />
					<label class="form-label inp" for="registerFirstName">First
						Name</label><?php if (isset($_POST['first_name']))
							echo $_POST['first_name']; ?></p>
				</div>

				<!-- Username input -->
				<div data-mdb-input-init class="form-outline mb-4">
					<input type="text" id="registerLastname" class="form-control inp" />
					<label class="form-label inp" for="registerLastname">Last
						Name</label><?php if (isset($_POST['last_name']))
							echo $_POST['last_name']; ?></p>
				</div>

				<!-- Email input -->
				<div data-mdb-input-init class="form-outline mb-4">
					<input type="email" id="registerEmail" class="form-control inp" />
					<label class="form-label inp"
						for="registerEmail">Email</label><?php if (isset($_POST['email']))
							echo $_POST['email']; ?> </p>
				</div>

				<!-- Password input -->
				<div data-mdb-input-init class="form-outline mb-4">
					<input type="password" id="registerPassword" class="form-control inp" />
					<label class="form-label inp"
						for="registerPassword">Password</label><?php if (isset($_POST['pass1']))
							echo $_POST['pass1']; ?> </p>
				</div>

				<!-- Repeat Password input -->
				<div data-mdb-input-init class="form-outline mb-4">
					<input type="password" id="registerRepeatPassword" class="form-control" />
					<label class="form-label inp" for="registerRepeatPassword">Repeat
						password</label><?php if (isset($_POST['pass2']))
							echo $_POST['pass2']; ?> </p>
				</div>

				<!-- Checkbox -->
				<div class="form-check d-flex justify-content-center mb-4">
					<input class="form-check-input me-2" type="checkbox" value="" id="registerCheck" checked
						aria-describedby="registerCheckHelpText" />
					<label class="form-check-label" for="registerCheck">
						I have read and agree to the terms
					</label>
				</div>

				<!-- Submit button -->
				<button type="submit" data-mdb-button-init data-mdb-ripple-init
					class="btn btn-primary btn-block mb-3">Sign up</button>
			</form>
		</div>
	</div>
	<!-- Pills content -->
</form>

<!-- MDB -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/8.1.0/mdb.umd.min.js"></script>
<?php include('includes/footer.html'); ?>