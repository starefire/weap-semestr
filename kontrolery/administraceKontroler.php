a<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class AdministraceKontroler extends Kontroler {

public function __construct()
	{
		$this->pohled = "administrace";
		$this->titulek = "Administrace";
	}

    public function Proved() {
        
        if(!(isset($_SESSION['login_user'])&&($_SESSION['login_user']=="admin"))){
            header("location: index.php");
            return;
        }
        
        $administrace = new Administrace();
        if(isset($_GET["delete"])){
            if($_GET["delete"]==true && isset($_GET["id"])){
                $administrace->delete($_GET['id']);
            }
        }
        
        if (isset($_REQUEST['insert'])){
            $administrace->vloz($_POST["nazev"],$_POST["autor"],$_POST["cena"],$_POST["obrazek"],$_POST["popis"],$_POST["kategorie"]);  
        }
        $this->data = $administrace->VypisProdukty();
    }
    

}
