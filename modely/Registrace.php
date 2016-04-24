<?php
class Registrace{
		public function registruj($jmeno,$heslo,$hesloZnovu){
			// kdyz byla odeslana registrace
			if (isset($_POST['registrace'])) {
				// pomocna promenna ktera signalizuje, zda jsou udaje z
				// formulare v poradku - splnuji pravidla
				$uspech = true;

				// kontrola zadani jmena
				if($jmeno=="") {
					echo ('<p style="color: yellow; font-weight: bold;">'.
					      'Není zadané uživatelské jméno.</p>');
					$uspech = false;
				}
				// kontrola zadani hesla
				if($heslo=="") {
					echo ('<p style="color: yellow; font-weight: bold;">'.
							'Heslo nesmí být prázdné.</p>');
					$uspech = false;
				}
				// kontrola shody hesel
				if($heslo != $hesloZnovu) {
					echo ('<p style="color: yellow; font-weight: bold;">'.
							'Zadaná hesla se neshodují.</p>');
					$uspech = false;
				}


				// kdyz byla kontrola v poradku -> provest registraci
				if($uspech) {
					$login = $jmeno;
					$hashHesla = $hesloZnovu;

					// vytvorit zaznam uzivatele v databazi
					// ...doplnit pozdeji
					include_once 'mysql.php';

					// ziskat pripojeni k databazi
					$pripojeni = mysqlPripojeni();

					// zjistit zda existuje uzivatel se zadanym loginem
					$dotaz = "SELECT * FROM uzivateldb WHERE login='$login';";

					// promenna uzivatel uchovava vysledek dotazu, kdyz uzivatel neexistuje
					// hodnota je FALSE, jinak objekt (TRUE)
					$uzivatel = mysqli_query($pripojeni, $dotaz);

					// kdyz uzivatel neexistuje -> registrujeme
					if($uzivatel) {
						$dotaz = "INSERT INTO uzivateldb (login, hashHesla, datumRegistrace)
										 VALUES ('$login', '$hashHesla', NOW());";

						// vykonat dotaz $dotaz nad pripojenim $pripojeni
						mysqli_query($pripojeni, $dotaz);

			      echo '<div id="registraceUspesna">'.
						     '<h1>Registrace uspesna.</h1>'.
						     '<p>Prihlaste se zde:</p>'.
			           '</div>';

			          header("location: /ES/index.php");
					}
					else {

						echo '<p style="color: red; font-weight: bold;">'.
								'Uživatel <b>'.$login.'</b> už existuje, zadejte'.
								' jiné přihlašovací jméno.</p>';
						formular();
					}

				}
				// jinak vypsat formular s prednastavenym jmenem
				else {
					formular($_POST['uzivatelLogin']);
				}
			}


	}
}
?>
