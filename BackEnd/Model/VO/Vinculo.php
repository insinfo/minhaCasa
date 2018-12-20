<?php
/**
 * Created by PhpStorm.
 * User: isaque
 * Date: 27/03/2018
 * Time: 18:31
 */

namespace Jubarte\Model\VO;


class Vinculo
{
    const TABLE_NAME = "vinculos";
    const KEY_ID = "id";
    const VINCULO = "vinculo";

    const TABLE_FIELDS = [
        self::VINCULO
    ];

    public $id;
    public $vinculo;

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
    public function getVinculo()
    {
        return $this->vinculo;
    }

    /**
     * @param mixed $vinculo
     */
    public function setVinculo($vinculo)
    {
        $this->vinculo = $vinculo;
    }


}