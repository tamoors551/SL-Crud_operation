<?php
// Include the necessary files
include("crud_app.php");
include("header.php");

// Start the session
session_start();

// Check if the user is logged in, if not, redirect to login page
if (!isset($_SESSION["username"])) {
  header("Location: login.php");
  exit;
}

?>
<?php
// Include the header again (repeated, can be removed)
include("header.php");
?>

<?php
// Empty PHP block, can be removed
?>


<h1 class="main_title">Welcome to the Lahore</h1>

<!-- Create a box with a heading and a button to add students -->
<div class="box1">
  <h2>ALL STUDENTS</h2>
  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">ADD STUDENTS</button>
</div>

<!-- Table to display all students -->
<table class="table">
  <thead>
    <tr>
      <td>ID</td>
      <td>First Name</td>
      <td>Last Name</td>
      <td>Age</td>
      <td>Update</td>
      <td>Delete</td>
    </tr>
  </thead>
<!-- Table body was Started Here -->
  <tbody>
    <?php
    // Retrieve all students from the database
    $query = "SELECT * FROM `students`";
    $result = mysqli_query($conn, $query);

    // Check if the query was successful
    if (!$result) {
      die("Connection failed: " . mysqli_connect_error());
    } else {
      // Display each student as a row in the table
      while ($row = mysqli_fetch_assoc($result)) {
    ?>
        <tr>
          <td><?php echo $row['id']; ?></td>
          <td><?php echo $row['first_name']; ?></td>
          <td><?php echo $row['last_name']; ?></td>
          <td><?php echo $row['age']; ?></td>
          <td><img src="./uploads/<?php echo $row['image']; ?>" alt=" <?php echo $row['image']; ?>" style="width:100px;"></td>
          <td><a href="update_page_1.php?id=<?php echo $row['id']; ?>" class="btn btn-success">Update</a></td>
          <td><a href="delete_page.php?id=<?php echo $row['id']; ?>" class="btn btn-danger" name="deletebtn">Delete</a></td>
        </tr>
    <?php
      }
    }
    ?>
  </tbody>

</table>

<?php
// Display a message if provided via URL query parameter
if (isset($_GET['message'])) {
  echo "<h5>" . $_GET['message'] . "</h5>";
}
?>

<!-- Modal for adding new student -->
<form action="insert_data.php" method="POST" enctype="multipart/form-data" >
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">ADD STUDENTS</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="f_name">First Name</label>
            <input type="text" name="f_name" class="from-control">
          </div>
          <div class="form-group">
            <label for="l_name">Last Name</label>
            <input type="text" name="l_name" class="from-control">
          </div>
          <div class="form-group">
            <label for="age">Age</label>
            <input type="text" name="age" class="from-control">
          </div>
        </div>
        
          <!--  enctype is used for Enctype: The enctype attribute specifies the encoding type for a form element. This can be set to “multipart/form-data” or “application/x-www-form. multipart/form-data is necessary if your users are required to upload a file through the form -->
          <input type="file" name="image" /> <br><br>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CLOSE</button>
          <button type="submit" class="btn btn-success" name="add_students" value="ADD">ADD</button>
        </div>
      </div>
    </div>
  </div>
</form>

<?php
// Include the footer
include("footer.php");
?>









