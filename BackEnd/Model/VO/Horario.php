<?php
/**
 * Created by PhpStorm.
 * User: isaque
 * Date: 04/04/2018
 * Time: 13:41
 */

namespace Jubarte\Model\VO;

class Horario
{
    const TABLE_NAME = "horarios";
    const KEY_ID = "idCargaHoraria";

    const DIA_SEMANA = "diaSemana";
    const ENTRADA = "entrada";
    const SAIDA = "saida";
    const TEMPO_TOTAL = "tempoTotal";

    const TABLE_FIELDS = [
        self::KEY_ID,
        self::DIA_SEMANA,
        self::ENTRADA,
        self::SAIDA,
        self::TEMPO_TOTAL
    ];

    public $idCargaHoraria;
    public $diaSemana;
    public $entrada;
    public $saida;
    public $tempoTotal;

}