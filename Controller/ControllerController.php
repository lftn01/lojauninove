<?php
/**
 * Created by PhpStorm.
 * User: luiz-
 * Date: 17/11/2018
 * Time: 15:30
 */

namespace Controller;


class ControllerController
{
    function __construct()
    {
        session_start();
    }

    /**
     * @param $url
     */
    public function redirect($url){
        header('Location: '.$url);
    }
}