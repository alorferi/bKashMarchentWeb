<?php

namespace App\Business;

use App\Models\ActivityLog;
use App\Models\Otc;
use App\Models\OtcType;
use App\Models\User;
use App\Utils\MobileNumberUtils;
use App\Utils\OtcEnv;
use App\Utils\ResponseUtils;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class OtcManager
{
    private $smsManager;

    public function __construct()
    {
        $username = OtcEnv::sslWirelessUsername();
        $password = OtcEnv::sslWirelessPassword();
        $sid = OtcEnv::sslWirelessSidBn();

        $this->smsManager = new SmsManager($username, $password, $sid, 'bn');
    }


    public function generateOtc($username, $otcTypeName)
    {
        ActivityLog::addToLog(__CLASS__, __FUNCTION__, __LINE__);

        $otc = Otc::where(function ($query) use ($username) {
            $query->where('username', $username);
        })
            ->where('expired_at', '>', Carbon::now())
            ->whereNull('verified_at')
            ->orderBy("created_at", "DESC")
            ->first();

        $otc_expired_after_in_minutes = OtcEnv::otcExpiredAfterInMinutes();

        $expireObject = ['otc_expired_after_in_seconds' => $otc_expired_after_in_minutes * 60];

        if (MobileNumberUtils::isValidMobileNumber($username, "BD")) {
            $expireObject = array_merge($expireObject, ['username' => $username]);
        } else {
            $expireObject = array_merge($expireObject, ['username' => $username]);
        }

        if ($otc == null) {
            $otc = new Otc();

            if (MobileNumberUtils::isValidMobileNumber($username, "BD")) {
                $otc->username = $username;
            } else {
                $otc->username = $username;
            }

            $otc->ot_code = mt_rand(100000, 999999);
            $otcType = OtcType::where("name", $otcTypeName)->first();

            if ($otcType == null) {
                return ResponseUtils::unProcessableEntity(null, "OTC Type is not available.");
            }

            $otc->otc_type_id = $otcType->id;
            $otc->for_whom = Auth::id();

            // get the current time
            $currentTime = Carbon::now();

            $otc->expired_at = $currentTime->addMinutes($otc_expired_after_in_minutes); // add otc_expired_after_in_minutes minutes to the current time
            $otc->save();

            $sentResult = false;

            if (MobileNumberUtils::isValidMobileNumber($username, "BD")) {
                //Send SMS
                $test_login_user_id  = env('TEST_LOGIN_USER_ID', null);

                if ($test_login_user_id == $username && $otcTypeName = "RESET_PASSWORD") {
                    $sentResult = true;
                } else {
                    $sentResult = $this->sendSms($otc);
                }
            } else {
                // Send Email
                $sentResult = $this->sendEmail($otc);
            }


            if ($sentResult) {
                $expireObject = array_merge($expireObject, ['sms_sent_at' => $otc->sent_at,'sent_at' => $otc->sent_at]);
                return ResponseUtils::ok($expireObject, "OTC generated & sent.", ResponseUtils::MSG_STATUS_OTC_GENERATED);
            } else {
                return ResponseUtils::unProcessableEntity(null, "Failed to send OTC");
            }
        } else {
            $expireInSeconds = $otc->expired_at->diffInSeconds(Carbon::now());
            $expireObject = array_merge($expireObject, ['sms_sent_at' => $otc->sent_at,'sent_at' => $otc->sent_at]);
            $expireObject = array_merge($expireObject, ['otc_expired_after_in_seconds' => $expireInSeconds]);

            return ResponseUtils::ok($expireObject, "OTC already generated & sent.", ResponseUtils::MSG_STATUS_OTC_GENERATED);
        }
    }

    public function generateOtcForMobile($mobile, $otcTypeName)
    {
        ActivityLog::addToLog(__CLASS__, __FUNCTION__, __LINE__);

        $otc = Otc::where('mobile', $mobile)
            ->where('expired_at', '>', Carbon::now())
            ->whereNull('verified_at')
            ->orderBy("created_at", "DESC")
            ->first();

        $otc_expired_after_in_minutes = OtcEnv::otcExpiredAfterInMinutes();

        $expireObject = ['otc_expired_after_in_seconds' => $otc_expired_after_in_minutes * 60, 'mobile' => $mobile];

        if ($otc == null) {
            $otc = new Otc();
            $otc->mobile = $mobile;
            $otc->ot_code = mt_rand(100000, 999999);
            $otcType = OtcType::where("name", $otcTypeName)->first();

            if ($otcType == null) {
                return ResponseUtils::unProcessableEntity(null, "OTC Type is not available.");
            }

            $otc->otc_type_id = $otcType->id;
            $otc->for_whom = Auth::id();

            // get the current time
            $currentTime = Carbon::now();

            $otc->expired_at = $currentTime->addMinutes($otc_expired_after_in_minutes); // add otc_expired_after_in_minutes minutes to the current time
            $otc->save();

            $test_login_user_id  = env('TEST_LOGIN_USER_ID', null);

            if ($test_login_user_id == $mobile && $otcTypeName = "RESET_PASSWORD") {
                $sentResult = true;
            } else {
                $sentResult = $this->sendSms($otc);
            }

            if ($sentResult) {
                $expireObject = array_merge($expireObject, ['sms_sent_at' => $otc->sent_at]);
                // LogWrite::info("OTC",json_encode($expireObject));
                return ResponseUtils::ok($expireObject, "OTC generated & sent.", ResponseUtils::MSG_STATUS_OTC_GENERATED);
            } else {
                return ResponseUtils::unProcessableEntity(null, "Failed to send OTC sms.");
            }
        } else {
            $expireInSeconds = $otc->expired_at->diffInSeconds(Carbon::now());
            $expireObject = array_merge($expireObject, ['sms_sent_at' => $otc->sent_at]);
            $expireObject = array_merge($expireObject, ['otc_expired_after_in_seconds' => $expireInSeconds]);

            return ResponseUtils::ok($expireObject, "OTC already generated & sent.", ResponseUtils::MSG_STATUS_OTC_GENERATED);
        }
    }


    public function generateOtcForEmail($email, $otcTypeName)
    {
        ActivityLog::addToLog(__CLASS__, __FUNCTION__, __LINE__);

        $otc = Otc::where('email', $email)
            ->where('expired_at', '>', Carbon::now())
            ->whereNull('verified_at')
            ->orderBy("created_at", "DESC")
            ->first();

        $otc_expired_after_in_minutes = OtcEnv::otcExpiredAfterInMinutes();

        $expireObject = ['otc_expired_after_in_seconds' => $otc_expired_after_in_minutes * 60, 'email' => $email];

        if ($otc == null) {
            $otc = new Otc();
            $otc->email = $email;
            $otc->ot_code = mt_rand(100000, 999999);
            $otcType = OtcType::where("name", $otcTypeName)->first();

            if ($otcType == null) {
                return ResponseUtils::unProcessableEntity(null, "OTC Type is not available.");
            }

            $otc->otc_type_id = $otcType->id;
            $otc->for_whom = Auth::id();

            // get the current time
            $currentTime = Carbon::now();

            $otc->expired_at = $currentTime->addMinutes($otc_expired_after_in_minutes); // add otc_expired_after_in_minutes minutes to the current time
            $otc->save();

            $sentResult = $this->sendEmail($otc);

            if ($sentResult) {
                $expireObject = array_merge($expireObject, ['sms_sent_at' => $otc->sent_at]);
                // LogWrite::info("OTC",json_encode($expireObject));
                return ResponseUtils::ok($expireObject, "OTC generated & sent.", ResponseUtils::MSG_STATUS_OTC_GENERATED);
            } else {
                return ResponseUtils::unProcessableEntity(null, "Failed to send OTC sms.");
            }
        } else {
            $expireInSeconds = $otc->expired_at->diffInSeconds(Carbon::now());
            $expireObject = array_merge($expireObject, ['sms_sent_at' => $otc->sent_at]);
            $expireObject = array_merge($expireObject, ['otc_expired_after_in_seconds' => $expireInSeconds]);

            return ResponseUtils::ok($expireObject, "OTC already generated & sent.", ResponseUtils::MSG_STATUS_OTC_GENERATED);
        }
    }


    public function verifyOtc($username, $otCode, $otcTypeName)
    {
        ActivityLog::addToLog(__CLASS__, __FUNCTION__, __LINE__);

        if ($otCode == null) {
            return ResponseUtils::result(null, "OTC required", ResponseUtils::MSG_STATUS_FAILED);
        }

        $otc = Otc::where(function ($query) use ($username) {
            $query->where('username', $username);
        }) ->whereHas("otcType", function ($query) use ($otcTypeName) {
            $query->where("otc_types.name", $otcTypeName);
        })
            ->whereNull('verified_at')
            ->orderBy('created_at', "DESC")
            ->first();


        if ($otc) {
            if ($otc->expired_at->lt(Carbon::now())) {
                return ResponseUtils::result(null, "OTC Expired, Try Again", ResponseUtils::MSG_STATUS_FAILED);
            }

            if ($otc->ot_code != $otCode) {
                $expireObject = ['username' => $username];

                if (MobileNumberUtils::isValidMobileNumber($username, "BD")) {
                    $expireObject = array_merge($expireObject, ['mobile' => $username]);
                } else {
                    $expireObject = array_merge($expireObject, ['email' => $username]);
                }

                $expireInSeconds = $otc->expired_at->diffInSeconds(Carbon::now());

                $expireObject = array_merge($expireObject, ['otc_expired_after_in_seconds' => $expireInSeconds]);

                return ResponseUtils::result($expireObject, "Wrong OTC, Please type correct OTC", ResponseUtils::MSG_STATUS_OTC_REJECTED);
            }

            switch ($otcTypeName) {

                case OtcType::K_SHOW_MY_SUBSCRIPTIONS:

                case OtcType::K_REGISTER_USER:
                    $otc->verified_at = Carbon::now();
                    $otc->save();
                    return ResponseUtils::result(null, "OTC Verified", ResponseUtils::MSG_STATUS_OK);
                    break;

                default:
                    return ResponseUtils::result(null, "Invalid Attempt", ResponseUtils::MSG_STATUS_FAILED, );
                    break;
            }

        }

    }

    public function verifyOtcForMobile($mobile, $otCode, $otcTypeName)
    {
        ActivityLog::addToLog(__CLASS__, __FUNCTION__, __LINE__);

        if ($otCode == null) {
            return ResponseUtils::result(null, "OTC required", ResponseUtils::MSG_STATUS_FAILED);
        }

        $otc = Otc::where(function ($query) use ($mobile, $otcTypeName) {
            $query->where('mobile', $mobile)
                ->whereHas("otcType", function ($query) use ($otcTypeName) {
                    $query->where("otc_types.name", $otcTypeName);
                })

                ->whereNull('verified_at');
        })
            ->orderBy('created_at', "DESC")
            ->first();

        if ($otc) {
            if ($otc->expired_at->lt(Carbon::now())) {
                return ResponseUtils::result(null, "OTC Expired, Try Again", ResponseUtils::MSG_STATUS_FAILED);
            }

            if ($otc->ot_code != $otCode) {
                $expireObject = ['mobile' => $mobile];

                $expireInSeconds = $otc->expired_at->diffInSeconds(Carbon::now());

                $expireObject = array_merge($expireObject, ['otc_expired_after_in_seconds' => $expireInSeconds]);

                return ResponseUtils::result($expireObject, "Wrong OTC, Please type correct OTC", ResponseUtils::MSG_STATUS_OTC_REJECTED);
            }

            // Generate token if user exists else return true
            $user = User::where('mobile', $mobile)->first();

            if ($user) {
                $otc->verified_at = Carbon::now();
                $otc->save();

                $token = $user->createToken('verified-otc', [$otcTypeName])->accessToken;

                return ResponseUtils::result($token, "OTC Verified & Token generated", ResponseUtils::MSG_STATUS_OK);
            } elseif ($otcTypeName == OtcType::K_REGISTER_USER) {
                $otc->verified_at = Carbon::now();
                $otc->save();
                return ResponseUtils::result(null, "OTC Verified", ResponseUtils::MSG_STATUS_OK);
            } else {
                return ResponseUtils::result(null, "Invalid Attempt", ResponseUtils::MSG_STATUS_FAILED, );
            }
        } else {
            return ResponseUtils::result(null, "Invalid Attempt", ResponseUtils::MSG_STATUS_FAILED);
        }
    }

    public function verifyOtcForEmail($email, $otCode, $otcTypeName)
    {
        ActivityLog::addToLog(__CLASS__, __FUNCTION__, __LINE__);

        if ($otCode == null) {
            return ResponseUtils::result(null, "OTC required", ResponseUtils::MSG_STATUS_FAILED);
        }

        $otc = Otc::where(function ($query) use ($email, $otcTypeName) {
            $query->where('email', $email)
                ->whereHas("otcType", function ($query) use ($otcTypeName) {
                    $query->where("otc_types.name", $otcTypeName);
                })

                ->whereNull('verified_at');
        })
            ->orderBy('created_at', "DESC")
            ->first();

        if ($otc) {
            if ($otc->expired_at->lt(Carbon::now())) {
                return ResponseUtils::result(null, "OTC Expired, Try Again", ResponseUtils::MSG_STATUS_FAILED);
            }

            if ($otc->ot_code != $otCode) {
                $expireObject = ['email' => $email];

                $expireInSeconds = $otc->expired_at->diffInSeconds(Carbon::now());

                $expireObject = array_merge($expireObject, ['otc_expired_after_in_seconds' => $expireInSeconds]);

                return ResponseUtils::result($expireObject, "Wrong OTC, Please type correct OTC", ResponseUtils::MSG_STATUS_OTC_REJECTED);
            }

            // Generate token if user exists else return true
            $user = User::where('email', $email)->first();

            if ($user) {
                $otc->verified_at = Carbon::now();
                $otc->save();

                $token = $user->createToken('verified-otc', [$otcTypeName])->accessToken;

                return ResponseUtils::result($token, "OTC Verified & Token generated", ResponseUtils::MSG_STATUS_OK);
            } elseif ($otcTypeName == OtcType::K_REGISTER_USER) {
                $otc->verified_at = Carbon::now();
                $otc->save();
                return ResponseUtils::result(null, "OTC Verified", ResponseUtils::MSG_STATUS_OK);
            } else {
                return ResponseUtils::result(null, "Invalid Attempt", ResponseUtils::MSG_STATUS_FAILED, );
            }
        } else {
            return ResponseUtils::result(null, "Invalid Attempt", ResponseUtils::MSG_STATUS_FAILED);
        }
    }

    public function sendSms(Otc $otc)
    {
        $disabled_otc_sms = OtcEnv::disabledOtcSms();

        if ($disabled_otc_sms) {
            return true;
        }

        $mobile = explode("#", $otc->mobile)[0];

        $sms = str_replace("#", $otc->ot_code, $otc->otcType->sms_template);

        $sentStatus = $this->smsManager->sendSms($mobile, $sms);

        if ($sentStatus) {
            $otc->sent_at = Carbon::now();
            $otc->sent_by_user_id = Auth::id();
            $otc->save();
        }

        return $sentStatus;
    }

    public function sendEmail(Otc $otc)
    {
        try {
            $email_subject = $otc->otcType->email_subject_template;
            $email_body = str_replace("#", $otc->ot_code, $otc->otcType->email_body_template);

            $details = [
                'title' =>  $email_subject,
                'body' => $email_body
            ];

            \Mail::to($otc->email)->send(new \App\Mail\OtcMail($details));

            $otc->sent_at = Carbon::now();
            $otc->sent_by_user_id = Auth::id();
            $otc->save();

            return true;
        } catch(Exception $e) {
            return false;
        }
    }
}
