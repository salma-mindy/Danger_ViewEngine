<?php
include 'db.php';


$draw = $_POST['draw'];
$row = $_POST['start'];
$rowperpage = $_POST['length'];
$columnIndex = $_POST['order'][0]['column']; 
$columnName = $_POST['columns'][$columnIndex]['data']; 
$columnSortOrder = $_POST['order'][0]['dir']; 
$searchValue = $_POST['search']['value']; 

$searchArray = array();


$searchQuery = " ";
if($searchValue != ''){
    $searchQuery = " AND (nom LIKE :nom or 
        email LIKE :email) ";
    $searchArray = array( 
        'nom'=>"%$searchValue%", 
        'email'=>"%$searchValue%"
    );
}


$stmt = $db->prepare("SELECT COUNT(*) AS allcount FROM utilisateurs ");
$stmt->execute();
$records = $stmt->fetch();
$totalRecords = $records['allcount'];


$stmt = $db->prepare("SELECT COUNT(*) AS allcount FROM utilisateurs WHERE 1 ".$searchQuery);
$stmt->execute($searchArray);
$records = $stmt->fetch();
$totalRecordwithFilter = $records['allcount'];


$stmt = $db->prepare("SELECT * FROM utilisateurs WHERE 1 ".$searchQuery." ORDER BY ".$columnName." ".$columnSortOrder." LIMIT :limit,:offset");


foreach($searchArray as $key=>$search){
    $stmt->bindValue(':'.$key, $search,PDO::PARAM_STR);
}

$stmt->bindValue(':limit', (int)$row, PDO::PARAM_INT);
$stmt->bindValue(':offset', (int)$rowperpage, PDO::PARAM_INT);
$stmt->execute();
$empRecords = $stmt->fetchAll();

$data = array();

foreach($empRecords as $row){
    $data[] = array(
            "nom"=>$row['nom'],
            "prenom"=>$row['prenom'],
            "email"=>$row['email'],
            "contact"=>$row['contact']
        );
}


$response = array(
    "draw" => intval($draw),
    "iTotalRecords" => $totalRecords,
    "iTotalDisplayRecords" => $totalRecordwithFilter,
    "aaData" => $data
);

echo json_encode($response);