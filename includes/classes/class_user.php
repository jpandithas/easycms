<?php
/**
 * Date: 16-Jan-17
 * Time: 6:32 PM
 */

class User
{
    protected $username;
    protected $password;
    protected $firstname;
    protected $lastname;
    protected $userlevel;
    protected $uid;

    public function __construct($username, $password)
    {
        $this->AuthenticateUser($username, $password);
    }

    protected function SetUser($username, $password, $firstname, $lastname, $userlevel)
    {
        //echo $username, $password, $firstname, $lastname, $userlevel;
        $this->username = $username;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->password = Security::Password($password);
        $this->userlevel = $userlevel;
        return true;
    }

    public function GetUserID()
    {
        if ($this->uid==null)
        {
            return false;
        }
        return $this->uid;
    }

    public function GetUserArray()
    {
        $userarray = array($this->username, $this->firstname, $this->lastname, $this->userlevel);
        return $userarray;
    }

    public function GetUserPassword()
    {
        return $this->password;
    }

    protected function AuthenticateUser($username, $password)
    {
        if (empty($username)|| empty($password)) return false;
        $db = new dB();
        $dbh = $db->GetConnectionObject();
        $sql = "SELECT uid from users WHERE username = ? AND password = ? LIMIT 1";
        $stmt = $dbh-> prepare($sql);
        $stmt->execute(array($username,Security::Password($password)));
        $result  = $stmt->fetch();
        if ($result)
        {
          $fields = "name,surname,userlevel";
            $table = 'users';
            $condition  = 'uid = '.$result['uid']. " LIMIT 1";
            $userdata = $db->dBFetchFromTable($fields, $table, $condition);
           // var_dump($userdata);
            $this->uid = $result['uid'];
            $this->SetUser($username, Security::Password($password), $userdata[0]['name'], $userdata[0]['surname'],$userdata[0]['userlevel']);
            return true;
        }
        return false;
    }
}
?>