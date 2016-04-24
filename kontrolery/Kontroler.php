<?php
abstract class Kontroler {

	protected $pohled;
	protected $titulek;
	protected $data = array();

	public function Zobraz()
	{
		if($this->pohled != ""){
			require ("pohledy/design/template.phtml");
		}

	}
	abstract function Proved();

	public function Presmeruj($adresa)
	{
		header("Location: $adresa");
		header("Connection: close");
        exit;	
	}

}