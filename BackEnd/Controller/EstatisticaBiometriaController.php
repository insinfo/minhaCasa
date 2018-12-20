<?php

namespace Jubarte\Controller;

use \Slim\Http\Request;
use \Slim\Http\Response;
use \Exception;

use Jubarte\Util\DBLayer;
use Jubarte\Util\Utils;
use Jubarte\Util\StatusCode;
use Jubarte\Util\StatusMessage;
use Jubarte\Model\VO\ViewServidores;

class EstatisticaBiometriaController
{

    public static function getServidoresBiometria(Request $request, Response $response)
    {
        try {
            $params = $request->getParsedBody();
            $biometria = $params['biometria'];
            $search =  isset($params['search']) ? '%' . trim($params['search']) . '%' : '%%';
            $draw =  isset($params['draw']) ? $params['draw'] : null;
            $limit = isset($params['length']) ? $params['length'] : null;
            $offset = isset($params['start']) ? $params['start'] : null;
            $orderby = isset($params['ordering']) ? $params['ordering'] : null;

            //solicitacoes_abertas
            DBLayer::Connect();
            $query = DBLayer::table(ViewServidores::TABLE_NAME)
                 ->select(DBLayer::raw('id, matricula, nome, cpf, rg, "dataNascimento" , "siglaLotacao", biometria'))
                ->whereRaw("biometria=$biometria")
                ->where(function ($query) use ($search) {
                    $query->orWhere(ViewServidores::MATRICULA, 'ilike', $search);
                    $query->orWhere(ViewServidores::NOME, 'ilike', $search);
                    $query->orWhere(ViewServidores::CPF, 'ilike', str_replace('.','',str_replace('-','',$search))); //retirar mascara
                    $query->orWhere(ViewServidores::RG, 'ilike', $search);
                    $query->orWhere(ViewServidores::SIGLA_LOTACAO, 'ilike', $search);
                    $query->orWhere(ViewServidores::NOME_LOTACAO, 'ilike', $search);
                });
            $totalRecords = $query->count();

            if($orderby and count($orderby))
            foreach($orderby as $order)
            {
                $query->orderBy($order['columnKey'],$order['direction']);
            }
            else
                $query->orderBy("nome");
/*
            $query = DBLayer::table(DBLayer::raw('pessoas p'))
                ->from(DBLayer::raw('pessoas p, pessoas_fisicas pf, servidores s, pmro_padrao.organograma o, pmro_padrao.organograma_historico h'))
                ->select(DBLayer::raw('distinct "idLotacao" p.id, matricula, p.nome, cpf, rg, "dataNascimento" , "idLotacao", h.sigla, h."dataInicio", biometria'))
                ->whereRaw('p.id=pf."idPessoa"')
                ->whereRaw('p.id=s."idPessoa"')
                ->whereRaw('s."idLotacao"=o.id')
                ->whereRaw('o.id=h."idOrganograma"')
                ->whereRaw("o.ativo=true")
                ->whereRaw("biometria=$biometria")
                ->orderBy(DBLayer::Raw("idLotacao", 'h."dataInicio" desc'));
                ;
          $totalRecords = $query->count();
*/
            if($limit != null)
            {
                $data = $query->limit($limit)->offset($offset)->get();
            }
            else{
                $data = $query->get();
            }

            $result['draw'] = $draw;
            $result['recordsFiltered'] = $totalRecords;
            $result['recordsTotal'] = $totalRecords;
            $result['data'] = $data;

            return $response->withStatus(StatusCode::SUCCESS)
                ->withJson($result);

        } catch (Exception $e) {
            return $response->withStatus(StatusCode::BAD_REQUEST)
                ->withJson((['message' => StatusMessage::MENSAGEM_ERRO_PADRAO,
                    'exception' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]));
        }
    }

