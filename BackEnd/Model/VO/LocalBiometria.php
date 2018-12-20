<?php
/**
 * Created by PhpStorm.
 * User: isaque
 * Date: 27/03/2018
 * Time: 18:28
 */

namespace Jubarte\Model\VO;

class LocalBiometria
{
    const TABLE_NAME = "locais_biometria";
    const KEY_ID = "id";
    const UNIDADE = "unidade";
    const LOCALIZACAO = "localizacao";
    const BAIRRO = "bairro";
    const SETOR = "setor";

    const TABLE_FIELDS = [
        self::UNIDADE,
        self::LOCALIZACAO,
        self::BAIRRO,
        self::SETOR
    ];

    public $id;
    public $unidade;
    public $localizacao;
    public $bairro;
    public $setor;

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
    public function getUnidade()
    {
        return $this->unidade;
    }

    /**
     * @param mixed $unidade
     */
    public function setUnidade($unidade)
    {
        $this->unidade = $unidade;
    }

    /**
     * @return mixed
     */
    public function getLocalizacao()
    {
        return $this->localizacao;
    }

    /**
     * @param mixed $localizacao
     */
    public function setLocalizacao($localizacao)
    {
        $this->localizacao = $localizacao;
    }

    /**
     * @return mixed
     */
    public function getBairro()
    {
        return $this->bairro;
    }

    /**
     * @param mixed $bairro
     */
    public function setBairro($bairro)
    {
        $this->bairro = $bairro;
    }

    /**
     * @return mixed
     */
    public function getSetor()
    {
        return $this->setor;
    }

    /**
     * @param mixed $setor
     */
    public function setSetor($setor)
    {
        $this->setor = $setor;
    }



}