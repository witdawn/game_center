<?php

namespace App\Http\Requests;

use App\Exceptions\GeneralException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

abstract class Request extends FormRequest
{

    /**
     * 自动认证失败
     *
     * @throws GeneralException
     */
    protected function failedAuthorization()
    {
        throw new GeneralException('验证失败!', 200);
    }

    /**
     *
     * @param Validator $validator
     *
     * @throws HttpResponseException
     */
    protected function failedValidation(Validator $validator)
    {
        $message = '';
        foreach ($validator->getMessageBag()->getMessages() as $key => $val) {
            $message .= $val[0].' , ';
        }
        $jsonData = [
            'msg'  => $message,
            'data' => [],
            'code' => 203
        ];
        $header = ['Access-Control-Allow-Origin' => '*'];
        $options = JSON_UNESCAPED_UNICODE;
        throw new HttpResponseException(response()->json($jsonData, 200, $header, $options));
    }

    public function initRequest($params, $key = null)
    {
        if (!$key) {
            $keyInfo = $this->all();
        } else {
            if (!$this->$key)
                $keyInfo = [];
            else
                $keyInfo = $this->$key;
        }
        foreach ($params as $keyname => $value) {
            if (!isset($keyInfo[$keyname])) {
                if ($key)
                    $keyInfo = array_merge($keyInfo, [$keyname => $value]);
                else
                    $this->offsetSet($keyname, $value);
            }
        }
        if ($key)
            $this->offsetSet($key, $keyInfo);
    }
}
