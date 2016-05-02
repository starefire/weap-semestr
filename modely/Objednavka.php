<?php
class Objednavka{
	#Prida do DB zaznam o objednavce
	public function Objednej($jmeno,$prijmeni,$adresa,$platba,$doprava,$knihy,$cena)
	{
		/*$param = array(
			"jmeno"=>$jmeno,
			"prijmeni"=>$prijmeni,
			"adresa"=>$adresa,
			"platba"=>$platba,
			"doprava"=>$doprava,
			"produkty"=>$produkty,
			"cena"=>$cena);*/
		
                $pripojeni = mysqli_connect('localhost', 'root', '', 'eshop');

		// zkontrolovat pripojeni
		if(mysqli_connect_errno($pripojeni)) {
			echo "<p>Nepodařilo se připojit k databázi: ".mysqli_connect_error().
			"</p>";
		}

		// pripravit dotaz
		$dotazSQL = "INSERT INTO objednavky (jmeno, prijmeni,  platba, doprava, cena, adresa, status, knihy )
							VALUES ('".$jmeno."',
									    '".$prijmeni."',
									    '".$platba."',
									    '".$doprava."',
									    '".$cena."',
									    '".$adresa."',
									    'new',
									    '".$knihy."')";



		// provest dotaz
		mysqli_query($pripojeni, $dotazSQL);

		// uzavrit pripojeni k databazi
		mysqli_close($pripojeni);

		//return db::Vloz("objednavky",$param);
	}
}