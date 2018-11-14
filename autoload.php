<?php
/**
 * Created by PhpStorm.
 * User: luiz-
 * Date: 13/11/2018
 * Time: 22:10
 */
function my_autoload ($pClassName) {
    require_once(__DIR__ . "/" . str_replace("\\","/", $pClassName) . ".php");
}
spl_autoload_register("my_autoload");