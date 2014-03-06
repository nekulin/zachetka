<?php

class IndexController extends ControllerBase
{

    public function indexAction()
    {
        $attrUsersOnline = UsersOnline::find(array(
            "sort" => array("_id" => 1),
            "limit" => 5,
        ));
        $this->view->setVar("attrUsersOnline", $attrUsersOnline);
    }

}

