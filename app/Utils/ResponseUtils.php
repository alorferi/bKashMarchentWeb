<?php

namespace App\Utils;

use Symfony\Component\HttpFoundation\Response;

class ResponseUtils
{

    public const MSG_STATUS_OK = "OK";
    public const MSG_STATUS_FAILED = "FAILED";
    public const MSG_STATUS_NOT_FOUND = "NOT_FOUND";
    public const MSG_STATUS_OTC_GENERATED = "OTC_GENERATED";
    public const MSG_STATUS_OTC_REJECTED = "OTC_REJECTED";


    public static function result($data, $message, $status)
    {
        $result =  [
            'status' => $status,
            'message' => $message,
            'data' => $data
        ];
        return $result;
    }

    private static function errorResult($errors=null,$message=null,$status=null)
    {
        $result =  [
            'status' => $status,
            'message' => $message,
            'errors' => $errors
        ];
        return $result;
    }


    private static function unset(&$result){

        foreach($result as $k=>$v){
            if($v==null){
                unset($result[$k]);
            }
        }

        return $result;
    }

    public static function foundItems($list)
    {
        return count($list) . " Item(s) found.";
    }

    public static function ok($data = null,string $message = null,$status=ResponseUtils::MSG_STATUS_OK)
    {
        $result = ResponseUtils::result($data, $message, $status);
        ResponseUtils::unset($result);
        return response()->json($result, Response::HTTP_OK);
    }

    public static function failed(string $message = null)
    {
        $result = ResponseUtils::result(null, $message, ResponseUtils::MSG_STATUS_FAILED);
        ResponseUtils::unset($result);
        return response()->json($result, Response::HTTP_OK);
    }

    public static function okMessage(string $message)
    {
        $result = ResponseUtils::result(null, $message, ResponseUtils::MSG_STATUS_OK);
        ResponseUtils::unset($result);
        return response()->json($result, Response::HTTP_OK);
    }

    public static function notFound(string $message)
    {
        $result = ResponseUtils::result(null, $message,null);
        ResponseUtils::unset($result);
        return response()->json($result, Response::HTTP_NOT_FOUND);
    }


    public static function unProcessableEntity($errors = null,string $message = null)
    {
        $result = ResponseUtils::errorResult($errors,$message, null);
        ResponseUtils::unset($result);
        return response()->json($result, Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public static function unProcessableEntityMessage(string $message)
    {
       return ResponseUtils::unProcessableEntity(null,$message);
    }

    public static function unauthorized(string $message)
    {
        $result = ResponseUtils::result(null, $message,null);
        ResponseUtils::unset($result);
        return response()->json($result, Response::HTTP_UNAUTHORIZED);
    }

    public static function forbidden(string $message)
    {
        $result = ResponseUtils::result(null, $message, null);
        ResponseUtils::unset($result);
        return response()->json($result, Response::HTTP_FORBIDDEN);
    }

    public static function badRequest(string $message)
    {
        $result = ResponseUtils::result(null, $message, null);
        ResponseUtils::unset($result);
        return response()->json($result, Response::HTTP_BAD_REQUEST);
    }

    public static function json($data)
    {
        return response()->json($data, Response::HTTP_OK);
    }

    public static function noContent()
    {
        $result = ResponseUtils::result(null,null,null);
        ResponseUtils::unset($result);
        return response()->json($result, Response::HTTP_NO_CONTENT);
    }

    public static function accepted( $data=null,string $message,$status=null)
    {
        $result = ResponseUtils::result($data, $message, $status);
        return response()->json($result, Response::HTTP_ACCEPTED);
    }

    public static function created($data=null, string $message=null, $status=ResponseUtils::MSG_STATUS_OK)
    {
        $result = ResponseUtils::result($data, $message, $status);
        return response()->json($result, Response::HTTP_CREATED);
    }
}
