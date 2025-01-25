<?php
require_once 'models/item_model.php';
// test.php
session_start();
$modelItem = new modelItem();
$items = $modelItem->getAllRoles();

echo '<pre>';
var_dump($items);
echo '</pre>';
?>