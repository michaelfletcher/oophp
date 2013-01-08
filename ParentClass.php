<?php

class ParentClass {

    function __construct() {
        echo 'Constructor function was called on the ' . __CLASS__ . '<br>';
    }

    public function DoSomething() {
        echo __CLASS__ . ' is doing something.<br>';
        return 'Hi from parent doing something.<br>';
    }

}

?>
