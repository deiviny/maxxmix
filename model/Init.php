<?php
    if($_SERVER['SERVER_NAME'] == "localhost"){
        define('SERVER', 'localhost');
        define('USER', 'root');
        define('PASS', '');
        define('BANCO', 'rhsaaud');
        define('PORTA', '3306');
    } else {
        define('SERVER', 'ns62.hostgator.com.br');
        define('USER', 'ponta055_rh');
        define('PASS', 'Dani@46902056');
        define('BANCO', 'ponta055_rh');
        define('PORTA', '3306');
    }    
