<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Tymon\JWTAuth\Exceptions\UserNotDefinedException;
use App\Http\Resources\User;

class ApiAuthController extends ApiController {

    public function __construct() {
        parent::__construct();
        $this->middleware('auth:api', ['except' => ['login', 'registerAccount', 'refeshToken']]);
    }

    public function login(Request $request) {
        $credential = \request(['email', 'password']);
        if ($token = auth('api')->attempt($credential)) {
            auth('api')->refreshToken($token);
        }
    }

    public function logOut() {
        auth('api')->logout();
        return $this->sendResponse(null, __('Logout successfully'));
    }

    public function refeshToken() {

    }

    /**
     * @param Request $request
     * @return Response
     */
    public function me(Request $request) {
        try {
            $user = $request->user('api');
            $data = new User($user);
            return $this->sendResponse($data, __('Get info successfully'));
        } catch (UserNotDefinedException $exception) {
            return $this->sendResponse($data, $exception->getMessage(), Response::HTTP_NOT_FOUND);
        }
    }

    public function registerAccount() {

    }

    public function updateProfile() {

    }

    public function forgetPassword() {}

}
