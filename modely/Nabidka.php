<?php
class Nabidka{
	#Posle data o produktech podle kriteria�
	public function VypisProdukty($kategorie, $razeni){
		if($kategorie =="")
			return db::VratVse("SELECT*FROM knihy  ORDER BY $razeni", array());
		else
			return db::VratVse("SELECT*FROM knihy WHERE kategorie = ? ORDER BY $razeni", array($kategorie));
	}

}