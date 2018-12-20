<?php

namespace Jubarte\Controller;

use \Slim\Http\Request;
use \Slim\Http\Response;
use \Exception;

use Jubarte\Util\DBLayer;
use Jubarte\Util\Utils;
use Jubarte\Util\StatusCode;
use Jubarte\Util\StatusMessage;

use Jubarte\Model\VO\ViewPessoas;
use Jubarte\Model\VO\Token;
use PmroPadraoLib\Controller\PessoaController;
use Jubarte\Model\BSL\ActiveDirectoryAPI;
use PmroPadraoLib\Controller\OrganogramaController;
use Jubarte\Model\VO\CartaSenhaSolicitacao;

class CartaSenhaController
{
    public static function getPessoaByCPF(Request $request, Response $response)
    {
        try {

            $cpf = $request->getAttribute('cpf');
            if (!$cpf) {
                throw new Exception('CPF é obrigatório!');
            }

            DBLayer::Connect();
            $query = DBLayer::table(ViewPessoas::TABLE_NAME);
            $query->where(ViewPessoas::CPF, '=', $cpf);
            $result = $query->first();

            return $response->withStatus(StatusCode::SUCCESS)
                ->withJson($result);

        } catch (Exception $e) {
            return $response->withStatus(StatusCode::BAD_REQUEST)
                ->withJson((['message' => StatusMessage::MENSAGEM_ERRO_PADRAO,
                    'exception' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]));
        }
    }

    public static function savePessoa(Request $request, Response $response)
    {
        try {
            $id = $request->getAttribute('id');
            $formData = $request->getParsedBody();
            $idPessoa = null;
            if ($id) {
                PessoaController::update($formData);
            } else {
                $idPessoa = PessoaController::save($formData);
            }

            return $response->withStatus(StatusCode::SUCCESS)
                ->withJson([
                    'message' => StatusMessage::MENSAGEM_DE_SUCESSO_PADRAO,
                    'idPessoa' => $idPessoa
                ]);

        } catch (Exception $e) {
            return $response->withStatus(StatusCode::BAD_REQUEST)
                ->withJson(([
                    'message' => StatusMessage::MENSAGEM_ERRO_PADRAO,
                    'exception' => $e->getMessage(),
                    'line' => $e->getLine(), 'file' => $e->getFile()]));
        }


    }

    //lista organogramas nivel maximo ou seja altarquias/PMRO ou seja Orgãos
    public static function getAllOrganogramaOrgao(Request $request, Response $response)
    {
        try {
            DBLayer::Connect();
            $query = DBLayer::table('');
            $query->from(DBLayer::raw('func_organograma()'));
            $query->whereRaw('"idPai" is null');
            $result = $query->get();

            return $response->withStatus(StatusCode::SUCCESS)
                ->withJson($result);

        } catch (Exception $e) {
            return $response->withStatus(StatusCode::BAD_REQUEST)
                ->withJson((['message' => StatusMessage::MENSAGEM_ERRO_PADRAO,
                    'exception' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]));
        }
    }

    //lista nivel abaixo de PMRO/Altarquias
    public static function getAllOrganogramaUnidade(Request $request, Response $response)
    {
        try {

            $idOrgao = $request->getAttribute('idOrgao');
            $idOrgao = $idOrgao ? $idOrgao : 389;
            DBLayer::Connect();
            $query = DBLayer::table('');
            $query->from(DBLayer::raw('func_organograma()'));
            $query->where("idPai", '=', $idOrgao);
            $result = $query->get();

            return $response->withStatus(StatusCode::SUCCESS)
                ->withJson($result);

        } catch (Exception $e) {
            return $response->withStatus(StatusCode::BAD_REQUEST)
                ->withJson((['message' => StatusMessage::MENSAGEM_ERRO_PADRAO,
                    'exception' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]));
        }
    }

