<?php
/**
 * Date: 12-Jan-17
 * Time: 8:59 PM
 */

class Router
{

    /**
     * @param URL $url
     */
    public function RunActiveModFromURL (URL $url)
    {
        $db  = new dB();
        $db_mod_name  = $db->GetModuleFromdB($url);
        $fs_mod_name  = $this->GetActiveModuleFromFileSystem($url);
        if ($db_mod_name AND $fs_mod_name AND ($fs_mod_name == $db_mod_name))
        {
            include_once ("modules/active/".$db_mod_name."/".$db_mod_name.".php");
            call_user_func($db_mod_name);
        }
    }

    /**
     * @param URL $url
     * @return bool
     */
    public function GetActiveModuleFromFileSystem(URL $url)
    {
        $urlComponents = $url->GetUrlComponentsArray();
        switch ($url->GetUrlComponentsNumber())
        {
            case 1:
                $mod_name = $urlComponents['action'];
                break;
            case 2:
                $mod_name = $urlComponents['action']."_".$urlComponents['type'];
                break;
            case 3:
                $mod_name = $urlComponents['action']."_".$urlComponents['type'];
                break;
            default:
                return false;
            break;
        }

        if (is_dir("modules/active/".$mod_name))
        {
            $file_path = "modules/active/".$mod_name."/".$mod_name.".php";
            if (is_readable($file_path) && !is_uploaded_file($file_path))
            {
                if (is_callable($mod_name,true,$callable_name))
                {
                    return $callable_name;
                }
            }
        }
        return false;

    }

    /**
     * @return mixed
     */
    public function RunPassiveModules()
    {
        $db = new dB();
        $mods_array = $db->GetPassivesFromDB();
        $errors['path'] = 0;
        $errors['files'] = 0;
        foreach ($mods_array as $row)
        {
            $passive_mods_path = "modules/passive/";
            if (is_dir($passive_mods_path.$row['path']))
            {
                if (is_file($passive_mods_path.$row['path']."/".$row['mod_name'].".php"))
                {
                    $file = $passive_mods_path.$row['path']."/".$row['mod_name'].".php";
                    include_once($file);
                }
                else
                {
                    $errors['files']++;
                }
            }
            else
            {
                $errors['path']++;
            }
        }
        return $errors;
    }

}

?>