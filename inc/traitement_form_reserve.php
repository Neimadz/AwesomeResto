<?php
require_once 'connect.php';

$post = array();
$error=  array();

$displayErr = false;
$formValid = false;


if(!empty($_POST)) {
	foreach ($_POST as $key => $value) {
		$post[$key] = trim(strip_tags($value));		
	}
	if(!$post['name']) {
		$error[] = 'Veuillez saisir votre nom';
	}
	if(!$post['firstname']) {
		$error[] = 'Veuillez saisir votre prénom';
	}
	if(!is_numeric($post['how_many']) || empty($post['how_many'])) {
		$error[] = 'Veuillez saisir un nombre de personnes supérieur à 1';
	}
	if(!$post['num']) {
		$error[] = 'Veuillez saisir un numéro de téléphone correct';		
	}
	if(!$post['date']) {
		$error[] = 'Veuillez sélectionner une date';		
	}
	if(!$post['hour']) {
		$error[] = 'Veuillez sélectionner une heure';		
	}
	if(!empty($post['message']) {
		$error[] = 'Vous n\'avez rien écris';
		
	}

	if(count($error) > 0 ) {
		$displayErr = true;
	}

	else {
		$formValid = true;

		$res = $db->prepare('INSERT INTO')
	}



}