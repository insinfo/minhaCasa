<?php

namespace Jubarte\Controller;

use Jubarte\Model\DAL\SuporteFAQDAL;
use Jubarte\Model\VO\Pessoa;
use Jubarte\Model\VO\SuporteFAQ;
use Jubarte\Model\VO\Usuario;
use PmroPadraoLib\Util\Utils;

use \Illuminate\Database\Query\Builder;
use Slim\Http\Request;

class SuporteFAQController
{
    public static $userLogged  = null;

    private static function getUserPermissions () {
        $userPermissions = [
            "faq" => [
                'add' => false,
                'edit' => false
            ]
        ];

        if (self::$userLogged) {
            $usuarios = self::$userLogged -> getUsuarios();


            foreach($usuarios as $usuario) {
                $perfil = $usuario -> getPerfil();

                if ($perfil -> getPrioridade() <= 10) {
                    return $userPermissions = array_merge($userPermissions, [
                        "faq" => [
                            'add' => true,
                            "edit" => true
                        ]
                    ]);
                } else if ($perfil->getPrioridade() == 30) {
                    return $userPermissions = array_merge($userPermissions, [
                        "faq" => [
                            'add' => true,
                            "edit" => true
                        ]
                    ]);
                }
            }
        }
        return $userPermissions;
    }

    public static function getAll ($filters) {
        /* filters */

        $filtered = 0;

        $count = SuporteFAQDAL::getInstance()->count();

        $faqs = SuporteFAQDAL::getInstance()->getAllDataArray( function ( Builder $query) use ($filters, &$filtered){

            if ($filters['search']) {
                $query->where(function (Builder $query) use ($filters){
                   return $query -> where("descricao","ilike", "%" . $filters['search'] . "%")
                       -> orWhere("titulo", "ilike", "%" . $filters['search'] . "%");
                });
            }

            if ($filters['category']) {
                $query->where('categoria', 'ilike', $filters['category']);
            }


            $filtered = $query->count();

            if ($filters['length']) {
                $query->limit($filters['length']);
            }

            if ($filters['start'] && $filters['length']) {
                $query->offset($filters['start']);
            }

            $query->orderBy('categoria', 'asc');

            return $query;
        });

        $result = [];

        $categories = [];
        $catcontrol = [];

        foreach ($faqs as $f) {
            if (array_search($f['categoria'], $catcontrol) === false) {
                array_push($catcontrol, $f['categoria']);
                array_push($categories, ['categoria' => $f['categoria']]);
            }
        }

        $result['draw'] = $filters['draw'];
        $result['recordsFiltered'] = $filtered;
        $result['recordsTotal'] = $count;

        $result['data'] = [
            "itens" => $faqs,
            "categories" => $categories,
            "userPermissions" => self::getUserPermissions()
        ];

        return $result;
    }

    public static function get($id) {
        $faqItem = SuporteFAQDAL::getInstance()->getById($id);

        return [
            'data' => $faqItem->toArray()
        ];
    }

    public static function add($data) {


        if (!self::getUserPermissions()['faq']['add']) throw new \Exception("Você não tem as permissões necessárias");

        $faq = new SuporteFAQ();
        $faq -> setDescricao($data['descricao'])
            -> setCategoria($data['categoria'])
            -> setTitulo($data['titulo'])
            -> setDataCriacao(Utils::getDateTimeNow("en"))
            -> setLike(0)
            -> setUnlike(0);

        $suporteFaqDAL = new SuporteFAQDAL();
        $faq = $suporteFaqDAL -> save($faq);

        return [
            "data" => $faq -> toArray()
        ];
    }

    public static function update($data, $id) {
        if (!self::getUserPermissions()['faq']["edit"]) throw new \Exception("Você não tem as permissões necessárias");

        $faq = SuporteFAQDAL::getInstance()->getById($id);

        if (!empty($data['titulo'])){
            $faq -> setTitulo($data['titulo']);
        }

        if (!empty($data['descricao'])) {
            $faq -> setDescricao($data['descricao']);
        }

        if (!empty($data['categoria'])) {
            $faq -> setCategoria($data['categoria']);
        }

        SuporteFAQDAL::getInstance()->save($faq);

        return [
            "data" => $faq ->toArray()
        ];
    }

    public static function delete($id) {
        $faq = SuporteFAQDAL::getInstance()->getById($id);
        SuporteFAQDAL::getInstance()->delete($faq);
        return [
            'data' => $faq -> toArray()
        ];
    }

    public static function getCategories ($id) {
        $categorias = SuporteFAQDAL::getInstance()->getCategories();

        return [
            'data' => $categorias
        ];
    }

    public static function addLike ($id) {
        $faq = SuporteFAQDAL::getInstance()->getById($id);
        $faq -> like();

        SuporteFAQDAL::getInstance()->save($faq);
        return [
            "data" => $faq ->toArray()
        ];
    }

    public static function addUnlike ($id) {
        $faq = SuporteFAQDAL::getInstance()->getById($id);
        $faq -> unlike();
        SuporteFAQDAL::getInstance()->save($faq);

        return [
            "data" => $faq -> toArray()
        ];
    }

}