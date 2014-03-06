<?php
class UsersOnline extends \Phalcon\Mvc\Collection {

    public $user_id;
    public $createdAt;

    public function getSource() {
        return "users_online";
    }


} 