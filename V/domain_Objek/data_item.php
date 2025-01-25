<?php 
class Item
{
	public $item_id;
	public $item_name;
	public $item_desc;
	
	public $hargaBarang;

	function __construct($item_id, $item_name, $item_desc, $hargaBarang)
	{
        $this->item_id = $item_id;
		$this->item_name =$item_name;
        $this->item_desc = $item_desc;
        // $this->item_status = $item_status;
		$this->hargaBarang = $hargaBarang;
	
	}
}



?>