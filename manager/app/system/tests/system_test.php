<?php
require_once('app/lib/simpletest/autorun.php');
require_once('app/system/class.System.php');

class TestOfSystem extends UnitTestCase {
 
    function testgetController(){
        $sys = new System();
        $this->assertTrue($sys->getController());
    }
    function testgetAction(){
        $sys = new System();
        $this->assertTrue($sys->getAction(''));
    }
    
    
    
}



?>