<?php

namespace app\Controllers;
use app\Models\Log;

class LogController
{
    public static function firstAccess($client_id=null,$admin_id=null){
        $log = new Log();
        $lastid = $log->firstAccessLog($client_id,$admin_id);
        $_SESSION['Log']['LastLogId'] = $lastid;
        if($lastid){
          return $lastid;
        }
    }

    public static function getLastId(){
        return $_SESSION['Log']['LastLogId'] ?? 0;
    }
    
    public static function lastAccess(){
        $log = new Log();
        if ($log->lastAccessLog(self::getLastId())) {
           return true;
        }
    }
}

