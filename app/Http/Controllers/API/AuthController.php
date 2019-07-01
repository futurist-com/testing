<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UserStoreRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserRegistred;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
//use Illuminate\Auth\Notifications\ResetPassword;
//use Illuminate\Foundation\Auth\ResetsPasswords;
//use Hash;

use Illuminate\Auth\Events\PasswordReset;
//use Illuminate\Auth\Passwords\CanResetPassword;

class AuthController extends Controller
{
    //
    use SendsPasswordResetEmails;
    //use ResetsPasswords;

    public function register(UserStoreRequest $request)
    {
        $validate = $request->validated();
        $user = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => bcrypt(request('password'))
        ]);
        //send email veryfi
        Mail::to($user->email)->send(new UserRegistred($user));
        //loogin
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')->accessToken;

            return response()->json(
                [
                    //'token' => $success['token'],
                    //'user' => $user,
                    'status' => 200
                ]
            );
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }
    public function login()
    {
        //return response()->json(['status' => 201]);
        // Проверяем существует ли пользователь с указанным email адресом
        $user = User::whereEmail(request('username'))->first();

        if (!$user) {
            return response()->json([
                'message' => 'Не верный email или пароль.',
                'status' => 422
            ], 422);
        }

        // Если пользователь с таким email адресом найден - проверим совпадает
        // ли его пароль с указанным
        if (!\Hash::check(request('password'), $user->password)) {
            return response()->json([
                'message' => 'Не верный email или пароль.',
                'status' => 422
            ], 422);
        }

        // Внутренний API запрос для получения токенов
        $client = DB::table('oauth_clients')
            ->where('password_client', true)
            ->first();

        // Убедимся, что Password Client существует в БД (т.е. Laravel Passport
        // установлен правильно)
        if (!$client) {
            return response()->json([
                'message' => 'Laravel Passport is not setup properly.',
                'status' => 500
            ], 500);
        }

        $data = [
            'grant_type' => 'password',
            'client_id' => $client->id,
            'client_secret' => $client->secret,
            'username' => request('username'),
            'password' => request('password'),
        ];

        $request = Request::create('/oauth/token', 'POST', $data);

        $response = app()->handle($request);

        // Проверяем был ли внутренний запрос успешным
        if ($response->getStatusCode() != 200) {
            return response()->json([
                'message' => 'Не верный email или пароль.',
                'status' => 422
            ], 422);
        }

        // Вытаскиваем данные из ответа
        $data = json_decode($response->getContent());

        // Формируем окончательный ответ в нужном формате
        return response()->json([
            'token' => $data->access_token,
            'user' => $user,
            'status' => 200
        ]);
    }
    public function logout()
    {
        //return 'Protected route';
        $accessToken = auth()->user()->token();

        $refreshToken = DB::table('oauth_refresh_tokens')
            ->where('access_token_id', $accessToken->id)
            ->update([
                'revoked' => true
            ]);

        $accessToken->revoke();

        return response()->json(['status' => 200]);
    }
    public function getUser()
    {
        return auth()->user();
    }
    public function getEmail()
    {
        //
        $user = User::whereEmail(request('email'))->first();
        if ($user) {
            return response()->json([
                'message' => 'Такой email уже зарегестрирован.',
                'unique' => 0,
                'status' => 422
            ], 422);
        } else {
            return response()->json([
                'unique' => 1,
                'status' => 200
            ]);
        }
    }
    public function confirmEmail()
    {
        //dd($request);
        $user = User::whereToken(request('token'))->first();

        if ($user) {
            $user->confirmEmail();
            Auth::login($user);
            $success['token'] =  $user->createToken('MyApp')->accessToken;
            return response()->json([
                'message' => "Адрес email подтвержден.",
                'token' => $success['token'],
                'user' => $user,
                'status' => 200
            ]);
        } else {
            return response()->json([
                'message' => "Учетной записи не найденно.",
                'status' => 422
            ], 422);
        }

        //$request->session()->flash('message', 'Учетная запись подтверждена. Войдите под своим именем.');

        //return redirect('login');
    }
    public function sendPasswordResetLink(Request $request)
    {
        return $this->sendResetLinkEmail($request);
    }
    protected function sendResetLinkResponse(Request $request, $response)
    {
        return response()->json([
            'message' => 'На почту  было отправленно письмо  с дальнейшими инструкциями по смене пароля.',
            'data' => $response
        ]);
    }
    protected function sendResetLinkFailedResponse(Request $request, $response)
    {
        return response()->json(['message' => 'Не удалось отправить электронное письмо на этот адрес электронной почты.'], 422);
    }
    
}
