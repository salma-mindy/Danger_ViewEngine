<?php
require_once '../php/db.php';

if(isset($_POST['id']))
{
    $id = $_POST['id'];

    $sql = "DELETE FROM danger WHERE id='$id' ";
    $query = $db->prepare($sql);
    $query -> execute();
    echo 1;
   exit;  
}
echo 0;
exit;
?>