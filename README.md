# Crud Operations with PHP MYSQL (PDO)

## Hello there,
In this project, I will present PHP MYSQL (PDO) and CRUD (Create, Read, Update, Delete) operations.

#### Our Project Content
* All CRUD operations
* Success and error alerts with SweatAlert


## İndex.php
* Listing Data
- Applying Add, Edit, Delete Operations

![alt text](https://github.com/FRTYZ/Crud-Operations-with-PHP-MYSQL-PDO/blob/main/img/crud-homepage.png?raw=true)

## add.php
#### Adding New Data
![alt text](https://github.com/FRTYZ/Crud-Operations-with-PHP-MYSQL-PDO/blob/main/img/crud-add.png?raw=true)

#### Alert with SweatAlert
![alt text](https://github.com/FRTYZ/Crud-Operations-with-PHP-MYSQL-PDO/blob/main/img/crud-add-alert.png?raw=true)

## update.php
#### Updating Data
![alt text](https://github.com/FRTYZ/Crud-Operations-with-PHP-MYSQL-PDO/blob/main/img/crud-update.png?raw=true)

#### Alert with SweatAlert
![alt text](https://github.com/FRTYZ/Crud-Operations-with-PHP-MYSQL-PDO/blob/main/img/crud-update-alert.png?raw=true)

## delete.php
#### Deletion of selected data
#### Alert with SweatAlert
![alt text](https://github.com/FRTYZ/Crud-Operations-with-PHP-MYSQL-PDO/blob/main/img/crud-delete.png?raw=true)

## Source Codes
* Related explanations are in the source code

#### .fonc.php (Database Settings)
```
<?php
$host = '127.0.0.1';
$dbname = 'pdocrud';
$username = 'root';
$password = '';
$charset = 'utf8';
//$collate = 'utf8_unicode_ci';
$dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_PERSISTENT => false,
    PDO::ATTR_EMULATE_PREPARES => false,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    //   PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES $charset COLLATE $collate"
];
try {
    $connect = new PDO($dsn, $username, $password, $options);
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection error: ' . $e->getMessage();
    exit;
}
?>
```

#### index.php
```
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
```



#### add.php          

```
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
```


#### edit.php
```
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
                 $title = $_POST['title']; // After the page is refreshed, we assign the posted values to the variables.
                 $content = $_POST['content']; 
                 $error = "";

    // We check if the data fields are empty. You can do it in other controls.
                 
    if ($title <> "" && $content <> "" && $error == "") { //
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
```

#### delete.php
```
<?php
if ($_GET) {

    // $page = $_GET["page name"];     If you have defined the page name for your admin panel, you can use this
    include("fonc.php"); // we include our database connection on our page.
    $query = $connect->prepare("SELECT * FROM article Where id=:id");
    $query->execute(['id' => (int)$_GET["id"]]);
    $result = $query->fetch();//executing query and getting data
    
        // We write our query code to delete the data whose id is selected.
    $where = ['id' => (int)$_GET['id']];
    $status = $connect->prepare("DELETE FROM article WHERE id=:id")->execute($where);
    if ($status) {
        header("location:index.php"); // If the query runs, we send it to the index.php page.
    }
}
?>
```



Good Encodings
