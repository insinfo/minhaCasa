<?php
/**
 * Created by PhpStorm.
 * User: isaque
 * Date: 17/09/2018
 * Time: 11:25
 */

namespace Jubarte\Model\DAL;

use \Exception;

use Jubarte\Util\DBLayer;
use Jubarte\Util\Utils;
use Jubarte\Util\StatusCode;
use Jubarte\Util\StatusMessage;

use Jubarte\Model\VO\PontoEletronico;
use Jubarte\Model\VO\Token;

class PontoEletronicoDAL
{
    private $db = null;

    function __construct()
    {
        $this->db = DBLayer::Connect();
    }
    //lista a marcação do mes de um servidor
    public function getMarcacao($cpf,$date = null, $limit = null, $offset = null, $ordering = null)
    {
        $date = $date ? $date : date('Y-m-d', time());
        //dd/mm/yyyy
        $format = "Y-m-d";
        $dateobj = \DateTime::createFromFormat($format, $date);
        $mes = $dateobj->format('n');//date('n', strtotime($date));
        $ano = $dateobj->format('Y');//date('Y',strtotime($date));
        $query = DBLayer::Connect('pontoEletronicoPMRO')
            ->table(PontoEletronico::TABLE_NAME)
            ->from(DBLayer::raw("generate_series(date_trunc('MONTH',now())::DATE, (date_trunc('month', CURRENT_DATE) + interval '1 month' - interval '1 day')::date,'1 day') as i"))
            ->select(DBLayer::raw('to_char(i,\'DD\') as "dia", 
            CASE EXTRACT( DOW FROM i)
             WHEN 0 THEN \'Domingo\'
             WHEN 1 THEN \'Segunda\'
             WHEN 2 THEN \'Terça\'
             WHEN 3 THEN \'Quarta\'
             WHEN 4 THEN \'Quinta\'
             WHEN 5 THEN \'Sexta\'
             WHEN 6 THEN \'Sábado\'
            END AS "diaSemana", ponto.*'))
        ->leftJoin(DBLayer::raw(
            "(select data_ponto,matricula,cpf, nome, entrada1,saida1, 
            entrada2, saida2, entrada3,saida3, entrada4, saida4
            from marcacao          
            where cpf  ='$cpf'
            and extract(month FROM data_ponto) = '$mes'
            and extract(YEAR FROM data_ponto) = '$ano'
            ) as ponto "
        ),function ($join) {
            $join->on(DBLayer::raw('ponto.data_ponto'), '=', DBLayer::raw('i'));
        });

        $totalRecords = $query->count();
        //implementação da ordenação do ModernDataTable
        if ($ordering != null && count($ordering) > 0) {
            foreach ($ordering as $item) {
                $query->orderBy($item['columnKey'], $item['direction']);
            }
        } else {
            $query->orderBy('dia');
        }

        if ($limit != null && $offset != null) {
            $data = $query->limit($limit)->offset($offset)->get();
        } else {
            $data = $query->get();
        }

        $corEntrada = '#03A9F4';//'#ffb700';
        $corSaida = '#0076AF';//'#03a9f4';
        foreach ($data as &$item) {
            $item['horarios'] = array();
            if($item['data_ponto']) {
                for ($i = 1; $i < 5; $i++) {
                    //1
                    if ($item['entrada' . $i]) {
                        $horarios = array();
                        $horarios['title'] = 'Entrada ' . $i;//.': ' . $item['entrada'.$i];
                        $horarios['start'] = $item['data_ponto'] . 'T' . $item['entrada' . $i];
                        $horarios['color'] = $corEntrada;
                        array_push($item['horarios'], $horarios);
                    }
                    if ($item['saida' . $i]) {
                        $horarios = array();
                        $horarios['title'] = 'Saida ' . $i;//.': ' . $item['saida'.$i];
                        $horarios['start'] = $item['data_ponto'] . 'T' . $item['saida' . $i];
                        $horarios['color'] = $corSaida;
                        array_push($item['horarios'], $horarios);
                    }
                }
            }
        }
        $result['draw'] = '1';
        $result['recordsFiltered'] = $totalRecords;
        $result['recordsTotal'] = $totalRecords;
        $result['data'] = $data;
        $result['now'] = $date;
        return $result;
    }
}