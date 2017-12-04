<?php
/**
 * Date: 12-Jan-17
 * Time: 8:43 PM
 */

//This is the first function of the boostrapper
function boot()
{

    // settings should load FIRST
    fileload("settings/settings.php");
    // fileload the classes
    fileload("includes/*/*");

    $url = new URL();
    //echo $url->GetUrl();


    $router  = new Router();
    // Passive mods should run Before the active ones
    $router->RunPassiveModules();
    // Run the active mod from the URL
    $router->RunActiveModFromURL($url);

    append_left_sidebar(Theme::MainNavigationMenu());


    ob_start();
    Theme::LoadCurrentTheme();
    ob_end_flush();

}

function fileload($path)
{
    if (empty($path)) return false;

    $files_path = glob($path);

    if (!is_array($files_path)) return false;

    foreach ($files_path as $file)
    {
        if (is_readable($file) && !is_uploaded_file($file))
        {
            include_once($file);
            //echo $file." ..loaded! <br>";
        }
    }
    return true;
}


?>