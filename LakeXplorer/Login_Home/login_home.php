<?php include("../Connection/connect.php"); ?>
<?php 
  
    $api_url = "https://api.quotable.io/random";
	$quote = json_decode(file_get_contents($api_url));

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link href="css/bootstrap5.0.1.min.css" rel="stylesheet" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="css/datatables-1.10.25.min.css" />

  <style>
      .container{
      	 margin-left:280px;
      	 margin-top:-750px;
      }

	  .viewbtn{
		  cursor: pointer
	  }

	  #example tr td:nth-child(1), #example th:nth-child(1){
		display: none;
	  }

	  #example tr td:nth-child(3), #example th:nth-child(3){
		display: none;
	  }

	  #example tr td:nth-child(4), #example th:nth-child(4){
		display: none;
	  }

	  #example tr td:nth-child(5), #example th:nth-child(5){
		display: none;
	  }

	  #example tr td:nth-child(6), #example th:nth-child(6){
		display: none;
	  }

	  #example tr td:nth-child(7), #example th:nth-child(7){
		display: none;
	  }

	  #example tr td:nth-child(8), #example th:nth-child(8){
		display: none;
	  }

	  #example tr td:nth-child(9), #example th:nth-child(9){
		display: none;
	  }

	  #like_btn{
        background: transparent;
		border: none;
		outline: none;
		font-size: 20px;
		color: grey;
	  }

	  #like_btn i:hover{
        cursor: pointer;
	  }
	  
  </style>


  <link rel="stylesheet" href="../Login_Home/css_login_home/style.css">
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
</head>

<body>
	<!-- Sidebar -->
	<div class="d-flex flex-column flex-shrink-0 p-3" id="sidebar">
 	<h1>LakeXplorer</h1>
 	<hr>

 	<ul class="nav nav-pills flex-column mb-auto">
 		<li>
 			<a href="#" data-bs-toggle="modal" data-bs-target="#postModal">Post Image</a>
 		</li>
 	</ul>

 	<div class="dropdown">
 		<a href="#" class="d-flex align-items-center text-decoration-none one dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
			<?php  
			   include ("../Connection/connect.php");
			   $email = $_GET['email'];

			   $sql = "SELECT name,surname FROM user WHERE email = '$email' ";
			   $res = mysqli_query($conn, $sql);	
			   
			   while($row = mysqli_fetch_assoc($res)){
				   $name = $row['name'];
				   $surname = $row['surname'];

				   echo $name ."  "  .$surname;
			   }
			?>
	    </a>
 		<ul class="dropdown-menu dropdown-menu-white text-small shadow" aria-labelledby="dropdownUser1">
 			<li>
			    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#myimagesModal">My images</a>
 				<a class="dropdown-item" onclick="window.location.href='../Home/home.php'; ">Log out</a>
 			</li>			
 		</ul>
 	</div>
 </div>
<!-- Sidebar -->	

<!-- Main -->
<div class="container">
	<div class="row">
        <table id="example" class="table">
			<thead>				
			</thead>
			<tbody>
			<?php
			    include ("../Connection/connect.php");

                $query = "SELECT * FROM lake";
                $query_run = mysqli_query($conn, $query);
            ?>
                    <table id="example" class="table">
                        <thead>
                        </thead>
                        <?php
                if($query_run)
                {
                    foreach($query_run as $row)
                    {
            ?>
                        <tbody>
                            <tr>
                                <td> <?php echo $row['id']; ?> </td>
                                <td> <?php echo '<img src="data:image;base64,'.base64_encode($row['image']).'" style="width: 1100px; height: 500px;"  class="viewbtn">'; ?> </td>
								<td> <?php echo $row['title']; ?></td>
								<td> <?php echo $row['description']; ?></td>
								<td> <?php echo $row['longitude']; ?></td>
								<td> <?php echo $row['latitudes']; ?></td>
								<td> <?php echo $row['user_reference']; ?></td>
								<td> <?php echo $row['lake_reference']; ?></td>
                                <td> <?php echo $row['soft_id']; ?> </td>
                            </tr>
                        </tbody>
                        <?php           
                    }
                }
                else 
                {
                    echo "No Record Found";
                }
            ?>
			</tbody>
       </table>     
   </div>
 </div>
