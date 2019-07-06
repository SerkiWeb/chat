<?php
session_start();

require('database.php');
require('message.php');
		
if ($_POST) {

	if (!isset($_POST['pseudo']) || !isset($_POST['message'])) {
		die('bad request');
	}

	$pseudo = filter_var($_POST['pseudo'], FILTER_SANITIZE_STRING);
	$message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);
	
	if (!isset($_SESSION['pseudo'])) {
		if (preg_match("[^£$&]", $pseudo)) {
			die('erreur : bad pseudo');			
		}
		$_SESSION['pseudo'] = $pseudo;
	}

	if (messageNotMatch($message)) {
		die('erreur : message format');	
	}

	$now = new DateTime('now');
	$result = Message::insertMessage($pseudo, $message, $now->format("Y/m/d H:i:s"));
	echo(Message::lastPublishedSince($now));
	exit;
}

echo(Message::lastPublished());

function messageNotMatch($message)
{
	if (count($message) > 200) {
		return true;
	}
}
