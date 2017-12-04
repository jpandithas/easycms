<?php
/**
 * Date: 06-Feb-17
 * Time: 8:37 PM
 */

function login()
{
    append_content("<h2>Login</h2>");

   // var_dump($_POST);

    if (!empty($_POST['Submit']) && ($_POST['Submit']=="Login"))
    {
        //authenticate User
        if (empty($_POST['username']) || empty($_POST['password']))
        {
            append_content("<h3 id='error'> Empty Username or Password </h3>");
            append_content(DisplayLoginForm());
        }
        else
        {
            $username = Security::Sanitize_Text($_POST['username']);
            $password = Security::Sanitize_Text($_POST['password']);
          //  echo $username." ".$password;
            $user = new User($username,$password);


            $uid = $user->GetUserID();


            if ($uid)
            {
                $_SESSION['userid'] = $uid;
                $_SESSION['username'] = $username;
                URL::Redirect('home');
            }
            else
            {
                append_content("<h3 id='error'> Login Failed! </h3>");
                append_content(DisplayLoginForm());
            }
        }
    }
    else
    {
        append_content(DisplayLoginForm());
    }
}

function DisplayLoginForm()
{
    $html = "<form id='loginform' action='' method='POST'>";
    $html .= " Username <input type='text' name='username'>";
    $html .= " Password <input type='password' name='password'>";
    $html .= "<input type='submit' name='Submit' value='Login'>";
    $html .="</form>";
    return $html;
}

?>