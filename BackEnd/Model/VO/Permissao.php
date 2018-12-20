<?php

namespace Jubarte\Model\VO;

class Permissao
{
    const TABLE_NAME = "permissoes";
    const ID_PERFIL = "idPerfil";
    const ID_PESSOA = "idPessoa";
    const ID_MENU = "idSistema";
    const ID_SISTEMA = "idSistema";

    const TABLE_FIELDS = [self::ID_PERFIL, self::ID_PESSOA, self::ID_MENU, self::ID_SISTEMA];

    public $idPerfil;
    public $idPessoa;
    public $idMenu;
    public $idSistema;

    /**
     * @return mixed
     */
    public function getIdPerfil()
    {
        return $this->idPerfil;
    }

    /**
     * @param mixed $idPerfil
     */
    public function setIdPerfil($idPerfil)
    {
        $this->idPerfil = $idPerfil;
    }

    /**
     * @return mixed
     */
    public function getIdPessoa()
    {
        return $this->idPessoa;
    }

    /**
     * @param mixed $idPessoa
     */
    public function setIdPessoa($idPessoa)
    {
        $this->idPessoa = $idPessoa;
    }

    /**
     * @return mixed
     */
    public function getIdMenu()
    {
        return $this->idMenu;
    }

    /**
     * @param mixed $idMenu
     */
    public function setIdMenu($idMenu)
    {
        $this->idMenu = $idMenu;
    }

    /**
     * @return mixed
     */
    public function getIdSistema()
    {
        return $this->idSistema;
    }

    /**
     * @param mixed $idSistema
     */
    public function setIdSistema($idSistema)
    {
        $this->idSistema = $idSistema;
    }
}

