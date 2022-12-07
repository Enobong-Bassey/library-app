<?php
    include './includes/db.php';
    
    if(isset($_POST['updateEmail'])){
        $uniqueEmail = $_POST['updateEmail'];

        $retIDQuery = "SELECT * FROM memberprofile WHERE email = '$uniqueEmail'";
        $result5 = $conn->query($retIDQuery);

        $street = $_POST['updateStreet'];
        $city = $_POST['updateCity'];
        $province = $_POST['updateProvince'];
        $zip = $_POST['updateZip'];
        $country = $_POST['updateCountry'];
        $phone = $_POST['updatePhone'];

        $updateQuery = "UPDATE memberprofile SET street = '$street', city = '$city', province = '$province',
        zip = '$zip', country = '$country', phone = '$phone' WHERE email = $uniqueEmail";
        $result = $conn->query($updateQuery);
        
    }
?>