<?php 
    function validatingPhone($phone){
        if(preg_match('/^\+358[0-9]{9}$/', $phone)){
            $phone = true;

        }else if(preg_match('/^\358[0-9]{9}$/', $phone)){
            $phone = true;

        }else if(preg_match('/^\044[0-9]{7}$/', $phone)){
            $phone = true;

        }else{
            $phone = false;

        }
    }
?>