<?php
/**
 * Created by PhpStorm.
 * User: arnelaponin
 */

require_once(dirname(__FILE__).'/../../../config/config.php');
require_once(dirname(__FILE__).'/../Message.php');

class MessageRepository extends BaseRepository {

    protected $pdo;

    public function __construct(PDO $pdo = null) {
        parent::__construct($pdo);
    }

    function find($id) {
        $stmt = $this->pdo->prepare('SELECT message.* FROM message WHERE id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Message');
        return $stmt->fetch();
    }

    function findByConversationId($conversation_id) {
        $stmt = $this->pdo->prepare('SELECT message.* FROM message WHERE conversation_id = :conversation_id');
        $stmt->bindParam(':conversation_id', $conversation_id);
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Message');
        return $stmt->fetchAll();
    }

    function save(\Message $message) {

        $stmt = $this->pdo->prepare('INSERT INTO message (sender_id, conversation_id, body) VALUES (:sender_id, :conversation_id, :body)');
        $stmt->bindParam(':sender_id', $message->getSenderId());
        $stmt->bindParam(':conversation_id', $message->getConversationId());
        $stmt->bindParam(':body', $message->getBody());
        $stmt->execute();

        return $this->pdo->lastInsertId();
    }

}