<?php

namespace Jubarte\Controller;

use \Slim\Http\Request;
use \Slim\Http\Response;
use \Exception;

use Jubarte\Util\DBLayer;
use Jubarte\Util\Utils;
use Jubarte\Util\StatusCode;
use Jubarte\Util\StatusMessage;

class IntranetController
{
    public static function getSistemasAtivos(Request $request, Response $response)
    {
        try {

            $params = $request->getParsedBody();

            //sistemas_ativos
            DBLayer::Connect();
            $query = DBLayer::table(DBLayer::raw('sistemas'))
                ->from(DBLayer::raw('sistemas'))
                ->select(DBLayer::raw('count(id)'))
                ->where("ativo","=","true");
            $data = $query->get();

            //*$totalRecords = $query->count();

            $result['sistemas_ativos'] = $data[0]['count'];

            //usuarios_ativos
            $query = DBLayer::table(DBLayer::raw('usuarios'))
                ->from(DBLayer::raw('usuarios'))
                ->select(DBLayer::raw('count(distinct "idPessoa")'))
                ->where("ativo","=","true");
            $data = $query->get();

            //*$totalRecords = $query->count();

            $result['usuarios_ativos'] = $data[0]['count'];

            //pessoas_cadastradas
            $query = DBLayer::table(DBLayer::raw('pessoas'))
                ->from(DBLayer::raw('pessoas'))
                ->select(DBLayer::raw('count(id)'))
                ;
            $data = $query->get();

            //*$totalRecords = $query->count();

            $result['cadastros_ativos'] = $data[0]['count'];

            return $response->withStatus(StatusCode::SUCCESS)
                ->withJson($result);

        } catch (Exception $e) {
            return $response->withStatus(StatusCode::BAD_REQUEST)
                ->withJson((['message' => StatusMessage::MENSAGEM_ERRO_PADRAO,
                    'exception' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]));
        }
    }

    public static function getEstatisticaSolicitacoes(Request $request, Response $response)
    {
        try {

            $params = $request->getParsedBody();

            //solicitacoes_abertas
            DBLayer::Connect();
            $query = DBLayer::table(DBLayer::raw('solicitacoes a'))
                ->from(DBLayer::raw('solicitacoes a, atendimentos b'))
                ->select(DBLayer::raw('count(distinct a.id)'))
                ->whereRaw('a.id = b."idSolicitacao"')
                ->whereRaw('a."dataFechamento" IS NULL')
                ->whereRaw("b.status=0");
                ;
            $data = $query->get();

            //*$totalRecords = $query->count();

            $result['solicitacoesAbertas'] = $data[0]['count'];

            //solicitacoes concluidas
            $query = DBLayer::table(DBLayer::raw('solicitacoes'))
                ->from(DBLayer::raw('solicitacoes'))
                ->select(DBLayer::raw('count(id)'))
                ->whereNotNull('dataFechamento');
            $data = $query->get();

            //*$totalRecords = $query->count();

            $result['solicitacoesConcluidas'] = $data[0]['count'];

            //total de solicitacoes
            $query = DBLayer::table(DBLayer::raw('solicitacoes'))
                ->from(DBLayer::raw('solicitacoes'))
                ->select(DBLayer::raw('count(id)'))
                ;
            $data = $query->get();

            //*$totalRecords = $query->count();

            $result['solicitacoesTotal'] = $data[0]['count'];

            //total em andamento (Andamento + Pendente)
            $query = DBLayer::table(DBLayer::raw('solicitacoes a'))
                ->from(DBLayer::raw('solicitacoes a, atendimentos b'))
                ->select(DBLayer::raw('count(distinct a.id)'))
                ->whereRaw('a.id = b."idSolicitacao"')
                ->whereRaw('a."dataFechamento" IS NULL')
                ->whereRaw("b.status IN (1,2)");
                ;
            $data = $query->get();

            //*$totalRecords = $query->count();

            $result['solicitacoesAndamento'] = $data[0]['count'];

            return $response->withStatus(StatusCode::SUCCESS)
                ->withJson($result);

        } catch (Exception $e) {
            return $response->withStatus(StatusCode::BAD_REQUEST)
                ->withJson((['message' => StatusMessage::MENSAGEM_ERRO_PADRAO,
                    'exception' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]));
        }
    }

    public static function getAniversariantes(Request $request, Response $response)
    {
        try {

            $params = $request->getParsedBody();

            //solicitacoes_abertas
            DBLayer::Connect();
            $query = DBLayer::table(DBLayer::raw('view_servidores a'))
                ->from(DBLayer::raw('view_servidores a'))
                ->select(DBLayer::raw('distinct nome, "dataNascimento", "siglaLocalTrabalho", "siglaLotacao", image, (extract(\'YEAR\' from current_date)||to_char(current_date,\'MMDD\')) as niver, (extract(\'YEAR\' from current_date)||to_char("dataNascimento",\'MMDD\'))::integer as aniversario'))
                ->whereRaw('to_char("dataNascimento",\'MMDD\')::integer BETWEEN to_char(current_date - \'1day\'::interval,\'MMDD\')::integer AND to_char(current_date + \'1day\'::interval,\'MMDD\')::integer')
                ->orderBy("aniversario", "nome")
                ;
            $data = $query->get();

            //*$totalRecords = $query->count();

            $result['data'] = $data;

            return $response->withStatus(StatusCode::SUCCESS)->withJson($result);

        }
        catch (Exception $e)
        {
            return $response->withStatus(StatusCode::BAD_REQUEST)
                ->withJson((['message' => StatusMessage::MENSAGEM_ERRO_PADRAO,
                    'exception' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]));
        }
    }
}