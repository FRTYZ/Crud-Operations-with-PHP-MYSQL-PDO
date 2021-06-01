<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<title></title>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<a href="index.php"><button type="button" class="btn btn-danger btn-lg btn-block">Back To Homepage</button></a>
				<div class="card mb-3">
					<div class="card-body">						
						<form method="post" action="" enctype="multipart/form-data">
							<div class="form-group">
								<label>Title</label>
								<input required type="text" class="form-control" name="title" placeholder="Write a Title">
							</div>				
							<div class="form-group">
								<label>Content</label>
								<input required type="text" class="form-control" name="content" placeholder="Write a Content">
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-primary">ADD</button>
								<script type="text/javascript" src="js/sweetalert.min.js"></script>
							</div>
							<?php
include('fonc.php');

if ($_POST) { // We check if there is a post on the page.

    $title = $_POST['title'];// After the page is refreshed, we assign the posted values to the variables.
    $content = $_POST['content'];    
    $error = "";

    // We check whether the data fields are empty. You can do it in other controls.
    
    if ($title <> "" && $content <> "" && $error == "") { // Veri 
        //Data to change
    	$line = [                       
    		'title' => $title,
    		'content' => $content, 


    	];
    	$sql = "INSERT INTO article SET title=:title, content=:content;";
    	$status = $connect->prepare($sql)->execute($line);

    	if ($status) {
    		echo '<script>swal("Successful","Added.","success").then((value)=>{ window.location.href = "index.php"});
    		</script>';
            // If the update query worked, we redirect to the index.php page.

    	}
    	
    	else {
            echo '<script>swal("error","An error has occurred, please check.","error");</script>'; // If id is not found or there is an error in the query, we print the error.
        }
    }
    if ($error != "") {
    	echo '<script>swal("error","' . $error . '","error");</script>';
    }
}

?>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>