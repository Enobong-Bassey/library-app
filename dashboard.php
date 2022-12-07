<?php 

    session_start();

    if(!$_SESSION["email"]) {
        $_SESSION["accessError"] = "Please sign up or sign in first!";
        header("Location: ./signup.php");
    }

    require './includes/upHead.php'; 
    
?>

<title>Readers Library - Dashboard</title>
<meta name="description" content="">

<?php 
    require './includes/downHead.php'; 
    require './includes/header.php';
?>

        <li class="nav-item">
          <a class="nav-link" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="dashboard.php">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="start-a-borrow.php">Start a Borrow</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Manage Staff</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="newStaff.php">New Staff</a></li>
            <li><a class="dropdown-item" href="assignStaff.php">Assign Staff</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Member Activity</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="borrowBook.php">Borrow a Book</a></li>
            <li><a class="dropdown-item" href="returnBook.php">Return a Book</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Manage Books</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="newBook.php">New Book</a></li>
            <li><a class="dropdown-item" href="editBook.php">Edit a Book</a></li>
            <li><a class="dropdown-item" href="deleteBook.php">Delete a Book</a></li>
          </ul>
        </li>
      </ul>
    </div>
    <a href="./logout.php" class="btn btn-danger" style="text-align: center;">Logout</a>
  </div>
