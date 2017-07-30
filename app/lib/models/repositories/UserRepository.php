<?php
/**
 * Created by PhpStorm.
 * User: arnelaponin
 */

require_once(dirname(__FILE__).'/../../../config/config.php');
require_once(dirname(__FILE__).'/../User.php');

class UserRepository extends BaseRepository {

    protected $pdo;

    public function __construct(PDO $pdo = null) {
        parent::__construct($pdo);
    }

    function find($id) {
        $stmt = $this->pdo->prepare('SELECT user.* FROM user WHERE id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
        return $stmt->fetch();
    }

    function findByConversationId($conversation_id) {
        $stmt = $this->pdo->prepare('SELECT user.* FROM participant 
            INNER JOIN user ON participant.user_id=user.id 
            WHERE participant.conversation_id=:conversation_id');
        $stmt->bindParam(':conversation_id', $conversation_id);
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
        return $stmt->fetchAll();
    }
}