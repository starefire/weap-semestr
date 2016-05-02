a<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class LoginKontroler extends Kontroler {

public function __construct()
	{
		$this->pohled = "login";
		$this->titulek = "Login";
	}

    public function Proved() {
           if($_SERVER["REQUEST_METHOD"] == "POST") {
                // username and password sent from form 
                $myusername = $_POST['username'];
                $mypassword = $_POST['password']; 

                $sql = "SELECT id FROM login WHERE username = '$myusername' and passwd = '$mypassword'";
                $result = db::Login($sql);
                //$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
                //$active = $row['active'];

                //$count = mysqli_num_rows($result);

                // If result matched $myusername and $mypassword, table row must be 1 row

                if(1 == 1) {
                   //session_register("myusername");
                   $_SESSION['login_user'] = $myusername;

                   header("location: index.php");
                }else {
                   $error = "Your Login Name or Password is invalid";
                }
       }

    }
    

}
