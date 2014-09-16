<?php
 
//require LIB.'PHPMailer/class.phpmailer.php';
include LIB.'SendGrid/SendGrid_loader.php';

class System{
        private $_url;
        private $_explode; 
        public  $_controller;
        public  $_action;
        public  $_params;
        
        
        public function __construct() {
            $this->setUrl();
            $this->setExplode();
            $this->setController();
            $this->setAction();
            $this->setParams();
        }
        
        private function setUrl(){
           $_GET['url'] = (isset($_GET['url']) ? $_GET['url']: 'home/index'); 
           $this->_url = $_GET['url'];
        }
        
        private function setExplode(){
            $this->_explode = explode('/',$this->_url);
        }
        
        private function setController(){
            $this->_controller = $this->_explode[0];
        }
        private function setAction(){
            $act = (!isset($this->_explode[1]) || $this->_explode[1] == null ? 'index' : $this->_explode[1]);
            $this->_action = $act;
        }
        
        private function setParams(){
           unset($this->_explode[0],$this->_explode[1]);
           if(end($this->_explode) == null) array_pop($this->_explode);
           $params = array_merge($this->_explode,$_GET);
           unset($params['url']);
           if($params){
            $this->_params = $params;
           }
        }
        public function getParams($name = null){
               if($name != null){
                    return $this->_params[$name];
                }else{
                    return $this->_params;
                }
        }
        
        
        public function getController(){
            if($this->_controller)
                return $this->_controller; 
            else
                return false;   
        }
        
        public function getAction(){
              if($this->_action)
                  return $this->_action;
              else
                return false;   
        }
        
        public function run(){
            $controller_path = CONTROLLERS.$this->_controller.'/'.$this->_controller.'Controller.php';
            if(!file_exists($controller_path)){
                $controller = 'home';
                $controller_path = CONTROLLERS.$controller.'/'.$controller.'Controller.php';
                require_once($controller_path);
                $app = new $controller();
                $action = $this->_controller;
                if(!method_exists($app,$action)){
                    $controller = 'home';
                    $controller_path = CONTROLLERS.$controller.'/'.$controller.'Controller.php';
                    require_once($controller_path);
                    $app = new $controller();
                    $action = 'nao_existe';
                }
                $app->$action();
            }else{
                require_once($controller_path);
                $app = new $this->_controller();
                $action = $this->_action;
                if(!method_exists($app,$this->_action)){
                    
                  $controller = 'home';
                  $controller_path = CONTROLLERS.$controller.'/'.$controller.'Controller.php';
                  require_once($controller_path);
                  $app = new $controller();
                  $action = 'nao_existe';
                }      
                unset($_REQUEST['url']);
                unset($_REQUEST['PHPSESSID']);
                
                $app->$action();
            }
        }
        
        function sendEmailOLD($to,$to_name = '',$subject,$content){
            $mail = new PHPMailer();  
            $mail->SetFrom(FROM_EMAIL,NAME_EMAIL);
            $mail->AddAddress($to,$to_name);
            $mail->AddBCC('rrsilvadev@gmail.com');
            $mail->Subject = $subject;
            $mail->MsgHTML($content);
            // ANEXO
            //$mail->AddAttachment('images/phpmailer_mini.gif');
            if(!$mail->Send()) {
                echo "Mailer Error: " . $mail->ErrorInfo;
                return false;
            } else {
              
              return true;
            }
        }
        
        
        function sendEmail($to,$to_name = '',$subject,$content,$from_email =''){
               $sendgrid = new SendGrid('VaiMoto', 'dudinha09'); 
               $mail = new SendGrid\Mail();
               if(is_array($to)){
                   foreach($to as $k=>$v){
                    $mail->addTo($v);       
                   }
               }else{                                                        
                 $mail->addTo($to);  
                 
               }
               if($from_email == ''){
                $from_email = FROM_EMAIL;   
               }
               
               $mail->setFrom($from_email)->setSubject($subject)->setHtml($content);
               
               $email = $sendgrid->web->send($mail);             
               return (array)json_decode($email);
        }
        
        
        function geraSenha($tamanho = 8, $maiusculas = true, $numeros = true, $simbolos = false){
            
            $lmin = 'abcdefghijklmnopqrstuvwxyz';
            $lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $num = '1234567890';
            $simb = '!@#$%*-';
            $retorno = '';
            $caracteres = '';

            $caracteres .= $lmin;
            if ($maiusculas) $caracteres .= $lmai;
            if ($numeros) $caracteres .= $num;
            if ($simbolos) $caracteres .= $simb;

            $len = strlen($caracteres);
            for ($n = 1; $n <= $tamanho; $n++) {
            $rand = mt_rand(1, $len);
            $retorno .= $caracteres[$rand-1];
            }
            return $retorno;
        }
        
