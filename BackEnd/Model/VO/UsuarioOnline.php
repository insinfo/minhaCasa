<?php

namespace Jubarte\Model\VO;

class UsuarioOnline
{
    const TABLE_NAME = "usuarios_online";
    const ID_PESSOA = "idPessoa";
    const DATA_ATIVIDADE = "dataAtividade";


    const TABLE_FIELDS = [
        self::ID_PESSOA,
        self::DATA_ATIVIDADE
    ];

    public $idPessoa;
    public $dataAtividade;

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
    public function getDataAtividade()
    {
        return $this->dataAtividade;
    }

    /**
     * @param mixed $dataAtividade
     */
    public function setDataAtividade($dataAtividade)
    {
        $this->dataAtividade = $dataAtividade;
    }


}

