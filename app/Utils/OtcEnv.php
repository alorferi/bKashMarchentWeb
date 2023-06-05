<?php

namespace App\Utils;

class OtcEnv
{


    public static function sslWirelessUsername()
    {
        return env("SSL_WIRELESS_USERNAME");
    }

    public static function sslWirelessPassword()
    {
        return  env("SSL_WIRELESS_PASSWORD");
    }


    public static function sslWirelessSidEn()
    {
        return env("SSL_WIRELESS_SID_EN");
    }

    public static function sslWirelessSidBn()
    {
        return env("SSL_WIRELESS_SID_BN");
    }
    public static function disabledOtcSms()
    {
        return env("DISABLED_OTC_SMS");
    }

    public static function otcExpiredAfterInMinutes()
    {
        return env("OTC_EXPIRED_AFTER_IN_MINUTES");
    }


}