</nav>
<h1 style="font-family: 'Roboto', sans-serif; font-size: 2em; font-weight: 700; text-align: left; padding-left: 60px; margin-top: -150px; color: cyan; z-index: auto;">Readers Library, Fredericton</h1>
</header>
<main>
    <div class="container">
        <div class="row dashboard" id="upperSection">
            <div class="row">
                <div class="col-md-6 col-sm-8 text-left">
                    <h2 id="bookSearchHeader">Dashboard</h2>
                </div>
                <div class="col-md-6 col-sm-8 text-right" style="text-align: right;">
                    <?php
                        $email = $_SESSION['email'];
                    ?>
                    <button id="createProfileBtn" class="btn btn-success btn-sm">Create Profile</button>
                    <button id="updateProfileBtn" class="btn btn-warning btn-sm" onclick="getProfileDetails(<?php echo '$email'; ?>)">Update Profile</button>
                </div>
            </div>
            <hr id="pageHeaderLine">
            <p id='profileLbl'>User logged in: 
                <?php include './includes/db.php';

                    $email = $_SESSION['email'];

                    $query = "SELECT * FROM users WHERE email = '$email'";
                    $result = $conn->query($query);

                    while($data = mysqli_fetch_array($result)){
                        $fname = ucfirst($data['first_name']);
                        $lname = ucfirst($data['last_name']);

                        echo '<b>'.$lname.', '.$fname.'</b>';
                    }
                ?>
            </p>
            <div class="col-md-8 col-sm-8" id="upperLeftDash">
                <div class="row col-md-12" id="memberID">
                    <div class="col-md-4 col-sm-8 text-center">
                        <?php
                            include './includes/db.php';

                            $photoQuery = "SELECT photo FROM users WHERE email = '{$_SESSION["email"]}'";
                            $resultimg = $conn->query($photoQuery);
                            if($resultimg->num_rows > 0) {
                                $rowimg = mysqli_fetch_assoc($resultimg);
                                echo "<img src='" . $rowimg["photo"] . "'width='100px' id='memberPhotoCard'>";
                            } else {
                                echo "<img src='./assets/images/userimg/user.png' width='100px' id='memberPhotoCard'>";
                            }
                        ?>                        
                        <form action="uploadPhoto.php" method="POST" enctype="multipart/form-data">
                            <div class="row text-center">
                                <input type="file" name="userPhoto"><br>
                                <input type="submit" value="Upload Photo" class="btn btn-primary btn-sm btn-block mt-2"></p>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div id="userProfileDetails" class="" style="border-radius: 10px; font-family: 'Roboto', sans-serif; font-size: small; height: 22.5em; margin-left: 2em; background-color: aliceblue; font-family: 'Roboto', sans-serif; border: 0.5px solid #777;">
                            <div class="text-center py-1" style="top: 0; border-top-left-radius: 10px; border-top-right-radius: 10px; height: 5vh; background-color: darkblue; color: aliceblue; font-weight: 700; font-family: 'Questrial', sans-serif;">
                                <span style="font-size: 24px;"><i class="fa-regular fa-address-card"></i>&nbsp;Profile Card</span>
                            </div>
                            <div class="py-4 px-4 text-left">
                                <?php
                                    include './includes/db.php';

                                    $getDetailsQuery = "SELECT * FROM memberprofile WHERE email = '{$_SESSION["email"]}'";
                                    $resultDetails = $conn->query($getDetailsQuery);

                                    if(mysqli_num_rows($resultDetails) > 0){
                                        $rowdet = mysqli_fetch_assoc($resultDetails);

                                        echo '<div style="color: darkblue;"><i class="fa-solid fa-house"></i><br><p><b>'
                                        .strtoupper($rowdet['street']).'<br>'.strtoupper($rowdet['city']).', '.strtoupper($rowdet['province']).', '.strtoupper($rowdet['zip']).'<br>'.strtoupper($rowdet['country']).'</b></p></div>';
                                        echo '<div style="color: darkblue;"><i class="fa-solid fa-phone"></i><br><p><b>'.$rowdet['phone'].'</b></p></div>';
                                        echo '<div style="color: darkblue;"><i class="fa-solid fa-envelope"></i><br><p><b>'.$rowdet['email'].'</b></p></div>';
                                    } else {
                                        echo "No profile details found for user.";
                                    }
                                ?>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-8" id="upperRightDash">
                <div class="row" id="profileUpdate">
                <form action="" method="POST">
                    <h5 id="bookSearchHeader">Update Profile</h5>
                    <div class="col-md-12 col-sm-8 my-1">
                        <label for="street" class="form-label text-left" id="profileLbl">Street Address</label>
                        <input type="text" class="form-control input-sm" id="updatestreet" name="street">
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm-8 mb-1">
                            <label for="city" class="form-label"  id="profileLbl">City</label>
                            <input type="text" class="form-control input-sm" id="updatecity" name="city">
                        </div>
                        <div class="col-md-4 col-sm-8 mb-1">
                            <label for="province" class="form-label" id="profileLbl">Province / State</label>
                            <input type="text" class="form-control input-sm" id="updateprovince" name="province">
                        </div>
                        <div class="col-md-4 col-sm-8 mb-1">
                            <label for="zip" class="form-label" id="profileLbl">Zip Code</label>
                            <input type="text" class="form-control input-sm" id="updatezip" name="zip">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm-8 mb-1">
                            <label for="country" class="form-label" id="profileLbl">Country</label>
                            <input type="text" class="form-control input-sm" id="updatecountry" name="country">
                        </div>
                        <div class="col-md-4 col-sm-8 mb-1">
                            <label for="phone" class="form-label" id="profileLbl">Phone number</label>
                            <input type="text" class="form-control input-sm" id="updatephone" name="phone">
                        </div>
                        <div class="col-md-4 col-sm-8 mb-1">
                            &nbsp;
                        </div>
                    </div>
                    <div class="row">
                        <input type="hidden" name="secret" value="updateProfile">
                        <input type="reset" value="Clear" class="btn btn-secondary btn-block btn-sm mb-2" id="resetProfile">
                        <input type="button" value="Update" name="" class="btn btn-primary btn-block btn-sm" onclick="sendProfileUpdate('.$userEmail.')">
                    </div>
                </form>
                </div>
                <div class="row" id="profileCreate">
                <form action="createProfileProcess.php" method="POST">
                    <h5 id="bookSearchHeader">Create Profile</h5>
                    <div class="col-md-12 col-sm-8 mb-1 mt-2">
                        <label for="street" class="form-label text-left" id="profileLbl">Street Address</label>
                        <input type="text" class="form-control control-sm" id="street" name="street">
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm-8 mb-1">
                            <label for="city" class="form-label"  id="profileLbl">City</label>
                            <input type="text" class="form-control" id="city" name="city">
                        </div>
                        <div class="col-md-4 col-sm-8 mb-1">
                            <label for="province" class="form-label" id="profileLbl">Province / State</label>
                            <input type="text" class="form-control" id="province" name="province">
                        </div>
                        <div class="col-md-4 col-sm-8 mb-1">
                            <label for="zip" class="form-label" id="profileLbl">Zip Code</label>
                            <input type="text" class="form-control" id="zip" name="zip">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm-8 mb-1">
                            <label for="country" class="form-label" id="profileLbl">Country</label>
                            <input type="text" class="form-control" id="country" name="country">
                        </div>
                        <div class="col-md-4 col-sm-8 mb-1">
                            <label for="phone" class="form-label" id="profileLbl">Phone number</label>
                            <input type="text" class="form-control" id="phone" name="phone">
                        </div>
                        <div class="col-md-4 col-sm-8 mb-1">
                            &nbsp;
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <input type="hidden" name="secret" value="createProfile">
                        <input type="reset" value="Clear" class="btn btn-secondary btn-block btn-sm mb-2"  id="resetProfile">
                        <input type="submit" value="Create" class="btn btn-primary btn-block btn-sm" >
                    </div>
                </form>
                </div>
            </div>
        </div>
        <div class="row dashboard" id="lowerSection">
            <h4>Borrowing Statistics</h4><hr>
            <div class="col-md-3 col-sm-8 " id="lowerLeftDash">
                <div class="col text-center" id="statBoxLeft" style="background-color: darkblue; color: white; border-radius: 15px; min-height: 50px; padding: 20px;">
                    <h6>Borrowed to date</h6><hr style="color: white;">
                    <?php
                        include './includes/db.php';

                        $userEmail = $_SESSION['email'];

                        $alltimeborrowquery = "SELECT * FROM borrowedbooks WHERE borrowingemail = '$userEmail'";
                        $result = $conn->query($alltimeborrowquery);
                        $num = mysqli_num_rows($result);
                        echo '<h2>'.$num.'</h2>';
                    ?>
                </div>
            </div>
            <div class="col-md-3 col-sm-8 " id="lowerMidLeftDash">
                <div class="col text-center" id="statBoxMidLeft" style="background-color: darkgreen; color: white; border-radius: 15px; min-height: 50px; padding: 20px;">
                    <h6>Currently reserved</h6><hr style="color: white;">
                    <?php
                        include './includes/db.php';

                        $userEmail = $_SESSION['email'];

                        $currentreservequery = "SELECT * FROM memberreservedbooks WHERE requesting_email = '$userEmail'";
                        $result4 = $conn->query($currentreservequery);
                        $num4 = mysqli_num_rows($result4);
                        echo '<h2>'.$num4.'</h2>';
                    ?>
                </div>
            </div>
            <div class="col-md-3 col-sm-8 " id="lowerMidRightDash">
                <div class="col text-center" id="statBoxMidRight" style="background-color: darkgoldenrod; color: white; border-radius: 15px; min-height: 50px; padding: 20px;">
                    <h6>Currently borrowed</h6><hr style="color: white;">
                    <?php
                        include './includes/db.php';

                        $userEmail = $_SESSION['email'];

                        $currentborrowquery = "SELECT * FROM borrowedbooks WHERE borrowingemail = '$userEmail' AND date_returned is null";
                        $result2 = $conn->query($currentborrowquery);
                        $num2 = mysqli_num_rows($result2);
                        echo '<h2>'.$num2.'</h2>';
                    ?>
                </div>
            </div>
            <div class="col-md-3 col-sm-8 " id="lowerRightDash">
                <div class="col text-center" id="statBoxRight" style="background-color: red; color: white; border-radius: 15px; min-height: 50px; padding: 20px;">
                    <h6>Return date elapsed</h6><hr style="color: white;">
                    <?php
                        include './includes/db.php';

                        $userEmail = $_SESSION['email'];

                        $datepastborrowquery = "SELECT COUNT(bbid) FROM borrowedbooks WHERE borrowingemail = '$userEmail' AND (CURDATE() - due_return_date) > 0 AND date_returned is null";
                        $result3 = $conn->query($datepastborrowquery);
                        $num3 = mysqli_num_rows($result3);
                        echo '<h2>'.$num3.'</h2>';
                    ?>
                </div>
            </div>
        </div>
    </div>
