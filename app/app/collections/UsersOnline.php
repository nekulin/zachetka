<?php
class UsersOnline extends \Phalcon\Mvc\Collection {

    public $user_id;
    public $createdAt;

    public function getSource() {
        return "users_online";
    }

    /**
     * @param int $intLimit
     * @return \UsersOnline[]
     */
    public static function findFirstLimit($intLimit) {
        return self::find(array(
            "sort" => array("_id" => 1),
            "limit" => $intLimit,
        ));
    }
} 