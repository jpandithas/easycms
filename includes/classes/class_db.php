<?php
/**
 * Date: 16-Jan-17
 * Time: 6:32 PM
 */

class dB
{
    protected $dbh;

    /**
     *
     */
    public function __construct()
    {
        $this->dbh = $this->dBConnect();
    }

    protected function dBConnect()
    {
        $connection_string = "mysql:host=".HOST.";dbname=".DBNAME;
        return new PDO($connection_string, DBUSER, DBPASS);
    }

    /**
     * @param URL $url
     * @return bool
     */
    public function GetModuleFromdB(URL $url)
    {
        $url_components_array = $url->GetUrlComponentsArray();
        $sql  = "SELECT func_name FROM ".DBNAME.".routes WHERE ";


        //exit the function with FALSE if url array is empty
        if ($url->GetUrlComponentsArray() == 0) return false;

        switch ($url->GetUrlComponentsNumber())
        {
            case 1:
                $sql .= "action = ?";
                $execute_params = array($url_components_array['action']);
                break;
            case 2:
                $sql .= "action = ? AND type = ?";
                $execute_params = array($url_components_array['action'], $url_components_array['type']);
                break;
            case 3:
                $sql .= "action = ? AND type = ?";
                $execute_params = array($url_components_array['action'], $url_components_array['type']);
                break;
        }
         $sql .= " LIMIT 1";

        //echo $sql;
        $statement  = $this->dbh->prepare($sql);
        $result = $statement->execute($execute_params);

        if ($result)
        {
            $mod_name_array = $statement->fetch(PDO::FETCH_ASSOC);
            return $mod_name_array['func_name'];
        }
        return false;
    }

    public function GetPassivesFromDB()
    {
        $sql  = "SELECT mod_name,path FROM ".DBNAME.".`passive_modules` WHERE status = 1";
        $statement = $this->dbh->prepare($sql);
        $result = $statement->execute();
        if ($result)
        {
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
           return false;

    }

    public function GetSidebarItems()
    {
        $fields = "action,type,description";
        $table_name = "routes";
        $condition = "id is NULL AND status = 1";

        return $this->dBFetchFromTable($fields,$table_name,$condition);
    }

    /** Method gets rows from Database
     * @param $fields
     * @param $tbl_name
     * @param $condition
     * @return array|bool
     */
    public function dBFetchFromTable($fields, $tbl_name, $condition)
    {
        if (empty($fields) || empty($tbl_name)) return false;
        $sql  = "SELECT ".$fields." FROM ".DBNAME.".`".$tbl_name."`";
        //echo $condition;
        if (!empty($condition))
        {
            $sql .= " WHERE ".$condition;
        }
       //echo $sql."<br>";
        $statement  = $this->dbh->prepare($sql);
        $result  = $statement->execute();
        if ($result)
        {
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
            return false;
    }

   public function GetConnectionObject()
   {
       return $this->dbh;
   }

    public function PageExists($pageid)
    {

        if (!empty($pageid))
        {
            $sql = "SELECT pageid FROM page WHERE pageid  = ? LIMIT 1";
            $stmt = $this->dbh->prepare($sql);
            $stmt->execute(array($pageid));
            $result  = $stmt->fetch();
            if ($result) return true;
        }
        return false;
    }


}

?>