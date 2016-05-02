<?php


// spustit spravu session
session_start();

// kdyz uzivatel nema prideleno ID
if(!isset($_SESSION['id']))
	// nastavit jeho ID na 0
	$_SESSION['id'] = 0;
  
  
