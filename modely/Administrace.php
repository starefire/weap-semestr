<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Administrace{
    
public function VypisProdukty(){
		return db::VratVse("SELECT*FROM knihy  ORDER BY nazev", array());
	}
    
function delete($id) {
		$pripojeni = mysqli_connect("localhost","czjan-prochazk15","prochy01","czjan-prochazka");

		// pripravit dotaz pro databazi na smazani obrazku se zadanym ID
		$query = "DELETE FROM knihy WHERE id=$id";


		// spusti pripraveny dotaz na databazi
		//mysqli_query($pripojeni, $query);
                if ($pripojeni->query($query) === TRUE) {
                    echo "New record created successfully";
                } else {
                    echo "Error: " . $query . "<br>" . $pripojeni->error;
                }
		// uzavrit pripojeni k databazi
		mysqli_close($pripojeni);
	}


	function akceUpravitProdukt($idPrispevku) {

		// pokud parametr ID existuje -> nacist ho do $id
		if($id = $_GET['id']) {
			$pripojeni = mysqli_connect('localhost', 'root', '', 'eshop');

			$data = mysqli_query($pripojeni, $query);

			// data existuji -> nacist zaznam
			if($data && $zaznam = mysqli_fetch_array($data)){

				// zde nacist veci z formu

				// aktualizovat hodnotu v databazi
				$query = "UPDATE obrazek SET hodnoceniKladne=".$hodnoceni." WHERE id=".$id.";";

				// spustit dotaz
				mysqli_query($pripojeni, $query);


			}
			else {
				echo "Prispevek s ID=".$id." neexistuje.";
			}

			mysqli_close($pripojeni);
		}
	}
    
        function vloz($nazev, $autor, $cena, $obrazek, $popis, $kategorie){
            $pripojeni = mysqli_connect("localhost","czjan-prochazk15","prochy01","czjan-prochazka");

		// pripravit dotaz pro databazi na smazani obrazku se zadanym ID
		$query = "INSERT INTO knihy (nazev, autor, cena, obrazek, dlouhy_popis, kategorie)
VALUES ('$nazev','$autor','$cena','$obrazek','$popis','$kategorie')";


		// spusti pripraveny dotaz na databazi
		//mysqli_query($pripojeni, $query);
                if ($pripojeni->query($query) === TRUE) {
                    echo "New record created successfully";
                } else {
                    echo "Error: " . $query . "<br>" . $pripojeni->error;
                }
		// uzavrit pripojeni k databazi
		mysqli_close($pripojeni);
            
        }
     
        
        
}