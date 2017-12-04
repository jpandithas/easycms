<?php
/**
 * Date: 27-Apr-17
 * Time: 7:20 PM
 */
function display_page()
{
    $url = new URL();
    $urlcomponents = $url->GetUrlComponentsArray();
    if (!empty($urlcomponents['id']))
    {
        $pageid = $urlcomponents['id'];
        $db = new dB();
        if ($db->PageExists($pageid))
        {
            $fields = "title,body,alias";
            $table = "page";
            $condition="pageid = ".$pageid;
            $page = $db->dBFetchFromTable($fields,$table,$condition);
            append_content("<h2> {$page[0]['title']}</h2>");
            append_content("{$page[0]['body']}");
            append_content("<br> Alias: {$page[0]['alias']}");
        }
        else
        {
            append_content("Page Not Found");
        }
    }
    else
    {
        append_content("Page not Found!");
    }

}

?>