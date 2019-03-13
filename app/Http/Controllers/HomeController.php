<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Afiliado;
use App\Asegurado;
use App\Historia;
use App\FUA;
use View;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        //$fuas = FUA::where('estado','=',1)->get();
        $fuas = DB::table('fuas as f')
            ->leftJoin('afiliados as a', 'a.id', '=', 'f.id_afiliado')
            ->leftJoin('users as u', 'u.id', '=', 'f.fua_profesional')
            ->where('f.estado','=',1)
            ->select(
                'f.id',
                'f.fua_NumFormato', 
                'a.afi_ApePaterno', 
                'a.afi_ApeMaterno', 
                'a.afi_Nombres', 
                'a.afi_SegNombre', 
                'a.afi_Dni',
                'u.name',
                'u.lastname'
            )
            ->get();
        View::share('i', 0);
        return view('fuas.index',compact('fuas'));

    }

    public function afiliados(Request $request)
    {

        $queryWord = strtoupper($request->q);
        $fechaActual = date('Y-m-d');
        $asegurados = null;
        if($queryWord != ""){
            $asegurados = Asegurado::where('afi_NroFormato', '=', $queryWord)
            ->orWhere('afi_Dni', '=', $queryWord)
            ->get();

            foreach ($asegurados as $asegurado) {

                $afiliado = new Afiliado;

                $verificador = Afiliado::where('afi_NroFormato', $asegurado->afi_NroFormato)->where('afi_TipoFormato', $asegurado->afi_TipoFormato)->where('afi_Dni',$asegurado->afi_Dni)->where('afi_FecNac', $asegurado->afi_FecNac)->first();

                if($verificador === null){
                    $afiliado = new Afiliado;
                }else{
                    $afiliado = Afiliado::find($verificador->id);
                }

                $historia = Historia::where('dni',$asegurado->afi_Dni)->first();

                //$afiliado = new Afiliado;
                $afiliado->pre_CodEjeAdm = $asegurado->pre_CodEjeAdm;
                $afiliado->afi_IdEESSAte = $asegurado->afi_IdEESSAte;
                $afiliado->pre_Nombre = $asegurado->pre_Nombre;
                $afiliado->afi_IdDisa = $asegurado->afi_IdDisa;
                $afiliado->afi_IdDistrito = $asegurado->afi_IdDistrito;
                $afiliado->afi_TipoFormato = $asegurado->afi_TipoFormato;
                $afiliado->afi_NroFormato = $asegurado->afi_NroFormato;
                $afiliado->afi_IdTipoDocumento = $asegurado->afi_IdTipoDocumento;
                $afiliado->afi_Dni = $asegurado->afi_Dni;
                $afiliado->afi_FecFormato = $asegurado->afi_FecFormato;
                $afiliado->afi_ApePaterno = $asegurado->afi_ApePaterno;
                $afiliado->afi_ApeMaterno = $asegurado->afi_ApeMaterno;
                $afiliado->afi_Nombres = $asegurado->afi_Nombres;
                $afiliado->afi_SegNombre = $asegurado->afi_SegNombre;
                $afiliado->afi_IdSexo = $asegurado->afi_IdSexo;
                $afiliado->afi_FecNac = $asegurado->afi_FecNac;
                $afiliado->fechaActual = $asegurado->FEC_ACTUAL;
                $afiliado->edad = $asegurado->Edad;
                $afiliado->afi_IdEstado = $asegurado->afi_IdEstado;
                if($historia != null){
                    $afiliado->historia = $historia->hc;
                }

                $fechaActual = $asegurado->FEC_ACTUAL;

                $afiliado->save();
                
            }
        }

        $afiliados = Afiliado::where('fechaActual',$fechaActual)->where(function($q) use ($queryWord){
            $q->where('afi_NroFormato', '=', $queryWord)->orWhere('afi_Dni', '=', $queryWord);
        })->get();

        View::share('q', $request->q);
        View::share('searchedBooks', $afiliados );
        return view('home');

    }

    public function fuas(Request $request)
    {

        $queryWord = strtoupper($request->fn);
        $fuas = null;
        if($queryWord != ""){

            $fuas = DB::table('fuas as f')
            ->leftJoin('afiliados as a', 'a.id', '=', 'f.id_afiliado')
            ->leftJoin('users as u', 'u.id', '=', 'f.fua_profesional')
            ->where('f.fua_NumFormato','=',$queryWord)
            ->select(
                'f.id',
                'f.fua_NumFormato', 
                'a.afi_ApePaterno', 
                'a.afi_ApeMaterno', 
                'a.afi_Nombres', 
                'a.afi_SegNombre', 
                'a.afi_Dni',
                'u.name',
                'u.lastname'
            )
            ->get();
        }
        View::share('i', 0);
        View::share('fn', $request->fn);
        View::share('fuas', $fuas );
        return view('fuas');

    }
}
