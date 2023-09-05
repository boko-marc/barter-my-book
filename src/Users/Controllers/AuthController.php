<?php

namespace Core\Users\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Core\Controllers\Controller;
use Core\Schools\Repository\SchoolRepositoryInterface;
use Core\Users\Mails\AccountActivation;
use Core\Users\Repository\UsersRepositoryInterface;
use Core\Users\Requests\ActivateAccount;
use Core\Users\Requests\AuthenticateRequest;
use Core\Users\Requests\UserRequest;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{

    protected UsersRepositoryInterface $usersRepository;
    protected SchoolRepositoryInterface $schoolRepository;
    public function __construct(UsersRepositoryInterface $usersRepository, SchoolRepositoryInterface $schoolRepository)
    {
        $this->usersRepository = $usersRepository;
        $this->schoolRepository = $schoolRepository;
    }

    public function register(UserRequest $request)
    {
        $data = $request->validated();
        $school = $this->schoolRepository->findOneBy([['id', $request->school_id]]);
        $verification_code = random_int(1000, 9999);
        $data['verification_code'] = $verification_code;
        $user = $this->usersRepository->make($data);
        $user =  $this->usersRepository->associate($user, ['school' => $school]);
        Mail::to($user->email)->send(new AccountActivation($user, $verification_code));
        return response(['message' => "Insciption réussi", "data" => $user]);
    }


    public function validateAccount(ActivateAccount $request)
    {
        $user = $this->usersRepository->findOneBy([['verification_code', $request->verification_code]]);
        if (!is_null($user)) {
            $this->usersRepository->update(['verification_code' => null, "is_activated" => true], $user);

            $token = $user->createToken("auth_token")->plainTextToken;
            $response = [
                "message" => "Compte activé",
                'access_token' => $token,
                'data' => $user->load(['school'])
            ];
            return response($response, 201);
        }
        $response = ['message' => "Code invalide"];
        return response($response, 422);
    }

    public function login(AuthenticateRequest $request)
    {
        $credentials = null;

            $credentials = $request->only('register_number', 'password');
        

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if (!$user->is_activated) {
                $code = random_int(1000, 9999);
                $this->usersRepository->update(['verification_code' => $code],$user);

                    Mail::to($user->email)->send(new AccountActivation($user, $code));
                    $response = ['message' => "Compte non activé. Un code d'activation vous est envoyé par email afin de vous permettre d'activer votre compte."];
                

                return response($response, 422);
            }
            $token = $user->createToken("auth_token")->plainTextToken;
         

            $response = [
                "message" => "Connecté",
                'access_token' => $token,
                'data' => $user->load(['school'])
            ];

            return response($response, 200);
        }
        $response = ['message' => "Données de connexion invalides"];
        return response($response, 404);
    }


    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        $response = [
            "message" => "Déconnecté",
        ];
        return response($response, 200);
    }
}
