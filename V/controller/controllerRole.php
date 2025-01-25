<?php
require_once 'models/role_model.php';

class controllerRole
{
    private $roleModel;

    public function __construct()
    {
        $this->roleModel = new modelRole();
    }

    public function lisrRole()
    {
        $roles = $this->roleModel->getAllRoles();
        include 'views/role_list.php';
    }

    public function addRole($role_name, $role_desc, $role_status)
    {
        $this->roleModel->addRole($role_name, $role_desc, $role_status);
        // header('location: index.php?modul=role');
    }

    public function editById($role_id)
    {
        $role = $this->roleModel->getRoleById($role_id);
        include 'views/role_edit.php';
    }

    public function updateById($role_id,$role_name ,$role_desc, $role_status)
    {
        $this->roleModel->updateRole($role_id, $role_name, $role_desc, $role_status);
        header('location: index.php?modul=role');
    }
    
    public function deleteById($role_id)
    {
        $cekking = $this->roleModel->deleteRole($role_id);
        if($cekking == false){
            throw new Exception('gagal');
        }else{
            header('location: index.php?modul=role');
        }
    }

    // merubah objek menjadu
    public function getListRoleName()
    {
        $roles = [];
        foreach ($this->roleModel->getAllRoles() as $role) {
            $roles[] = $role->role_name;
        }
        return $roles;
    }
    public function getRoleByName($role_name){
        return $this->roleModel->getRoleByName($role_name);
    }



}











?>