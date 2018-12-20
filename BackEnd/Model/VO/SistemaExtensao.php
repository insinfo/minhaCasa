<?php

namespace Jubarte\Model\VO;

class SistemaExtensao
{
    const TABLE_NAME = "sistemas_extensoes";
    const KEY_ID = "id";
    const ID_SISTEMA = "idSistema";
    const NOME = "nome";
    const ROTA_LEITURA = "rotaLeitura";
    const METODO_LEITURA = "metodoLeitura";
    const ROTA_EXIBICAO = "rotaExibicao";
    const METODO_EXIBICAO = "metodoExibicao";
    const ROTA_GRAVACAO = "rotaGravacao";
    const METODO_GRAVACAO = "metodoGravacao";
    const TIPO_EXIBICAO = "tipoExibicao";
    const ROTA_DELETE = "rotaDelete";
    const METODO_DELETE = "metodoDelete";

    const TABLE_FIELDS = [
        self::ID_SISTEMA,
        self::NOME,
        self::ROTA_LEITURA,
        self::METODO_LEITURA,
        self::ROTA_EXIBICAO,
        self::METODO_EXIBICAO,
        self::ROTA_GRAVACAO,
        self::METODO_GRAVACAO,
        self::TIPO_EXIBICAO,
        self::ROTA_DELETE,
        self::METODO_DELETE,
    ];

    public $id;
    public $idSistema;
    public $nome;
    public $rotaLeitura;
    public $metodoLeitura;
    public $rotaExibicao;
    public $metodoExibicao;
    public $rotaGravacao;
    public $metodoGravacao;
    public $tipoExibicao;
    public $rotaDelete;
    public $metodoDelete;

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

    /**
     * @return mixed
     */
    public function getRotaLeitura()
    {
        return $this->rotaLeitura;
    }

    /**
     * @param mixed $rotaLeitura
     */
    public function setRotaLeitura($rotaLeitura)
    {
        $this->rotaLeitura = $rotaLeitura;
    }

    /**
     * @return mixed
     */
    public function getMetodoLeitura()
    {
        return $this->metodoLeitura;
    }

    /**
     * @param mixed $metodoLeitura
     */
    public function setMetodoLeitura($metodoLeitura)
    {
        $this->metodoLeitura = $metodoLeitura;
    }

    /**
     * @return mixed
     */
    public function getRotaExibicao()
    {
        return $this->rotaExibicao;
    }

    /**
     * @param mixed $rotaExibicao
     */
    public function setRotaExibicao($rotaExibicao)
    {
        $this->rotaExibicao = $rotaExibicao;
    }

    /**
     * @return mixed
     */
    public function getMetodoExibicao()
    {
        return $this->metodoExibicao;
    }

    /**
     * @param mixed $metodoExibicao
     */
    public function setMetodoExibicao($metodoExibicao)
    {
        $this->metodoExibicao = $metodoExibicao;
    }

    /**
     * @return mixed
     */
    public function getRotaGravacao()
    {
        return $this->rotaGravacao;
    }

    /**
     * @param mixed $rotaGravacao
     */
    public function setRotaGravacao($rotaGravacao)
    {
        $this->rotaGravacao = $rotaGravacao;
    }

    /**
     * @return mixed
     */
    public function getMetodoGravacao()
    {
        return $this->metodoGravacao;
    }

    /**
     * @param mixed $metodoGravacao
     */
    public function setMetodoGravacao($metodoGravacao)
    {
        $this->metodoGravacao = $metodoGravacao;
    }

    /**
     * @return mixed
     */
    public function getTipoExibicao()
    {
        return $this->tipoExibicao;
    }

    /**
     * @param mixed $tipoExibicao
     */
    public function setTipoExibicao($tipoExibicao)
    {
        $this->tipoExibicao = $tipoExibicao;
    }

    /**
     * @return mixed
     */
    public function getRotaDelete()
    {
        return $this->rotaDelete;
    }

    /**
     * @param mixed $rotaDelete
     */
    public function setRotaDelete($rotaDelete)
    {
        $this->rotaDelete = $rotaDelete;
    }

    /**
     * @return mixed
     */
    public function getMetodoDelete()
    {
        return $this->metodoDelete;
    }

    /**
     * @param mixed $metodoDelete
     */
    public function setMetodoDelete($metodoDelete)
    {
        $this->metodoDelete = $metodoDelete;
    }


}