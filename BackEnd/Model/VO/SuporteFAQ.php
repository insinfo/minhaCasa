<?php
/**
 * Created by PhpStorm.
 * User: gabriel
 * Date: 31/07/18
 * Time: 15:50
 */

namespace Jubarte\Model\VO;


use PmroPadraoLib\Model\VO\ModelAbstract;

class SuporteFAQ extends ModelAbstract
{
    const TABLE_NAME = "faqs";

    private $id;
    private $descricao;
    private $titulo;
    private $dataCriacao;
    private $like;
    private $unlike;
    private $categoria;

    public function toArray () {
        return [
          'id' => $this->getId(),
          'descricao' => $this->getDescricao(),
          'titulo' => $this->getTitulo(),
          'dataCriacao' => $this->getDataCriacao(),
          'like' => $this->getLike(),
          'unlike' => $this->getUnlike(),
          'categoria' => $this->getCategoria()
        ];
    }

    /**
     * @param mixed $categoria
     */
    public function setCategoria($categoria)
    {
        if (empty($categoria) ) {
            throw new \Exception("Selecione ou crie uma nova categoria para o item de faq");
        }

        $this->categoria = strtolower($categoria);
        return $this;
    }

    /**
     * @param mixed $dataCriacao
     */
    public function setDataCriacao($dataCriacao)
    {
        $this->dataCriacao = $dataCriacao;
        return $this;
    }

    /**
     * @param mixed $descricao
     */
    public function setDescricao($descricao)
    {
        if (empty($descricao)) {
            throw new \Exception("A descrição do item do faq não pode ser vasio.");
        }

        $this->descricao = $descricao;
        return $this;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param mixed $like
     */
    public function setLike($like)
    {
        $this->like = $like;
        return $this;
    }

    /**
     * @param mixed $titulo
     */
    public function setTitulo($titulo)
    {
        if (empty($titulo)) {
            throw new \Exception("Título do faq não pode ser vasio");
        } else if(strlen($titulo) < 3) {
            throw new \Exception( "Não é possível adicionar um título tão pequeno");
        }

        $this->titulo = $titulo;
        return $this;
    }

    /**
     * @param mixed $unlike
     */
    public function setUnlike($unlike)
    {
        $this->unlike = $unlike;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * @return mixed
     */
    public function getDataCriacao()
    {
        return $this->dataCriacao;
    }

    /**
     * @return mixed
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getLike()
    {
        return $this->like;
    }

    /**
     * @return mixed
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * @return mixed
     */
    public function getUnlike()
    {
        return $this->unlike;
    }

    public function like () {
        $this->like += 1;
        return $this;
    }

    public function unlike () {
        $this->unlike += 1;
    }

}