        function sendGCM($tokens = array(),$message='',$results= array()){
            // API key from Google APIs
            // $apiKey = "AIzaSyCZRAb5PwLfngX0W2xZbgtdF8kXJtNoS-M"; // ANTIGO
            //$apiKey = "AIzaSyAmT_VUe3AK0C4GsjLNrrzR1L4pBFOI_SM"; // EMAIL
            $apiKey = APP_KEY;  // PLAY

            // Tokens
            $registrationIDs = $tokens;
            
            // URL
            $url = 'https://android.googleapis.com/gcm/send';
            /*
            $fields = array(
                            'registration_ids'  => $registrationIDs,
                            'data'              => array( "message" => $message , "result" => $results ),
                            );
           */                 
                            $fields = array(
                                'registration_ids'  => $registrationIDs,
                                'data'              => $results
                            );                            

            $headers = array( 
                                'Authorization: key=' . $apiKey,
                                'Content-Type: application/json'
                            );

            // Open connection
            $ch = curl_init();

            // Set the url, number of POST vars, POST data
            curl_setopt( $ch, CURLOPT_URL, $url );

            curl_setopt( $ch, CURLOPT_POST, true );
            curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

            curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $fields ) );

            // Execute post
            $result = curl_exec($ch);

            // Close connection
            curl_close($ch);

            return (array)json_decode($result);
            
        }
        
         function sendSMS($message,$number){
             
            $apiKey = "AIzaSyBv-6yy5Dhqi3Km7T7eHzV_JCXLoaNKTuU";  // PLAY
            $results['fone'] = $number;
            $results['msg'] = $message;
            
            // Token
            $tokens[] = 'APA91bGZCliE5Aqrs0_H9NtYB1Incd5VhaitE2ZhzqW93ZXXqprSVq_xME1faoIqWtF40MDHutBK80LKqD-lLEGB1SWcHuNwgStXT-Xpyan_Ae8C-Z2IXLxxslJ2LXE1lH4vz5skwvkcWEzIPr0iitERRte1cPzVvA';
            $registrationIDs = $tokens;
            
            // URL
            $url = 'https://android.googleapis.com/gcm/send';
            $fields = array(
                            'registration_ids'  => $registrationIDs,
                            'data'              => $results,
                            );

            $headers = array( 
                                'Authorization: key=' . $apiKey,
                                'Content-Type: application/json'
                            );

            // Open connection
            $ch = curl_init();

            // Set the url, number of POST vars, POST data
            curl_setopt( $ch, CURLOPT_URL, $url );

            curl_setopt( $ch, CURLOPT_POST, true );
            curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

            curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $fields ) );

            // Execute post
            $result = curl_exec($ch);

            // Close connection
            curl_close($ch);

            return (array)json_decode($result);
            
            
        }
        
        
        
        function urlize($url) { 
                $search = array('/[^A-Za-z0-9]/', '/--+/', '/^-+/', '/-+$/' ); 
                $replace = array( '-', '-', '', ''); 
                return strtolower(preg_replace($search, $replace,$this->retira_acentos($url))); 
        } 
        
        function retira_acentos($texto) 
        { 
        $array1 = array( "á", "à", "â", "ã", "ä", "é", "è", "ê", "ë", "í", "ì", "î", "ï", "ó", "ò", "ô", "õ", "ö", "ú", "ù", "û", "ü", "ç" 
        , "Á", "À", "Â", "Ã", "Ä", "É", "È", "Ê", "Ë", "Í", "Ì", "Î", "Ï", "Ó", "Ò", "Ô", "Õ", "Ö", "Ú", "Ù", "Û", "Ü", "Ç" ); 
        $array2 = array( "a", "a", "a", "a", "a", "e", "e", "e", "e", "i", "i", "i", "i", "o", "o", "o", "o", "o", "u", "u", "u", "u", "c" 
        , "A", "A", "A", "A", "A", "E", "E", "E", "E", "I", "I", "I", "I", "O", "O", "O", "O", "O", "U", "U", "U", "U", "C" ); 
        return str_replace( $array1, $array2, $texto); 
        } 
            
        function utf2ascii($string) { 
        $iso88591  = "\\xE0\\xE1\\xE2\\xE3\\xE4\\xE5\\xE6\\xE7"; 
        $iso88591 .= "\\xE8\\xE9\\xEA\\xEB\\xEC\\xED\\xEE\\xEF"; 
        $iso88591 .= "\\xF0\\xF1\\xF2\\xF3\\xF4\\xF5\\xF6\\xF7"; 
        $iso88591 .= "\\xF8\\xF9\\xFA\\xFB\\xFC\\xFD\\xFE\\xFF"; 
        $ascii = "aaaaaaaceeeeiiiidnooooooouuuuyyy"; 
        return strtr(mb_strtolower(utf8_decode($string), 'ISO-8859-1'),$iso88591,$ascii); 
        }
        
        function object_to_array_recusive ( $object, $assoc=TRUE, $empty='' ) 
            { 

                $res_arr = array(); 

                if (!empty($object)) { 

                    $arrObj = is_object($object) ? get_object_vars($object) : $object;

                    $i=0; 
                    foreach ($arrObj as $key => $val) { 
                        $akey = ($assoc !== FALSE) ? $key : $i; 
                        if (is_array($val) || is_object($val)) { 
                            $res_arr[$akey] = (empty($val)) ? $empty : $this->object_to_array_recusive($val); 
                        } 
                        else { 
                            $res_arr[$akey] = (empty($val)) ? $empty : (string)$val; 
                        } 

                    $i++; 
                    }

                } 

                return $res_arr;
            }


        
        
}
?>