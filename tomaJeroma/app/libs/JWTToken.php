<?php
    require_once '../app/libs/Session.php';
    class JWTToken {

    static function generarToken($mail,$role) : string {
        $header = base64_encode(json_encode(["alg"=>'HS256','typ'=>'JWT']));
        $payload = base64_encode(json_encode(["sub"=>"UserData$mail",'mail'=>$mail,'role'=>$role,'iat'=>time(),'exp'=>time()+3600]));
        $key='clave_secreta';
        $signature=base64_encode(hash_hmac('sha256',"$header.$payload",$key,true));

        return "$header.$payload.$signature";
    }
    
    static function validateToken($JWT) : bool {
        list($header64, $payload64, $signature64) = explode(".",$JWT);
        $key='clave_secreta';
        $sing = base64_decode($signature64);
        $ValidateSing=hash_hmac('sha256',"$header64.$payload64",$key,true);
        $payload = json_decode(base64_decode($payload64));

        if (hash_equals($sing,$ValidateSing) or isset($payload['exp']) && $payload['exp']< time()) {
            
            return false;
        }
            return true;
    }
    
    static function rescueMail($JWT) :string {
        list($header64, $payload64, $signature64) = explode(".",$JWT);
        $payload = json_decode(base64_decode($payload64),true);

        return $payload['mail'];
    }

    static function rescueUserRole($JWT) :string {
        list($header64, $payload64, $signature64) = explode(".",$JWT);
        $payload = json_decode(base64_decode($payload64),true);

        return $payload['role'];
    }


    }


?>