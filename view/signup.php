
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
                                $appointment_date = $_POST['appointment_date'];
                                $special_request = $_POST['special_request'];

                                // Validate password
                                if ($password !== $confirm_password) {

                                        echo '<script>swal("Warning","Passwords do not match.","warning")</script>';
                                    //echo "Passwords do not match.";
                                    //exit();
                                }

                                // Insert user into the database
                                $user_id = $db->insertUser($email, $password, $email); // Corrected: no need to pass $db
                                if ($user_id) {
                                    // Insert patient details
                                    $db->insertPatient($user_id, $first_name, $last_name, $birth_date, $mobile, $email);

                                    // Retrieve the patient record to get patient_id
                                    $patient = $db->getPatientByUserId($user_id);
                                    if ($patient) {
                                        // Insert the appointment
                                        $db->insertAppointment($patient['patient_id'], $appointment_date);
                                    } else {
                                        //echo "Error retrieving patient information.";
                                        echo '<script>swal("Warning","Error retrieving patient information.","warning")</script>';
                                        //exit();
                                    }

                                    // Redirect to a success page
                                    // header("Location: ?a=success");
                                    echo '<script>
                                    swal("Success", "Your appointment has been booked successfully.", "success")
                                    .then((value) => {
                                        window.location.href = "?a=login";
                                    });
                                  </script>';
                                   // exit();
                                } else {
                                    //echo "Error creating user.";
                                         echo '<script>swal("Warning","Error creating user.","warning")</script>';
                                    //();
                                }
                            } else {
                                // Retrieve data from URL parameters
                                $first_name = $_GET['first_name'] ?? '';
                                $last_name = $_GET['last_name'] ?? '';
                                $email = $_GET['email'] ?? '';
                                $mobile = $_GET['mobile'] ?? '';
                                $birth_date = $_GET['birth_date'] ?? '';
                                $appointment_date = $_GET['appointment_date'] ?? '';
                                $special_request = $_GET['special_request'] ?? '';
                            }
                            ?>

							

                            <form method="post" action="?a=signup">
                                <input type="hidden" name="first_name" value="<?php echo htmlspecialchars($first_name); ?>">
                                <input type="hidden" name="last_name" value="<?php echo htmlspecialchars($last_name); ?>">
                                <input type="hidden" name="mobile" value="<?php echo htmlspecialchars($mobile); ?>">
                                <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
                                <input type="hidden" name="birth_date" value="<?php echo htmlspecialchars($birth_date); ?>">
                                <input type="hidden" name="appointment_date" value="<?php echo htmlspecialchars($appointment_date); ?>">
                                <input type="hidden" name="special_request" value="<?php echo htmlspecialchars($special_request); ?>">
                                <div class="form-row">
									<div class="form-group col-md-6">
										<input type="password" name="password" required class="form-control" placeholder="Your Password" />
									</div>
									<div class="form-group col-md-6">
										<input type="Password" type="password" name="confirm_password" required class="form-control" placeholder="Repeat Your Password" />
									</div>
								</div>
                                <!-- <div>
                                    <label>Password</label>
                                    <input type="password" name="password" required>
                                </div>
                                <div>
                                    <label>Confirm Password</label>
                                    <input type="password" name="confirm_password" required>
                                </div> -->
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
