<?php
    if(defined('DB_USER') == false){
        DEFINE ('DB_USER', 'admin');
        ezpz
    }
    if(defined('DB_PASSWORD') == false){
        DEFINE ('DB_PASSWORD', 'ceadmin-db');
    }
    if(defined('DB_HOST') == false){
        DEFINE ('DB_HOST', 'ce-database.cbe1mmzjy0xh.us-east-1.rds.amazonaws.com:3306');
    }
    if(defined('DB_NAME') == false){
        DEFINE ('DB_NAME', 'CreativeEvent');
    }
    
    
?>