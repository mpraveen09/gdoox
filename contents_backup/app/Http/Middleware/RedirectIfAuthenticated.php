<?php

namespace Gdoox\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class RedirectIfAuthenticated
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
//        if ($this->auth->check()) {
//            return redirect('/');
//        }
        
        //===========@ Check the Deactivate 
      if($this->auth->check() && $this->auth->user()->active !== 1){
            $this->auth->logout();
            return redirect('auth/login')->with('message','Sorry!, This user account is deactive. Please activate your account through the Activation Link sent to you on your registered Mail Id and then try to Login.');
      }

        return $next($request);
    }
}
