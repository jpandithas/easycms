<?php
/**
 * Date: 23-Jan-17
 * Time: 7:35 PM
 */

function add_page()
{
    append_content("<h2> Add Page! </h2>");
    //var_dump($_POST);
    if (!empty($_POST['submit']) and ($_POST['submit']=="Add"))
    {
        if (!empty($_POST['page_title']) and !empty($_POST['alias']))
        {
            $db = new dB();
            $dbc = $db->GetConnectionObject();
            $sql  = "INSERT INTO page VALUES (NULL , ?, ?, ?)";
            $values = array($_POST['page_title'],$_POST['page_body'],$_POST['alias']);
            $stmt = $dbc->prepare($sql);
            $stmt->execute($values);
            if ($dbc->lastInsertId())
            {
                append_content("<h4> Page '{$_POST['page_title']}' Created Successfully with ID: {$dbc->lastInsertId()} </h4>");
                append_content("Visit the page <a href='".CMS_BASE_URI."?q=display/page/{$dbc->lastInsertId()}"."'> Here </a>");
            }
        }
        else
        {
            append_content("Page title or Alias is Blank!");
            append_content(ShowForm());
        }
    }
    else
    {
        append_content(ShowForm());
    }


}

function ShowForm()
{
    $form = new Webform('',"POST",'add_page');
    $form->insert_textbox("Page Title ","page_title");
    $form->add_textarea("Page Body ",10,20,"page_body","<p>Page</p>");
    $form->insert_textbox("Alias ","alias");
    $form->insert_submit("Add Page");
    return $form->getForm();
}
?>