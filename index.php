<?php
/**
 * Date: 12-Jan-17
 * Time: 8:41 PM
 */
session_start();
// this file calls the bootstraper

include('includes/bootstrap.php');

/*
 * Calls the boostraper function
 * This should be the FIRST function of the boostrapper file
*/
boot();

?>