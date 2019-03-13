<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FUA extends Model
{
    //
    protected $table = 'fuas';

    protected $fillable = [
        'fua_NumFormato',
        'fua_Lugar',
        'fua_CodigoPrestacional',
        'id_afiliado',
        'fua_Personal',
        'fua_LugarDesc',
        'fua_Atencion',
        'fua_fechaAtencion',        
        'fua_horaAtencion',
        'fua_minAtencion',
        'fua_ConceptoPrestacional',
        'fua_DestinoAsegurado',
        'fua_SaludMaterna',
        'fua_fechaParto',
        'fua_peso',
        'fua_talla',
        'fua_imc',
        'fua_imc_c',
        'fua_profesional',

        'afi_historia',

        'apo_peso',
        'apo_talla',
        'apo_pa',
        'apo_1_cpn',
        'apo_1_egest',
        'apo_1_au',
        'apo_1_pv', 
        'apo_1_cp',

        'apo_2_egest',
        'apo_2_apgar',
        'apo_2_ctc',

        'apo_3_cred',
        'apo_3_prem',
        'apo_3_bpn',
        'apo_3_ec',
        'apo_3_fg',
        'apo_3_pab',
        'apo_3_tap',
        'apo_3_cn',
        'apo_3_ci',

        'apo_4_ei',

        'apo_5_vacam',
        'apo_5_tsm',

        'vac_BCG',
        'vac_DPT',
        'vac_APO',
        'vac_ASA',
        'vac_SPR',
        'vac_SR',
        'vac_HVB',
        'vac_INF',
        'vac_PAR',
        'vac_RUB',
        'vac_ROT',
        'vac_DT',
        'vac_IPV',
        'vac_PEN',
        'vac_AAM',
        'vac_ANE',
        'vac_ATE',
        'vac_CED',
        'vac_VPH',
        'vac_OV',
        'vac_GRHVB',

        'controlDx',

        'estado'

    ];
}