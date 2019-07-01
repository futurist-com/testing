<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\DB;

class ResetPasswordController extends Controller
{
    //
    use ResetsPasswords;
    
    public function callResetPassword(Request $request)
    {
        return $this->reset($request);
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
    public function isToken(){
        $token = DB::table('password_resets')
            ->where('token', request('token'))
            ->first();
            if ($token){
                return response()->json([
                    'message' => 'IsToken true.',
                    'status' => 200
                ], 200);
            }else {
                return response()->json([
                    'message' => 'Запроса на изменения пароля нет. Проверьте ссылку.',
                    'status' => 422
                ], 422);
            }

    }
}
