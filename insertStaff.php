<?php
    include './includes/db.php';

    if(isset($_POST['submitStaffBtn'])){

      $fnameSend = $_POST['completeFName'];
      $lnameSend = $_POST['completeLName'];
      $emailSend = $_POST['completeEmail'];
      $passwordSend = $_POST['completePassword'];
      $roleSend = $_POST['completeRole'];

        $insertStaffQuery = "INSERT INTO users(uid, first_name, last_name, email, password, role, verify_status, joined_date)
        values (null,'$fnameSend','$lnameSend','$emailSend','$passwordSend','$roleSend','0',current_timestamp())";
        $result = mysqli_query($conn, $insertStaffQuery);

        if($result){
          header('Location: newStaff.php');
        }
     }
?>