    public static function getAllOrganogramaDepartamento(Request $request, Response $response)
    {
        try {

            $idUnidade = $request->getAttribute('idUnidade');
            $idUnidade = $idUnidade ? $idUnidade : 1;
            DBLayer::Connect();
            $query = DBLayer::table('');
            $query->from(DBLayer::raw('func_organograma()'));
            $query->whereRaw('"idPai" in (SELECT id FROM "view_secretarias")');
            $query->where("idPai", '=', $idUnidade);
            $result = $query->get();

            return $response->withStatus(StatusCode::SUCCESS)
                ->withJson($result);

        } catch (Exception $e) {
            return $response->withStatus(StatusCode::BAD_REQUEST)
                ->withJson((['message' => StatusMessage::MENSAGEM_ERRO_PADRAO,
                    'exception' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]));
        }
    }

    //orgaos do sali
    public static function getAllSaliOrgao(Request $request, Response $response)
    {
        try {
            DBLayer::Connect('saliTeste');
            $query = DBLayer::table('');
            $query->selectRaw("cod_orgao||'.'||ano_exercicio as cod_orgao, nom_orgao");
            $query->from(DBLayer::raw('administracao.orgao'));
            $query->whereRaw('situacao=1');
            $query->orderBy('nom_orgao');
            $result = $query->get();

            foreach ($result as &$item) {
                $item['nom_orgao'] = utf8_encode($item['nom_orgao']);
            }

            return $response->withStatus(StatusCode::SUCCESS)
                ->withJson($result);

        } catch (Exception $e) {
            return $response->withStatus(StatusCode::BAD_REQUEST)
                ->withJson(([
                    'message' => StatusMessage::MENSAGEM_ERRO_PADRAO,
                    'exception' => $e->getMessage(), 'line' => $e->getLine(),
                    'file' => $e->getFile()
                ]));
        }
    }

    //Unidade do sali
    public static function getAllSaliUnidade(Request $request, Response $response)
    {
        try {
            $idOrgao = $request->getAttribute('idOrgao');
            $idOrgao = $idOrgao ? $idOrgao : '2.2003';
            DBLayer::Connect('saliTeste');
            $query = DBLayer::table('');
            $query->selectRaw("cod_orgao||'.'||ano_exercicio as cod_orgao, cod_unidade, nom_unidade");
            $query->from(DBLayer::raw('administracao.unidade'));
            $query->whereRaw("cod_orgao||'.'||ano_exercicio='$idOrgao'");
            $query->whereRaw("situacao=1");
            $query->orderBy('nom_unidade');
            $result = $query->get();

            foreach ($result as &$item) {
                $item['nom_unidade'] = utf8_encode($item['nom_unidade']);
            }

            return $response->withStatus(StatusCode::SUCCESS)
                ->withJson($result);

        } catch (Exception $e) {
            return $response->withStatus(StatusCode::BAD_REQUEST)
                ->withJson(([
                    'message' => StatusMessage::MENSAGEM_ERRO_PADRAO,
                    'exception' => $e->getMessage(), 'line' => $e->getLine(),
                    'file' => $e->getFile()
                ]));
        }
    }

    //Departamento do sali
    public static function getAllSaliDepartamento(Request $request, Response $response)
    {
        try {
            $idOrgao = $request->getAttribute('idOrgao');
            $idOrgao = $idOrgao ? $idOrgao : '2.2003';

            $idUnidade = $request->getAttribute('idUnidade');
            $idUnidade = $idUnidade ? $idUnidade : 16;

            DBLayer::Connect('saliTeste');
            $query = DBLayer::table('');
            $query->selectRaw("cod_orgao||'.'||ano_exercicio as cod_orgao, cod_unidade, cod_departamento, nom_departamento");
            $query->from(DBLayer::raw('administracao.departamento'));
            $query->whereRaw("cod_orgao||'.'||ano_exercicio='$idOrgao'");
            $query->whereRaw("cod_unidade='$idUnidade'");
            $query->whereRaw("situacao=1");
            $query->orderBy('nom_departamento');
            $result = $query->get();

            foreach ($result as &$item) {
                $item['nom_departamento'] = utf8_encode($item['nom_departamento']);
            }

            return $response->withStatus(StatusCode::SUCCESS)
                ->withJson($result);

        } catch (Exception $e) {
            return $response->withStatus(StatusCode::BAD_REQUEST)
                ->withJson(([
                    'message' => StatusMessage::MENSAGEM_ERRO_PADRAO,
                    'exception' => $e->getMessage(), 'line' => $e->getLine(),
                    'file' => $e->getFile()
                ]));
        }
    }

