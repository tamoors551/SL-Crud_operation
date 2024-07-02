<?php
include("crud_app.php");

if(isset($_POST['add_students'])){
// echo"Yes it is pressed";

$fname = $_POST['f_name'];
$lname = $_POST['l_name'];
$age = $_POST['age'];

// here we are uploading the img  file   
  $file_name = $_FILES['image']['name'];
  $file_type = $_FILES['image']['type'];
  $file_size = $_FILES['image']['size'];
  $file_tmp = $_FILES['image']['tmp_name'];
// $file_tmp (is a temporarey file name )
  move_uploaded_file($file_tmp, "uploads/" . $file_name);


    if($fname == "" || empty($fname)){
    // here we use the URL to pass the data via GET method 
        header('location: index.php?message=You need to fill in the first name!' );

    }
    else
    {
        $query = "insert into `students` (`first_name` , `last_name` , `age`, `image`  ) values ('$fname' , '$lname' , '$age', '$file_name'  )  ";
        $result = mysqli_query($conn, $query);

        // if the Query is Succesful then data is inserted into data base otherwise Query Failed Message is appear 

        if(!$result)
        {
            die("Query Faild ".mysqli_error($conn));
        }
        else
        {
            header('location:index.php?message=You data has been added Successfully ');

        }
    }
}


?>