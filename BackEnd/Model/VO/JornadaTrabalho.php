<?php
/**
 * Created by PhpStorm.
 * User: isaque
 * Date: 27/03/2018
 * Time: 18:13
 */

namespace Jubarte\Model\VO;


class JornadaTrabalho
{
    const TABLE_NAME = "jornada_trabalho";
    const KEY_ID = "id";
    const DESCRICAO = "descricao";
    const CARGA = "carga";
    const PERIODICIDADE = "periodicidade";

    const TABLE_FIELDS = [
        self::DESCRICAO,
        self::CARGA,
        self::PERIODICIDADE
    ];

    public $id;
    public $descricao;
    public $carga;
    public $periodicidade;

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
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * @param mixed $descricao
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    /**
     * @return mixed
     */
    public function getCarga()
    {
        return $this->carga;
    }

    /**
     * @param mixed $carga
     */
    public function setCarga($carga)
    {
        $this->carga = $carga;
    }

    /**
     * @return mixed
     */
    public function getPeriodicidade()
    {
        return $this->periodicidade;
    }

    /**
     * @param mixed $periodicidade
     */
    public function setPeriodicidade($periodicidade)
    {
        $this->periodicidade = $periodicidade;
    }



}