<?php
/**
 * Created by PhpStorm.
 * User: isaque
 * Date: 23/01/2018
 * Time: 20:10
 */

namespace Jubarte\Model\DAL;

use Jubarte\Util\DBLayer;
use Jubarte\Util\Utils;

use Jubarte\Model\VO\Menu;

class MenuDAL
{
    private $db = null;

    function __construct()
    {
        $this->db = DBLayer::Connect();
    }

    public function getHierarchyForUser($pId, $idSistema = null, $ativo = null, $idPessoa = null)
    {
        $idPai = '';
        if ($pId == null) {
            $idPai = ' is NULL';
        } else {
            $idPai = " ='" . $pId . "'";
        }

        /*
         SELECT m.*
        FROM usuarios u, permissoes p, menus m
         WHERE
        u."idSistema" = p."idSistema"
        u."idPerfil" = p."idPerfil"
          AND p."idMenu" = m."id"
            AND m.ativo = true
            AND m."idPai" is NULL   <---- idPai (recursao)
          AND u."idPessoa" = 1   <--- idPessoa do token
          AND u."idSistema" = 2;   <----- idSistema do FOR
        */
        $query = $this->db
            ->table(DBLayer::raw('usuarios u, permissoes p, menus m'))
            ->select(DBLayer::raw('m.*'))
            ->from(DBLayer::raw('usuarios u, permissoes p, menus m'))
            ->whereRaw('u."idPerfil" = p."idPerfil"')
            ->whereRaw('u."idSistema" = p."idSistema"')
            ->whereRaw('p."idMenu" = m."id"')
            ->whereRaw('m."idPai"' . $idPai)
            ->whereRaw('u."idPessoa"=' . $idPessoa);

        if ($ativo != null) {
            $ativo = $ativo == true ? "'t'" : "'f'";
            $query->whereRaw('m."ativo"=' . $ativo);
        }

        if ($idSistema != null) {
            $query->whereRaw('u."idSistema"=' . $idSistema);
        }

        $query->orderBy(DBLayer::raw('m."ordem"'));

        $data = $query->get();
        //$result['sql'] = $query->toSql();

        $result = array();

        if ($data != null) {
            foreach ($data as $item) {
                $idP = $item[Menu::KEY_ID];
                $menuItem = array();
                $menuItem[Menu::KEY_ID] = $item[Menu::KEY_ID];
                $menuItem[Menu::ID_PAI] = $item[Menu::ID_PAI];
                $menuItem[Menu::ROTA] = $item[Menu::ROTA];
                $menuItem[Menu::LABEL] = $item[Menu::LABEL];
                $menuItem[Menu::ICONE] = $item[Menu::ICONE];
                $menuItem[Menu::COR] = $item[Menu::COR];
                $menuItem[Menu::ORDEM] = $item[Menu::ORDEM];
                $menuItem[Menu::ATIVO] = $item[Menu::ATIVO];
                $menuItem[Menu::ID_SISTEMA] = $item[Menu::ID_SISTEMA];

                $filhos = $this->getHierarchyForUser($idP, $idSistema, $ativo, $idPessoa);

                if ($filhos != null) {
                    $menuItem['nodes'] = $filhos;
                }
                array_push($result, $menuItem);
            }
        }
        return $result;
    }

    public function getHierarchy($pId, $idSistema = null,$ativo=null)
    {
        $idPai = '';
        if ($pId == null)
        {
            $idPai = ' is NULL';
        }
        else
        {
            $idPai = " ='" . $pId . "'";
        }
        $idSistem = $idSistema == null ? '' : ' AND "' . Menu::ID_SISTEMA . '"=' . $idSistema.'';

        $query = $this->db->table(Menu::TABLE_NAME)
            ->whereRaw('"' . Menu::ID_PAI . '" ' . $idPai . $idSistem)
            ->orderBy(Menu::ORDEM, DBLayer::ORDER_DIRE_ASC);

        if($ativo)
        {
            $query->where(Menu::ATIVO, '=', $ativo);
        }

        $data = $query->get();
        //$result['sql'] = $query->toSql();

        $result = array();

        if ($data != null)
        {
            foreach ($data as $item)
            {
                $idP = $item[Menu::KEY_ID];
                $menuItem = array();
                $menuItem[Menu::KEY_ID] = $item[Menu::KEY_ID];
                $menuItem[Menu::ID_PAI] = $item[Menu::ID_PAI];
                $menuItem[Menu::ROTA] = $item[Menu::ROTA];
                $menuItem[Menu::LABEL] = $item[Menu::LABEL];
                $menuItem[Menu::ICONE] = $item[Menu::ICONE];
                $menuItem[Menu::COR] = $item[Menu::COR];
                $menuItem[Menu::ORDEM] = $item[Menu::ORDEM];
                $menuItem[Menu::ATIVO] = $item[Menu::ATIVO];
                $menuItem[Menu::ID_SISTEMA] = $item[Menu::ID_SISTEMA];

                $filhos = $this->getHierarchy($idP);

                if ($filhos != null)
                {
                    $menuItem['nodes'] = $filhos;
                }
                array_push($result, $menuItem);
            }
        }
        return $result;
    }

}