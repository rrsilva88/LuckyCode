<?php
/*
 * 
 ***********************
 * PROJETO
 * LuckyCode
 * 
 * @dev Rafael Rodrigues
 * @rrsilvadev@gmail.com
 * @rrsilva88
 ***********************
 * 
 */
 
 
require_once('app/init.php');
$start = new System();
if(DEBUG){
    $controller = $start->getController();
    $action = $start->getAction();
    include BASE.'lib/simpletest/autorun.php';
    class AllTests extends TestSuite {
        function AllTests() {
                $this->addFile(BASE.'system/tests/system_test.php');
        }
    }
}else{
    $start->run();
}



?>
