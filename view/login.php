        <!-- Top Header Start -->
        <section class="banner-header">
            <div class="container text-center">
                <div class="row">
                    <div class="col-md-12">
                        <h1><a href="?a=home">Dr. Johnson</a></h1>
                        <!-- <a class="brand" href="index.html" title="Home"><img alt="Logo" src="img/logo.png"></a> -->
                    </div>
                </div>

                <div class="col-md-12">
                    <h2>Your Family Doctor</h2>
                </div>
            </div>
        </section>
        <!-- Top Header End -->

        <!-- Header Start -->
        <?php require_once "includes/navbar.php"; ?>
        <!-- Header End -->

		<main id="main">

		<?php
//session_start(); // Start the session
require_once "model/function.php"; // Include your database functions
$db = new mainClass(); // Create an instance of your database class

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate user credentials
    $stmt = $db->prepare("SELECT user_id, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        
        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Password is correct, set session variables
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['email'] = $email; // Store email in session if needed
			
            // Redirect to the User folder
            //header("Location: User/index.php");
            echo '<script>
            swal("Success", "Your appointment has been booked successfully.", "success")
            .then((value) => {
                window.location.href = "User/index.php";
            });
          </script>';
            exit();
        } else {
            //echo "Invalid password.";
            echo '<script>swal("Warning","Invalid password.","warning")</script>';
        }
    } else {
        echo '<script>swal("Warning","No user found with that email.","warning")</script>';
        //echo "No user found with that email.";
    }
} 

?>

			<!-- Login Section Start -->
			<section id="login">
				<div class="container">
					<div class="section-header">
						<h3>Login</h3>
					</div>
					<div class="row">
						<div class="col-md-3 form">
							
						</div>
						
						<div class="col-md-6 form">
							<form method="post">
								<div class="form-group">
									<input type="email" name="email" class="form-control" placeholder="Your Email" required />
								</div>
								<div class="form-group">
									<input type="password" name="password" class="form-control" placeholder="Your Password" required />
								</div>
								<div class="form-group">
									<div class="custom-control custom-checkbox">
										<input type="checkbox" class="custom-control-input" id="remember2">
											<label class="custom-control-label" for="remember2">Remember me</label>
									</div>
								</div>
								<div><button type="submit">Sign In</button></div>
							</form>
						</div>

						<div class="col-md-3 form">
							
						</div>
					</div>
				</div>
			</section>
			<!-- Login Section end -->

			<!-- Subscriber Section Start -->
            <section id="subscriber">
                <div class="container">
                    <h3>Get Free Consultation</h3>
                    <form class="form-inline">
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="Your Email Goes Here">
                        </div>
                        <button type="submit" class="btn">Submit</button>
                    </form>
                </div>
            </section>
            <!-- Subscriber Section end -->
            
            <!-- Support Section Start -->
            <section id="support" class="wow fadeInUp">
                <div class="container">
                    <h1>
                        Need help? Call me 24/7 at +1-234-567-8900
                    </h1>
                </div>
            </section>
            <!-- Support Section end -->

        </main>
