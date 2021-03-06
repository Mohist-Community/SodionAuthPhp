<?php

namespace Mohist\SodionAuth\Controller;

use Mohist\SodionAuth\Response\Response;
use Mohist\SodionAuth\Result\EmailExistResult;
use Mohist\SodionAuth\Result\SuccessResult;
use Mohist\SodionAuth\Result\UserExistResult;

class RegisterController extends Controller
{
    protected function hand($request)
    {
        $result = $this->provider->register(
            $request->username,
            $request->email,
            $request->password
        );
        switch (get_class($result)) {
            case UserExistResult::class:
                return Response::user_exist();
            case EmailExistResult::class:
                return Response::email_exist();
            case SuccessResult::class:
                return Response::ok();
            default:
                return Response::unknown('server_error', 'server_error');
        }
    }
}
