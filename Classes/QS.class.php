<?php
    function ExecuteJS($user, $function) {
        $arr = array('Function' => $function, 'Cookies' => null, 'socketid' => $user);
        $user->send(json_encode($arr));
    }
    function Run($main) {
        if(php_sapi_name() != 'cli') {
            $main->Client();
        }
    }
?>