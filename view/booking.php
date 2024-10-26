        <!-- Top Header Start -->
        <section class="banner-header">
            <div class="container text-center">
                <div class="row">
                    <div class="col-md-12">
                        <h1><a href="index.html">Dr. Johnson</a></h1>
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

            <!-- Booking Section Start -->
            <section id="booking">
                <div class="container">
                    <div class="section-header">
                        <h3>Book for Getting Services</h3>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="booking-form">
                               <!-- view/booking.php -->
                                    <form method="post" action="?a=process_booking">
                                        <div class="form-row">
                                            <div class="control-group col-sm-6">
                                                <label>First Name</label>
                                                <input type="text" name="first_name" class="form-control" placeholder="E.g. John Sina" required="required" />
                                            </div>
                                            <div class="control-group col-sm-6">
                                                <label>Last Name</label>
                                                <input type="text" name="last_name" class="form-control" placeholder="E.g. Doe" required="required" />
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="control-group col-sm-6">
                                                <label>Mobile</label>
                                                <input type="text" name="mobile" class="form-control" placeholder="E.g. +1 234 567 8900" required="required" />
                                            </div>
                                            <div class="control-group col-sm-6">
                                                <label>Email</label>
                                                <input type="email" name="email" class="form-control" placeholder="E.g. email@example.com" required="required" />
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="control-group col-sm-6">
                                                <label>Birth Date</label>
                                                <input type="date" name="birth_date" class="form-control" required="required" />
                                            </div>
                                            <div class="control-group col-sm-6">
                                                <label>Select a Service</label>
                                                <select name="service" class="custom-select" required>
                                                    <option value="">Consultation</option>
                                                    <option>Health Checkup</option>
                                                    <option>Flu Shots</option>
                                                    <option>Blood Test</option>
                                                    <option>Physical Exams</option>
                                                    <option>Prevention</option>
                                                    <option>Family Planning</option>
                                                    <option>Home Visits</option>
                                                    <option>Insurance</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="control-group col-sm-6">
                                                <label>Appointment Date</label>
                                                <input type="date" name="appointment_date" class="form-control" required="required" />
                                            </div>
                                            <div class="control-group col-sm-6">
                                                <label>Appointment Time</label>
                                                <input type="time" name="appointment_time" class="form-control" required="required" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label>Special Request</label>
                                            <textarea name="special_request" class="form-control" placeholder="E.g. Special Request"></textarea>
                                        </div>
                                        <div class="button float-right mt-3">
                                            <button type="submit">Book Now</button>
                                        </div>
                                    </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Booking Section End -->
            
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

       