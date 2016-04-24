<?php
#Slouzi k vypsani obsahu kosiku a objednani
class KosikKontroler extends Kontroler {

public function __construct()
	{
		$this->pohled = "kosik";
		$this->titulek = "Košík";
		$this->error = "";
		$this->test = array();
	}
	public function Proved()
	{
		#vytvori a vypise kosik
		$kos = new Kosik();
		$this->data['produkty'] = $kos->VypisObsah();

		#Nacte soubory z POST, pred podminkou, protoze se tyhle veci davaji do sablony
		$this->jmeno = post('jmeno');
		$this->prijmeni = post('prijmeni');
		$this->mesto = post('mesto');
		$this->doprava = post('doprava');
		$this->platba = post('platba');
		if($_POST)
		{
			#Zkontroluje, jestli existuji vsechny udaje
			if($this->jmeno&&$this->prijmeni&&$this->mesto&&$this->doprava&&$this->platba)
				{
					#Zalozi a prida do objednavky
					$obj = new Objednavka();
					
					if($baf=$obj->Objednej($this->jmeno,
									$this->prijmeni,
									$this->mesto,
									$this->platba,
									$this->doprava,
									$this->UpravProdukty(),
									$kos->CelkovaCena()))
					{
						#ulozi zpravu do SESSION, ktera se zobrazi v index.php a kde se po jejim vypsani SESSION znici
						$_SESSION['zprava']="Úspěšně objednáno.";
						$this->Presmeruj("index.php");
					}
					else
					{
						$this->error="Nepovedlo se připojit k databazi. Zkuste to za chvili.";
					}				
				}
			else
				$this->error = "Nemáte vyplněný formlulář";

		}
	}
	#Funkce, která upraví produkty do formy vhodné pro db - vytvoří řetězec POČET.PRODUKT;POČET.PRODUKT;...
	private function UpravProdukty()
	{
		$stringProdukty = "";
		for($i = 0; $i<count($this->data['produkty']);$i++){
			$stringProdukty .= $this->data['produkty'][$i]['pocet'].".".$this->data['produkty'][$i]['id'].";"; 

		}
		return $stringProdukty;
	}
	
}
#jen pro zjednoduseni nacteni z POST
	function post($nazev)
	{
		if(isset($_POST[$nazev])&&$_POST[$nazev]!="")
			return $_POST[$nazev];
		else
			return null;

	}