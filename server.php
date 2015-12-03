<?php

class YarService {


    public function test(){

        echo 123;
        return 'test123';

    }

}

$server = new Yar_Server(new YarService());
$server->handle();
