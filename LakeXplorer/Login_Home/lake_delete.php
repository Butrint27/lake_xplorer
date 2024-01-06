
<?php
include("../Connection/connect.php");

if(isset($_POST['delete_lake']))
{	
    $lake_id = mysqli_real_escape_string($conn, $_POST['delete_lake']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    $query = "DELETE FROM lake WHERE id='$lake_id' ";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Lake Deleted Successfully";
        header('Location: ../Login_Home/login_home.php?email=' .$email);
        exit();
    }
    else
    {
        $_SESSION['message'] = "Lake Not Deleted";
        header('Location: ../Login_Home/login_home.php?email=' .$email);
        exit();
    }
}

?>