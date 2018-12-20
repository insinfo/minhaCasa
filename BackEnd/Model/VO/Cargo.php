<?php
/**
 * Created by PhpStorm.
 * User: isaque
 * Date: 27/03/2018
 * Time: 18:24
 */

namespace Jubarte\Model\VO;


class Cargo
{
    const TABLE_NAME = "cargos";
    const KEY_ID = "id";
    const NOME = "nome";

    const TABLE_FIELDS = [
        self::NOME
    ];

    public $id;
    public $nome;

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
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }




}