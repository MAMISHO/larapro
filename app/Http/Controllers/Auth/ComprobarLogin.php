<?php namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
// use Illuminate\Contracts\Auth\Guard;
// use Illuminate\Contracts\Auth\Registrar;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

trait ComprobarLogin {

	/**
	 * The Guard implementation.
	 *
	 * @var Guard
	 */
	protected $auth;
	//protected $usuario;

	/**
	 * The registrar implementation.
	 *
	 * @var Registrar
	 */
	protected $registrar;

	/**
	 * Show the application registration form.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getRegister()
	{
		return view('auth.register');
	}

	/**
	 * Handle a registration request for the application.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	// public function postRegister(Request $request)
	// {
	// 	$validator = $this->registrar->validator($request->all());

	// 	if ($validator->fails())
	// 	{
	// 		$this->throwValidationException(
	// 			$request, $validator
	// 		);
	// 	}

	// 	$this->auth->login($this->registrar->create($request->all()));

	// 	return redirect($this->redirectPath());
	// }
	public function postRegister(Request $request)
	{
		$this->validate($request, [
			'usuario' 	=> 'required',
			'clave' 	=> 'required',
		]);

		$user = \DB::table('usuarios')
		->select('usuario')
		->where('usuario', 'mauricio')
		->get();
		// dd($user);
		
		// return $user;
		$aux;
		foreach($user as &$aux) {
			$aux     = get_object_vars($aux);
			$usuario =$aux['usuario'];
		}
		$session = 'vacia';

		\Session::put('miSession', \Input::get('usuario'));
		\Session::put('miSession', \Input::get('clave'));

		return view('home', array('usuario'=>$usuario));
	
	}

	/**
	 * Show the application login form.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getLogin()
	{
		return view('auth.login');
	}

	/**
	 * Handle a login request to the application.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function postLogin(Request $request)
	{
		$this->validate($request, [
			'usuario' 	=> 'required',
			'clave' 	=> 'required',
			'_tipo_login' => 'required'
		]);

		$credentials = $request->only('usuario', 'clave', '_tipo_login');

		// if ($this->auth->attempt($credentials, $request->has('remember')))
		// {
			// return redirect()->intended($this->redirectPath());
		// }
		// if($credentials['pass']==12345){
			// return redirect()->intended($this->redirectPath());
		// }
		// return redirect($this->loginPath())
		// 			->withInput($request->only('email', 'remember'))
		// 			->withErrors([
		// 				'email' => $this->getFailedLoginMessage(),
		// 				'pass'	=> $credentials['pass'],
		// 			]);
		// 		}

		$user = \DB::table('usuarios')
		->where('usuario', $credentials['usuario'])
		->get();
		// dd($user);

		$aux;
		$usuario = null;
		$clave = null;
		// $tipo_login = null;
		foreach($user as &$aux) {
			$aux     = get_object_vars($aux);
			$usuario =$aux['usuario'];
			$clave 	=$aux['clave'];
			// $tipo_login = $aux['tipo_login'];
		}

		if ($usuario)	//Existe usuario, se verifica el password
		{
			if (\Hash::check($credentials['clave'], $clave))//Loogueado con exito
			{
				
				$str = strtoupper(\Input::get('usuario'));
				\Session::put('miSession', \Input::get('clave'));
				\Session::put('miSession', $str);
				// return view('home', array('usuario'=>$usuario));
				
				// return $credentials;
				
				return redirect($this->homePath());

			}
		}//Error en la autenticación de ls credenciales
				return redirect($this->loginPath())
					->withInput($request->only('usuario'))
					->withErrors([
						'error' => $this->getFailedLoginMessage(),
						'usuario_ant'	=> $credentials['usuario']
					]);
				
	}

	/**
	 * Get the failed login message.
	 *
	 * @return string
	 */
	protected function getFailedLoginMessage()
	{
		return 'Datos incorrectos';
	}

	/**
	 * Log the user out of the application.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getLogout()
	{
		$this->auth->logout();
		\Session::forget('miSession');
		return redirect('/');
	}

	/**
	 * Get the post register / login redirect path.
	 *
	 * @return string
	 */
	public function redirectPath()
	{
		if (property_exists($this, 'redirectPath'))
		{
			return $this->redirectPath;
		}

		return property_exists($this, 'redirectTo') ? $this->redirectTo : '/home';
	}

	/**
	 * Get the path to the login route.
	 *
	 * @return string
	 */
	public function homePath()
	{
		// return property_exists($this, 'loginPath') ? $this->loginPath : '/auth/login';
		return property_exists($this, 'homePath') ? '/home' : '/home';
	}

	public function loginPath()
	{
		// return property_exists($this, 'loginPath') ? $this->loginPath : '/auth/login';
		return property_exists($this, 'loginPath') ? $this->loginPath : '/';
	}

}