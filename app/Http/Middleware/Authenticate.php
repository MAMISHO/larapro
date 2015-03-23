<?php namespace App\Http\Middleware;

use App\Http\Requests\Request;
use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Input;

class Authenticate {

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
		//$this->auth = $auth;
	}

	// public function __construct(Request $request){

 //        $this->validate($request,[
	// 		'usuario'	=>	'required',
	// 		'clave'	=>	'required',
	// 		]);

	// 	$credentials = $request->only('usuario', 'clave');
	// 	echo $credentials;
	// }

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
        // $this->validate($request,[
        //     'usuario'	=>	'required',
        //     'clave'	=>	'required',
        // ]);

        //$credentials = $request->only('usuario', 'clave');

        return Input::get('app_mainView_formulario_form_user');;
        //return  $credentials;

		if ($this->auth->guest())
		{
			if ($request->ajax())
			{
				return response('Unauthorized.', 401);
			}
			else
			{
				return redirect()->guest('auth/login');
			}
		}
		return $next($request);
	}

}
