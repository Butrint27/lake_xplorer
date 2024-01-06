

<?php
         include("../Connection/connect.php");
         $image = addslashes (file_get_contents($_FILES['image']['tmp_name']));
         $title = $_POST["title"];
         $description = $_POST["description"];
         $longitude = $_POST["longitude"];
         $latitudes = $_POST["latitudes"];
         $user_reference = $_POST['user_reference'];
         $lake_reference = $_POST['lake_reference'];
         $email = $_POST['email'];
      

         $sql = "call lake_procedure('$image', '$title', '$description', '$longitude', '$latitudes', '$user_reference', '$lake_reference', '$email')";

         
         if($conn->query($sql)){
            header('Location: ../Login_Home/login_home.php?email=' .$email);
            exit();
      }
   
   $conn->close();
   
?>

