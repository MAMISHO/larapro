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
			if(\Session::get('tipo_usuario')=="administrador"){
				return view('administrador');	
			}
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
			\Session::put('examen_actual', $request['examen']);
			\Session::put('preguntas', $preguntas);
			\Session::put('fecha', $mytime);
			// dd($mytime);
			// dd($preguntas);

			// if($preguntas[0]==null){
			// 	$preguntas[0]="No existen preguntas para el examen";
			// }

			return view('examen', array('examenes'=>$examenes,'preguntas'=>$preguntas, 'fecha'=>$mytime));	
		}
		return redirect($this->loginPath());
		//return property_exists($this, 'loginPath') ? $this->loginPath : '/';
	}

	public function calificarExamen(Request $request){
		if(\Session::get('miSession')){
			//hay que añadir en la BBDD que el examen ya no esta disponible, con la fecha y puntaje
			$examenes = $this->getExamenes();
			$resultados = $this->comprobarRespuestas($request);
			$puntaje['puntos'] = \Session::get('puntos');
			$puntaje['correctas'] = \Session::get('correctas');
			$puntaje['incorrectas'] = \Session::get('incorrectas');
			$puntaje['sin_responder'] = \Session::get('sin_responder');
			$puntaje['fecha'] = \Carbon\Carbon::now();
			return view('resultados', array('resultados'=>$resultados, 'puntaje'=>$puntaje, 'examenes'=>$examenes));	
		}
		return redirect($this->loginPath());
	}

	public function crearExamen(){
		if(\Session::get('miSession')){
				return view('nuevoexamen');	
		}
		return redirect($this->loginPath());
	}

	public function crearNuevoExamen(Request $request){
		if(\Session::get('miSession')){

			$this->validate($request, [
				'nombre' 	=> 'required',
				'codigo'	=> 'required',
			]);

			$id = \DB::table('examenes')->insertGetId(
    			['nombre' => $request['nombre'], 'codigo' => $request['codigo']]
				);
			return view('administrador');	
		}
		return redirect($this->loginPath());
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

        
        // dd($aleatorias);
        // dd(sizeof($query));
        // dd($query);

         //Normalizamos la preguntas
        $preguntas = null;
		$cont =0;
		foreach($query as &$aux) {
			$preguntas[$cont]    = get_object_vars($aux);
			$cont++;
		}


		//Tomamos solo 10 preguntas aleatorias
		$aleatorias[] = 0;
		$ind =0;
		if(sizeof($query)>=10){
	        while(sizeof($aleatorias)<10){
	        	$num = rand(0, sizeof($query)-1);
	        	if(!in_array($num, $aleatorias)){
	        		$aleatorias[$ind] = $num;
	        		$ind++;
	        	}
	        }
	    }

        $preguntas_finales = null;
        foreach ($aleatorias as $key => $indice) {
        	$preguntas_finales[$key] = $preguntas[$indice];
        }

        // dd($preguntas);
        // dd($preguntas_finales);
		return $preguntas_finales;
	}

	private function comprobarRespuestas(Request $request){
		$respuestas = null;
		$examen_actual = \Session::get('examen_actual');
		$preguntas = \Session::get('preguntas');

		//sacamos las respuestas del request
		foreach ($request as $key => $req) {
			$respuestas[$key] = $req;
		}

		//Pasamos las respuestas a un array de claves 'respuestas_n' => 'resp_n'
		$resp = $respuestas['request'];
		foreach ($resp as $key => $req) {
			$respu[$key] = $req;
		}

		//sacamos las claves del array 'respuestas_n' para luego tratarlas
		$claves = array_keys($respu);
		$valores = array_values($respu);

		//formamos una matriz de tipo 'indice','respuestas_n','n'
		$matrix = null;
		foreach ($claves as $key => $clave) {
			$aux = explode("_", $clave);
			if($aux[0]!=""){
				$matrix[$key]['clave'] = $clave;
				$matrix[$key]['codigo'] = $aux[1];
				$matrix[$key]['respuesta'] = $valores[$key];
			}
		}

		//tranformo la matriz de claves para hacer el cruce con la de respuestas
		$respuestas_user[] = null;
		
		if($matrix != null){
			foreach ($matrix as $key => $mat) {
				$respuestas_user[$mat['codigo']] = $mat['respuesta']; 
			}
		}
		// dd('hola');
		//asignamos las puntuaciones a las respuestas.
		$puntuaciones = null;
		$puntos = 0;
		$correctas = 0;
		$incorrectas = 0;
		$sin_responder = 0;
		foreach ($preguntas as $key => $pre) {
			if(array_key_exists($pre['pregunta_id'], $respuestas_user)){
				$puntuaciones[$key]['pregunta'] = $pre['pregunta'];
				$puntuaciones[$key]['respuesta'] = $respuestas_user[$pre['pregunta_id']];
				$puntuaciones[$key]['correcta'] = $pre['correcta'];
				if($puntuaciones[$key]['respuesta'] == $puntuaciones[$key]['correcta']){
					$puntuaciones[$key]['puntos'] = 1;
					$puntuaciones[$key]['icon'] = "fa fa-check-circle verde";
					$correctas++;
				}else{
					$puntuaciones[$key]['puntos'] = round( -(1/3), 1, PHP_ROUND_HALF_DOWN);
					$puntuaciones[$key]['icon'] = "fa fa-times-circle rojo";
					$incorrectas++;
				}
			}else{
				$puntuaciones[$key]['pregunta'] = $pre['pregunta'];
				$puntuaciones[$key]['respuesta'] = '--';
				$puntuaciones[$key]['correcta'] = $pre['correcta'];
				$puntuaciones[$key]['puntos'] = 0;
				$puntuaciones[$key]['icon'] = "fa fa-minus-square";
				$sin_responder++;
			}
			$puntos = $puntos + $puntuaciones[$key]['puntos'];
		}


		// dd($respuestas_user);
		//dd($preguntas);
		// dd($puntuaciones);
		if($puntos<0){
			$puntos = 0;
		}
		\Session::put('puntos', $puntos);
		\Session::put('correctas', $correctas);
		\Session::put('incorrectas', $incorrectas);
		\Session::put('sin_responder', $sin_responder);
		return $puntuaciones;
	}

}
