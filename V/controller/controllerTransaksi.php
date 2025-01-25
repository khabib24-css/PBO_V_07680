<?php
require_once 'models/transaksi_model.php';
require_once 'models/item_model.php';
require_once 'models/user_model.php';

class controllerTransaksi
{
    private $transaksiModel;
    private $itemModel;
    private $userModel;

    public function __construct(){
        $this->transaksiModel = new modelTransaksi();
        $this->itemModel = new modelItem();
        $this->userModel = new modelUser();
    }

    public function listTransaksi(){
        $transaksis = $this->transaksiModel->getAllTransaksi();
        include 'Views/transaksi_list.php';
    }

    public function addTransaksi($barangIds, $jumlahs, $customerId, $kasirId){
        // Konversi ID barang ke objek barang
        $barangs = [];
        foreach ($barangIds as $barangId) {
            $barangs[] = $this->itemModel->getRoleById($barangId);
        }

        // Dapatkan objek customer dan kasir
        $customer = $this->userModel->getUserById($customerId);
        $kasir = $this->userModel->getUserById($kasirId);

        // Tambahkan transaksi
        $this->transaksiModel->addTransaksi($barangs, $jumlahs, $customer, $kasir);

        // Redirect ke daftar transaksi
        header('location: index.php?modul=transaksi');
    }
}
?>