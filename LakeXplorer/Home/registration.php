
<?php
         include("../Connection/connect.php");
         $name = $_POST["name"];
         $surname = $_POST["surname"];
         $email = $_POST["email"];
         $password = $_POST["password"];
      

         $sql = "call user_procedure('$name', '$surname', '$email', '$password')";

         
         if($conn->query($sql)){
            header('Location: home.php');
            exit();
      }
   
   $conn->close();
   
?>