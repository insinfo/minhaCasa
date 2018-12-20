<?php
/**
 * Created by PhpStorm.
 * User: gabriel
 * Date: 18/12/18
 * Time: 14:26
 */

namespace Jubarte\Model\VO;


class ActivateCode {

    const TABLE = 'activate_codes';

    const FIELD_CODE = 'code';
    const FIELD_EXPIRE = 'expire';
    const FIELD_PESSOA_ID = 'pessoa_id';

    private $code;
    private $expire;
    private $pessoa_id;

    /**
     * @param mixed $code
     */
    public function setCode($code) {
        $this -> code = $code;
        return $this;
    }

    /**
     * @param mixed $expire
     */
    public function setExpire($expire) {
        $this -> expire = $expire;
        return $this;
    }

    /**
     * @param mixed $pessoa_id
     */
    public function setPessoaId($pessoa_id) {
        $this -> pessoa_id = $pessoa_id;
        return $this;
    }


    /**
     * @return mixed
     */
    public function getCode() {
        return $this -> code;
    }

    /**
     * @return mixed
     */
    public function getExpire() {
        return $this -> expire;
    }

    /**
     * @return mixed
     */
    public function getPessoaId() {
        return $this -> pessoa_id;
    }

}