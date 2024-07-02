<?php
// Include the necessary files
include("crud_app.php"); // Include file for database connection
include("header.php"); // Include file for header

// Check if an ID is provided in the URL
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    // Retrieve the student record with the provided ID from the database
    $query = "SELECT * FROM `students` WHERE `id` = '$id' ";
    // where is used to Check if the id is present in the database

    $result = mysqli_query($conn, $query);

    // Check if the query was successful
    if (!$result) {
        // If the query failed, display an error message and stop the script execution
        die("Query Failed " . mysqli_error($conn));
    } else {
        // If the query was successful, fetch the record as an associative array
        $row = mysqli_fetch_assoc($result);
    }
}

// Check if the form is submitted to update the student record
if (isset($_POST['update_students'])) {
    // Retrieve the form data
    $id = $_POST['id'];
    $fname = $_POST['f_name'];
    $lname = $_POST['l_name'];
    $age = $_POST['age'];
    $oldimage = $_POST['hiddenImage'];
    $file_name2 = $_FILES['image']['name'];

    if ($file_name2 == "") {
        // Update the student record in the database
        $query = "UPDATE `students` SET `first_name` = '$fname', `last_name` = '$lname', `age` = '$age' WHERE `id` = '$id' ";
        $result = mysqli_query($conn, $query);

        // Check if the update query was successful
        if (!$result) {
            // If the update query failed, display an error message and stop the script execution
            die("Query Failed " . mysqli_error($conn));
        } else {
            // If the update query was successful, redirect to the index page with a success message
            header('location:index.php?update_msg=You have successfully updated the data');
        }
    } else {
        // here we are uploading the img  file   
        $file_name = $_FILES['image']['name'];
        $file_type = $_FILES['image']['type'];
        $file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];
        // $file_tmp (is a temporarey file name )
        move_uploaded_file($file_tmp, "uploads/" . $file_name);

        // Update the student record in the database
        $query = "UPDATE `students` SET `first_name` = '$fname', `last_name` = '$lname', `age` = '$age', `image`= '$file_name' 
    WHERE `id` = '$id' ";
        $result = mysqli_query($conn, $query);

        // Check if the update query was successful
        if (!$result) {
            // If the update query failed, display an error message and stop the script execution
            die("Query Failed " . mysqli_error($conn));
            
        } else {
            // If the update query was successful, redirect to the index page with a success message
            unlink("uploads/" . $oldimage);
            header('location:index.php?update_msg=You have successfully updated the data');
        }
    }
}

?>

<!-- Display the update form -->
<form action="update_page_1.php" method="POST"  enctype="multipart/form-data" >
    <!-- Hidden input field to pass the student ID -->
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
    <input type="hidden" name="hiddenImage" value="<?php echo $row['image']; ?>">
    <div class="form-group">
        <label for="f_name">First Name</label>
        <!-- Input field for the first name with the current value pre-filled -->
        <input type="text" name="f_name" class="form-control" value="<?php echo $row['first_name']; ?>">
    </div>
    <div class="form-group">
        <label for="l_name">Last Name</label>
        <!-- Input field for the last name with the current value pre-filled -->
        <input type="text" name="l_name" class="form-control" value="<?php echo $row['last_name']; ?>">
    </div>
    <div class="form-group">
        <label for="age">Age</label>
        <!-- Input field for the age with the current value pre-filled -->
        <input type="text" name="age" class="form-control" value="<?php echo $row['age']; ?>">
    </div>
    <input type="file" name="image" /> <br><br>
    <!-- Submit button to update the student record -->
    <button type="submit" class="btn btn-success" name="update_students">Update</button>
</form>

<?php include("footer.php"); ?>