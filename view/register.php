
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

			<!-- Login Section Start -->
			<section id="login">
				<div class="container">
					<div class="section-header">
						<h3>Singup</h3>
					</div>
					<div class="row">
						<div class="col-md-12 form">

                        <?php
                            require_once "model/function.php"; 
                            $db = new mainClass(); // Create an instance of your database class

                            if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                                // Retrieve form data
                                $first_name = $_POST['first_name'];
                                $last_name = $_POST['last_name'];
                                $mobile = $_POST['mobile'];
                                $email = $_POST['email'];
                                $password = $_POST['password'];
                                $confirm_password = $_POST['confirm_password'];
                                $birth_date = $_POST['birth_date'];
                                $gender = $_POST['gender'];
                               
                                    // Validate password
                                    if ($password !== $confirm_password) {

                                        echo '<script>swal("Warning","Passwords do not match.","warning")</script>';
                                        
                                    }

                                    // Insert user into the database
                                    $user_id = $db->insertUser($email, $password, $email); // Corrected: no need to pass $db
                                    if ($user_id) {

                                        $run = $db->RegsPatient($user_id, $first_name, $last_name, $birth_date, $mobile, $email, $gender);

                                        if ($run) {
                                            
                                            echo '<script>
                                                swal("Success", "Signup successfully.", "success")
                                                .then((value) => {
                                                    window.location.href = "?a=login";
                                                });
                                            </script>';
                                        
                                        } else {
                                           
                                            echo '<script>swal("Warning","Error creating user.","warning")</script>';
                                            
                                    }

                                    } else {
                                    
                                            echo '<script>swal("Warning","Error creating user.","warning")</script>';
                                        
                                    }
                            } 
                            ?>

							

                            <form method="post">
                                
                                <div class="form-row">
                                <div class="form-group col-md-6">
										<input type="text" name="first_name" required class="form-control" placeholder="First Name" />
									</div>
									<div class="form-group col-md-6">
										<input type="text"  name="last_name" required class="form-control" placeholder="Last Name" />
									</div>
                                    <div class="form-group col-md-6">
										<input type="text" name="mobile" required class="form-control" placeholder="Mobile" />
									</div>
									<div class="form-group col-md-6">
										<input type="email"  name="email" required class="form-control" placeholder="Email" />
									</div>
									<div class="form-group col-md-6">
										<input type="date" name="birth_date" required class="form-control" placeholder="D.O.B" />
									</div>
									<div class="form-group col-md-6">
										<input type="text" name="gender" required class="form-control" placeholder="Gender" />
									</div>

                                    <div class="form-group col-md-6">
										<input type="Password" type="password" name="password" required class="form-control" placeholder="Password" />
									</div>

                                    <div class="form-group col-md-6">
										<input type="Password" type="password" name="confirm_password" required class="form-control" placeholder="Repeat Your Password" />
									</div>
								</div>
                              
                                <button type="submit" class="float-right">Create Account</button>
                            </form>
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
