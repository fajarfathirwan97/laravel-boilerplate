<?php
namespace App\Traits;

trait ResponseTraits{

    protected function getStatusCode($statusCode)
    {
        switch ($statusCode) {
            case 100:
                $message = ['message'=>'continue'];
                break;
            case 101:
                $message = ['message'=>'switching protocols'];
                break;
            case 102:
                $message = ['message'=>'processing'];
                break;
            case 200:
                $message = ['message'=>'ok'];
                break;
            case 201:
                $message = ['message'=>'created'];
                break;
            case 202:
                $message = ['message'=>'accepted'];
                break;
            case 203:
                $message = ['message'=>'non-authorative infromation'];
                break;
            case 204:
                $message = ['message'=>'no content'];
                break;
            case 205:
                $message = ['message'=>'reset content'];
                break;
            case 206:
                $message = ['message'=>'partial content'];
                break;
            case 207:
                $message = ['message'=>'multi-status'];
                break;
            case 208:
                $message = ['message'=>'already reported'];
                break;
            case 226:
                $message = ['message'=>'IM used'];
                break;
            case 300:
                $message = ['message'=>'multiple choices'];
                break;
            case 301:
                $message = ['message'=>'move permanently'];
                break;
            case 302:
                $message = ['message'=>'found'];
                break;
            case 303:
                $message = ['message'=>'see other'];
                break;
            case 304:
                $message = ['message'=>'not modified'];
                break;
            case 305:
                $message = ['message'=>'use proxy'];
                break;
            case 306:
                $message = ['message'=>'switch proxy'];
                break;
            case 307:
                $message = ['message'=>'temporary redirect'];
                break;
            case 308:
                $message = ['message'=>'permanent redirect'];
                break;
            case 400:
                $message = ['message'=>'bad request'];
                break;
            case 401:
                $message = ['message'=>'unauthorized'];
                break;
            case 402:
                $message = ['message'=>'payment required'];
                break;
            case 403:
                $message = ['message'=>'forbidden'];
                break;
            case 404:
                $message = ['message'=>'not found'];
                break;
            case 405:
                $message = ['message'=>'method not allowed'];
                break;
            case 406:
                $message = ['message'=>'not acceptable'];
                break;
            case 422:
                $message = ['message'=>'unprocessable entity'];
                break;
            case 500:
                $message = ['message'=>'internal server error'];
                break;
            case 501:
                $message = ['message'=>'not implemented'];
                break;
            case 502:
                $message = ['message'=>'bad gateway'];
                break;
            case 503:
                $message = ['message'=>'service unavailable'];
                break;
                
        }
        return array_merge($message,['statusCode'=>$statusCode]);
    }
    /**
     * Return Response Template
     *
     * Return template with header code
     *
     * @param Integer $statusCode
     * @param Mixed $body
     * @return response json
     **/
    public function returnResponse($statusCode,$body = [])
    {
        return response()->json([
            'meta' => array_merge($this->getStatusCode($statusCode),['status'=>$statusCode >= 400 ? 'fail' : 'success']),
            'body' => [
                'content' => $body
            ]
            ],$statusCode);
    }
     /**
     * Return Response Template for select2
     *
     * @param Integer $statusCode
     * @param Mixed $body
     * @return response json
     **/
    public function returnResponseSelect2($statusCode,$body = [])
    {
        return response()->json(['results' => $body],$statusCode);
    }
}