<!-- Main -->

<script>

	$(document).ready(function (){
		$('.viewbtn').on('click', function(){
            $('#imagesModal').modal('show');

			$tr = $(this).closest('tr');

			var data = $tr.children("td").map(function(){
                 return $(this).text();
			}).get();

            console.log(data);

			$('#lake_id').val(data[0]);
			$('#lake_image').val(data[1]);
			$('#lake_title').val(data[2]);
			$('#lake_description').val(data[3]);
			$('#lake_longitude').val(data[4]);
			$('#lake_latitudes').val(data[5]);
			$('#lake_user_reference').val(data[6]);
			$('#lake_lake_reference').val(data[7]);
		});
	});

</script>

<!-- Post Modal -->
<div class="modal fade" id="postModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" style="color:#342D7E">Post Image</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
     <form action="post_image.php" method="POST" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label" style="color:#342D7E">Upload image:</label>
			<input class="form-control" type="file" name="image" value="" />
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label" style="color:#342D7E">Title:</label>
            <input type="text" class="form-control" id="title" name="title" style="color:#342D7E">
          </div>
		  <div class="mb-3">
            <label for="recipient-name" class="col-form-label" style="color:#342D7E">Description:</label>
            <input type="text" class="form-control" id="description" name="description" style="color:#342D7E">
          </div>
		  <div class="mb-3">
            <label for="recipient-name" class="col-form-label" style="color:#342D7E">Longitude:</label>
            <input type="number" class="form-control" id="longitude" name="longitude" style="color:#342D7E">
          </div>
		  <div class="mb-3">
            <label for="recipient-name" class="col-form-label" style="color:#342D7E">Latitudes:</label>
            <input type="number" class="form-control" id="latitudes" name="latitudes" style="color:#342D7E">
          </div>
		  <div class="mb-3">
            <label for="recipient-name" class="col-form-label" style="color:#342D7E">User reference:</label>
            <input type="text" class="form-control" id="user_reference" name="user_reference" style="color:#342D7E">
          </div>
		  <div class="mb-3">
            <label for="recipient-name" class="col-form-label" style="color:#342D7E">Lake reference:</label>
            <input type="text" class="form-control" id="lake_reference" name="lake_reference" style="color:#342D7E">
          </div>
		  <input type="hidden" name="email" value=
		    <?php 
			   include ("../Connection/connect.php");
			   $email = $_GET['email'];

			   $sql = "SELECT email FROM user WHERE email = '$email'";
			   $res = mysqli_query($conn, $sql);	
			   
			   while($row = mysqli_fetch_assoc($res)){
				   $email = $row['email'];
				   
				   echo $email;
			   }
            ?>							
		  />
      </div>
      <div class="modal-footer">
        <input type="submit"  name="save"  id="save" value="Save" class="btn btn-primary" style="background-color: #342D7E">
      </div>
    </form>
    </div>
  </div>
</div>
<!-- Post Modal -->

