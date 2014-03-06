<?php


class UsersTask extends \Phalcon\CLI\Task {

    /**
     * Создает тестовых пользователей
     */
    public function generateAction() {
        for ($i=0; $i<100000; $i++) {
            $objUser = new Users();
            $objUser->name = 'name ' . $i;
            $objUser->key = $i;
            $objUser->save();
        }
    }

    public function authAction() {
        // TODO:: запустить в несколько потоков. Лучше реализовать в супервайзере
        while(true) {
            $intKey = rand(0, 100000);
            $objUsersOnline = UsersOnline::findFirst(array(
                array('user_id' => $intKey),
            ));
            if (!$objUsersOnline) {
                $objUsersOnline = new UsersOnline();
                $objUsersOnline->createdAt = new MongoDate();
                $objUsersOnline->user_id = $intKey;
                $objUsersOnline->save();
            }
            sleep(2);
        }
    }
} 