</main>

<footer>
    
</footer>

<!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"></script>

    <script>

        $('#createProfileBtn').click(function() {
            $('#profileUpdate').hide();
            $('#profileCreate').show();
        });

        $('#updateProfileBtn').click(function() {
            $('#profileCreate').hide();
            $('#profileUpdate').show();
            getProfileDetails();
        });

    // Update profile
        function getProfileDetails(updateEmail){

            $.post("updateProfile.php",{updateemail:updateEmail},function(data,status){
                var user_id = JSON.parse(data);

                $('#updatestreet').val(user_id.street);
                $('#updatecity').val(user_id.city);
                $('#updateprovince').val(user_id.province);
                $('#updatezip').val(user_id.zip);
                $('#updatecountry').val(user_id.country);
                $('#updatephone').val(user_id.phone);
            });
        }

        function sendProfileUpdate(userEmail){

            var street = $('#street').val();
            var city = $('#city').val();
            var province = $('#province').val();
            var zip = $('#zip').val();
            var country = $('#country').val();
            var phone = $('#phone').val();

            $.post("processUpdateProfile.php",{
                updateStreet:street,
                updateCity:city,
                updateProvince:province,
                updateZip:zip,
                updateCountry:country,
                updatePhone:phone,
                updateEmail:userEmail
            },function(data,status){
                
            });
        }
    </script>
</body>
</html>