<?php

namespace SC5050;

trait AbilityToResetTheDatabase{
    
    public function resetTheDatabase($SQL_DumpFile){
        
        //These are the DC login creds:
        global $CRG_DBuserName; // <-- set in the global _bootstrap.php file
        global $CRG_DBname; // <-- set in the global _bootstrap.php file
        
        //The initial state DB SQL file:
        global $CRG_DBsetupPath; // <-- set in the global _bootstrap.php file

        //This command resets the database to the dump:
        $string = "mysql -u $CRG_DBuserName $CRG_DBname < $SQL_DumpFile";
        shell_exec($string);
    }
}