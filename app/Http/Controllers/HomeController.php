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
			
			// dd($examenes);
			// dd(csrf_token());
			if(\Session::get('tipo_usuario')=="administrador"){
				$examenes = $this->getAllTest();
				$alumnos = $this->getAllStudents();
				// dd($alumnos);
				return view('administrador', array('examenes'=>$examenes, 'alumnos'=>$alumnos));	
			}
			
			// $examenes = $this->getExamenes();
			$examenes = $this->getAllExamenes();
			return view('home', array('examenes'=>$examenes));	
		}

		return redirect($this->loginPath());
		//return property_exists($this, 'loginPath') ? $this->loginPath : '/';
	}

	public function nuevoExamen(Request $request)
	{
		// dd($request);
		if(\Session::get('miSession')){
			

			// if($request['examen']){
				// $examenes = $this->getExamenes();
				$examen = $this->getTestData($request['examen']);
				$preguntas = $this->getPreguntas($request);
				$mytime = \Carbon\Carbon::now();



				\Session::put('examen_actual', $request['examen']);
				\Session::put('preguntas', $preguntas);
				\Session::put('fecha', $mytime);
				$usuario = $this->getUserData();
				// $estado = $this->examenEstado($examenes[0]['usuario_id'], $request['examen']);
				// dd($res);
				// dd($examen);
				// if ($estado) {
					return view('examen', array('examen'=>$examen,'preguntas'=>$preguntas, 'fecha'=>$mytime, 'usuario'=>$usuario));	
				//}
				
			// }
			return redirect("/home");
		}
		return redirect($this->loginPath());
		//return property_exists($this, 'loginPath') ? $this->loginPath : '/';
	}

	public function calificarExamen(Request $request){
		if(\Session::get('miSession')){
			//hay que añadir en la BBDD que el examen ya no esta disponible, con la fecha y puntaje
			$examen = $this->getTestData(\Session::get('examen_actual'));
			$usuario = $this->getUserData();
			$resultados = $this->comprobarRespuestas($request);
			$puntaje['puntos'] = \Session::get('puntos');
			$puntaje['correctas'] = \Session::get('correctas');
			$puntaje['incorrectas'] = \Session::get('incorrectas');
			$puntaje['sin_responder'] = \Session::get('sin_responder');
			$puntaje['fecha'] = \Carbon\Carbon::now();

			$this->setExamenCalificado($usuario, $resultados, $puntaje);
			// dd($examen,$usuario);
			return view('resultados', array('resultados'=>$resultados, 'puntaje'=>$puntaje, 'examen'=>$examen, 'usuario'=>$usuario));	
		}
		return redirect($this->loginPath());
	}

	public function crearExamen(){
		if(\Session::get('miSession')){
				return view('nuevoexamen');	
		}
		return redirect($this->loginPath());
	}

	public function examenesAlumno(Request $request){
			$this->validate($request, [
				'user' 	=> 'required',
			]);
		if(\Session::get('tipo_usuario')=="administrador"){
			$examenes = $this->getExamenesRealizados($request['user']);
			$estudiante = $this->getStudent($request['user']);
			// dd($examenes,$estudiante);
			return view('examenes', array('examenes'=>$examenes, 'estudiante'=>$estudiante));	
		}
	}

	public function alumnosExamen(Request $request){
		$this->validate($request, [
				'test' 	=> 'required',
			]);
		if(\Session::get('tipo_usuario')=="administrador"){
			$alumnos = $this->getAlumnosExaminados($request['test']);
			$examen = $this->getExamen($request['test']);
			// dd($alumnos, $examen);
			return view('alumnos', array('alumnos'=>$alumnos, 'examen'=>$examen));	
		}
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

	private function getAllExamenes(){
		// $user_data = $this->getUserData();

		$test = \DB::table('examenes')
		->select('examenes.id as examen_id',
				 'examenes.nombre as examen_nombre',
            	 'examenes.codigo as examen_codigo')
		->get();

			$examen = null;
			$cont =0;
			foreach($test as &$aux) {
				$examen[$cont]    = get_object_vars($aux);
				$cont++;
			}

		return $examen;
	}

	private function getExamenes(){
		$user_data = $this->getUserData();

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

	private function getTestData($id){
		
		$test = \DB::table('examenes')
			->where('id',$id)
            ->get();

        $examen = null;
			$cont =0;
			foreach($test as &$aux) {
				$examen[$cont]    = get_object_vars($aux);
				$cont++;
			}

		return $examen;
	}

	private function getExamenesRealizados($usuario_id){
		// $user_data = $this->getUserData();

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
            		 'usuarios_examenes.correctas as examen_correctas',
            		 'usuarios_examenes.incorrectas as examen_incorrectas',
            		 'usuarios_examenes.sin_responder as examen_sin_responder',
            		 'usuarios_examenes.fecha as examen_fecha',
            		 'examenes.id as examen_id',
            		 'examenes.nombre as examen_nombre',
            		 'examenes.codigo as examen_codigo')
            ->where('usuarios.id',$usuario_id)
            // ->where('usuarios_examenes.estado',"inactivo")
            ->groupBy('usuarios_examenes.id')
            ->get();

			$examenes = null;
			$cont =0;
			foreach($test as &$aux) {
				$examenes[$cont]    = get_object_vars($aux);
				$cont++;
			}

		return $examenes;
	}

	private function getAlumnosExaminados($examen_id){
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
            		 'usuarios_examenes.correctas as examen_correctas',
            		 'usuarios_examenes.incorrectas as examen_incorrectas',
            		 'usuarios_examenes.sin_responder as examen_sin_responder',
            		 'usuarios_examenes.fecha as examen_fecha',
            		 'examenes.id as examen_id',
            		 'examenes.nombre as examen_nombre',
            		 'examenes.codigo as examen_codigo')
            ->where('examenes.id',$examen_id)
            // ->where('usuarios_examenes.estado',"inactivo")
            ->groupBy('usuarios_examenes.id')
            ->get();

			$alumnos = null;
			$cont =0;
			foreach($test as &$aux) {
				$alumnos[$cont]    = get_object_vars($aux);
				$cont++;
			}

		return $alumnos;
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

	private function getAllTest(){
			$test = \DB::table('examenes')
						->orderBy('nombre', 'asc')
						->get();

			$tests = null;
			$cont =0;
			foreach($test as &$aux) {
				$tests[$cont]    = get_object_vars($aux);
				$cont++;
			}

			return $tests;
	}
	private function getAllStudents(){
			$user = \DB::table('usuarios')
			->where('tipo','usuario')
			->orderBy('apellidos', 'asc')
			->get();

			$users = null;
			$cont =0;
			foreach($user as &$aux) {
				$users[$cont]    = get_object_vars($aux);
				$cont++;
			}

			return $users;
	}

	private function getStudent($id){
		$user = \DB::table('usuarios')
			->where('id', $id)
			->get();
		
		$student = null;
		$cont =0;
		foreach($user as &$aux) {
			$student[$cont]    = get_object_vars($aux);
			$cont++;
		}

		return $student;
	}

	private function getExamen($id){
		$testQuery = \DB::table('examenes')
			->where('id', $id)
			->get();
		
		$test = null;
		$cont =0;
		foreach($testQuery as &$aux) {
			$test[$cont]    = get_object_vars($aux);
			$cont++;
		}

		return $test;
	}

	private function setExamenCalificado($usuario, $preguntas, $resultados){
		// DB::table('users')
  //           ->where('id', 1)
  //           ->update(['votes' => 1]);
		$examen_id = \Session::get('examen_actual');
		$resultado = "";
		// dd($usuario, $preguntas, $resultados, $examen_id, $resultado);

		//tratamos los resultados de las preguntas para hacerla una cadena y guardarlo en el campo resultados, para disponer de estos datos hacemos el algoritmo inverso del siguiente
		foreach ($preguntas as $key => $res) {
			$resultado .= "pregunta" . "=" . $res['pregunta'] . ",";
			$resultado .= "respuesta" . "=" . $res['respuesta'] . ",";
			$resultado .= "correcta" . "=" . $res['correcta'] . ",";
			$resultado .= "puntos" . "=" . $res['puntos'] . ",";
			$resultado .= "icon" . "=" . $res['icon'] . ";";
		}
		// dd($usuario);
		//item 1
        \DB::table('usuarios_examenes')->insertGetId(array(
        		'usuario_id'	=>	$usuario['id'],
        		'examen_id'		=>	$examen_id,
        		'nota'			=>	$resultados['puntos'],
            	'correctas'		=>	$resultados['correctas'],
            	'incorrectas'	=>	$resultados['incorrectas'],
            	'sin_responder'	=>	$resultados['sin_responder'],
            	'resultado'		=>	$resultado,
            	'fecha'			=>	$resultados['fecha'],
            	'estado'		=>	"activo"
        	));

			// \DB::table('usuarios_examenes')
   //          ->where('examen_id', $examen_id)
   //          ->where('usuario_id', $usuario['usuario_id'])
   //          ->update(['nota'			=>	$resultados['puntos'],
   //          		  'correctas'		=>	$resultados['correctas'],
   //          		  'incorrectas'		=>	$resultados['incorrectas'],
   //          		  'sin_responder'	=>	$resultados['sin_responder'],
   //          		  'resultado'		=>	$resultado,
   //          		  'fecha'			=>	$resultados['fecha'],
   //          		  'estado'			=>	"activo"]);

        //\Session::forget('preguntas');
        // dd($usuario, $preguntas, $resultados, $examen_id, $resultado);
	}
	private function examenEstado($usuario_id, $examen_id){
		$test = \DB::table('usuarios_examenes')
			->join('examenes', 'usuarios_examenes.examen_id', '=', 'examenes.id')
            ->join('usuarios', 'usuarios_examenes.usuario_id', '=', 'usuarios.id')
            ->select('estado')
            ->where('usuario_id',$usuario_id)
            ->where('examen_id',$examen_id)
            ->get();
        if($test[0]->estado == "inactivo"){
        	return false;
        }
        return true;
	}
}
