<?php
class ProduktKontroler extends Kontroler
{
	public function __construct()
	{
		$this->pohled = "produkt";
		$this->titulek;
	}
	public function Proved()
	{
		#Nacte id produktu, ktery ma zobrazit z GET a jestlize nenalezne produkt v DB,
		#tak presmeruje na nabidku, jinak ulozi data
		$idProduktu = (isset($_GET['id'])) ? $_GET['id'] : "";

		$produkt = new Produkt();
		if(isset($_GET['delete'])){
			$produkt->akceOdstranitProdukt($idProduktu);
		#$this->Presmeruj("index.php");
		}


		if(Produkt::Existuje($idProduktu))
		{
                        $kos = new Kosik();
			$this->data = Produkt::Vypis($idProduktu);
			$this->titulek= $this->data['nazev'];
                        $this->cena = $kos->CelkovaCena();
		}
		else
			$this->Presmeruj("index.php");

		#Vytvoreni nabidky a ulozeni dat

	}

}