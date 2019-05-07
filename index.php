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
            if(isset($_SOCKET["name"])) {
                //checking if request exsists
                if($_SOCKET["name"] != "") {
                    $name = $_SOCKET["name"];
                    //Executing JS on user
                    ExecuteJS($user, "alert('Hey $name!')");
                }
            }
        }
    };

    //shared

    Run($main);
?>