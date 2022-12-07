<?php
    include './includes/db.php';

    if(isset($_POST['displaySend'])){
        $table = '<table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th scope="col">Action Buttons</th>
            </tr>
        <thead>';
        $staffTableQuery = "SELECT * FROM users";
        $result = $conn->query($staffTableQuery);
        $number = 1;
        while($row = mysqli_fetch_assoc($result)){

            $id = $row['uid'];
            $fname = ucfirst($row['first_name']);
            $lname = ucfirst($row['last_name']);
            $email = $row['email'];
            $role = ucfirst($row['role']);

            $table.='<tr>
            <td scope="row">'.$number.'</td>
            <td>'.$fname.'</td>
            <td>'.$lname.'</td>
            <td>'.$email.'</td>
            <td>'.$role.'</td>
            <td>
                <button class="btn btn-warning btn-sm" onclick="getStaffDetails('.$id.')">Update</button>&nbsp;&nbsp;
                <button class="btn btn-danger btn-sm" onclick="delStaff('.$id.')">Delete</button>
            </td>
            </tr>';
            $number++;
        }

        $table.='</table>';
        echo $table;
    }

?>
