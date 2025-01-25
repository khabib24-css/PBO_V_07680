<?php

class Transaksi
{
    public $idTransaksi;
    public $barangs=[];
    public $jumlahs=[];
    public $total;
    public $customer;
    public $kasir;

    public function __construct($idTransaksi, $barang, $jumlah, $customer, $kasir)
    {
        $this->idTransaksi = $idTransaksi;
        $this->barangs = $barang;
        $this->customer = $customer;
        $this->kasir = $kasir;
        $this->jumlahs = $jumlah;
    }
}