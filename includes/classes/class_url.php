<?php
/**
 * Date: 19-Jan-17
 * Time: 6:43 PM
 */

class URL
{
    protected $action;
    protected $type;
    protected $id;

    public function __construct()
    {
       $this->ReadUrl();
    }

    protected function ReadUrl()
    {
        if (!empty($_GET['q']))
        {
            $url = $this->splitUrl($_GET['q']);
            $this->updateUrl($this->sanitizeUrl($url));
            //var_dump($url);
        }
    }

    protected function sanitizeUrl($url)
    {
        if (is_array($url))
        {
            $sanitized_url = array();
            foreach ($url as $component)
            {
                array_push($sanitized_url,strip_tags($component));
            }
            return $sanitized_url;
        }
        return false;
    }

    public function GetUrl()
    {
        if (!empty($this->action))
        {
            $url = $this->action;
        }
        else
        {
            return false;
        }
        if (!empty($this->type))
        {
            $url .= "/".$this->type;
            if (!empty($this->id))
            {
                $url .= "/".$this->id;
            }
        }
        return $url;
    }

    public function GetUrlComponentsArray()
    {
        if (!empty($this->action))
        {
            $url_array['action'] = $this->action;

            if(!empty($this->type))
            {
                $url_array['type'] = $this->type;

                if (!empty($this->id))
                {
                    $url_array['id'] = $this->id;
                }
            }
            return $url_array;
        }
        return false;
    }

    public function GetUrlComponentsNumber()
    {
        return count($this->GetUrlComponentsArray());
    }
    
    protected function updateUrl($url)
    {
        if (is_array($url) )
        {
            $this->action = $url[0];
            if (!empty($url[1])) $this->type = $url[1];
            if (!empty($url[2])) $this->id = $url[2];
            return true;
        }
        return false;
    }

    protected function splitUrl($url)
    {
        return explode('/',$url,4);
    }

    public static function Redirect($path)
    {
        $target = CMS_BASE_URI;
        if (strtolower($path) == "home")
        {
            header("Location: {$target}");
            return true;
        }
        header("Location: {$path}");
        return true;
    }

}

?>