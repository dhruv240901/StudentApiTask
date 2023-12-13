<?php

namespace App\Http\Middleware;

use App\Traits\Response;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    use Response;
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('login');
    }

    protected function unauthenticated($request, array $guards)
    {
        // $return_data = array();
        // $return_data['code'] = 0;
        // $return_data['status'] = 'FAIL';
        // $return_data['message'] = "UnAuthenticated";

        abort($this->error(403,'Unauthorized'));
    }
}
