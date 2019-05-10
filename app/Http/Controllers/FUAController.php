<?php

namespace App\Http\Controllers;

use App\FUA;
use App\Dx;
use App\Parametro;
use Illuminate\Http\Request;
use View;
use App\Afiliado;
use App\User;
use App\Historia;
use DB;
use DateTime;

class FUAController extends Controller
{
    
    public function __construct()
    {
        //$this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fuas = FUA::where('estado','=', "1")->get()->paginate(10);

        dd($fuas); exit;

        return view('fuas.index',compact('fuas'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function getFUA()
    {
        return view('obtenerFUA');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $id_afiliado = $request->id_afiliado;

        $afiliado = Afiliado::where('id','=',$id_afiliado)->first();
        View::share('afiliado', $afiliado);

        $users = User::all();

         $CODPREST = Parametro::where('grupo','=',"CODPREST")->get();
        $PERSONAL = Parametro::where('grupo','=',"PERSONAL")->get();
        $LUGATEN = Parametro::where('grupo','=',"LUGATEN")->get();
        $TIPOATEN = Parametro::where('grupo','=',"TIPOATEN")->get();
        $CONPREST = Parametro::where('grupo','=',"CONPREST")->get();
        $DESTASEG = Parametro::where('grupo','=',"DESTASEG")->get();
        $MATERNA = Parametro::where('grupo','=',"MATERNA")->get();

        View::share('CODPREST',$CODPREST);
        View::share('PERSONAL',$PERSONAL);
        View::share('LUGATEN',$LUGATEN);
        View::share('TIPOATEN',$TIPOATEN);
        View::share('CONPREST',$CONPREST);
        View::share('DESTASEG',$DESTASEG);
        View::share('MATERNA',$MATERNA);

        View::share('users', $users);
        return view('fuas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fua = new FUA;
        $fua->fua_NumFormato = $request->fua_NumFormato;
        $fua->fua_CodigoPrestacional = $request->fua_CodigoPrestacional;
        $fua->fua_Lugar = $request->fua_Lugar;
        $fua->id_afiliado = $request->id_afiliado;
        $fua->fua_Personal = $request->fua_Personal;
        $fua->fua_LugarDesc = $request->fua_LugarDesc;
        $fua->fua_Atencion = $request->fua_Atencion; 
        $fua->fua_fechaAtencion = $request->fua_fechaAtencion;
        $fua->fua_horaAtencion = $request->fua_horaAtencion;
        $fua->fua_minAtencion = $request->fua_minAtencion;
        $fua->fua_ConceptoPrestacional = $request->fua_ConceptoPrestacional;
        $fua->fua_DestinoAsegurado = $request->fua_DestinoAsegurado;
        $fua->fua_peso = $request->fua_peso;
        $fua->fua_talla = $request->fua_talla;
        $fua->fua_SaludMaterna = $request->fua_SaludMaterna;
        $fua->fua_fechaParto = $request->fua_fechaParto;
        $fua->afi_historia = $request->afi_historia;

        $deleteHistoria = Historia::where('dni', $request->afi_Dni)->delete();

        $historia = new Historia;
        $historia->dni = $request->afi_Dni;
        $historia->hc = $request->afi_historia;
        $historia->save();

        if($request->fua_SaludMaterna == 0){
            $fua->fua_fechaParto = NULL;            
        }

        if($fua->fua_peso > 0 && $fua->fua_talla > 0){
            $fua->fua_imc = $fua->fua_peso / ($fua->fua_talla * $fua->fua_talla);
        }
        $fua->fua_profesional = $request->fua_profesional;
       
        $fua->save();

        return redirect()->route('fuas.edit',$fua->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FUA  $fUA
     * @return \Illuminate\Http\Response
     */
    public function show(FUA $fua)
    {
        return view('fua.show',compact('fua'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FUA  $fUA
     * @return \Illuminate\Http\Response
     */
    public function edit(FUA $fua)
    {
        $afiliado = Afiliado::where('id','=',$fua->id_afiliado)->first();
        View::share('afiliado', $afiliado);

        $users = User::all();
        View::share('users', $users);


        $CODPREST = Parametro::where('grupo','=',"CODPREST")->get();
        $PERSONAL = Parametro::where('grupo','=',"PERSONAL")->get();
        $LUGATEN = Parametro::where('grupo','=',"LUGATEN")->get();
        $TIPOATEN = Parametro::where('grupo','=',"TIPOATEN")->get();
        $CONPREST = Parametro::where('grupo','=',"CONPREST")->get();
        $DESTASEG = Parametro::where('grupo','=',"DESTASEG")->get();
        $MATERNA = Parametro::where('grupo','=',"MATERNA")->get();

        $BIFURCA = Parametro::where('grupo','=', "001")->get();

        $MENTAL = Parametro::where('grupo','=', "MENTAL")->get();
        $CLASEDX = Parametro::where('grupo','=', "CLASEDX")->get();

        $PROFESIONAL = User::find($fua->fua_profesional);

        //dd($PROFESIONAL); exit;

        View::share('CODPREST',$CODPREST);
        View::share('PERSONAL',$PERSONAL);
        View::share('LUGATEN',$LUGATEN);
        View::share('TIPOATEN',$TIPOATEN);
        View::share('CONPREST',$CONPREST);
        View::share('DESTASEG',$DESTASEG);
        View::share('MATERNA',$MATERNA);
        View::share('BIFURCA',$BIFURCA);
        View::share('MENTAL',$MENTAL);
        View::share('PROFESIONAL', $PROFESIONAL);
        View::share('CLASEDX',$CLASEDX);

        $DX = DB::table('dx')
            ->leftJoin('cie10', 'dx.codigo', '=', 'cie10.id')
            ->where('dx.id_fua','=',$fua->id)
            ->select('cie10.id', 'cie10.codigo', 'cie10.descripcion', 'dx.clase', 'dx.codigo as dxid')
            ->get();

        //------------- CONSTRUIR DIAGNOSTICOS ---------------------
        $strDX = "";
        foreach($DX as $d){
            $strDX .= $d->descripcion."_RT";
            $strDX .= $d->clase."_RT";
            $strDX .= $d->codigo."_RN";
        }
        //----------------------------------------------------------

        $DXcount = DB::table('dx')->where('id_fua','=', $fua->id)->count();

        View::share('DX',$DX);
        View::share('strDX', $strDX);
        View::share('DXcount',$DXcount);

        return view('fuas.edit',compact('fua'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FUA  $fUA
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FUA $fua)
    {
        $fua->update($request->all());

         if($request->fua_SaludMaterna == 0){
            $fua->fua_fechaParto = NULL;            
        }

        $deleteHistoria = Historia::where('dni', $request->afi_Dni)->delete();

        $historia = new Historia;
        $historia->dni = $request->afi_Dni;
        $historia->hc = $request->afi_historia;
        $historia->save();


        $fua->save();
        

       return redirect()->route('fuas.edit',$fua->id);

    }

    public function saveDx(Request $request){
        /*$data = $request->all();
        $classDx = array_get($data, 'classDx');*/
        $fua = $request->id_fua;
        $class = $request->classDx;
        $cod = $request->codDx;

        $formato = FUA::find($fua);

        $formato->controlDx = $request->controlDx;
        $formato->save();

        $deletedRows = Dx::where('id_fua', $fua)->delete();

        for($i=0; $i<count($class);$i++){
            $dx = new Dx;
            $dx->id_fua = $fua;
            $dx->clase = $class[$i];
            $dx->codigo = $cod[$i];

            $dx->save();
        }

        return;

    }

    public function saveAPO(Request $request){

        $fua = FUA::find($request->id_fua);
        //dd($request); exit;


        $fua->apo_peso = $request->apo_peso;
        $fua->apo_talla = $request->apo_talla;
        $fua->apo_imc = $request->apo_imc;
        $fua->apo_pa = $request->apo_pa;
        $fua->apo_1_cpn = $request->apo_1_cpn;
        $fua->apo_1_egest = $request->apo_1_egest;
        $fua->apo_1_au = $request->apo_1_au;
        $fua->apo_1_pv = $request->apo_1_pv;
        $fua->apo_1_cp  = $request->apo_1_cp;

        $fua->apo_2_egest = $request->apo_2_egest;
        $fua->apo_2_apgar = $request->apo_2_apgar;
        $fua->apo_2_ctc = $request->apo_2_ctc;

        $fua->apo_3_cred = $request->apo_3_cred;
        $fua->apo_3_prem = $request->apo_3_prem;
        $fua->apo_3_bpn = $request->apo_3_bpn;
        $fua->apo_3_ec = $request->apo_3_ec;
        $fua->apo_3_fg = $request->apo_3_fg;
        $fua->apo_3_pab = $request->apo_3_pab;
        $fua->apo_3_tap = $request->apo_3_tap;
        $fua->apo_3_cn = $request->apo_3_cn;
        $fua->apo_3_ci = $request->apo_3_ci;

        $fua->apo_4_ei = $request->apo_4_ei;
        $fua->apo_5_vacam = $request->apo_5_vacam;
        $fua->apo_5_tsm = $request->apo_5_tsm;

        if($fua->apo_peso > 0 && $fua->apo_talla > 0){
            $fua->apo_imc_c = floatval($fua->apo_peso) / (floatval($fua->apo_talla)/100 * floatval($fua->apo_talla)/100);
            
        }

        $fua->save();

        return;

    }

    public function saveVAC(Request $request){

        $fua = FUA::find($request->id_fua);

        $fua->vac_BCG = $request->vac_BCG;
        $fua->vac_DPT = $request->vac_DPT;
        $fua->vac_APO = $request->vac_APO;
        $fua->vac_ASA = $request->vac_ASA;
        $fua->vac_SPR = $request->vac_SPR;
        $fua->vac_SR = $request->vac_SR;
        $fua->vac_HVB = $request->vac_HVB;
        $fua->vac_INF = $request->vac_INF;
        $fua->vac_PAR = $request->vac_PAR;
        $fua->vac_RUB = $request->vac_RUB;
        $fua->vac_ROT = $request->vac_ROT;
        $fua->vac_DT = $request->vac_DT;
        $fua->vac_IPV = $request->vac_IPV;
        $fua->vac_PEN = $request->vac_PEN;
        $fua->vac_AAM = $request->vac_AAM;
        $fua->vac_ANE = $request->vac_ANE;
        $fua->vac_ATE = $request->vac_ATE;
        $fua->vac_CED = $request->vac_CED;
        $fua->vac_VPH = $request->vac_VPH;
        $fua->vac_OV = $request->vac_OV;
        $fua->vac_GRHVB = $request->vac_GRHVB;

        $fua->save();

        return;
    }

    public function close(Request $request){
        $fua = FUA::where('id','=',$request->id_fua)->first();

        $fua->estado = 2;
        $fua->save();

        return redirect()->route('fuas.edit',$fua->id);

    }

    public function checkCP(Request $request){
        $id_afiliado = $request->id_afiliado;
        $id_cp = $request->id_cp;

        $parametro = Parametro::where('grupo','=','CODPREST')->where('codigo',"=",$id_cp)->first();

        $periodicidad = $parametro->extra;

        // TRATO DE PERIODICIDAD
        $res = new \stdClass();
        $res->estado = "OK";
        $res->mensaje = "";


        if($periodicidad == "A"){
            $ultima_atencion = FUA::where('id_afiliado','=',$id_afiliado)
            ->where('fua_CodigoPrestacional','=',$id_cp)
            ->orderBy('id','desc')
            ->first();

            if($ultima_atencion != null){
                $earlier = new DateTime($ultima_atencion->fua_fechaAtencion);
                $later = new DateTime(date("Y-m-d"));

                $diff = $later->diff($earlier)->format("%a");
                if($diff < 365){
                    $res->estado = "error";
                    $res->mensaje = "Este Codigo Prestacional solo puede ser usado en periodo anual, actualmente han pasado ".$diff. " dia(s) desde la ultima atención con este Codigo Prestacional.";
                }
                
            }
        }


        return json_encode($res);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FUA  $fUA
     * @return \Illuminate\Http\Response
     */
    public function destroy(FUA $fua)
    {
        //
    }
}
