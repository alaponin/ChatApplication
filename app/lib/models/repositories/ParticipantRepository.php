<?php
/**
 * Created by PhpStorm.
 * User: arnelaponin
 */

require_once(dirname(__FILE__).'/../../../config/config.php');
require_once(dirname(__FILE__).'/../Participant.php');
require_once(dirname(__FILE__).'/BaseRepository.php');

class ParticipantRepository extends BaseRepository {

    protected $pdo;

    public function __construct(PDO $pdo = null) {
        parent::__construct($pdo);
    }

    function find($id) {
        $stmt = $this->pdo->prepare('SELECT participant.* FROM participant WHERE id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Participant');
        return $stmt->fetch();
    }

    function findByConversationId($conversation_id) {
        $stmt = $this->pdo->prepare('SELECT participant.* FROM participant WHERE conversation_id = :conversation_id');
        $stmt->bindParam(':conversation_id', $conversation_id);
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Participant');
        return $stmt->fetchAll();
    }

    function save(\Participant $participant) {
        $stmt = $this->pdo->prepare('INSERT INTO participant (conversation_id, user_id) VALUES (:conversation_id, :user_id)');
        $stmt->bindParam(':conversation_id', $participant->getConversationId());
        $stmt->bindParam(':user_id', $participant->getUserId());
        $stmt->execute();
        return $this->pdo->lastInsertId();
    }

    function checkParticipation($user_id, $conversation_id) {
        $stmt = $this->pdo->prepare('SELECT count(*) FROM participant 
            WHERE participant.conversation_id=:conversation_id 
            AND participant.user_id=:user_id;');
        $stmt->bindParam(':conversation_id', $conversation_id);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

}