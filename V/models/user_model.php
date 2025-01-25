<?php
require_once 'domain_Objek/data_user.php';
require_once 'domain_Objek/node_role.php';

class modelUser{
    private $USERS = [] ;
    private $nextId = 1;

    public function __construct() {
        if (isset($_SESSION['USERS'])) {
            $this->USERS = unserialize($_SESSION['USERS']);
            $this->nextId = count($this->USERS) + 1;
        } else {
            $this->initializeDefaultRole();
        }
    }


    public function addUser($uname, $pass, $role) {
        $User = new User($this->nextId++, $uname, $pass, $role);
        $this->USERS[] = $User;//INI ARRAY TAPI LEBIH TE[ATNYA LIST]
        $this->saveToSession();
    }

    private function saveToSession() {
        $_SESSION['USERS'] = serialize($this->USERS);
    }

    public function getUser(){
        return $this->USERS ;
    }

    public function initializeDefaultRole() {
        $obj_role1 = new Role(1,"admin","administrator",1);
        $obj_role2 = new Role(2,"kasir","keuangan",1);
        $this->addUser("khabib", 1234,$obj_role2);
        $this->addUser("labuu", 1234,$obj_role1);
        $this->addUser("bibi", 1234,$obj_role2);
    }

    public function getUserById($user_id) {
        foreach ($this->USERS as $User) {
            if ($User->user_id == $user_id) {
                return $User;
            }
        }
        return null;
    }

    public function deleteUser($User){
        if ($User != null) {
            $key = array_search($User, $this->USERS);
            unset($this->USERS[$key]);
            $this -> USERS = array_values($this->USERS);
            $this->saveToSession();
            return true;
    }else{
        return false;
    }
}

    public function updateUser($user_id, $username,$password,$role){
        $userlokal = $this->getUserById($user_id);
        if ($userlokal != null) {
            $userlokal->username = $username;
            $userlokal->password = $password;
            $userlokal->role = $role;
            return true;
        }else{
            return false;
        }
    }

    public function getUserByName($name){
        foreach ($this->USERS as $user){
            if ($user->username == $name){
                return $user;
            }
        }
        return null;
    }
}

// $obj_user = new modelUser();
// $USERS = $obj_user->getUser();
// print_r($USERS);
// foreach ($USERS as $User) {
//     echo "username : ".$User->username."<br>";
//     echo "password : ".$User->password."<br>";
//     echo "role name : ".$User->role->role_name."<br>";
// }
// echo"========================"."<br>";
// // echo"testing by id"."<br>";
// // $userlokal = $obj_user->getUserById(2);
// // print_r($userlokal);    
// // $userlokal = $obj_user->getUserById(1);
// // print_r($userlokal);    
// echo"testing delete"."<br>";
// echo ""."<br>";

// $lokal = $obj_user->getUserById(1);
// print_r($lokal);
// $obj_user->deleteUser($lokal);
// $USERS = $obj_user->getUser();
// echo ""."<br>";

// echo "<br>";
// foreach ($USERS as $User) {
//     echo "username : ".$User->username."<br>";
//     echo "password : ".$User->password."<br>";
//     echo "role name : ".$User->role->role_name."<br>";
// }
// $lokal = $obj_user->getUserById(1);
// // print_r($lokal);
// $obj_role1 = new Role(1,"admin","administrator",1);
// $obj_user->updateUser(2,"faishol@gmail.com",123,$obj_role1);
// $USERS = $obj_user->getUser();
// echo ""."<br>";

// echo "<br>";
// foreach ($USERS as $User) {
//     echo "username : ".$User->username."<br>";
//     echo "password : ".$User->password."<br>";
//     echo "role name : ".$User->role->role_name."<br>";
// }

?>