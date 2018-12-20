<?php
/**
 * Created by PhpStorm.
 * User: isaque
 * Date: 15/02/2018
 * Time: 16:42
 */

namespace Jubarte\Model\VO;


class UsuarioExtensao
{
    const TABLE_NAME = "usuarios_extensoes";
    const ID_PESSOA = "idPessoa";
    const ID_SETOR = "idSetor";
    const LOGIN = "login";
    const ATIVO = "ativo";

    const TABLE_FIELDS = [self::ID_PESSOA, self::ID_SETOR, self::LOGIN, self::ATIVO];

    public $idPessoa;
    public $idSetor;
    public $login;
    public $ativo;


}