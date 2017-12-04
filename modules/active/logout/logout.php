<?php
/**
 * Date: 06-Apr-17
 * Time: 7:04 PM
 */
function logout()
{
  session_destroy();
    URL::Redirect("home");
}

?>