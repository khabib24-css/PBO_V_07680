<?php 
session_start();
require_once 'controller/controllerRole.php';
require_once 'controller/controllerItem.php';
require_once 'models/user_model.php';
require_once 'controller/controllerTransaksi.php';
// require_once 'models/node_model.php';


$obj_Role = new controllerRole();
$obj_Item = new controllerItem();
$obj_User = new modelUser();
$obj_Transaksi = new controllerTransaksi();


if (isset($_GET['modul'])){
    $modul = $_GET['modul'];
}else{
    $modul = 'dashboard';
}

switch ($modul){
    case 'dashboard':
        include 'views/kosong.php';
        break;
        case 'transaksi':
            $fitur = isset($_GET['fitur']) ? $_GET['fitur'] : null;
            switch ($fitur){
                case 'add':
                    if ($_SERVER['REQUEST_METHOD']=='POST'){
                        print_r($_POST);
                        $customer_name = $_POST['customer'];
                        $Customer = $obj_User->getUserByName($customer_name);
                        $Kasir = $obj_User->getUserById(1);
                        echo $Customer->username."<br>";
                        echo $Kasir->username."<br>";
                        echo "<br>";
                        // Asumsikan $_POST['barang'] dan $_POST['jumlah'] adalah array
                        $barang = $_POST['barang'];
                        $jumlah = $_POST['jumlah'];
    
                        $obj_barangs = [];
                        foreach ($barang as $key => $bar) {
    //                        echo "Barang: " . $bar . ", Jumlah: " . $jumlah[$key] . "<br>";
                            $obj_barangs[] = $obj_Item->getItemID($bar);
                        }
                        $obj_Transaksi->addTransaksi($obj_barangs,$jumlah,$Customer,$Kasir);
                    } else {
    //                    $listRoleName = $objectRole->getListRoleName();
                        $barangs = $obj_Item->getAllBarangs();
                        $customers = $obj_User->getUser();
    //                    foreach ($customers as $customer){
    //                        echo $customer->name."<br>";
    //                    }
                        include 'Views/transaksi_input.php';
                    }
                    break;
                default:
                    $obj_Transaksi->listTransaksi();
            }
            break;


    case 'user':
        
        $fitur = isset($_GET['fitur']) ? $_GET['fitur'] :null;
        switch ($fitur){
            case 'add':
                if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                    $uname = $_POST["username"];
                    $pass = $_POST["password"];
                    $role_name = $_POST["role_name"];
                    $role = $obj_Role->getRoleByName($role_name);
                    $obj_User ->addUser($uname,$pass, $role);
                    header('location: index.php?modul=user');
                }else{
                    $roles = $obj_Role->getListRoleName();
                    include 'views/user_input.php';
                
                }
                break;
            default:
            $User = $obj_User->getUser();
            // print_r($users);
            include 'views/user_list.php';
            break;
        }
        break;


    case 'role':
        $fitur = isset($_GET['fitur']) ? $_GET['fitur'] :null;
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        switch ($fitur) {
            case 'addRole':
                if ($_SERVER['REQUEST_METHOD'] == 'POST')
                {
                    $role_name = $_POST['role_name'];
                    $role_desc = $_POST['role_desc'];
                    $role_status = $_POST['role_status'];
                    // $obj_Role->addRole($role_name,$role_desc,$role_status);
                    // header('location: index.php?modul=role');
                    if ($role_status == 1){
                        $role_status = 1;
                    }else{
                        $role_status = 0;
                    }
                    $obj_Role->addRole($role_name,$role_desc,$role_status);
                }else{
                    include 'views/role_input.php';
                }
                // echo "Masuk pak eko";
                break;
            case 'delete':
                // $obj_Role->deleteRole($id);
                //         header('location: index.php?modul=role');
                $obj_Role->deleteById($id);
                        break;
            case 'update':
                // $role = $obj_Role->getRoleById($_GET['id']);
                // // print_r($role); untuk mengecek isi $role dengan id
                // include 'views/role_edit.php';
                $obj_Role->editById($id);
                break;
            case 'editRole':
                if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                    $role_name = $_POST['role_name'];
                    $role_desc = $_POST['role_desc'];
                    $role_status = $_POST['role_status'];
                    // $obj_Role->updateRole($id,$role_name,$role_desc,$role_status);                    
                    // header('location: index.php?modul=role');
                    if ($role_status == 1){
                        $obj_Role->updateById($id,$role_name,$role_desc,$role_status);
                    }else{
                        $obj_Role->updateById($id,$role_name,$role_desc,$role_status);
                    }
                }else{
                    
                }
                break;
                default:
                        // $roles = $obj_Role->getAllRoles();
                        $obj_Role->lisrRole() ;
                        // include 'views/role_list.php';
                        break;
                    }
        break;


    case 'barang':
        $fitur = isset($_GET['fitur']) ? $_GET['fitur'] :null;
        $item_id = isset($_GET['id']) ? $_GET['id'] : null;
        switch ($fitur) {
            case 'tambah':
                if ($_SERVER['REQUEST_METHOD'] == 'POST')
                {
                    $item_name = $_POST['item_name'];
                    $item_desc = $_POST['item_desc'];
                    $hargaBarang = $_POST['hargaBarang'];

                    $obj_Item->tambahItem($item_name,$item_desc,$hargaBarang);
                    header('location: index.php?modul=barang');
                }else{
                    include 'views/item_input.php';
                }
                // echo "Masuk pak eko";
                break;
            case 'deleteBarang':
                $obj_Item->deleteItemByID($item_id);
                        header('location: index.php?modul=barang');
                        break;
            case 'updateBarang':
                // $data = $obj_Item->getRoleById($_GET['id']);
                $obj_Item->editItemByID($item_id);
                // print_r($data); //untuk mengecek isi $role dengan id
                include 'views/item_edit.php';
                break;
            case 'editBarang':
                if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                    $item_name = $_POST['item_name'];
                    $item_desc = $_POST['item_desc'];
                    $hargaBarang = $_POST['hargaBarang'];
                    $obj_Item->updateItemByID($item_id,$item_name,$item_desc,$hargaBarang);                    
                    header('location: index.php?modul=barang');
                }else{
                    include 'views/item_list.php';
                }
                break;
                default:
                        $obj_Item->listitem();
                        // include 'views/item_list.php';
                    }
                    break;

}

?>