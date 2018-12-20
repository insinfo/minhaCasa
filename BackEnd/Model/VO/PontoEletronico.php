<?php
/**
 * Created by PhpStorm.
 * User: isaque
 * Date: 17/08/2018
 * Time: 11:33
 */

namespace Jubarte\Model\VO;


class PontoEletronico
{
    const TABLE_NAME = "marcacao";
    const CPF = "cpf";
    const MATRICULA = "matricula";
    const NOME = "nome";
    const DATA_PONTO = "data_ponto";
    const ENTRADA_1 = "entrada1";
    const SAIDA_1 = "saida1";
    const ENTRADA_2 = "entrada2";
    const SAIDA_2 = "saida2";
    const ENTRADA_3 = "entrada3";
    const SAIDA_3 = "saida3";
    const ENTRADA_4 = "entrada4";
    const SAIDA_4 = "saida4";
    const HORAS_TRABALHADAS = "hs_trabalhadas";

    const TABLE_FIELDS = [
        self:: CPF,
        self:: MATRICULA,
        self:: NOME,
        self:: DATA_PONTO,
        self:: ENTRADA_1,
        self:: SAIDA_1,
        self:: ENTRADA_2,
        self:: SAIDA_2,
        self:: ENTRADA_3,
        self:: SAIDA_3,
        self:: ENTRADA_4,
        self:: SAIDA_4,
        self:: HORAS_TRABALHADAS
    ];

    const DISPLAY_NAMES =
        [
            'matricula' => 'Matricula',
            'cpf' => 'CPF',
            'nome' => 'Nome',
            'data_ponto' => 'Data do Ponto'
        ];

    public $cpf;
    public $matricula;
    public $nome;
    public $data_ponto;
    public $entrada1;
    public $saida1;
    public $entrada2;
    public $saida2;
    public $entrada3;
    public $saida3;
    public $entrada4;
    public $saida4;
    public $hs_trabalhadas;

    public function fillFromArray($pessoaDataArray)
    {
        if ($pessoaDataArray != null) {
            foreach ($pessoaDataArray as $key => $val) {
                if (property_exists(__CLASS__, $key)) {
                    $this->$key = $val;
                }
            }
        }
    }

    function __construct(array $data = array())
    {
        foreach ($data as $key => $val) {
            if (property_exists(__CLASS__, $key)) {
                $this->$key = $val;
            }
        }
    }
}