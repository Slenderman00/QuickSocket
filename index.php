<?php
    include_once "Classes/QS.class.php";
    include_once "Classes/controller.class.php";

    $main = new class {
        
        function Client() {
            $vc = new Controller;

            $vc->view("Views/index.html");
            $vc->returnView();
        }

        function Server($_SOCKET, $user, $_USERS) {
            //server

            //example
            ExecuteJS($user, "alert('JS')");

        }
    };

    //shared

    Run($main);
?>