<?php
/**
 * Date: 30-Mar-17
 * Time: 8:31 PM
 */

class Security
{
  public static function Password($password)
  {
      return md5(PASSWORD_SALT.md5($password));
  }

    public static function Sanitize_Text($text)
    {
        return stripslashes(strip_tags($text));
    }
}

?>