<!-- My Images Modal -->
<div class="modal fade" id="myimagesModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
	  <table id="example" class="table">
			<thead>				
			</thead>
			<tbody>
			<?php
			    include ("../Connection/connect.php");
				$email = $_GET['email'];

                $query = "SELECT * FROM lake WHERE email = '$email' ";
                $query_run = mysqli_query($conn, $query);
            ?>
                    <table id="example" class="table">
                        <thead>
                        </thead>
                        <?php
                if($query_run)
                {
                    foreach($query_run as $row)
                    {
            ?>
                        <tbody>
                            <tr>
                                <td> <?php echo $row['id']; ?> </td>
                                <td> <?php echo '<img src="data:image;base64,'.base64_encode($row['image']).'" style="width: 1000px; height: 400px;">'; ?> </td>
								<td> <?php echo $row['title']; ?></td>
								<td> <?php echo $row['description']; ?></td>
								<td> <?php echo $row['longitude']; ?></td>
								<td> <?php echo $row['latitudes']; ?></td>
								<td> <?php echo $row['user_reference']; ?></td>
								<td> <?php echo $row['lake_reference']; ?></td>
                                <td> <?php echo $row['soft_id']; ?> </td>
								<td>
								   <form action="lake_delete.php"  method="POST">
									 <input type="hidden" name="email" value="<?php echo $row['email']?>" >
                                     <button type="submit" name="delete_lake" class="btn btn-danger deletebtn" style="margin-top:150px" value="<?php echo $row['id'];?>"> DELETE </button>
					              </form>
                                </td>
                            </tr>
                        </tbody>
                        <?php           
                    }
                }
                else 
                {
                    echo "No Record Found";
                }
            ?>
			</tbody>
       </table> 
      </div>
    </div>
  </div>
</div>
<!-- My Images Modal -->


<!-- Images View Modal -->
<div class="modal fade" id="imagesModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="window.location.reload();"></button>
      </div>


      <div class="modal-body">
	      <input type="hidden" id="lake_id" name="lake_id">
		  <input type="hidden" id="lake_title" name="lake_title">
		  <input type="hidden" id="lake_description" name="lake_description">
		  <input type="hidden" id="lake_longitude" name="lake_longitude">
		  <input type="hidden" id="lake_latitudes" name="lake_latitudes">
		  <input type="hidden" id="lake_user_reference" name="lake_user_reference">
		  <input type="hidden" id="lake_lake_reference" name="lake_lake_reference">

           <h1 id="demo_title" style="color:#342D7E"></h1>	
		   <p  id="demo_description"></p>
		   <h5 style="color:#342D7E">Longitude:</h5> <p id="demo_longitude"></p>
		   <h5 style="color:#342D7E">Latitudes:</h5> <p id="demo_latitudes"></p>
		   <h5 style="color:#342D7E">User reference::</h5> <p id="demo_user_reference"></p>	 
		   <h5 style="color:#342D7E">Lake reference::</h5> <p id="demo_lake_reference"></p>	
		   <h5 class="content"><?php echo $quote->content; ?></h5>
		   <button id="like_btn" onclick="Toggle()" class="btn" type="button"><i class="fa fa-thumbs-up fa-lg" aria-hidden="true"></i></button>	
      </div>
	  <button type="button" id="button" onclick="myFunction()" class="btn btn-info">Show more</button>

	<script>
		function myFunction(){
		 let x = document.getElementById("lake_title").value;
		 document.getElementById("demo_title").innerHTML = x;

		 let y = document.getElementById("lake_description").value;
		 document.getElementById("demo_description").innerHTML = y;

		 let z = document.getElementById("lake_longitude").value;
		 document.getElementById("demo_longitude").innerHTML = z;

		 let t = document.getElementById("lake_latitudes").value;
		 document.getElementById("demo_latitudes").innerHTML = t;

		 let g = document.getElementById("lake_user_reference").value;
		 document.getElementById("demo_user_reference").innerHTML = g;

		 let h = document.getElementById("lake_lake_reference").value;
		 document.getElementById("demo_lake_reference").innerHTML = h;
		}	
	 </script> 

	 <script>
         var btnvar1 = document.getElementById('like_btn');

		 function Toggle(){
			 if(btnvar1.style.color == "blue"){
				btnvar1.style.color = "grey"
			 }else{
				btnvar1.style.color = "blue"
			 }
		 }
	 </script>

	 
    </div>
  </div>
</div>
<!-- Images View Modal -->

  <script src="https://use.fontawesome.com/fe459689b4.js"></script>
  <script src="js/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
  <script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script type="text/javascript" src="js/dt-1.10.25datatables.min.js"></script>
</body>
</html>





