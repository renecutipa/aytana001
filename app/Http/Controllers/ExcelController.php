<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Afiliado;
use DB;
use Excel;

class ExcelController extends Controller
{
    //

    public function importExport()
    {
        return view('importExport');
    }
 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function downloadExcel($type)
    {
        $data = Item::get()->toArray();
            
        return Excel::create('itsolutionstuff_example', function($excel) use ($data) {
            $excel->sheet('mySheet', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });
        })->download($type);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function importExcel(Request $request)
    {
        
		$ingresados = 0;
		$actualizados = 0;
        if($request->hasFile('import_file')){
			$path = $request->file('import_file')->getRealPath();
			$data = Excel::load($path, function($reader) {
			})->get();
			$ingresados = 0;
			$actualizados = 0;
			if(!empty($data) && $data->count()){
				foreach ($data as $key => $value) {
					//dd($data);
					$reg = Afiliado::where('afi_NroFormato','=',$value->afi_nroformato)->first();
					if($reg == null){
						$insert = [
							'afi_depa' => $value->afi_depa,
							'afi_prov' => $value->afi_prov,
							'afi_dist' => $value->afi_dist,
							'pre_CodEjeAdm' => $value->pre_codejeadm,
							'afi_IdEESSAte' => $value->afi_ideessate,
							'pre_Nombre' => $value->pre_nombre,
							'afi_IdDisa' => $value->afi_iddisa,
							'afi_IdDistrito' => $value->afi_iddistrito,
							'afi_TipoFormato' => $value->afi_tipoformato,
							'afi_NroFormato' => $value->afi_nroformato,
							'afi_IdTipoDocumento' => $value->afi_idtipodocumento,
							'afi_Dni' => $value->afi_dni,
							'afi_FecFormato' => $value->afi_fecformato,
							'afi_ApePaterno' => $value->afi_apepaterno,
							'afi_ApeMaterno' => $value->afi_apematerno,
							'afi_Nombres' => $value->afi_nombres,
							'afi_SegNombre' => $value->afi_segnombre,
							'afi_IdSexo' => $value->afi_idsexo,
							'afi_FecNac' => $value->afi_fecnac,
							'fechaActual' => $value->fechaactual,
							'edad' => $value->edad,
							'afi_IdEstado' => $value->afi_idestado,
							'afi_FecBaja' => $value->afi_fecbaja,
						];
						DB::table('afiliados')->insert($insert);
						$ingresados++;
					}else{
						$reg->afi_depa = $value->afi_depa;
						$reg->afi_prov = $value->afi_prov;
						$reg->afi_dist = $value->afi_dist;
						$reg->pre_CodEjeAdm = $value->pre_codejeadm;
						$reg->afi_IdEESSAte = $value->afi_ideessate;
						$reg->pre_Nombre = $value->pre_nombre;
						$reg->afi_IdDisa = $value->afi_iddisa;
						$reg->afi_IdDistrito = $value->afi_iddistrito;
						$reg->afi_TipoFormato = $value->afi_tipoformato;
						$reg->afi_NroFormato = $value->afi_nroformato;
						$reg->afi_IdTipoDocumento = $value->afi_idtipodocumento;
						$reg->afi_Dni = $value->afi_dni;
						$reg->afi_FecFormato = $value->afi_fecformato;
						$reg->afi_ApePaterno = $value->afi_apepaterno;
						$reg->afi_ApeMaterno = $value->afi_apematerno;
						$reg->afi_Nombres = $value->afi_nombres;
						$reg->afi_SegNombre = $value->afi_segnombre;
						$reg->afi_IdSexo = $value->afi_idsexo;
						$reg->afi_FecNac = $value->afi_fecnac;
						$reg->fechaActual = $value->fechaactual;
						$reg->edad = $value->edad;
						$reg->afi_IdEstado = $value->afi_idestado;
						$reg->afi_FecBaja = $value->afi_fecbaja;

						$reg->save();
						$actualizados++;
					}	

					
				}				
			}
			return back()->with('success', 'Ingresados ('.$ingresados.'). - '.'Actualizados ('.$actualizados.').');
		}else{
			return back()->with('danger', 'Error.');	
		}
 
        
    }
}
