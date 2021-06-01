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