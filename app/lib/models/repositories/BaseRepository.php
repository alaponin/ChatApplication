<?php
/**
 * Created by PhpStorm.
 * User: arnelaponin
 */

class BaseRepository {

    public function __construct(PDO $pdo = null) {
        $this->pdo = $pdo;
        if ($this->pdo == null) {
            $this->pdo = new \PDO("sqlite:" . Config::PATH_TO_SQLITE_FILE);
        }
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

}