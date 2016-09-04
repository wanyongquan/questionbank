<?php
/**
 * Holds the core settings;
 */
global $CFG;

if (!isset($CFG)){
    exit(1);
}

// detect real dirroot path reliably;    
$CFG->dirroot =dirname(dirname(__FILE__));

// wwwroot is mandatory
if (!isset($CFG->wwwroot)){
    echo ('Fatal error: $CFG->wwwroot is not configured! Exiting.'."\n");
    exit(1);
}

$CFG->libdir    =$CFG->dirroot.'/lib';


/** 
 *  Database Connection. Used for all access to the database.
 *  @global questionbank $DB
 *  @name $DB
 */
global $DB;

/**
 * php's session;
 * @global object $SESSION;
 * @name $SESSION
 */
global $SESSION;

/**
 * Hold the user configuration for the current user.
 * @global object $USER
 * @name $USER
 */

global $USER;

require_once ($CFG->libdir.'/dblib.php'); // database access
// connect to the database;
setupDB();

