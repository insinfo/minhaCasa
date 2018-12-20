<?php
/**
 * Created by PhpStorm.
 * User: isaque
 * Date: 11/07/2018
 * Time: 13:33
 */

namespace Jubarte\Model\VO;

class PerfilUsuario
{
    const TABLE_NAME = "usuarios_perfis";
    const ID_PESSOA = "idPessoa";
    const PROFISSAO = "profissao";
    const FACEBOOK = "facebook";
    const GOOGLEPLUS = "googlePlus";
    const INSTAGRAM = "instagram";
    const LINKEDIN = "linkedin";
    const TWITTER = "twitter";
    const YOUTUBE = "youtube";

    const TABLE_FIELDS = [
        self::ID_PESSOA,
        self::PROFISSAO,
        self::FACEBOOK,
        self::GOOGLEPLUS,
        self::INSTAGRAM,
        self::LINKEDIN,
        self::TWITTER,
        self::YOUTUBE
    ];

    public $idPessoa;
    public $profissao;
    public $facebook;
    public $googlePlus;
    public $instagram;
    public $linkedin;
    public $twitter;
    public $youtube;

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
    public function getProfissao()
    {
        return $this->profissao;
    }

    /**
     * @param mixed $profissao
     */
    public function setProfissao($profissao)
    {
        $this->profissao = $profissao;
    }

    /**
     * @return mixed
     */
    public function getFacebook()
    {
        return $this->facebook;
    }

    /**
     * @param mixed $facebook
     */
    public function setFacebook($facebook)
    {
        $this->facebook = $facebook;
    }

    /**
     * @return mixed
     */
    public function getGooglePlus()
    {
        return $this->googlePlus;
    }

    /**
     * @param mixed $googlePlus
     */
    public function setGooglePlus($googlePlus)
    {
        $this->googlePlus = $googlePlus;
    }

    /**
     * @return mixed
     */
    public function getInstagram()
    {
        return $this->instagram;
    }

    /**
     * @param mixed $instagram
     */
    public function setInstagram($instagram)
    {
        $this->instagram = $instagram;
    }

    /**
     * @return mixed
     */
    public function getLinkedin()
    {
        return $this->linkedin;
    }

    /**
     * @param mixed $linkedin
     */
    public function setLinkedin($linkedin)
    {
        $this->linkedin = $linkedin;
    }

    /**
     * @return mixed
     */
    public function getTwitter()
    {
        return $this->twitter;
    }

    /**
     * @param mixed $twitter
     */
    public function setTwitter($twitter)
    {
        $this->twitter = $twitter;
    }

    /**
     * @return mixed
     */
    public function getYoutube()
    {
        return $this->youtube;
    }

    /**
     * @param mixed $youtube
     */
    public function setYoutube($youtube)
    {
        $this->youtube = $youtube;
    }


}