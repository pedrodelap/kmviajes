<?php

class Conexion{

	static public function conectar(){

		$link = new PDO("mysql:host=mysql-server-80;port=3306;dbname=bd_kmviajes2",
			            "root",
			            ".sweetpwd.");

		$link->exec("set names utf8");
		
		return $link;

	}

}