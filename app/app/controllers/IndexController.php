<?php

class IndexController extends ControllerBase
{

    public function indexAction()
    {
        $attrUsersOnline = UsersOnline::findFirstLimit(5);
        $this->view->setVar("attrUsersOnline", $attrUsersOnline);
    }

}

