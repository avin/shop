<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

abstract class ApiController extends Controller
{

    /**
     * Generates result response object
     *
     * @param mixed  $data
     * @param string $message
     *
     * @return array
     */
    protected static function makeApiResult($data, $message)
    {
        $result = array();
        $result['flag'] = true;
        $result['message'] = $message;
        $result['data'] = $data;
        return $result;
    }

    /**
     * Generates paginate result response object
     * @param $paginateElements
     * @param $message
     * @return mixed
     */
    protected static function makeApiPaginateResult($paginateElements, $message)
    {
        $result = $paginateElements->toArray();
        $result['flag'] = true;
        $result['message'] = $message;
        return $result;
    }

    /**
     * Generates error response object
     *
     * @param int    $errorCode
     * @param string $message
     * @param mixed  $data
     *
     * @return array
     */
    protected static function makeApiError($errorCode, $message, $data = array())
    {
        $error = array();
        $error['flag'] = false;
        $error['message'] = $message;
        $error['code'] = $errorCode;
        if(!empty($data))
            $error['data'] = $data;
        return $error;
    }

}
