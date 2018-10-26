<?php
    function validateRequestParam ($param_needed, $param_supplied) {
        $resp = ['status'=>false,'msg'=>"none"];
        try{
            foreach ($param_needed as $k => $param) {
                if(array_key_exists($param, $param_supplied)){
                    if(empty($param_supplied[$param]) || $param_supplied[$param] == ""){
                        throw new Exception("Parameter Value Missing for $param", 1);                        
                    }
                }
                else{
                    throw new Exception("Parameter Missing, need $param", 1);                    
                }
            }
            $resp['status'] = true;
            return $resp;
        }
        catch(Exception $e){
            $resp['msg'] = $e->getMessage();
            return $resp;
        }
    }