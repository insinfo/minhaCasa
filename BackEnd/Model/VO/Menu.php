<?php

namespace Jubarte\Model\VO;

class Menu
{
    const TABLE_NAME = "menus";
    const KEY_ID = "id";
    const ID_PAI = "idPai";
    const ID_SISTEMA = "idSistema";
    const ICONE = "icone";
    const LABEL = "label";
    const ROTA = "rota";
    const COR = "cor";
    const ORDEM = "ordem";
    const ATIVO = "ativo";

    const TABLE_FIELDS = [self::ID_PAI, self::ID_SISTEMA, self::ICONE, self::LABEL, self::ROTA, self::COR, self::ORDEM, self::ATIVO];

    public $id;
    public $idPai;
    public $idSistema;
    public $icone;
    public $label;
    public $rota;
    public $cor;
    public $ordem;
    public $ativo;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getIdPai()
    {
        return $this->idPai;
    }

    /**
     * @param mixed $idPai
     */
    public function setIdPai($idPai)
    {
        $this->idPai = $idPai;
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

    /**
     * @return mixed
     */
    public function getIcone()
    {
        return $this->icone;
    }

    /**
     * @param mixed $icone
     */
    public function setIcone($icone)
    {
        $this->icone = $icone;
    }

    /**
     * @return mixed
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param mixed $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }

    /**
     * @return mixed
     */
    public function getRota()
    {
        return $this->rota;
    }

    /**
     * @param mixed $rota
     */
    public function setRota($rota)
    {
        $this->rota = $rota;
    }

    /**
     * @return mixed
     */
    public function getCor()
    {
        return $this->cor;
    }

    /**
     * @param mixed $cor
     */
    public function setCor($cor)
    {
        $this->cor = $cor;
    }

    /**
     * @return mixed
     */
    public function getOrdem()
    {
        return $this->ordem;
    }

    /**
     * @param mixed $ordem
     */
    public function setOrdem($ordem)
    {
        $this->ordem = $ordem;
    }

    /**
     * @return mixed
     */
    public function getAtivo()
    {
        return $this->ativo;
    }

    /**
     * @param mixed $ativo
     */
    public function setAtivo($ativo)
    {
        $this->ativo = $ativo;
    }



}

