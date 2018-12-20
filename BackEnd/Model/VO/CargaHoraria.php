<?php
/**
 * Created by PhpStorm.
 * User: isaque
 * Date: 27/03/2018
 * Time: 18:24
 */

namespace Jubarte\Model\VO;

class CargaHoraria
{
    const TABLE_NAME = "carga_horaria";
    const KEY_ID = "id";
    const ID_PESSOA = "idPessoa";
    const ID_LOCAL_BIOMETRIA = "idLocalBiometria";
    const TIPO = "tipo";
    const MES_COMPETENCIA = "mesCompetencia";
    const ANO_COMPETENCIA = "anoCompetencia";

    const TABLE_FIELDS = [
        self::ID_PESSOA,
        self::ID_LOCAL_BIOMETRIA,
        self::TIPO,
        self::ANO_COMPETENCIA,
        self::MES_COMPETENCIA
    ];


}