    //Setor do sali
    public static function getAllSaliSetor(Request $request, Response $response)
    {
        try {
            $idOrgao = $request->getAttribute('idOrgao');
            $idOrgao = $idOrgao ? $idOrgao : '2.2003';

            $idUnidade = $request->getAttribute('idUnidade');
            $idUnidade = $idUnidade ? $idUnidade : 16;

            $idDepartamento = $request->getAttribute('idDepartamento');
            $idDepartamento = $idDepartamento ? $idDepartamento : 5;

            DBLayer::Connect('saliTeste');
            $query = DBLayer::table('');
            $query->selectRaw("a.cod_orgao||'.'||a.ano_exercicio as cod_orgao, a.cod_unidade, a.cod_departamento, a.ano_exercicio, a.cod_setor,a.nom_setor ");
            $query->from(DBLayer::raw('administracao.setor a'));
            $query->whereRaw("a.cod_orgao||'.'||a.ano_exercicio='$idOrgao'");
            $query->whereRaw("a.cod_unidade='$idUnidade'");
            $query->whereRaw("a.cod_departamento='$idDepartamento'");
            $query->whereRaw("situacao=1");
            $query->orderBy('nom_setor');
            $result = $query->get();

            foreach ($result as &$item) {
                $item['nom_setor'] = utf8_encode($item['nom_setor']);
            }

            return $response->withStatus(StatusCode::SUCCESS)
                ->withJson($result);

        } catch (Exception $e) {
            return $response->withStatus(StatusCode::BAD_REQUEST)
                ->withJson(([
                    'message' => StatusMessage::MENSAGEM_ERRO_PADRAO,
                    'exception' => $e->getMessage(), 'line' => $e->getLine(),
                    'file' => $e->getFile()
                ]));
        }
    }

    //lista todas as Organizational units do LDAP juntamente com grupos
    public static function getAllHierarchyOU(Request $request, Response $response)
    {
        try {
            $activeDirectoryAPI = new ActiveDirectoryAPI();
            $result = $activeDirectoryAPI->getAllHierarchyOU();

            return $response->withStatus(StatusCode::SUCCESS)
                ->withJson($result);

        } catch (Exception $e) {
            return $response->withStatus(StatusCode::BAD_REQUEST)
                ->withJson(([
                    'message' => StatusMessage::MENSAGEM_ERRO_PADRAO,
                    'exception' => $e->getMessage(), 'line' => $e->getLine(),
                    'file' => $e->getFile()
                ]));
        }
    }

    //LISTA TODOS Organogramas para um treeview
    public static function getAllHierarchyOrganograma(Request $request, Response $response)
    {
        try {
            //$formData = $request->getParsedBody();
            $result = OrganogramaController::getHierarquia(null);
        } catch (Exception $e) {
            return $response->withStatus(StatusCode::BAD_REQUEST)
                ->withJson((['message' => StatusMessage::MENSAGEM_ERRO_PADRAO, 'exception' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]));
        }
        return $response->withStatus(StatusCode::SUCCESS)->withJson($result);
    }

