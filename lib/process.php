<?php
include "db.php";
$db = new Database;
$tbl_name="employees";

if(isset($_POST['Add'])){
        $data = array(
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'address' => $_POST['address'],
            'phone' => $_POST['phone']
        );
echo "<pre>";
print_r($data);
echo "</pre>";
echo "<br/>";
var_dump($db->insert($tbl_name,$data));
    
$inserted = $db->insert($tbl_name, $data);

    if($inserted){
        echo "data insert";
    }
    else{
        echo "data not insert";
    }

}else{
    echo "data not prepare please check your html form";
}
