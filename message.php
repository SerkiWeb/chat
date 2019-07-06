<?php

class Message {

	static function insertMessage($pseudo, $message, $createdAt)
	{
		$db = new Database();
		$conn = $db->getConnection();
		$req=$conn->prepare('INSERT INTO chat (pseudo, message, createdAt) VALUES (:pseudo, :message, :createdAt)');
		$req->bindValue(':pseudo', $pseudo);
		$req->bindValue(':message', $message);
		$req->bindValue(':createdAt', $createdAt);
		return $req->execute();
	}

	static function lastPublished()
	{
		$db = new Database();
		$conn = $db->getConnection();
		$req = $conn->prepare('SELECT pseudo, message, createdAt FROM chat ORDER BY createdAt DESC LIMIT 20');
		$req->execute();
		$messages = $req->fetchAll(PDO::FETCH_ASSOC);
		return json_encode($messages);
	}

	static function lastPublishedSince($createdAt)
	{
		$db = new Database();
		$conn = $db->getConnection();
		$req = $conn->prepare('SELECT pseudo, message, createdAt FROM chat WHERE createdAt >= :createdAt');
		$req->bindValue(':createdAt', $createdAt->format('Y/m/d H:i:s'));
		$req->execute();
		$messages = $req->fetchAll(PDO::FETCH_ASSOC);
		return json_encode($messages);	
	}
}