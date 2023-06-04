<?php

namespace App\Utils;

use App\Models\Library;
use App\Models\LibraryMember;
use App\Models\LibraryBook;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;
use Illuminate\Http\Request;
use Exception;

class MobileNumberUtils
{

    public static function formatAFMobileNumber($mobileNumber)
    {

        $mobileNumberParts = explode("#", $mobileNumber);

        $mobileNumber = $mobileNumberParts[0];

        $mobileNumber = MobileNumberUtils::insertDialCode($mobileNumber);

        if( !MobileNumberUtils::isValidMobileNumber($mobileNumber, "BD") ){
            throw new Exception("Mobile number: $mobileNumber is not Bangladeshi format. If you are out of Bangladesh, please try with your email.");
        }

        if (strlen($mobileNumber) >= 10) {

            $kidCode = 0;

            if (sizeof($mobileNumberParts) > 1) {
                $kidCode = $mobileNumberParts[1];
                if ($kidCode > 0 && $kidCode < 10) {
                    $mobileNumber = "$mobileNumber#$kidCode";
                }
            }

            return $mobileNumber;
        } else {
            throw new Exception("Number should be greater than 10 digit long");
        }
    }



    public static function insertDialCode($mobileNumber, $iso_code= "BD")
    {

        if(StringUtils::startsWith($mobileNumber,"+880")){
            return $mobileNumber;
        }

        $mobileNumber = str_replace("-", "", $mobileNumber);
        $mobileNumber = str_replace("-", "", $mobileNumber);


        switch($iso_code){

          case "BD":

                if (strlen($mobileNumber) == 10) {
                    $mobileNumber = "+880$mobileNumber";
                } else if (strlen($mobileNumber) == 11) {
                    $mobileNumber = "+88$mobileNumber";
                }

            break;



        }



        return $mobileNumber;
    }

    public static function  isValidMobileNumber($mobileNumber, $iso_code="*")
    {

        $mobileNumber = str_replace("-", "", $mobileNumber);
        $mobileNumber = str_replace(" ", "", $mobileNumber);

        switch($iso_code){
           case "BD":
                $pattern = "/^(?:\+88|01)?(?:\d{11}|\d{13})$/";
            break;

          default:
                $pattern = "%^(?:(?:\(?(?:00|\+)([1-4]\d\d|[1-9]\d?)\)?)?[\-\.\ \\\/]?)?((?:\(?\d{1,}\)?[\-\.\ \\\/]?){0,})(?:[\-\.\ \\\/]?(?:#|ext\.?|extension|x)[\-\.\ \\\/]?(\d+))?$%i";
                break;

        }

        if (preg_match($pattern, $mobileNumber) && strlen($mobileNumber) >= 10 ) {
            return true;
        } else {
            return false;
        }
    }

}
