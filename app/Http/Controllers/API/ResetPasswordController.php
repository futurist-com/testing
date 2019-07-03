<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
    public function callResetPassword(Request $request){
        $tokenHash=\Hash::make($request->token);
        //dd($tokenHash);
        $token = DB::table('password_resets')
            ->where('token', bcrypt(request('token')))
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
       // 
        $tokenHash=\Hash::make(request('token'));
        //$tokenHash=bcrypt(request('token'));
        $tok="e51b240909633fbba0eec40fd7f9b1f6749c744200b1fc194048b2e9112e8ace";
        $val=Hash::check($tokenHash, $tok);
        dd($val);
        dd($tokenHash);
        
        $token = DB::table('password_resets')
            ->where('token', bcrypt(request('token')))
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
    //@todo --потестровать на завтра 
    function get_user_by_token($token){
        $records =  DB::table('password_resets')->get();
        foreach ($records as $record) {
            if (Hash::check($token, $record->token) ) {
               return $record->email;
            }
        }
    }
}
