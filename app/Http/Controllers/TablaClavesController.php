<?php namespace App\Http\Controllers;

// use Vendor\tecnickcom\tcpdf\tcpdf;

class TablaClavesController extends Controller {


	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		// $this->middleware('auth');
		$this->image_file = "http://www.upo.es/gac/presentacion/quejas/logo_gordo.JPG";
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */

	public function index(){
		if(\Session::get('miSession')){
			
			\PDF::SetTitle('Tarjeta Identificativa de la UPO');

			\PDF::AddPage();

			// Cabecera
			\PDF::Image($this->image_file, 10, 10, 15, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
			\PDF::Write(0, '', '', false, 'C', true, 0, false, false, 0);
            \PDF::Cell(0, 0, 'Tarjeta Identificativa de la UPO', 0, true, 'C', 0, '', 0, false, 'M', 'M');

			$data_user= $this->getUserData();

			$txt="Usuario : ".$data_user['nombre']." ".$data_user['apellidos']."\n Tabla de claves";
			 \PDF::Write(0, $txt, '', false, 'C', true, 0, false, false, 0);


			 // Tabla
			\PDF::Write(0, '', '', false, 'C', true, 0, false, false, 0);
			\PDF::WriteHTML($this->generar(), true, true, true, false, '');
			

			\PDF::Output('tabla_de_claves.pdf');

			return view('home');	
		}

		return redirect($this->loginPath());
	}

	public function descargar()
	{
		if(\Session::get('miSession')){		
			
			\PDF::SetTitle('Tarjeta Identificativa de la UPO');

			\PDF::AddPage();

			// Cabecera
			\PDF::Image($this->image_file, 10, 10, 15, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
			\PDF::Write(0, '', '', false, 'C', true, 0, false, false, 0);
            \PDF::Cell(0, 0, 'Tarjeta Identificativa de la UPO', 0, true, 'C', 0, '', 0, false, 'M', 'M');

			$data_user= $this->getUserData();

			$txt="Usuario : ".$data_user['nombre']." ".$data_user['apellidos']."\n Tabla de claves";
			 \PDF::Write(0, $txt, '', false, 'C', true, 0, false, false, 0);


			 // Tabla
			\PDF::Write(0, '', '', false, 'C', true, 0, false, false, 0);
			\PDF::WriteHTML($this->generar(), true, true, true, false, '');

			\PDF::Output('tabla_de_claves.pdf', 'D');

		    // return Response::download($filename);

			return view('home');	
		}
		return redirect($this->loginPath());
		//return property_exists($this, 'loginPath') ? $this->loginPath : '/';
	}



	public function loginPath()
	{
		// return property_exists($this, 'loginPath') ? $this->loginPath : '/auth/login';
		return property_exists($this, 'loginPath') ? $this->loginPath : '/';
	}

	private function generar(){
		$user_data = $this->getUserData();
			$tabla = 
			'<style>
				body {
					margin: 0;
					padding: 0;
					width: 100%;
					height: 100%;
					color: #333;
					display: table;
					font-weight: 100;
					font-family: "Lato";
				}
				td.valor{
					color:#333:
				}
				</style>
				<table cellspacing="0" cellpadding="0" border="1" align="center">			
					<tr>				
						<th>Posición</th>
						<th>1</th>
						<th>2</th>
						<th>3</th>
						<th>4</th>
						<th>5</th>
						<th>6</th>
						<th>7</th>
						<th>8</th>
					</tr>';
					// $tabla = $tabla.$user_data['matriz'];
					$filas = explode(";", $user_data['matriz']);
					$cont = 0;
					$matrix[][]= null;
					foreach($filas as &$fila) {
						$matrix[$cont] = explode(",", $fila);
						$cont++;
					}

					// $tam = sizeof($matrix[0]);
					//$col = sizeof($huge_array);
					$tam = 8;
					for ($i=0; $i < $tam ; $i++) { 
						
						$tabla = $tabla.'<tr>';

						for ($j=0; $j <$tam ; $j++){
							if($j==0){
								$tabla = $tabla.'<td>'.($i + 1).'</td>';
								$tabla = $tabla.'<td class="valor">'.$matrix[$i][$j].'</td>';
							}else{
								$tabla = $tabla.'<td class="valor">'.$matrix[$i][$j].'</td>';
							}
						}

						$tabla = $tabla.'</tr>';
					}
			$tabla = $tabla.'</table>';
			return $tabla;
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
}