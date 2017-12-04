<?php
/**
 * Date: 26-Jan-17
 * Time: 7:43 PM
 */

define("HOST","localhost");
define("DBNAME", "cms2017");
define("DBUSER", "cmsuser");
define("DBPASS", '1234');
define("CMS_BASE_URI",$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']);
define("PASSWORD_SALT",'mycms');

?>