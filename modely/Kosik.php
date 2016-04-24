<?php
class Kosik{

	#Pokud existuje produkt, prida, nebo pricte ho do SESSION
	public function Pridej($id)
	{
		if(Produkt::Existuje($id))
		{
			if(isset($_SESSION["id"]["$id"]))
				$_SESSION["id"]["$id"] = $_SESSION["id"]["$id"] +1;
			else
				$_SESSION["id"]["$id"] = 1;
		}
	}
	#Vrati obsah SESSION s id
	public function VypisObsah()
	{
		$objednaneProdukty = array();
		$i=0;
		if(isset($_SESSION["id"])){
			foreach( $_SESSION["id"] as $id => $pocet){
				if(Produkt::Existuje($id))
				{
					$objednaneProdukty[$i] = Produkt::Vypis($id);
					$objednaneProdukty[$i]['pocet'] = $pocet;
					$i++; 
				}
			}
		}
		return $objednaneProdukty;
	}
	#Spocte cenu vsech produktu v SESSION['id'](kosiku)
	public function CelkovaCena()
	{
		$produkty = $this->VypisObsah();
		$celkovaCena = 0;
		for($i = 0; $i<count($produkty);$i++){
	
		$celkovaCena += $produkty[$i]['cena']*$produkty[$i]['pocet'];
		}
		return $celkovaCena;
	}
}