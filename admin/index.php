<?php
/*
 * 
 ***********************
 * PROJETO PROMPT_2_STOCK v.1
 * Backend
 * @dev Rafael Rodrigues
 * @rafa.dev@live.com
 * @rrsilva88
 ***********************
 * 
 */

if (substr($_SERVER['HTTP_HOST'],0,3) != 'www') {
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: http://www.'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
}
 


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
