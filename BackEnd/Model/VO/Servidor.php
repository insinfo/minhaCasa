<?php
/**
 * Created by PhpStorm.
 * User: isaque
 * Date: 27/03/2018
 * Time: 18:32
 */

namespace Jubarte\Model\VO;

class Servidor
{
    const TABLE_NAME = "servidores";
    const KEY_ID = "id";
    const ID_PESSOA = "idPessoa";
    const MATRICULA = "matricula";
    const DATA_ADMISSAO = "dataAdmissao";
    const DATA_EXONERACAO = "dataExoneracao";
    const ID_VINCULO = "idVinculo";
    const ID_JORNADA_TRABALHO = "idJornadaTrabalho";
    const ID_CARGO = "idCargo";
    const ID_FUNCAO_GRATIFICADA = "idFuncaoGratificada";
    const ID_LOTACAO = "idLotacao";
    const ID_LOCAL_TRABALHO = "idLocalTrabalho";
    const DATA_CADASTRO = "dataCadastro";
    const DATA_ALTERACAO = "dataAlteracao";
    const ATIVO = "ativo";
    const BIOMETRIA = "biometria";
    const OBSERVACOES = "observacoes";

    const TABLE_FIELDS = [
        self::ID_PESSOA,
        self::MATRICULA,
        self::DATA_ADMISSAO,
        self::DATA_EXONERACAO,
        self::ID_VINCULO,
        self::ID_JORNADA_TRABALHO,
        self::ID_CARGO,
        self::ID_FUNCAO_GRATIFICADA,
        self::ID_LOTACAO,
        self::ID_LOCAL_TRABALHO,
        self::DATA_CADASTRO,
        self::DATA_ALTERACAO,
        self::ATIVO,
        self::BIOMETRIA,
        self::OBSERVACOES
    ];

    public $id;
    public $idPessoa;
    public $matricula;
    public $dataAdmissao;
    public $dataExoneracao;
    public $idVinculo;
    public $idJornadaTrabalho;
    public $idCargo;
    public $idFuncaoGratificada;
    public $idLocalTrabalho;
    public $dataCadastro;
    public $dataAlteracao;
    public $ativo;
    public $biometria;
    public $observacoes;
}