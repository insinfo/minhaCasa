<?php
/**
 * Created by PhpStorm.
 * User: isaque
 * Date: 08/03/2018
 * Time: 11:22
 */

namespace Jubarte\Model\VO;


use Jubarte\Model\DAL\UsuarioDAL;

use PmroPadraoLib\Model\VO\Pessoa as PmroPadraoModelPessoa;


class Pessoa extends PmroPadraoModelPessoa
{
    const TABLE_NAME_PESSOA = "pessoas";
    const KEY_ID_PESSOA = "id";
    const CGM_PESSOA = "cgm";
    const NOME_PESSOA = "nome";
    const EMAIL_PRINCIPAL = "emailPrincipal";
    const EMAIL_ADICIONAL = "emailAdicional";
    const TIPO_PESSOA = "tipo";
    const DATA_INCLUSAO = "dataInclusao";
    const DATA_ALTERACAO = "dataAlteracao";
    const IMAGEM = "imagem";

    const TIPO_PESSOA_FISICA = 'Fisica';
    const TIPO_PESSOA_JURIDICA = 'Juridica';
    const TIPO_PESSOA_OUTRO = 'Outro';

    const DISPLAY_NAMES =
        [
            'id' => 'ID',
            'cgm' => 'CGM',
            'nome' => 'Nome',
            'emailPrincipal' => 'E-mail Principal',
            'emailAdicional' => 'E-mail Adicional',
            'tipo' => 'Tipo',
            'dataInclusao' => 'Data de Inclusão',
            'dataAlteracao' => 'Data de Alteracão'
        ];

    public $id;
    public $cgm;
    public $nome;
    public $emailPrincipal;
    public $emailAdicional;
    public $tipo;
    public $dataInclusao;
    public $dataAlteracao;
    public $imagem;

    public function getUsuarios () {
        return UsuarioDAL::getInstance()->getById($this->getId());
    }


    public function fillFromArray(array $pessoaDataArray)
    {
        if($pessoaDataArray != null)
        {
            foreach ($pessoaDataArray as $key => $val)
            {
                if (property_exists(__CLASS__, $key))
                {
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
    public function getCgm()
    {
        return $this->cgm;
    }

    /**
     * @param mixed $cgm
     */
    public function setCgm($cgm)
    {
        $this->cgm = $cgm;
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
    public function getEmailPrincipal()
    {
        return $this->emailPrincipal;
    }

    /**
     * @param mixed $emailPrincipal
     */
    public function setEmailPrincipal($emailPrincipal)
    {
        $this->emailPrincipal = $emailPrincipal;
    }

    /**
     * @return mixed
     */
    public function getEmailAdicional()
    {
        return $this->emailAdicional;
    }

    /**
     * @param mixed $emailAdicional
     */
    public function setEmailAdicional($emailAdicional)
    {
        $this->emailAdicional = $emailAdicional;
    }

    /**
     * @return mixed
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * @param mixed $tipo
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    /**
     * @return mixed
     */
    public function getDataInclusao()
    {
        return $this->dataInclusao;
    }

    /**
     * @param mixed $dataInclusao
     */
    public function setDataInclusao($dataInclusao)
    {
        $this->dataInclusao = $dataInclusao;
    }

    /**
     * @return mixed
     */
    public function getDataAlteracao()
    {
        return $this->dataAlteracao;
    }

    /**
     * @param mixed $dataAlteracao
     */
    public function setDataAlteracao($dataAlteracao)
    {
        $this->dataAlteracao = $dataAlteracao;
    }

    /**
     * @return mixed
     */
    public function getImagem()
    {
        return $this->imagem;
    }

    /**
     * @param mixed $imagem
     */
    public function setImagem($imagem)
    {
        $this->imagem = $imagem;
    }



    public static function getClassName()
    {
        return get_called_class();
    }
}

