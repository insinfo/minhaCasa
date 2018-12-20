<?php
/**
 * Created by PhpStorm.
 * User: isaque
 * Date: 26/02/2018
 * Time: 15:38
 */

namespace Jubarte\Controller;

use \Slim\Http\Request;
use \Slim\Http\Response;
use \Exception;
use Jubarte\Util\StatusCode;
use Jubarte\Util\StatusMessage;

use PmroPadraoLib\Controller\OrganogramaController;

class OrganogramasController
{
    //LISTA TODOS Organogramas para um treeview
    public static function getHierarquia(Request $request, Response $response)
    {
        try
        {
            //$formData = $request->getParsedBody();
            $result = OrganogramaController::getHierarquia(null);
        }
        catch (Exception $e)
        {
            return $response->withStatus(StatusCode::BAD_REQUEST)
                ->withJson((['message' => StatusMessage::MENSAGEM_ERRO_PADRAO, 'exception' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]));
        }
        return $response->withStatus(StatusCode::SUCCESS)->withJson($result);
    }

    //LISTA Historico de uma Secretaria ou Setor
    public static function getHistoricoOrganograma(Request $request, Response $response)
    {
        try
        {
            $formData = $request->getParsedBody(); //print_r($formData);
            $result = OrganogramaController::getHistoricoOrganograma($formData['idOrganograma']);
            $result['data'] = $result;
        }
        catch (Exception $e)
        {
            return $response->withStatus(StatusCode::BAD_REQUEST)
                ->withJson((['message' => StatusMessage::MENSAGEM_ERRO_PADRAO, 'exception' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]));
        }
        return $response->withStatus(StatusCode::SUCCESS)->withJson($result);
    }

    public static function save(Request $request, Response $response)
    {
        try
        {
            $idOrganograma = $request->getAttribute('idOrganograma');
            $dataInicio = $request->getAttribute('dataInicio');

            //print "$idOrganograma :: $dataInicio";

            $formData = $request->getParsedBody();

            //valor default para dataInicio (caso nao seja preenchida)
            if(!isset($formData['setorHistorico']['dataInicio']))
                $formData['setorHistorico']['dataInicio'] = '01/01/1900';

            //print_r($formData);

            if(!$idOrganograma)
                $result = OrganogramaController::save($formData['setor'], $formData['setorHistorico']);
            elseif($idOrganograma AND $dataInicio)
            {   //alterar o histórico de um setor existente
                //print_r($formData);
                $formData['setor']['id'] = $idOrganograma;
                $formData['setorHistorico']['idOrganograma'] = $idOrganograma;
                $formData['setorHistorico']['dataInicio'] = $dataInicio;

                $result = OrganogramaController::update($formData['setor'], $formData['setorHistorico']);
            }
            elseif($idOrganograma)
            {
                //criar um historico para um setor existente
                //print_r($formData);
                //$formData['setor']['id'] = $idOrganograma;
                $formData['setorHistorico']['idOrganograma'] = $idOrganograma;
                $result = OrganogramaController::save($formData['setor'], $formData['setorHistorico']);
            }


        }
        catch (Exception $e)
        {
            return $response->withStatus(StatusCode::BAD_REQUEST)
                ->withJson((['message' => StatusMessage::MENSAGEM_ERRO_PADRAO, 'exception' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]));
        }
        return $response->withStatus(StatusCode::SUCCESS)->withJson(['message' => StatusMessage::MENSAGEM_DE_SUCESSO_PADRAO]);
    }

    //LISTA Historico de uma Secretaria ou Setor
    public static function getNumeroLei(Request $request, Response $response)
    {
        try
        {
            $formData = $request->getParsedBody(); //print_r($formData);
            $numeroLei = $request->getAttribute('numeroLei');

            $result = OrganogramaController::getNumeroLei($numeroLei);

        }
        catch (Exception $e)
        {
            return $response->withStatus(StatusCode::BAD_REQUEST)
                ->withJson((['message' => StatusMessage::MENSAGEM_ERRO_PADRAO, 'exception' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()]));
        }
        return $response->withStatus(StatusCode::SUCCESS)->withJson($result);
    }
}