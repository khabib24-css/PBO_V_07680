<?php

require_once 'domain_Objek/data_user.php';
require_once 'domain_objek/data_item.php';
require_once 'domain_objek/data_Transaksi.php';

class modelTransaksi {
    private $transaksis = [];
    private $nextId = 1;

    public function __construct() {
        if (isset($_SESSION['transaksis'])) {
            $this->transaksis = unserialize($_SESSION['transaksis']);
            $this->nextId = count($this->transaksis) + 1;
        } else {
            $this->initializeDefaultTransaksi();
        }
    }

    public function addTransaksi($barangs, $jumlahs, $customer, $kasir) {
        $transaksi = new Transaksi($this->nextId++, $barangs, $jumlahs, $customer, $kasir);
        $this->transaksis[] = $transaksi;
        $this->saveToSession();
    }

    private function saveToSession() {
        $_SESSION['transaksis'] = serialize($this->transaksis);
    }

    public function getAllTransaksi() {
        return $this->transaksis;
    }

    public function getTransaksiById($idTransaksi) {
        foreach ($this->transaksis as $transaksi) {
            if ($transaksi->idTransaksi == $idTransaksi) {
                return $transaksi;
            }
        }
        return null;
    }

    private function initializeDefaultTransaksi() {
        //create object
        $objUser = new modelUser();
        $objBarang = new modelItem();
        //create data transaksi-1
        $barang1 = $objBarang->getRoleById(1);
        $barang2 = $objBarang->getRoleById(2);

        //add barang dan jumlah jadi satu variable
        $barangsA[] = $barang1;
        $barangsA[] = $barang2;
        $barangsB[] = $barang1;

        $jumlahsA[] = 2;
        $jumlahsA[] = 6;

        $jumlahsB[] = 2;

        $this->addTransaksi($barangsA, $jumlahsA, $objUser->getUserById(1), $objUser->getUserById(2));
        $this->addTransaksi($barangsB, $jumlahsB, $objUser->getUserById(1), $objUser->getUserById(2));
    }
}
?>