<?php
/**
 * Created by PhpStorm.
 * User: isaque
 * Date: 16/04/2018
 * Time: 19:35
 */

namespace Jubarte\Model\VO;


class ViewPessoas
{
    const TABLE_NAME = "view_pessoas";
    const KEY_ID = "id";
    const CGM = "cgm";
    const NOME = "nome";
    const EMAIL_PRINCIPAL = "emailPrincipal";
    const EMAIL_ADICIONAL = "emailAdicional";
    const TIPO_PESSOA = "tipo";
    const DATA_INCLUSAO = "dataInclusao";
    const DATA_ALTERACAO = "dataAlteracao";
    const CPF = "cpf";

    const TABLE_FIELDS = [
        self::CGM,
        self::NOME,
        self::EMAIL_PRINCIPAL,
        self::EMAIL_ADICIONAL,
        self::TIPO_PESSOA,
        self::DATA_INCLUSAO,
        self::DATA_ALTERACAO
    ];

}