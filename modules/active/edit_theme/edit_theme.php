<?php
/**
 * Date: 09-Mar-17
 * Time: 7:14 PM
 */

function edit_theme()
{
    //var_dump($_POST);
    if (($_POST) and ($_POST['submit']=="Select"))
    {
        $theme_id = (integer) $_POST['selected_theme'];
        $db = new theme_db();
        $db->UpdateThemeRegistry($theme_id);
        $db = null;
        append_content("<h3>Theme Changed!</h3>");
    }
    else
    {
        append_content(show_form());
    }
}

function show_form()
{
    $form  = "<form action='' method='post'>";

    $db = new dB();
    $themes = $db->dBFetchFromTable("*","themes","");
    //var_dump($themes);

    $form .= "<table id='theme_selection'>";
    $form .= "<tr><th>Selection</th><th>Theme Name</th><th>Description</th><th>Status</th></tr>";
    foreach ($themes as $theme)
    {
        if ($theme['theme_status'] == 1)
        {
            $checked = " checked = \"checked\" ";
        }
        else
        {
            $checked = "";
        }
        $form .= "<tr><td><input type='radio' name='selected_theme' value='".$theme['theme_id']."'{$checked}></td>";
        $form .="<td>{$theme['theme_name']}</td><td>{$theme['theme_desc']}</td>";
        if ($theme['theme_status'] == 0)
        {
            $form .="<td> Disabled </td>";
        }
        else
        {
            $form .= "<td> Enabled </td>";
        }
        $form .="</tr>";
    }
    $form .= "</table>";
    $form .= "<input type='submit' name='submit' value='Select'/>";
    $form .="</form>";

    return $form;
}

class theme_db extends dB
{
    public function UpdateThemeRegistry($theme_id)
    {
        if (empty($theme_id) or $theme_id <= 0)
        {
            return false;
        }
        $sql = "UPDATE `themes` SET `theme_status` = 0";
        $this->dbh->exec($sql);
        $sql = "UPDATE `themes` SET `theme_status` = 1 WHERE `theme_id` = ?";
        $params = array($theme_id);
        $this->dbh->prepare($sql)->execute($params);
        return true;
    }
}

?>