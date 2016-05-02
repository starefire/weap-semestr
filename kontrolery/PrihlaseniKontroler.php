<?php
#Slouzi k vypsani obsahu kosiku a objednani
class PrihlaseniKontroler extends Kontroler {

public function __construct()
	{
		$this->pohled = "prihlaseni";
		$this->titulek = "Přihlášení";
		$this->error = "";
		$this->test = array();
	}
	public function Proved()
	{
		$prihlaseni = new Prihlaseni();

		#Nacte soubory z POST, pred podminkou, protoze se tyhle veci davaji do sablony
		$this->nick = post('uzivatelJmeno');
		$this->heslo = post('uzivatelHeslo');

		if($_POST)
		{
			#Zkontroluje, jestli existuji vsechny udaje
			if($this->nick&&$this->heslo)
				{

					if($prihlaseni->prihlas($this->nick,$this->heslo))
					{
						#ulozi zpravu do SESSION, ktera se zobrazi v index.php a kde se po jejim vypsani SESSION znici
						$_SESSION['zprava']="Úspěšně přihlášeno.";

					}
					else
					{
						$this->error="Nepovedlo se připojit k databazi. Zkuste to za chvili.";
					}
				}
			else
				$this->error = "Nemáte vyplněný formlulář";

		}else {
			prihlaseniFormular();
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
