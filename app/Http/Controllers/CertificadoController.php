<?php namespace App\Http\Controllers;

use DPDF;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CertificadoController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Principal Controller
	|--------------------------------------------------------------------------
	|
	| Este controlador tiene el flujo principal del modelo de negocio
	| y las vistas
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		// $this->middleware('guest');
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		return redirect('/larapro/public/');
	}

	public function obtenerDocumento(Request $request){
		$this->validate($request, [
				'documento' 	=> 'required',
			]);
		if(\Session::get('miSession')){
			
			$data= $request['documento'];
			// $pdf = DPDF::loadView('invoice.pdf', $data);
			// $pdf->download('invoice.pdf');

			$estudiante = $this->getUserData();
			// dd($estudiante);
			$examenes = $this->getExamenesRealizados($estudiante['id']);
			
			// dd($examenes,$estudiante);
			return view('misexamenes', array('examenes'=>$examenes, 'estudiante'=>$estudiante));	
		}
		return redirect($this->loginPath());
		
	}

	public function examenFirmado(Request $request){
		$this->validate($request, [
				'convocatoria' 	=> 'required',
				'id_firma' 	=> 'required',
				'location' 	=> 'required',
			]);
		if(\Session::get('miSession')){
			$this->updateConvocatoria($request['convocatoria'], $request['id_firma']);
			return view('firmado', array('id_firma'=>$request['id_firma']));	
		}
		return redirect($this->loginPath());
	}

	private function updateConvocatoria($convocatoria, $id_firma){

		\DB::table('usuarios_examenes')
            ->where('id', $convocatoria)
            ->update(['id_firma'		=>	$id_firma,
            		  'estado'			=>	"firmado"]);
        
         //comprobamos si ha superado el examen para actualizar los superados
        $test = \DB::table('usuarios_examenes')
        			->select('nota','examen_id','usuario_id')
        			->where('id', $convocatoria)
        			->get();

        $examen = null;
			$cont =0;
			foreach($test as &$aux) {
				$examen[$cont]    = get_object_vars($aux);
				$cont++;
			}
			if($examen[0]['nota']>=5){

				\DB::table('alumnos_matriculados_examenes')
				->where('usuario_id', $examen[0]['usuario_id'])
				->where('examen_id', $examen[0]['examen_id'])
				->update(['estado'	=>	"superado"]);

			}
			// dd($examen[0]);
	}

	public function loginPath()
	{
		// return property_exists($this, 'loginPath') ? $this->loginPath : '/auth/login';
		return property_exists($this, 'loginPath') ? $this->loginPath : '/';
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
            		 'usuarios_examenes.id_firma as examen_id_firma',
            		 'examenes.id as examen_id',
            		 'examenes.nombre as examen_nombre',
            		 'examenes.codigo as examen_codigo')
            ->where('usuarios.id',$usuario_id)
            ->where('usuarios_examenes.estado',"firmado")
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


}