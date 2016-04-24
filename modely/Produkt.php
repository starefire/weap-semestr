<?php
class Produkt
{
	#kontroluje jestli daný Produkt existuje
	public static function Existuje($id)
	{
		if(db::VratRadek("SELECT * FROM knihy WHERE id = ?", array($id)))
			return true;
		else
			return false;
	}
	#Vraci data o danem produktu
	public static function Vypis($id)
	{

			return db::VratRadek("SELECT * FROM knihy WHERE id = ?", array($id));
	}


	function akceOdstranitProdukt($idPrispevku) {

		// pripojit k DB
		$pripojeni = mysqli_connect('localhost', 'root', '', 'eshop');

		// pripravit dotaz pro databazi na smazani obrazku se zadanym ID
		$query = "DELETE FROM knihy WHERE id=('".$idPrispevku."');";


		// spusti pripraveny dotaz na databazi
		mysqli_query($pripojeni, $query);

		// uzavrit pripojeni k databazi
		mysqli_close($pripojeni);

		header("location: /ES/index.php");

	}
        
        
        
        
}