    public static function getEstatisticaBiometria(Request $request, Response $response)
    {
        try {

            $params = $request->getParsedBody();

            //->cadastrados_hoje
            DBLayer::Connect();
            $query = DBLayer::table(DBLayer::raw('servidores a'))
                ->from(DBLayer::raw('servidores a'))
                ->select(DBLayer::raw('count(a.id) as cadastrados_hoje'))
                ->whereRaw('biometria=true')
                ->whereRaw('(current_date::text=to_char("dataAlteracao", \'YYYY-MM-DD\') OR (current_date::text=to_char("dataCadastro", \'YYYY-MM-DD\')))');
                ;
            $data = $query->get();

            //*$totalRecords = $query->count();
            $result['cadastrados_hoje'] = $data[0]['cadastrados_hoje'];

            //->total_cadastrados E nao_cadastrados (biometria=false and dataExoneracao is null)
            $query = DBLayer::table(DBLayer::raw('servidores a'))
                ->from(DBLayer::raw('servidores a'))
                ->select(DBLayer::raw('biometria,count(id)'))
                //->whereRaw('biometria=false')
                ->whereNull('dataExoneracao')
                ->groupBy("biometria");
            $data = $query->get();
            //print_r($data);
            //*$totalRecords = $query->count();
            //$result['nao_cadastrados'] = $data[0]['count'];


            if($data[0]['biometria'])
            {
                $result['total_cadastrados'] = $data[0]['count'];
                $result['nao_cadastrados'] = $data[1]['count'];
            }
            else
            {
                $result['total_cadastrados'] = $data[1]['count'];
                $result['nao_cadastrados'] = $data[0]['count'];
            }

            //->total_matriculas
            $query = DBLayer::table(DBLayer::raw('servidores'))
                ->from(DBLayer::raw('servidores'))
                ->select(DBLayer::raw('count(id)'))
                ->whereNull('dataExoneracao')
                ;
            $data = $query->get();

            //*$totalRecords = $query->count();

            $result['total_matriculas'] = $data[0]['count'];



            $query = DBLayer::table(DBLayer::raw('servidores a'))
                ->from(DBLayer::raw('servidores a'))
                ->select(DBLayer::raw("current_date - '7days'::interval as data, count(id)"))
                //->whereRaw(DBLayer::raw('("dataAlteracao" > \''.$dia['data'].'\'  or "dataAlteracao" is null) OR (("dataCadastro" > \''.$dia['data'].'\'  or "dataCadastro" is null))'))
                ->select(DBLayer::raw('current_date - \'7 days\'::interval as data, count(id)'))
                ->whereRaw(DBLayer::raw('("dataAlteracao" > current_date - \'7days\'::interval  or "dataAlteracao" is null) OR (("dataCadastro" > current_date - \'7 days\'::interval  or "dataCadastro" is null))'))
                ;
            $nao_biometrias = $query->get();

            //print_r($nao_biometrias[0]);

            //print_r($data);
            /*
            select count(id) as count, current_date - '1 days'::interval
            from portal_rh.servidores
            where
            ("dataAlteracao" > current_date - '7days'::interval  or "dataAlteracao" is null) OR
            ("dataCadastro" > current_date - '7days'::interval  or "dataCadastro" is null)
            */



            //total de cadastrados nos ultimos 7 dias
            $query = DBLayer::table(DBLayer::raw('servidores a'))
                ->from(DBLayer::raw('servidores a'))
                ->select(DBLayer::raw('to_char("dataAlteracao", \'DD-MM-YYYY\')::date as data, count(id)'))
                ->whereRaw('biometria=true AND "dataAlteracao" <= current_timestamp')
                //->whereNull('dataExoneracao')
                ->groupBy("data")
                ->orderBy("data", "desc")
                ->limit(7);
            $data = $query->get();
            sort($data);//inverter a ordem das datas (menor para maior)
            //print_r($data);
            foreach($data as $i=>$d)
            {
                $wd = explode('-',$d['data']);
                $data[$i]['data'] = "$wd[2]-$wd[1]-$wd[0]";
            }

            $result['dia'] = $data;
            /*
            select to_char("dataAlteracao", 'YYYY-MM-DD') as data, count(id) as count
            from servidores
            where biometria=true
            group by data --to_char("dataAlteracao", 'YYYY-MM-DD');
            order by data;
            */

            foreach($data as $i=>$dia)
            {
                if(isset($wdata))
                {
                    $d = explode('-',$dia['data']);
                    $dia['data'] = "$d[2]-$d[1]-$d[0]";

                    $wdata[$i] = array("data"=>$dia['data'], "count"=> ($dia['count'] + $wdata[$i-1]['count']));

                    //$wdatanao[$i] = array("data"=>$dia['data'], "count"=> ($nao_biometrias[0]['count'] - $wdata[$i]['count']));
                }
                else
                {
                    $wdata[$i] = array("data"=>$dia['data'], "count"=> ($dia['count']));
                    $wdatanao[$i] = array("data"=>$dia['data'], "count"=> ($nao_biometrias[0]['count'] - $wdata[$i]['count']));
                }
                $wdatanao[$i] = array("data"=>$dia['data'], "count"=> ($nao_biometrias[0]['count'] - $wdata[$i]['count']));



                /*

                //quantidade de pessoas nao cadastradas há 7 dias atras
                $query = DBLayer::table(DBLayer::raw('servidores a'))
                    ->from(DBLayer::raw('servidores a'))
                    //->select(DBLayer::raw("'".$dia['data']."' as data, count(id)"))
                    //->whereRaw(DBLayer::raw('("dataAlteracao" > \''.$dia['data'].'\'  or "dataAlteracao" is null) OR (("dataCadastro" > \''.$dia['data'].'\'  or "dataCadastro" is null))'))
                    ->select(DBLayer::raw('current_date - \''.$i.' days\'::interval as data, count(id)'))
                    ->whereRaw(DBLayer::raw('("dataAlteracao" > current_date - \''.$i.'days\'::interval  or "dataAlteracao" is null) OR (("dataCadastro" > current_date - \''.$i.'\'::interval  or "dataCadastro" is null))'))
                    ;
                $result['nao_biometrias'][] = $query->get();
                */


            }
            $result['biometrias'] = $wdata;
            $result['biometrias_nao'] = $wdatanao;



            return $response->withStatus(StatusCode::SUCCESS)
                ->withJson($result);

        } catch (Exception $e) {
            return $response->withStatus(StatusCode::BAD_REQUEST)
                ->withJson((['message' => StatusMessage::MENSAGEM_ERRO_PADRAO,
                    'exception' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]));
        }
    }
}
