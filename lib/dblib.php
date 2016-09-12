<?php
/**
 * This library contains all the data manipulation languate functions used to interact with the DB
 */
mysqli_report ( MYSQLI_REPORT_STRICT );
function setupDB() {
    global $CFG, $DB;

    if (isset ( $DB )) {
        return;
    }

    if (! isset ( $CFG->dbuser )) {
        $CFG->dbuser = '';
    }

    if (! isset ( $CFG->dbpass )) {
        $CFG->dbpass = '';
    }

    if (! isset ( $CFG->dbname )) {
        $CFG->dbname = '';
    }

    try {
        // $DB->connect($CFG->dbhost, $CFG->dbuser, $CFG->dbpass);
        $DB = mysqli_connect ( $CFG->dbhost, $CFG->dbuser, $CFG->dbpass, $CFG->dbname );
    } catch ( exception $e ) {
        //
        echo $e->getMessage ();
        throw $e;
    }

    return true;
}

function query($sql){
    global $DB;
   $result = mysqli_query($DB, $sql)  or die( exit(mysqli_error($DB))) ;

}