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

class PortalController
{
    public static function createPost(Request $request, Response $response)
    {
        try {

            // Load WordPress
            require_once dirname(dirname(__FILE__)).'\vendor\wordpress-4.9.8-pt_BR\wp-load.php';
            require_once dirname(dirname(__FILE__)).'\vendor\wordpress-4.9.8-pt_BR\wp-admin\includes\taxonomy.php';
            // Set the timezone so times are calculated correctly
            date_default_timezone_set('America/Sao_Paulo');
            // Create post
            $id = wp_insert_post(array(
                'post_title'    => 'teste isaque API 3',
                'post_content'  => 'teste isaque API 3',
                'post_date'     => date('Y-m-d H:i:s'),
                'post_author'   => 1,
                'post_type'     => 'post',// ‘post’ or ‘page’
                'post_status'   => 'publish',
            ));

            if ($id) {
                // Set category - create if it doesn't exist yet
               // wp_set_post_terms($id, wp_create_category('My Category'), 'category');
                // Add meta data, if required
               // add_post_meta($id, 'meta_key', $metadata);

                /*wp_update_post(array(
                    'ID'    =>  $id,
                    'post_status'   =>  'publish'
                ));*/

            } else {
                throw new Exception("WARNING: Failed to insert post into WordPress");
            }

            return $response->withStatus(StatusCode::SUCCESS)
                ->withJson(['message' => StatusMessage::SUCCESS]);

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

}