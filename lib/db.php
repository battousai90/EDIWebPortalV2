<?php
if (!isset($_SESSION)) {
    session_start();
}

class DB extends PDO{
    private $serverName;
    private $user;
    private $password;
    private $database;

    public function __construct($envid = NULL)
    {
        switch ($envid)
        {
    	    case "1": //CWE Harvest production
            {
                $this->user = "dataexchanger";
                $this->password = "3tbz6nzs";
                $this->serverName = "WWMRSDEX01";
                $this->database = "DEXV8_CWE_PRD";
                break;
            }
        case "19": //CWE Harvest pré-production
            {
                $this->user = "dataexchanger";
                $this->password = "3tbz6nzs";
                $this->serverName = "10.0.1.86";
                $this->database = "DEXV8_ERP_WMS_PRV";
                break;
            }
        case "2": //CWE Harvest qualité
            {
                $this->user = "dataexchanger";
                $this->password = "3tbz6nzs";
                $this->serverName = "WWMRSDEX01";
                $this->database = "DEXV8_CWE_QUA";
                break;
            }
    	case "3": //CWE Other
            {
                $this->user = "dataexchanger";
                $this->password = "3tbz6nzs";
                $this->serverName = "10.0.1.86";
                $this->database = "DEXV8_OTHERS";
                break;
            }
        case "4": //CWE HID production
            {
                $this->user = "dataexchanger";
                $this->password = "3tbz6nzs";
                $this->serverName = "10.0.1.86";
                $this->database = "DEXV8_HID_PRD";
                break;
            } 
        case "6": //CWE HID qualité
            {
                $this->user = "dataexchanger";
                $this->password = "3tbz6nzs";
                $this->serverName = "10.0.1.86";
                $this->database = "DEXV8_HID_QUA2";
                break;
            } 
        case "7": //HK SAP production
            {
                $this->user = "dataexchanger";
                $this->password = "3tbz6nzs";
                $this->serverName = "10.48.20.64";
                $this->database = "DEXV8_HKG_PRD2";
                break;
            } 
        case "8": //HK SAP qualité
            {
                $this->user = "dataexchanger";
                $this->password = "3tbz6nzs";
                $this->serverName = "10.48.20.64";
                $this->database = "DEXV8_HKG_QUA";
                break;
            } 
        case "9": //US SAP production
            {
                $this->user = "dataexchangersap";
                $this->password = "3tbz6nzs";
                $this->serverName = "10.39.8.194";
                $this->database = "DEXV8_US_PRD";
                break;
            } 
        case "10": //US SAP qualité
            {
                $this->user = "dataexchangersap";
                $this->password = "3tbz6nzs";
                $this->serverName = "10.39.8.194";
                $this->database = "DEXV8_US_QUA";
                break;
            } 
        case "11": //CN SAP production
            {
                $this->user = "dataexchanger";
                $this->password = "3tbz6nzs";
                $this->serverName = "10.48.20.64";
                $this->database = "DEXV8_CHINA_PRD2";
                break;
            } 
        case "13": //CN SAP qualité
            {
                $this->user = "dataexchanger";
                $this->password = "3tbz6nzs";
                $this->serverName = "10.48.20.64";
                $this->database = "DEXV8_CHINA_QUA2";
                break;
            } 
        case "15": //BRA Harvest production
            {
                $this->user = "dataexchangersapbra";
                $this->password = "3tbz6nzs";
                $this->serverName = "10.39.8.194";
                $this->database = "DEXV8_BRAZIL_PRD2";
                break;
            }
        case "16": //BRA Harvest qualité
            {
                $this->user = "dataexchangersapbra";
                $this->password = "3tbz6nzs";
                $this->serverName = "10.39.8.194";
                $this->database = "DEXV8_BRAZIL_QUA2";
                break;
            }
        case "17": //JAP Harvest production
            {
                $this->user = "dataexchanger";
                $this->password = "3tbz6nzs";
                $this->serverName = "10.48.20.64";
                $this->database = "DEXV8_JAPAN_PRD2";
                break;
            }
        case "18": //JAP Harvest qualité
            {
                $this->user = "dataexchanger";
                $this->password = "3tbz6nzs";
                $this->serverName = "10.48.20.64";
                $this->database = "DEXV8_JAPAN_QUA2";
                break;
            }
        case "14":
            {
                $this->user = "edi";
                $this->password = "magic";
                $this->serverName = "EUMSQIBQ11";
                $this->database = "magicxpi";
                break;
            }
        case "22":
            {
                $this->user = "dex_nav";
                $this->password = "7kcE#bkc";
                $this->serverName = "10.48.20.53";
                $this->database = "DEXV8_ERP_NAV_PRD";
                break;
            }
        case "24":
            {
                $this->user = "dataexchanger";
                $this->password = "3tbz6nzs";
                $this->serverName = "10.3.69.150";
                $this->database = "DEXV8_CWE_QUA";
                break;
            }
        case "25":
            {
                $this->user = "dataexchanger";
                $this->password = "3tbz6nzs";
                $this->serverName = "EUPGDSQLP021.eu.loi.net";
                $this->database = "DEXV8_CWE_PRD";
                break;
            }
        case "26":
            {
                $this->user = "dataexchanger";
                $this->password = "3tbz6nzs";
                $this->serverName = "EUPGDSQLP021.eu.loi.net";
                $this->database = "DEXV8_NOSAP_PRD";
                break;
            }
        default:
            {
                $this->user = "dataexchanger";
                $this->password = "3tbz6nzs";
                $this->serverName = "EUPGDSQLP021.eu.loi.net";
                $this->database = "EDI_WebPortal";
                break;
            }
        } 

        try {

        parent::__construct('sqlsrv:Server='.$this->serverName.';Database='.$this->database.'', $this->user, $this->password);
        $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        }catch (Exception $e){
	        echo 'Is not possible to connect to the database';
	        echo'<br>';
	        echo $e->getMessage();
	        die();
        }
    }
}	
?>