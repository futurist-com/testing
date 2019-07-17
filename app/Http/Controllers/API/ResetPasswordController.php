<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Model\PasswordReset;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\library\Helpers\Helper;
use Carbon\Carbon;
use App\Notifications\EmailResetPasswordNotification;

class ResetPasswordController extends Controller
{
    //
    use ResetsPasswords;
    /**
     * send from mail code for verification user
     * @string request->email 
     * @return  status 200 
     */
    public function sendPasswordResetLink(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
        ]);
        $user = User::whereEmail(request('email'))->first();
        if (!$user) {
            return response()->json([
                'message' => "Учетной записи не найденно.",
                'status' => 422
            ], 422);
        } else {
            //$resetPass=$user->passReset();
            if (!$resetPass = $user->passReset) {
                $resetPass = new PasswordReset();
            }
            $code = Helper::generatePIN(8);
            $resetPass->email = request('email');
            $resetPass->token = bcrypt(str_random(30));
            $resetPass->created_at = Carbon::now();
            $resetPass->code = bcrypt($code);
            $resetPass->save();
            $user->notify(new EmailResetPasswordNotification($code));

            return response()->json([
                'message' => "На вашу почту отправленно письмо с кодом подтверждения. Введите код.",
                'status' => 200,
            ], 200);
        }
    }
    /**
     * check code for reset password
     * @
     * @return code 200 and token 
     */
    public function checkCodeResetPassword(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'code' => 'required'
        ]);
        $passReset = PasswordReset::where('email', '=', request('email'))->first();
        if ($passReset) {
            if (\Hash::check(request('code'), $passReset->code)) {
                $token = str_random(30);
                $passReset->token = bcrypt($token);
                $passReset->save();
                return response()->json([
                    'message' => 'Код подтвержден. Введите новый пароль.',
                    'token' => $token,
                    'status' => 200
                ], 200);
            }
            return response()->json([
                'message' => 'Не верный код.',
                'status' => 422
            ], 422);
        }
    }
    /**
     * update password 
     */
    public function callResetPassword(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'token' => 'required'
        ]);
        $passReset = PasswordReset::whereEmail($request->email)->first();
        if ($passReset) {
            if (\Hash::check($request->token, $passReset->token)) {
                $user = User::whereEmail($request->email)->first();
                $user->password = \Hash::make($request->password);
                $user->save();
                $passReset->delete();
                return response()->json([
                    'message' => 'Пароль изменнен.',
                    'status' => 200
                ], 200);
            }
        }
        return response()->json([
            'message' => 'Запрос на изменения пароля не верен.  Обратитесь в службу поддержки.',
            'status' => 422
        ], 422);
    }
}
