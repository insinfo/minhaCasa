<?php

namespace Jubarte\Model\DAL;

use PmroPadraoLib\Traits\Singleton;
use PmroPadraoLib\Model\DAL\UsuarioDAL as PMROPadraoUserDAL;
use Jubarte\Util\DBLayer;
use Jubarte\Model\VO\Usuario;
use Jubarte\Util\Criptografia;

class UsuarioDAL extends PMROPadraoUserDAL
{
   /* use Singleton;

    private $db = null;

    function __construct() {
        $this->db = DBLayer::Connect();
    }*/

    public function getById($id)
    {
        $data = $this->db()->table(Usuario::TABLE_NAME)
            ->where(Usuario::SISTEMA, '=', SistemaDAL::getInstance()->getBySigla('JUBARTE')->getId())
            ->where(Usuario::KEY_ID, $id)
            ->get();

        $users = [];

        foreach ($data as $d) {
            array_push($users, Usuario::fill($d));
        }

        return $users;
    }


}