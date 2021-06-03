<!DOCTYPE html>
<html>
<head>
	<title>PDO CRUD</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/all.min.css">
</head>
<body>

	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<a href="add.php"><button type="button" class="btn btn-primary btn-lg btn-block">ADD NEW DATA</button></a>
				<table class="table table-striped">
					<thead>
						<tr>
							<th scope="col">ID</th>							
							<th scope="col">Title</th>
							<th scope="col">Content</th>
							<th scope="col">Edit</th>
							<th scope="col">Delete</th>
						</tr>
					</thead>
					<tbody>
						<?php
						include('fonc.php'); // We include our database in our index.php page

						$query = $connect->prepare('Select * from article'); // We pull all the data from the "article" table in the database

						$query->execute(); // We run our query

						while($result=$query->fetch()) // We return our Data with While Loop
						
						{  // While Start

							?>
							<tr>
								<th scope="row"><?= $result['id']?></th>						
								<td><?= $result['title']?></td>
								<td><?= $result['content']?></td>
								<td>
									<a href="edit.php?id=<?= $result["id"] ?>"><button type="button" class="btn btn-success">Edit</button></a>
								</td>								
								<td>
									<a class="dropdown-item" href="#" data-toggle="modal"
									data-target="#delete<?= $result["id"] ?>"><button type="button" class="btn btn-warning">Delete</button></a>


									<!-- Logout Modal-->
									<div class="modal fade" id="delete<?= $result["id"] ?>" tabindex="-1" role="dialog"
										aria-labelledby="exampleModalLabel" aria-hidden="true">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="exampleModalLabel">Deletion Process</h5>
													<button class="close" type="button" data-dismiss="modal"
													aria-label="Close">
													<span aria-hidden="true">×</span>
												</button>
											</div>
											<div class="modal-body">Are you sure you want to delete the data?
											</div>
											<div class="modal-footer">
												<button class="btn btn-secondary pull-left mx-4" type="button"
												data-dismiss="modal">Cancel
											</button>
											<a class="btn btn-danger pull-right mx-4"
											href="delete.php?id=<?= $result["id"] ?>">Delete</a>


										</div>
									</div>
								</div>
							</div>
						</td>
					</tr>
					<?php
						}  // While End

						?>
						
					</tbody>
				</table>

			</div>
		</div>
	</div>

	<script src="js/jquery-3.4.1.min.js"></script>	
	<script src="js/bootstrap.min.js"></script>
</body>
</html>
