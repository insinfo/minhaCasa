<?php
/**
 * Created by PhpStorm.
 * User: gabriel
 * Date: 31/07/18
 * Time: 15:55
 */

namespace Jubarte\Model\DAL;

use Illuminate\Database\Query\Builder;
use Jubarte\Model\VO\SuporteFAQ;
use Mockery\Exception;
use PmroPadraoLib\Model\DAL\DALInterface;
use PmroPadraoLib\Model\VO\ModelInterface;
use PmroPadraoLib\Traits\Singleton;

class SuporteFAQDAL extends AbstractDAL implements DALInterface
{
    private $table;
    use Singleton;

    public function __construct () {
        $this->table = self::db()->table(SuporteFAQ::TABLE_NAME);
    }

    /**
     * @return int
     */

    public function count() {
        return $this->table->count();
    }

    /**
     * @param SuporteFAQ $faq
     * @return ModelInterface
     */

    public function insert(ModelInterface $faq) {
        $data = $faq->toArray();
        unset($data['id']);
        $id = $this->table-> insertGetId($data);
        return $faq -> setId($id);
    }

    /**
     * Remove um item do faq
     *
     * @param $id
     */

    public function delete (ModelInterface $faq) {
        $this->table->delete($faq -> getId());
    }

    /**
     * Altera dados do faq
     *
     * @param SuporteFAQ $faq
     * @return SuporteFAQ
     */

    public function update (ModelInterface $faq) {
        $data = $faq -> toArray();
        unset($data['id']);

        if (! $this->table->where('id', '=', $faq->getId()) -> update($data)) {
            throw new Exception("Não foi possível alterar os dados do FAQ");
        };

        return $faq;
    }

    /**
     * Salva um item de faq
     *
     * @param SuporteFAQ $faq
     * @return SuporteFAQ
     */

    public function save (ModelInterface $faq) {
        if ($faq ->getId()) {
            return $this->update($faq);
        } else {
            return $this->insert($faq);
        }
    }

    /**
     * @param null $callback
     * @return array|\Illuminate\Support\Collection|static[]
     * @throws \Exception
     */

    public function getAllDataArray ($callback = null) {
        $query = $this->table;

        if (is_callable($callback)) {
            $q = $callback($query);
            if ($q instanceof Builder) {
                $query = $q;
            } else {
                throw new \Exception("Esperado retorno da query no método getAllDataArray");
            }
        }

        return $query -> get();
    }

    /**
     * @param null $callback
     * @return array
     */

    public function getAll ($callback = null) {
        $data = $this->getAllDataArray($callback);

        $itens = [];

        foreach($data as $d) {
            array_push($itens, $this->mount($d));
        }

        return $itens;
    }

    /**
     * Return um objeto SuporteFaq com o id passado
     *
     * @param $id
     * @return SuporteFAQ
     */

    public function getById ($id) {
        $data = $this->table->find($id);
        return $this->mount($data);
    }

    /**
     * @return array|\Illuminate\Support\Collection|static[]
     */

    public function getCategories () {
        return $this->table->select("categoria") -> groupBy("categoria")
            ->get();
    }

    /**
     * Retorna um objeto SuporteFaq
     *
     * @param $data
     * @return SuporteFAQ
     */

    public function mount ($data) {
        $faq = new SuporteFAQ();

        return $faq -> setId($data['id'])
            -> setDescricao($data['descricao'])
            -> setCategoria(strtolower($data['categoria']))
            -> setDataCriacao($data['dataCriacao'])
            -> setLike($data['like'])
            -> setTitulo($data['titulo'])
            -> setUnlike($data['unlike']);

    }

}