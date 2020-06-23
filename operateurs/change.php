<?php
    require_once "../php/db.php";

    $pays = $_GET['paysId'];

    $stmt = $db->query("SELECT id,ville FROM ville WHERE pays ='$pays' ORDER BY ville");

    while($row = $stmt->fetch(PDO::FETCH_OBJ)) {
        echo "<option value='$row->ville'>$row->ville</option>";
    }