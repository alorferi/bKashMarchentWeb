<?php

namespace App\Business;

use App\Models\ActivityLog;
use App\Utils\LogWrite;
use DateTime;
use Illuminate\Support\Facades\Log;

class SmsManager
{
    private $username;
    private $password;
    private $sid;
    private $lng;

    public function __construct($username, $password, $sid, $lng)
    {
        $this->username = $username;
        $this->password = $password;
        $this->sid = $sid;
        $this->lng = $lng;
    }

    public function convertBanglaToUnicode($BanglaText)
    {
        $unicodeBanglaTextForSms = strtoupper(bin2hex(iconv('UTF-8', 'UCS-2BE', $BanglaText)));
        return $unicodeBanglaTextForSms;
    }

    public function sendSms($mobileNumber, $message)
    {
        if (strpos($mobileNumber, '+') === 0) {
            $mobileNumber = substr($mobileNumber, 1);
        }
        LogWrite::info("OTC", __CLASS__, __FUNCTION__, __LINE__, $mobileNumber, $message);
        if ($this->lng == 'bn') {
            $message = $this->convertBanglaToUnicode($message);
        }
        LogWrite::info("OTC", __CLASS__, __FUNCTION__, __LINE__, $mobileNumber, $message);
        $url = "http://sms.sslwireless.com/pushapi/dynamic/server.php?user=$this->username&pass=$this->password&sid=$this->sid&sms=" . urlencode($message) . "&msisdn=$mobileNumber&csmsid=" . (new DateTime())->getTimestamp();
        $curl = curl_init();
        curl_setopt_array($curl, [CURLOPT_RETURNTRANSFER => 1
                , CURLOPT_URL => $url
                , CURLOPT_USERAGENT => 'Request from Alor Feri']);
        $respXMLData = curl_exec($curl);
        curl_close($curl);

        $xmlObj = simplexml_load_string($respXMLData); // Interprets a string of XML into an object

        $xmlObj->SMSINFO->SMSTEXT = ""; // Make Empty SMSTEXT

        $json_string = json_encode($xmlObj); // object to String

        ActivityLog::addToLog(__CLASS__, __FUNCTION__, __LINE__, null, $json_string);

        if ($xmlObj) {
            return $xmlObj->SMSINFO->REFERENCEID;
        } else {
            return false;
        }
    }
}
