<?php

require_once('ParentClass.php');

class ChildClass extends ParentClass {

    function __construct() {
        parent::__construct();
        echo __CLASS__ . ' has been instantiated.<br>';
    }

    function DoSomething() {
        parent::DoSomething();
        echo __CLASS__ . ' is now doing something.<br>';
    }

}

?>
