 <?php 

// $st_id = $_GET['id'];

// include 'crud_app.php';

// $sql = "DELETE FROM students WHERE id = {$st_id}";
// $result = mysqli_query($conn, $sql) or die("Query Unsuccessful.");

// header("Location: index.php");

// mysqli_close($conn);

?>



<?php
include("crud_app.php"); // Include file for database connection

// Check if an ID is provided in the URL
if(isset($_GET["id"])){
    $id = $_GET["id"]; // Get the ID from the URL

    // Delete the student record with the provided ID from the database
    $query = "DELETE FROM `students` WHERE `id` = '$id' ";
    $result = mysqli_query($conn, $query); // Execute the delete query

    // Check if the delete query was successful
    if(!$result){
        // If the delete query failed, display an error message
        die("Query Failed ".mysqli_error($conn));
    } else {
        // If the delete query was successful, redirect to the index page with a success message
        header('location:index.php?delete_msg=You have successfully deleted the data');
    }
}
?>
