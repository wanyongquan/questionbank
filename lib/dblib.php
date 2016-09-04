<?php
 /**
  * This library contains all the data manipulation languate functions used to interact with the DB
  */

function setupDB(){
    global $CFG, $DB;
    
    if (isset($DB)){
        return;
    }
    
    if (!isset($CFG->dbuser)){
        $CFG->dbuser    ='';
    }
    
    if (!isset($CFG->dbpass)){
        $CFG->dbpass = '';
    }
    
    if (!isset($CFG->dbname)){
        $CFG->dbname='';
    }
    
    try {
        //$DB->connect($CFG->dbhost, $CFG->dbuser, $CFG->dbpass);
        $DB = mysqli_connect($CFG->dbhost, $CFG->dbuser, $CFG->dbpass, $CFG->dbname);
        
    }
    catch (exception $e){
        //
        throw $e;
    }
    
    return true;
   
    
}