    public static function createCartaSenha(Request $request, Response $response)
    {
        try {
            //$token = new Token($request);
            //$id = $request->getAttribute('id');
            $formData = $request->getParsedBody();
            $cartaSenha = array();
            $cartaSenha['tipoConta'] = $formData['tipoConta'];
            //$cartaSenha['isValidado'] = $formData['isValidado'];
            //$cartaSenha['dataSolicitacao'] = $formData['dataSolicitacao'];
            $cartaSenha['idPessoa'] = $formData['idPessoa'];
            $cartaSenha['cpf'] = $formData['cpf'];
            $cartaSenha['dadosDaConta'] = json_encode($formData['dadosDaConta']);
            $cartaSenha['matricula'] = $formData['matricula'];
            $cartaSenha['cargo'] = $formData['cargo'];
            $cartaSenha['telefoneSetor'] = $formData['telefoneSetor'];
            $cartaSenha['organogramaSigla'] = $formData['organogramaSigla'];
            $cartaSenha['organogramaId'] = $formData['organogramaId'];
            $cartaSenha['organogramaNome'] = $formData['organogramaNome'];
            $cartaSenha['observacoes'] = $formData['observacoes'];
            $cartaSenha['pass'] = $formData['pass'];
            $cartaSenha['nomeSolicitante'] = $formData['nomeSolicitante'];
            $cartaSenha['isUsuarioCadastradoPorAqui'] = $formData['isUsuarioCadastradoPorAqui'];

            DBLayer::Connect()->table(CartaSenhaSolicitacao::TABLE_NAME)
                ->insert($cartaSenha);

            return $response->withStatus(StatusCode::SUCCESS)
                ->withJson([
                    'message' => StatusMessage::MENSAGEM_DE_SUCESSO_PADRAO
                ]);

        } catch (Exception $e) {
            return $response->withStatus(StatusCode::BAD_REQUEST)
                ->withJson(([
                    'message' => StatusMessage::MENSAGEM_ERRO_PADRAO,
                    'exception' => $e->getMessage(),
                    'line' => $e->getLine(),
                    'file' => $e->getFile()
                ]));
        }

    }

    public static function getAllCartaSenha(Request $request, Response $response)
    {
        try {
            $params = $request->getParsedBody();
            $draw = isset($params['draw']) ? $params['length'] : null;
            $limit = isset($params['length']) ? $params['length'] : null;
            $offset = isset($params['start']) ? $params['start'] : null;
            $search = isset($params['search']) ? $params['search'] : null;
            $ordering = isset($param['ordering']) ? $params['ordering'] : null;

            $query = DBLayer::Connect()->table(CartaSenhaSolicitacao::TABLE_NAME);

            if ($search != null) {
                $search = '%' . $search . '%';
                $query->where(function ($query) use ($request, $search) {
                    $query->orWhere(CartaSenhaSolicitacao::CPF, 'ilike', $search);
                    $query->orWhere(CartaSenhaSolicitacao::MATRICULA, 'ilike', $search);
                    $query->orWhere(CartaSenhaSolicitacao::CARGO, 'ilike', $search);
                    $query->orWhere(CartaSenhaSolicitacao::ORGANOGRAMA_NOME, 'ilike', $search);
                    $query->orWhere(CartaSenhaSolicitacao::ORGANOGRAMA_SIGLA, 'ilike', $search);
                });
            }
            $totalRecords = $query->count();

            //implementação da ordenação do ModernDataTable
            if ($ordering != null && count($ordering) > 0) {
                foreach ($ordering as $item) {
                    $query->orderBy($item['columnKey'], $item['direction']);
                }
            } else {
                $query->orderBy(CartaSenhaSolicitacao::KEY_ID, DBLayer::ORDER_DIRE_ASC);
            }

            if ($limit != null && $offset != null) {
                $data = $query->limit($limit)->offset($offset)->get();
            } else {
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
                ->withJson(([
                    'message' => StatusMessage::MENSAGEM_ERRO_PADRAO,
                    'exception' => $e->getMessage(), 'line' => $e->getLine(),
                    'file' => $e->getFile()
                ]));
        }
    }
}