<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <title></title>
</head>
<?php
include('fonc.php');

$query = $connect->prepare("SELECT * FROM article Where id=:id");
$query->execute(['id' => (int)$_GET["id"]]);
$result = $query->fetch();//executing query and getting data
?>
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
                        <input required type="text" value="<?= $result["title"] ?>" class="form-control" name="title"
                        placeholder="Title">
                    </div>                  
                    <div class="form-group">
                        <label>Content</label>
                        <input required type="text" value="<?= $result["content"] ?>" class="form-control" name="content"
                        placeholder="Content">
                    </div>    
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Update Data</button>
                        <script type="text/javascript" src="js/sweetalert.min.js"></script>
                        <?php
                   if ($_POST) { // We check if there is a post on the page.
                 $title = $_POST['title']; // After the page is refreshed, we assign the posted values to the variables
                  $content = $_POST['content']; 
                     $error = "";

    // We check if the data fields are empty. You can do it in other controls.
    
    if ($title <> "" && $content <> "" && $error == "") {
        //Data to change
        $line = [
            'id' => $_GET['id'],            
            'title' => $title,
            'content' => $content,

        ];
        // We write our data update query code.z.
        $sql = "UPDATE article SET title=:title, content=:content WHERE id=:id;";
        $status = $connect->prepare($sql)->execute($line);

        if ($status) {
            echo '<script>swal("Successful","Data Updated ","success").then((value)=>{ window.location.href = "index.php"});

            </script>';
            // If our update query code worked, we are redirecting to index.php page.
        } else {
            echo 'An editing error has occurred. check your error: '; // If the id is not found or there is an error in the query, we print the error.
        }
    }
    if ($error != "") {
        echo '<script>swal("error","' . $error . '","error");</script>';
    }
}
    ?>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
</body>
</html>
