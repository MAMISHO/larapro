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

	public function getDiploma(Request $request){
		$this->validate($request, [
				'pdf' 	=> 'required',
			]);
		if(\Session::get('miSession')){
			
			// $documento = storage_path().'/diplomas/'.$request['pdf'];
			$examen = $this->getExamenRealizado($request['pdf']);
			// dd($examen);
			// $diploma = \TCPDF::ImportPDF($documento);
			// $diploma->Output('nombre.pdf', 'D');


			$pdf = new \TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
			$pdf->setFontSubsetting(false);
			$pdf->SetFont('helvetica', '', 10, '', false);
			$pdf->AddPage();
			// set certificate file
			// $certificate1 = 'file://'.realpath(storage_path().'/app/certs/server.crt');
			// $certificate1 = 'file://server.crt';
			$certificate = 'file://'.(dirname(__FILE__)).('/data/cert/tcpdf.crt');;
			// dd($certificate);
			// $certificate2 = storage_path().'/app/certs/'.'server.key';
			// set additional information
			$info = array(
			    'Name' => 'Examenes',
			    'Location' => 'UPO',
			    'Reason' => 'Diploma de examenes',
			    'ContactInfo' => 'https://www.examenemq.upo.es',
			    );
			$pdf->setSignature($certificate, $certificate, 'tcpdfdemo', '', 2, $info);
			// $text = 'Este es un <b color="#FF0000">documento firmado</b> mediante el certificado<b>tcpdf.crt</b>';
			
			$img_file = storage_path().'/css/fondo_diploma.png';
			$pdf->Image($img_file, 0, 0, 514, 304, '', '', '', false, 300, '', false, false, 0);

			$text = $this->getHTML($examen[0]);
			$pdf->writeHTML($text, true, 0, true, 0);
			$pdf->Output('diploma_'.$examen[0]['usuarios_examenes_id'].'_'.$examen[0]['usuario_dni'].'_'.$examen[0]['examen_codigo'].'.pdf', 'D');

		}
		return redirect($this->loginPath());
		
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
				$examen = $this->getExamenRealizado($convocatoria);
				//dd($examen);
				$diploma = $this->generarPDFDiploma($examen[0]);

				\DB::table('usuarios_examenes')
		            ->where('id', $convocatoria)
		            ->update(['diploma' => $diploma]);

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
            		 'usuarios_examenes.diploma as examen_diploma',
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

	// private function misDiplomas($examenes){
	// 	$usuario = $this->getUserData();
	// 	$test = null;
		
	// 	$cont = 0;
	// 	foreach ($examenes as $key => $examen) {
	// 		if($examen['examen_nota']>=5){
	// 			$test[$cont]= $examen;
	// 			$cont++;
	// 		}
	// 	}
	// 	// dd($test, $usuario);
	// 	$diplomas = null;
	// 	if($test){
	// 		$diplomas = $this->generarPDFDiploma($usuario, $test);
	// 	}

	// 	// dd($diplomas);
	// 	return $diplomas;
	// }

	private function generarPDFDiploma($examen){
		//dd('background-image: url('.storage_path().'/css/fondo_doc.jpg)');

		$fecha = \Carbon\Carbon::now();
		$estilos = '<style type="text/css">
					body{
						margin:0;
						padding:40px;
					    background-position: right bottom, left top;
					    background-repeat: no-repeat, repeat;
					}
					.contenedor{
						background-image: url(http://localhost/larapro/storage/css/fondo_doc.jpg);
						margin:0;
						padding:0;
						border: 2px solid #333;
						border-radius: 15px;
						height: 90%;
						width: 100%;
					}
					.header{
						height: 20%;
						width: 100%;
						font-style:italic;
						text-align:center;
					}
					.main{
						height: 65%;
						width: 100%;
						text-align:center;
					}
					.footer{
						height: 10%;
						width: 100%;
						text-align:right;							
					}
					</style>';
		$diploma_loc = null;
		// foreach ($examenes as $key => $examen) {
		
			$html ='<!DOCTYPE html>
					<html>
					<head>
						<title>Anular Examen</title>
						'.$estilos.'
					</head>
					<body>
						<div class="contenedor">
							<div class="header">
								<h1>Diploma de </h1>
							</div>
							<div class="main">
								<h2>Se le concede el siploma a  '.$examen['usuario_nombre'].' '.$examen['usuario_apellidos'].' con D.N.I. '.$examen['usuario_dni'].'</h2>
								<h3>Por haber realizado el examen de </h3>
								<h2>'.$examen['examen_nombre'].'</h2>
							</div>
							<div class="footer">
								<h2>Sevilla '.$fecha->format('d - m - Y').'</h2>
							</div>
						</div>
					</body>
					</html>';
			$file_location = storage_path().'/diplomas/'.$examen['usuario_dni'].'_'.$examen['examen_codigo'].'.pdf';
			DPDF::loadHTML($html)->save($file_location);
			$diploma_loc = $examen['usuario_dni'].'_'.$examen['examen_codigo'].'.pdf';
		// }
		//dd($examen);
		return $diploma_loc;
	}

	private function getExamenRealizado($examen_id){
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
            ->where('usuarios_examenes.id',$examen_id)
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

	private function getHTML($ex){
		$fecha = \Carbon\Carbon::now();
		$estilos = '<style type="text/css">
					body{
						margin:0;
						padding:40px;
					    background-position: right bottom, left top;
					    background-repeat: no-repeat, repeat;
					}
					.contenedor{
						margin:0;
						padding:0;
						border: 2px solid #333;
						border-radius: 15px;
						height: 90%;
						width: 100%;
					}
					.header{
						height: 20%;
						width: 100%;
						font-style:italic;
						text-align:center;
						font-size: 35px;
					}
					.main{
						height: 65%;
						width: 100%;
						text-align:center;
					}
					.footer{
						height: 10%;
						width: 100%;
						text-align:right;							
					}
					</style>';
		// $diploma_loc = null;
		// foreach ($examenes as $key => $examen) {
		
			$html ='<!DOCTYPE html>
					<html>
					<head>
						<title>Anular Examen</title>
						'.$estilos.'
					</head>
					<body>
						<div class="contenedor">
							<div class="header">
								<h1>Diploma</h1>
								<h4>Exámenes Online</h4>
							</div>
							<div class="main">
								<h2>Sr/ra  '.$ex['usuario_nombre'].' '.$ex['usuario_apellidos'].'</h2>
								<h4>Ha superado el examen de</h4>
								<h2>'.$ex['examen_nombre'].'</h2>
								<h3>Con una nota de : '.$ex['examen_nota'].'</h3>
							</div>
							<div class="footer">
								<h2>Sevilla '.$fecha->format('d-m-Y').'</h2>
							</div>
						</div>
					</body>
					</html>';
		return $html;
	}

}