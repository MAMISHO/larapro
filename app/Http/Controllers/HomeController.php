<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		// $this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		if(\Session::get('miSession')){
			$examenes = $this->getExamenes();
			// dd($examenes);
			// dd(csrf_token());

			return view('home', array('examenes'=>$examenes));	
		}
		return redirect($this->loginPath());
		//return property_exists($this, 'loginPath') ? $this->loginPath : '/';
	}

	public function nuevoExamen(Request $request)
	{
		if(\Session::get('miSession')){
			$examenes = $this->getExamenes();
			$preguntas = $this->getPreguntas($request);
			$mytime = \Carbon\Carbon::now();
			// dd($mytime);
			// dd($preguntas);

			return view('examen', array('examenes'=>$examenes,'preguntas'=>$preguntas, 'fecha'=>$mytime));	
		}
		return redirect($this->loginPath());
		//return property_exists($this, 'loginPath') ? $this->loginPath : '/';
	}

	public function calificarExamen(Request $request){
		// explode(",", $fila);
		$puntos = $this->comprobarRespuestas($request);
		
	}

	public function loginPath()
	{
		// return property_exists($this, 'loginPath') ? $this->loginPath : '/auth/login';
		return property_exists($this, 'loginPath') ? $this->loginPath : '/';
	}

	private function getExamenes(){
		$user_data = $this->getUserData();

		// $test = \DB::table('examenes')
		// 	->where('usuario', \Session::get('miSession', 'usuario'))
		// 	->get();

		$test = \DB::table('usuarios_examenes')
			->join('examenes', 'usuarios_examenes.examen_id', '=', 'examenes.id')
            ->join('usuarios', 'usuarios_examenes.usuario_id', '=', 'usuarios.id')
            ->select('usuarios.id as usuario_id',
            		 'usuarios.nombre as usuario_nombre',
            		 'usuarios.apellidos as usuario_apellidos',
            		 'usuarios.dni as usuario_dni',
            		 'usuarios.tipo as usuario_tipo',
            		 'usuarios_examenes.id as usuarios_examenes_id',
            		 'usuarios_examenes.nota as examen_nota',
            		 'usuarios_examenes.resultado as examen_resultado',
            		 'usuarios_examenes.estado as examen_estado',
            		 'usuarios_examenes.fecha as examen_fecha',
            		 'examenes.id as examen_id',
            		 'examenes.nombre as examen_nombre',
            		 'examenes.codigo as examen_codigo')
            ->where('usuarios.id',$user_data['id'])
            ->groupBy('usuarios_examenes.id')
            ->get();

			$examen = null;
			$cont =0;
			foreach($test as &$aux) {
				$examen[$cont]    = get_object_vars($aux);
				$cont++;
			}

		return $examen;
	}

	private function getUserData(){

			$user = \DB::table('usuarios')
			->where('usuario', \Session::get('miSession', 'usuario'))
			->get();

			$usuario = null;
			foreach($user as &$aux) {
				$usuario     = get_object_vars($aux);
			}
			return $usuario;
	}

	private function getPreguntas(Request $request){
		$this->validate($request, [
				'examen' 	=> 'required',
			]);
		$query = \DB::table('preguntas')
			->join('examenes', 'preguntas.examen_id', '=', 'examenes.id')
			->select('preguntas.id as pregunta_id',
					 'preguntas.pregunta',
					 'preguntas.resp_a',
					 'preguntas.resp_b',
					 'preguntas.resp_c',
					 'preguntas.resp_d',
					 'preguntas.correcta')
            ->where('examenes.id',$request['examen'])
            // ->groupBy('examenes.id')
            ->get();

  //       dd($query);
        $preguntas = null;
		$cont =0;
		foreach($query as &$aux) {
			$preguntas[$cont]    = get_object_vars($aux);
			$cont++;
		}

		return $preguntas;
	}

	private function comprobarRespuestas(Request $request){
		$respuestas = null;
		foreach ($request as $key => $req) {
			$respuestas[$key] = $req;
		}

		$resp = $respuestas['request'];
		foreach ($resp as $key => $req) {
			$respu[$key] = $req;
		}

		dd($respu);
	}

}
