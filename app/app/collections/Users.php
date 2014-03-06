<?php
class Users extends \Phalcon\Mvc\Collection {

    public $name;
    public $key;

    public function getSource() {
        return "users";
    }
} 