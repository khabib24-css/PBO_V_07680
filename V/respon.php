<?php 
// echo "ini adalah file testing response";
// echo "<br>";
// echo "modul = ".$_GET['modul']."<br>";
// echo "fitur = ".$_GET['fitur']."<br>";
// echo "request method :".$_SERVER['REQUEST_METHOD']."<br>";
// print_r($_POST);
// echo "<br>";
// echo "Nama Role : ".$_POST['role_name']."<br>";
// echo "keterangan role : ".$_POST['role_description']."<br>";
// echo "status role : ".$_POST['role_status']."<br>";

require_once 'domain_Objek/node_role.php';
$obj_Role = [];
$obj_Role[] = new Role(1,$_POST['role_name'],$_POST['role_desc'],$_POST['role_status']);
include 'views/role_list.php';
?>