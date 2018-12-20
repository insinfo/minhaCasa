<?php


namespace Jubarte\Model\DAL;

use Jubarte\Util\DBLayer;

use Jubarte\Model\VO\Pessoa;
use Jubarte\Model\VO\PessoaFisica;

class PessoaDAL
{
    private $db = null;

    function __construct()
    {
        $this->db = DBLayer::Connect();
    }

    /**
     * Obtem um objeto do tipo Pessoa.
     *
     * @param  integer  $id
     * @return  \Jubarte\Model\VO\PessoaFisica
     */
    public function getById($id)
    {
        $data = $this->db->table(Pessoa::TABLE_NAME_PESSOA)
            ->where(Pessoa::KEY_ID_PESSOA, $id)
            ->leftJoin('pessoas_fisicas','pessoas_fisicas.idPessoa','=','pessoas.id')
            ->first();

        return new PessoaFisica($data);
    }
}