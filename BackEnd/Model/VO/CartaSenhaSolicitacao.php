<?php
/**
 * Created by PhpStorm.
 * User: isaque
 * Date: 11/09/2018
 * Time: 15:01
 */

namespace Jubarte\Model\VO;

class CartaSenhaSolicitacao
{
    const TABLE_NAME = "carta_senha_solicitacoes";
    const KEY_ID = "id";
    const TIPO_CONTA = "tipoConta";
    const DATA_SOLICITACAO = "dataSolicitacao";
    const IS_VALIDADO = "isValidado";
    const ID_PESSOA = "idPessoa";
    const CPF = "cpf";
    const DADOS_DA_CONTA = "dadosDaConta";
    const MATRICULA = "matricula";
    const CARGO = "cargo";
    const TELEFONE_SETOR = "telefoneSetor";
    const ORGANOGRAMA_SIGLA = "organogramaSigla";
    const ORGANOGRAMA_ID = "organogramaId";
    const ORGANOGRAMA_NOME = "organogramaNome";

    const TABLE_FIELDS = [
        self::TIPO_CONTA,
        self::DATA_SOLICITACAO,
        self::IS_VALIDADO,
        self::ID_PESSOA,
        self::CPF,
        self::DADOS_DA_CONTA,
        self::MATRICULA,
        self::CARGO,
        self::TELEFONE_SETOR,
        self::ORGANOGRAMA_SIGLA,
        self::ORGANOGRAMA_ID,
        self::ORGANOGRAMA_NOME
    ];

    public $id;
    public $tipoConta;
    public $dataSolicitacao;
    public $isValidado;
    public $idPessoa;
    public $cpf;
    public $dadosDaConta;
    public $matricula;
    public $cargo;
    public $telefoneSetor;
    public $organogramaSigla;
    public $organogramaId;
    public $organogramaNome;

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
    public function getTipoConta()
    {
        return $this->tipoConta;
    }

    /**
     * @param mixed $tipoConta
     */
    public function setTipoConta($tipoConta)
    {
        $this->tipoConta = $tipoConta;
    }

    /**
     * @return mixed
     */
    public function getDataSolicitacao()
    {
        return $this->dataSolicitacao;
    }

    /**
     * @param mixed $dataSolicitacao
     */
    public function setDataSolicitacao($dataSolicitacao)
    {
        $this->dataSolicitacao = $dataSolicitacao;
    }

    /**
     * @return mixed
     */
    public function getisValidado()
    {
        return $this->isValidado;
    }

    /**
     * @param mixed $isValidado
     */
    public function setIsValidado($isValidado)
    {
        $this->isValidado = $isValidado;
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
    public function getCpf()
    {
        return $this->cpf;
    }

    /**
     * @param mixed $cpf
     */
    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
    }

    /**
     * @return mixed
     */
    public function getDadosDaConta()
    {
        return $this->dadosDaConta;
    }

    /**
     * @param mixed $dadosDaConta
     */
    public function setDadosDaConta($dadosDaConta)
    {
        $this->dadosDaConta = $dadosDaConta;
    }

    /**
     * @return mixed
     */
    public function getMatricula()
    {
        return $this->matricula;
    }

    /**
     * @param mixed $matricula
     */
    public function setMatricula($matricula)
    {
        $this->matricula = $matricula;
    }

    /**
     * @return mixed
     */
    public function getCargo()
    {
        return $this->cargo;
    }

    /**
     * @param mixed $cargo
     */
    public function setCargo($cargo)
    {
        $this->cargo = $cargo;
    }

    /**
     * @return mixed
     */
    public function getTelefoneSetor()
    {
        return $this->telefoneSetor;
    }

    /**
     * @param mixed $telefoneSetor
     */
    public function setTelefoneSetor($telefoneSetor)
    {
        $this->telefoneSetor = $telefoneSetor;
    }

    /**
     * @return mixed
     */
    public function getOrganogramaSigla()
    {
        return $this->organogramaSigla;
    }

    /**
     * @param mixed $organogramaSigla
     */
    public function setOrganogramaSigla($organogramaSigla)
    {
        $this->organogramaSigla = $organogramaSigla;
    }

    /**
     * @return mixed
     */
    public function getOrganogramaId()
    {
        return $this->organogramaId;
    }

    /**
     * @param mixed $organogramaId
     */
    public function setOrganogramaId($organogramaId)
    {
        $this->organogramaId = $organogramaId;
    }

    /**
     * @return mixed
     */
    public function getOrganogramaNome()
    {
        return $this->organogramaNome;
    }

    /**
     * @param mixed $organogramaNome
     */
    public function setOrganogramaNome($organogramaNome)
    {
        $this->organogramaNome = $organogramaNome;
    }



}