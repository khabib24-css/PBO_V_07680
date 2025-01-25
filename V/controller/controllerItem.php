<?php
require_once 'models/item_model.php';

class controllerItem
{
    private $dataItem;

    public function __construct()
    {
        $this->dataItem  = new modelItem();
    }

    public function listitem()
    {
        $items = $this->dataItem ->getAllRoles();
        include 'views/item_list.php';
    }

    public function tambahItem($item_name, $item_desc, $hargaBarang)
    {
        $this->dataItem->addRole($item_name, $item_desc, $hargaBarang);
    }

    public function editItemByID($item_id)
    {
        $item = $this->dataItem->getRoleById($item_id);
        include 'views/item_edit.php';
    }

    public function updateItemByID($item_id, $item_name,$item_desc, $hargaBarang)
    {
        $this->dataItem->updateRole($item_id,$item_name, $item_desc, $hargaBarang);
        header('location: index.php?modul=barang');
    }

    public function deleteItemByID($item_id)
    {
        $delete = $this->dataItem->deleteBarang($item_id);
        if ($delete == false) 
        {
            throw new Exception('gagal menghapus');
        }else{
            header('location: index.php?modul=barang');
        }
    }

    public function getlistItemName()
    {
        $items = [];
        foreach ($this->dataItem->getAllRoles() as $item) 
        {
            $items[] = $item->item_name;
        } 
        return $items;
    }

    public function getItemByName($item_name)
    {
        return $this->dataItem->getItemByName($item_name);
    }

    public function getItemID($item_id)
    {
        return $this->dataItem->getRoleById($item_id);
    }
    public function getAllBarangs()
    {
        return $this->dataItem ->getAllRoles();
    }


}

?>