
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
                                <form>
                                    <div class="form-row">
                                        <div class="control-group col-sm-6">
                                            <label>First Name</label>
                                            <input type="text" class="form-control" placeholder="E.g. John Sina" required="required" />
                                        </div>
                                        <div class="control-group col-sm-6">
                                            <label>Email</label>
                                            <input type="email" class="form-control" placeholder="E.g. email@example.com" required="required" />
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="control-group col-sm-6">
                                            <label>Mobile</label>
                                            <input type="text" class="form-control" placeholder="E.g. +1 234 567 8900" required="required" />
                                        </div>
                                        <div class="control-group col-sm-6">
                                            <label>Select a Service</label>
                                            <select class="custom-select">
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
                                            <input type="text" class="form-control datetimepicker-input" id="date" data-toggle="datetimepicker" data-target="#date" placeholder="E.g. MM/DD/YYYY" required="required" />
                                        </div>
                                        <div class="control-group col-sm-6">
                                            <label>Appointment Time</label>
                                            <input type="text" class="form-control datetimepicker-input" id="time" data-toggle="datetimepicker" data-target="#time" placeholder="E.g. HH:MM AM" required="required" />
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label>Special Request</label>
                                        <input type="text" class="form-control" placeholder="E.g. Special Request" required="required" />
                                    </div>
                                    <div class="button"><button type="submit">Book Now</button></div>
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

       