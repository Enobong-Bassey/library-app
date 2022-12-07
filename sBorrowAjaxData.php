<?php
session_start();
// Include the database config file 
include './includes/db.php'; 

if(isset($_POST["bookClass"]) && $_POST["bookClass"] != "") {
    // Capture selected bookClass
    $bookclass = $_POST["bookClass"];
    echo $bookclass;

    $query = "SELECT * FROM books WHERE book_class = $bookclass ORDER BY title ASC"; 
    $result = $conn->query($query); 
  
    // Generate HTML of book options list 
    if($result->num_rows > 0){  
        while($row = $result->fetch_assoc()){  
            echo '<option value=' . $row["title"] . '>' . $row["title"] . '</option>'; 
        } 
    }else{ 
        echo '<option value="">Books not available</option>'; 
    }
     
    // Define country and city array
    // $countryArr = array(
    //                 "usa" => array("New Yourk", "Los Angeles", "California"),
    //                 "india" => array("Mumbai", "New Delhi", "Bangalore"),
    //                 "uk" => array("London", "Manchester", "Liverpool")
    //             );
     
    // // Display city dropdown based on country name
    // if($country !== 'Select'){
    //     echo "<label>City:</label>";
    //     echo "<select>";
    //     foreach($countryArr[$country] as $value){
    //         echo "<option>". $value . "</option>";
    //     }
    //     echo "</select>";
    // } 
}
?>
 
