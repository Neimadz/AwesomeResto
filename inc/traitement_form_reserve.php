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
	if(!strlen($post['name']) <3 || strlen($post['name']) >15 ) {
		$error[] = 'Veuillez saisir votre nom';
	}
	if(!strlen($post['firstname']) <3 || strlen($post['firstname']) > 20 ){
		$error[] = 'Veuillez saisir votre prénom';
	}
	if(!is_numeric($post['how_many']) || empty($post['how_many'])) {
		$error[] = 'Veuillez choisir un nombre de personnes supérieur à 1';
	}
	if(!strlen($post['num']) != 10) {
		$error[] = 'Veuillez saisir un numéro de téléphone correct';		
	}
	if(!empty($post['date'])) {
		$error[] = 'Veuillez sélectionner une date';		
	}
	if(!empty($post['hour'])) {
		$error[] = 'Veuillez sélectionner une heure';		
	}
	if(!empty($post['message']) {
		$error[] = 'Vous n\'avez rien écris';
		
	}

	if(count($error) > 0 ) {
		$displayErr = true;
		echo 'Il ya des erreurs !';		
	}
	else {
		$formValid = true;

		$res = $db->prepare('INSERT INTO ')
	}

	if ($displayErr) {
		echo '<p>' .implode('<br>', $error). '</p>';
	}



}