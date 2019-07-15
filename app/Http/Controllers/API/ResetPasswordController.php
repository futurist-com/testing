<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Model\PasswordReset;
use Illuminate\Foundation\Auth\ResetsPasswords;
//use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\library\Helpers\Helper;
use Carbon\Carbon;
use App\Notifications\EmailResetPasswordNotification;

//use Illuminate\Support\Facades\Hash;
//use phpseclib\Crypt\Hash;

class ResetPasswordController extends Controller
{
    //
    use ResetsPasswords;

    /*public function callResetPassword(Request $request)
    {
        return $this->reset($request);
    }*/
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
                 'status' => 200
            ], 200);
        }
    }
    public function checkCodeResetPassword(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'code'=>'required|int'
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


    public function callResetPassword(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'token'=>'required'
        ]);
        $passReset = PasswordReset::whereEmail($request->email)->first();
        if ($passReset) {
            //dd($passReset);
            if (\Hash::check($request->token, $passReset->token)) {
                $user = $passReset->user;
                $user->password = bcrypt($request->password);
                //@todo not save password test
                //dd($user);
                $user->save();
                $passReset->delete();
                return response()->json([
                    'message' => 'Password change.',
                    'status' => 200
                ], 200);
            }
        }
        return response()->json([
            'message' => 'Запрос на изменения пароля не верен.  Обратитесь в службу поддержки.',
            'status' => 422
        ], 422);
    }


    protected function resetPassword($user, $password)
    {
        $user->password = \Hash::make($password);
        $user->save();
        event(new PasswordReset($user));
    }
    protected function sendResetResponse(Request $request, $response)
    {
        return response()->json(['message' => 'Password reset successfully.']);
    }
    protected function sendResetFailedResponse(Request $request, $response)
    {
        return response()->json(['message' => 'Failed, Invalid Token.']);
    }
    public function isToken()
    {
        // 
        $tokenHash = \Hash::make(request('token'));
        //$tokenHash=bcrypt(request('token'));
        $tok = "e51b240909633fbba0eec40fd7f9b1f6749c744200b1fc194048b2e9112e8ace";
        $val = Hash::check($tokenHash, $tok);
        dd($val);
        dd($tokenHash);

        $token = DB::table('password_resets')
            ->where('token', bcrypt(request('token')))
            ->first();
        if ($token) {
            return response()->json([
                'message' => 'IsToken true.',
                'status' => 200
            ], 200);
        } else {
            return response()->json([
                'message' => 'Запроса на изменения пароля нет. Проверьте ссылку.',
                'status' => 422
            ], 422);
        }
    }
    //@todo --потестровать на завтра 
    function get_user_by_token($token)
    {
        $records =  DB::table('password_resets')->get();
        foreach ($records as $record) {
            if (Hash::check($token, $record->token)) {
                return $record->email;
            }
        }
    }
}
