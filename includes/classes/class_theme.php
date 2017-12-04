<?php
/**
 * Date: 06-Mar-17
 * Time: 8:18 PM
 */

class Theme
{
   public static function LoadCurrentTheme()
   {
       $db = new dB();
       $theme = $db->dBFetchFromTable("theme_path","themes","theme_status = 1");
       if ($theme)
       {
           $path = "themes/".$theme[0]['theme_path']."/theme.php";
           if (is_readable($path))
           {
               include_once($path);
           }
           else
           {
               include_once("themes/default/theme.php");
           }
       }
       else
       {
           include_once("themes/default/theme.php");
       }
   }

    public static function MainNavigationMenu()
    {
        $db = new dB();
        $links = $db->GetSidebarItems();
       // var_dump($links);
        $html = "<h3 id='navigation'>MAIN NAVIGATION</h3>";
        $html .= "<ul id='main_navi_menu'>";
        foreach ($links as $link)
        {
            if (($link['action'] == 'login') and !empty($_SESSION['userid']) )
            {
                continue;
            }
            if (($link['action'] == 'logout') and empty($_SESSION['userid']))
            {
                continue;
            }
            $html .= "<li>";
            $html .= "<a href=".CMS_BASE_URI."?q=".$link['action'];
            if (!empty($link['type']))
            {
                $html .= "/".$link['type'];
            }
            $html .= ">".$link['description']."</a>";
            $html .= "</li>";
        }
        $html .= "</ul>";

        if (!empty($_SESSION['userid']))
        {
            $html .= "<h3> USER: {$_SESSION['username']} </h3>";
        }
        return $html;
    }
}

?>