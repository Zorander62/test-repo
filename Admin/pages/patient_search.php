

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <p class="mb-0">Manage Patients</p>
                    </div>
                </div>

                <div class="card-body p-4">
                    <!-- Search Form -->
                    <!-- <form  method="post" class="mb-4">
                        <div class=" row">
                            <div class="col-md-3">
                                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name">
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control"  id="last_name" name="last_name" placeholder="Last Name" >
                            </div>
                            <div class="col-md-3">
                                <input type="date" class="form-control"  id="dob" name="dob" >
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary w-100" value="Search" id="ValNO" onclick="mesansOFidentifacartion_change();">Search</button>
                            </div>
                        </div>
                    </form> -->


                    <form method="post" class="mb-4" onsubmit="mesansOFidentifacartion_change(event)">
                        <div class="row">
                            <div class="col-md-3">
                                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name">
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" placeholder="Optional">
                            </div>
                            <div class="col-md-3">
                                <input type="date" class="form-control" id="dob" name="dob">
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary w-100" value="Search" id="ValNO">Search</button>
                            </div>
                        </div>
                    </form>


                
                     <div class="row">
                                <div class="table-responsive py-4">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th>SN</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>D.O.B</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="tblBody">  
                                 
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>







<script>
function mesansOFidentifacartion_change(event) {
    // Prevent the form from submitting and causing a page reload
    event.preventDefault();
    
    // Create XMLHttpRequest object for AJAX request
    var xmlhttp = new XMLHttpRequest();
    
    // Get values from the input fields
    var first_name = document.getElementById("first_name").value;
    var last_name = document.getElementById("last_name").value;
    var dob = document.getElementById("dob").value;

    // Create the search string to pass as 'getdata'
    var searchQuery = first_name + "_" + last_name + "_" + dob;
    var url = "ajaxSearch.php?getdata=" + searchQuery;

    // Define the AJAX request behavior
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // Update the table body with the response (HTML)
            document.getElementById("tblBody").innerHTML = this.responseText;
        }
    };

    // Open the GET request and send it to the server
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
}
</script>