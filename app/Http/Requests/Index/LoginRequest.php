<?php

namespace App\Http\Requests\Index;

use App\Exceptions\GeneralException;
use App\Extension\QrCode;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     * @throws GeneralException
     */
    public function authorize()
    {
        $qrCode = new QrCode();
        $resCode = $qrCode->check($this->captcha);
        if (!$resCode)
            throw new GeneralException('验证码不正确', 21110);
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username'=>'required',
            'password'=>'required',
        ];
    }

    public function attributes()
    {
        return [
            'username'=>'用户名',
            'password'=>'密码',
        ];
    }
}
