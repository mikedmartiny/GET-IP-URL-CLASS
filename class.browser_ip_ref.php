<?php
    class browser_ip_ref{
    	
    	private $_db;
    	private $_ip;
    	private $_url;
        private $_yurl;
        private $agent = "";
        private $info = array();

        public function __construct($db){
            $this->_db = $db;

            if(isset($_SERVER["REMOTE_ADDR"])) {
    			$this->_ip = ip2long($_SERVER["REMOTE_ADDR"]);
    		} elseif(!empty($_SERVER['HTTP_CLIENT_IP'])) {
    			$this->_ip = ip2long($_SERVER['HTTP_CLIENT_IP']);
    		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    			$this->_ip = ip2long($_SERVER['HTTP_X_FORWARDED_FOR']);
    		} else {
    			$this->_ip = 'IP address error.';
    		}

            if (!empty($_SERVER['HTTP_REFERER'])) {
            	$this->_url = $_SERVER['HTTP_REFERER'];
            } else {
            	$this->_url = 'bookmarked';
            }

            $this->yurl = $_SERVER['REQUEST_URI'];
            $this->agent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : NULL;
            $this->getBrowser();
        }

         function getBrowser(){
            $browser = array("Navigator"            => "/Navigator(.*)/i",
                             "Firefox"              => "/Firefox(.*)/i",
                             "Internet Explorer"    => "/MSIE(.*)/i",
                             "Google Chrome"        => "/chrome(.*)/i",
                             "MAXTHON"              => "/MAXTHON(.*)/i",
                             "Opera"                => "/Opera(.*)/i",
                             );
            foreach($browser as $key => $value){
                if(preg_match($value, $this->agent)){
                    $this->info = array_merge($this->info,array("Browser" => $key));
                    $this->info = array_merge($this->info,array(
                      "Version" => $this->getVersion($key, $value, $this->agent)));
                    break;
                }else{
                    $this->info = array_merge($this->info,array("Browser" => "UnKnown"));
                    $this->info = array_merge($this->info,array("Version" => "UnKnown"));
                }
            }
            return $this->info['Browser'];
        }

        function getVersion($browser, $search, $string){
            $browser = $this->info['Browser'];
            $version = "";
            $browser = strtolower($browser);
            preg_match_all($search,$string,$match);
            switch($browser){
                case "firefox": $version = str_replace("/","",$match[1][0]);
                break;

                case "internet explorer": $version = substr($match[1][0],0,4);
                break;

                case "opera": $version = str_replace("/","",substr($match[1][0],0,5));
                break;

                case "navigator": $version = substr($match[1][0],1,7);
                break;

                case "maxthon": $version = str_replace(")","",$match[1][0]);
                break;

                case "google chrome": $version = substr($match[1][0],1,10);
            }
            return $version;
        }

        function insertInfo($pageID){
        	$country_code = $this->_db->query("SELECT `ci` from `ip` WHERE ".$this->_ip." BETWEEN `start` AND `end`");
            $country_code = $country_code->fetch_array(MYSQLI_ASSOC);
            $countryID = $country_code['ci'];

            $ipCount = $this->_db->query("SELECT * from `hit_counter_info` WHERE `longIP` = ".$this->_ip." AND `pageID` = $pageID");
            $num_rows = $ipCount->num_rows;

            if ($num_rows == 0) {
                $this->_db->query("INSERT INTO `hit_counter_info` (`longIP`,`pageID`,`cc`,`browser`,`version`) VALUES ('".$this->_ip."', '".$pageID."', '".$countryID."', '".$this->info['Browser']."', '".$this->info['Version']."')");
                return true;
            } else {
            	return false;
            }
        }

        function insertRef(){
            if ($this->_url == "bookmarked") {
                $this->_db->query("UPDATE `hit_counter_referrers` SET `ref_count` = ref_count + 1 WHERE `ref_url` = 'bookmark'");
            } else {
                $url_parts = parse_url($this->_url);
                $your_url = parse_url($this->yurl);
                if ($url_parts['host'] != $your_url['host']) {
                    $host_parts = explode( '.', $url_parts['host']);
                    $tld = end($host_parts);
                    $good_tld = array('com','org','edu','uk','net','ca','mil','de','jp','fr','au','us','ru','ch','it','nl','se','no','es','am');

                    if (in_array($tld, $good_tld)) {
                        $rowCount = $this->_db->query("SELECT * from `hit_counter_referrers` WHERE `ref_url` = '".$this->_url."'");
                        $num_rows = $rowCount->num_rows;

                        if ($num_rows == 1) {
                            $this->_db->query("UPDATE `hit_counter_referrers` SET `ref_count` = ref_count + 1 WHERE `ref_url` = '".$this->_url."'");
                            return true;
                        } else {
                            $this->_db->query("INSERT INTO `hit_counter_referrers` (`ref_url`,`ref_count`) VALUES ('".$this->_url."', 1)");
                            return true;
                        } 
                    }
                }
            }
        }
    }
?>