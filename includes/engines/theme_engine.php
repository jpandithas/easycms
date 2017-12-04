<?php
/**
 * Date: 13-Feb-17
 * Time: 7:04 PM
 */

function print_header()
{

}

function print_left_sidebar()
{

    if (!empty($GLOBALS['left_sidebar']))
    {
        print($GLOBALS['left_sidebar']);
    }
}

function print_right_sidebar()
{

}

function print_content()
{
  if (!empty($GLOBALS['content']))
  {
      print($GLOBALS['content']);
  }
}

function print_footer()
{

}

function append_content($content)
{
    if (empty($GLOBALS['content']))
    {
        $GLOBALS['content'] = $content;
    }
    else
    {
        $GLOBALS['content'] .= $content;
    }
}

function append_left_sidebar($sidebar)
{
    if (!empty($GLOBALS['left_sidebar']))
    {
        $GLOBALS['left_sidebar'] .= $sidebar;
    }
    else
    {
        $GLOBALS['left_sidebar'] = $sidebar;
    }
}

?>