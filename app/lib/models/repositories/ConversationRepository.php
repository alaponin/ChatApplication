<?php
/**
 * Created by PhpStorm.
 * User: arnelaponin
 */

require_once(dirname(__FILE__).'/../../../config/config.php');
require_once(dirname(__FILE__).'/../Conversation.php');
require_once(dirname(__FILE__).'/BaseRepository.php');

class ConversationRepository extends BaseRepository{

    protected $pdo;

    public function __construct(PDO $pdo = null) {
        parent::__construct($pdo);
    }

    function find($id) {
        $stmt = $this->pdo->prepare('SELECT conversation.* FROM conversation WHERE id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Conversation');
        return $stmt->fetch();
    }

    function findByUserId($user_id) {
        $stmt = $this->pdo->prepare('SELECT conversation.* FROM participant 
            INNER JOIN conversation ON participant.conversation_id=conversation.id 
            WHERE participant.user_id=:user_id 
            GROUP BY conversation.id');
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Conversation');
        return $stmt->fetchAll();
    }

    function save(\Conversation $conversation) {

        $stmt = $this->pdo->prepare('INSERT INTO conversation (title, creator_id) VALUES (:title, :creator_id)');
        $stmt->bindParam(':title', $conversation->getTitle());
        $stmt->bindParam(':creator_id', $conversation->getCreatorId());
        $stmt->execute();

        return $this->pdo->lastInsertId();
    }

}