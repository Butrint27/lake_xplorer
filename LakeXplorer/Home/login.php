<?php
     session_start();
     error_reporting(0);
   if($_SERVER["REQUEST_METHOD"] == "POST")
   {
      function validData($x)
      {
         $x = trim($x);
         $x = stripslashes($x);
         $x = htmlspecialchars($x);
         return $x;
      }
      $conn = new mysqli("localhost", "root", "blina2011", "lake_xplorer");
      if(!$conn->connect_errno)
      {
         $email = validData($_POST["email"]);
         $password = validData($_POST["password"]);
         
         if(!empty($email) and !empty($password))
         {
            $sql = "SELECT * FROM user WHERE email=? and password=?";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $email, $password);
            if($stmt->execute())
            {
               $result = $stmt->get_result();
               if($result->num_rows)
               {
                  header('Location: ../Login_Home/login_home.php?email=' .$email);
                  exit();
               }
               else
                 die("Wrong email or password");
            }
         }
      }
      $conn->close();
   }
	?>

   


<!--  header('Location: ../Login_Home/login_home.php?email=' .$email); -->