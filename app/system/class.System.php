<?php
 
require LIB.'PHPMailer/class.phpmailer.php';
//include LIB.'SendGrid/SendGrid_loader.php';

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
                    $action = 'verifica_rota';
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
        
        function sendEmail($to,$to_name = '',$subject,$content){
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
        
        function sendEmailGrid($to,$to_name = '',$subject,$content,$from = FROM_EMAIL){
               $sendgrid = new SendGrid('VaiMoto', 'dudinha09'); 
               $mail = new SendGrid\Mail();
               if(is_array($to)){
                   foreach($to as $k=>$v){
                    $mail->addTo($v);       
                   }
               }else{
                 $mail->addTo($to);  
               }
               $mail->setFrom($from)->setSubject($subject)->setHtml($content);
               
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
        
        
        function sendPush($token,$mensagem='',$dados = array()){
            // Put your private key's passphrase here:
            $passphrase = '200402';

            // Put your alert message here:
            //$message = 'ABRE LOGO ESSE NEGÓCIO.';
            
            $deviceToken = $token;
            $message = $mensagem;
            
            #echo 'tokens '.$token;

            ////////////////////////////////////////////////////////////////////////////////
             #echo getcwd().'/push/apns-dev-key.pem';
            $certficado = getcwd().'/push/apns-dev.pem';
            $ctx = stream_context_create();
            stream_context_set_option($ctx, 'ssl', 'local_cert',$certficado);
            stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

            // Open a connection to the APNS server
            // Open a connection to the APNS server
            // Para desenvolvimento adicinar sandbox na frente da url;
            $fp = stream_socket_client(
            'ssl://gateway.sandbox.push.apple.com:2195', $err,
            $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);

          

            // Create the payload body
            $body['aps'] = array(
                'alert' => $message,
                'sound' => 'default',
                );
            if(count($dados) > 0){
                $body['aps'] =  array_merge($body['aps'],$dados);
            }
            
         

            // Encode the payload as JSON
            $payload = json_encode($body);

            // Build the binary notification
            $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;

            // Send it to the server
            $result = fwrite($fp, $msg, strlen($msg));

            /*if (!$result)
                echo 'Message not delivered' . PHP_EOL;
            else
                echo 'Message successfully delivered' . PHP_EOL;
             * 
             */

            // Close the connection to the server
            fclose($fp);
            
            return $result;
            
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
                            'data'              => array( "message" => $message , "result" => $results )
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
                         #   echo '<pre>';
                         #   print_r($fields);
                         #   print_r($headers);
                         #   echo '</pre>';
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
            
            // Tokens
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
        
    
    function GetLatLng($endereco){
        $fullurl = "http://maps.googleapis.com/maps/api/geocode/json?address=".urlencode($endereco)."&sensor=true";
        $string .= file_get_contents($fullurl);
        $json = json_decode($string, true);
        $result['lat'] = $json['results']['0']['geometry']['location']['lat'];
        $result['lng'] = $json['results']['0']['geometry']['location']['lng'];
        
        
        return $result;
    }
    
    function getRoute($start,$end){
        
        
        
        
        
        $fullurl = "http://maps.googleapis.com/maps/api/directions/json?origin=".urlencode($start)."&destination=".urlencode($end)."&sensor=false";
        $string .= file_get_contents($fullurl);
        $json = json_decode($string, true);
        $result['remetente_latitude'] = $json['routes'][0]['legs'][0]['start_location']['lat'];
        $result['remetente_longitude'] = $json['routes'][0]['legs'][0]['start_location']['lng'];
        
        $result['destinatario_latitude'] = $json['routes'][0]['legs'][0]['end_location']['lat'];
        $result['destinatario_longitude'] = $json['routes'][0]['legs'][0]['end_location']['lng'];
        
        $result['km'] = $json['routes'][0]['legs'][0]['distance']['text']; 
        
        
        
        return $result;
        
    }
    
    function returnJson($data,$code,$msg=''){
        // DEFINE HEADER JSON
        header('Content-Type: application/json');
        
        
        $retorno['data'] = $data;
        $retorno['code'] = $code;
        $retorno['msg'] = $msg;
       
        echo json_encode($retorno);  
    }
    

        
        
}