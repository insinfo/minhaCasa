<?php
/**
 * Created by PhpStorm.
 * User: isaque
 * Date: 13/08/2018
 * Time: 12:17
 */

namespace Jubarte\Model\BSL;

use \Adldap\Adldap;
use \Adldap\Connections\Configuration;
use \Adldap\Schemas\ActiveDirectory;

class ActiveDirectoryAPI
{
    private $domainControllerHost = '192.168.133.10';
    private $baseDistinguishedName = 'DC=dcro,DC=gov';
    private $domainAdminUsername = 'desenvolvimento' . '@dcro.gov';
    private $domainAdminPassword = '@#Ins257257pmr0';//@#Ins257257pmr0
    private $adldap = null;

    /*
    #caminho das configurações do cliente LDAP
    nano /etc/ldap/ldap.conf
    TLS_CACERT  /var/www/html/config/certdcro.cer

    #arquivo de configuração

    #
    # LDAP Defaults
    #

    # See ldap.conf(5) for details
    # This file should be world readable but not world writable.

    #BASE   dc=example,dc=com
    #URI    ldap://ldap.example.com ldap://ldap-master.example.com:666

    #SIZELIMIT      12
    #TIMELIMIT      15
    #DEREF          never

    # TLS certificates (needed for GnuTLS)
    #TLS_CACERT     /etc/ssl/certs/ca-certificates.crt
    #TLS_REQCERT never
    TLS_CACERT  /var/www/html/config/certdcro.cer
    TLS_REQCERT allow


    */

    function __construct()
    {
        // Create the configuration array.
        $config = [
            // Mandatory Configuration Options
            'domain_controllers' => [$this->domainControllerHost],//Domain Controllers
            'base_dn' => $this->baseDistinguishedName,//Base Distinguished Name
            'admin_username' => $this->domainAdminUsername,
            'admin_password' => $this->domainAdminPassword,
            'use_tls' => true
            //  'use_ssl' => true,
            /*'version' => 3

            // Optional Configuration Options
              'schema'           => \Adldap\Schemas\ActiveDirectory::class,
              'account_prefix'   => 'ACME-',
              'account_suffix'   => '@acme.org',
              'port'             => 389,//non SSL and SSL 389/636
              'follow_referrals' => false,
              'use_ssl'          => false,
              'timeout'          => 5,

            // Custom LDAP Options
             'custom_options'  => [
                 // See: http://php.net/ldap_set_option
                 LDAP_OPT_X_TLS_REQUIRE_CERT => LDAP_OPT_X_TLS_NEVER
             ]*/
        ];
        /* $configuration = new Configuration();
         $configuration->setDomainControllers(['192.168.133.10']);
         $configuration->setBaseDn('DC=dcro,DC=gov');
         $configuration->setAdminUsername('desenvolvimento' . '@dcro.gov');
         $configuration->setAdminPassword('ostras');
         $configuration->setUseTLS(true);*/

        $this->adldap = new Adldap($config);
    }

    public function setDomainControllerHost($domainControllerHost)
    {
        $this->domainControllerHost = $domainControllerHost;
    }

    public function reconect()
    {
        $config = [
            'domain_controllers' => [$this->domainControllerHost],//Domain Controllers
            'base_dn' => $this->baseDistinguishedName,//Base Distinguished Name
            'admin_username' => $this->domainAdminUsername,
            'admin_password' => $this->domainAdminPassword,
            'use_tls' => true
        ];
        $this->adldap = new Adldap($config);
    }

    public function createUser($fullName,$sobrenomes, $firstName, $lastName, $userName, $password, $cpf = '', $email = '', $descricao = '', $company = '')
    {
        //$tes = $ad->authenticate('desenvolvimento','ostras');
        // $user = $ad->users()->find('isaque.neves');
        // $user->setPassword(\Adldap\Classes\Utilities::encodePassword('Ins257257'));
        //  $result  = $user->update();
        //  $result = $user->changePassword(null,'ostras1234',true);
        //$ad->setConfiguration()
        // $provider = $ad->connect();
        //  $users = $ad->users()->all();

        //$ad->users()->create( 'cn' => 'John Doe',);

        /* $user = $ad->users()->newInstance();
         $user->setCommonName('Isaque Teste');
         $user->setDisplayName('Isaque Teste');
         $user->setLastName('Teste');
        // $user->setInitials('IT');
       //  $user->setTitle('');
       //  $user->setDepartment($department);
       //  $user->setInfo($info);
      //   $user->setPhysicalDeliveryOfficeName($office);
         $user->setTelephoneNumber('2777-2339');
        // $user->setCompany($company);
      //   $user->setPassword('ostras1234');
        // $user->setStreetAddress($street_address);
      //   $user->setPostalCode($zip);
         $user->setAccountName('isaque.teste');
         $user->setUserPrincipalName('isaque.teste'.'@dcro.gov');
         $user->setName('Isaque Teste');
         $user->setDescription('description Isaque Teste');
        // $user->setAttribute('mobile', $mobile);

        // $adNewUser = $user->save();**/

        /* $nome = 'Melancia da Silva Brandão';
         $userFirstName = 'melancia';
         $userLastName = 'brandao';
         $userName = $userFirstName . '.' . $userLastName;*/
        // $userEmai

        $email = $email == null || $email == 'null' ? 'vazio' : $email;
        $descricao = $descricao == null || $descricao == 'null' ? 'vazio' : $descricao;
        $company = $company == null || $company == 'null' ? 'vazio' : $company;

        if ($userName == null || $userName == 'null' || $userName == '') {
            throw new \Exception('userName não pode ser nulo ou vazio!');
        }

        if ($fullName == null || $fullName == 'null' || $fullName == '') {
            throw new \Exception('fullName não pode ser nulo ou vazio!');
        }

        if ($firstName == null || $firstName == 'null' || $firstName == '') {
            throw new \Exception('firstName não pode ser nulo ou vazio!');
        }

        if ($lastName == null || $lastName == 'null' || $lastName == '') {
            throw new \Exception('lastName não pode ser nulo ou vazio!');
        }

        if ($cpf == null || $cpf == 'null' || $cpf == '') {
            throw new \Exception('cpf não pode ser nulo ou vazio!');
        }

        $user = $this->adldap->users()->newInstance();
        $user->setAccountName($userName);
        $user->setUserPrincipalName($userName.'@dcro.gov');
        $user->setDistinguishedName("CN=" . $fullName . ",OU=Geral,OU=PMRO,DC=dcro,DC=gov");
        $user->setFirstName($firstName);
        $user->setLastName($sobrenomes);
        $user->setDescription($descricao);
        $user->setCompany($company);
        $user->setDisplayName($fullName);

        $user->setEmail($email);
        // podem ser usados ​​para armazenar dados personalizados sem estender o esquema.
        //ExtensionAttribute1 até ExtensionAttribute15,

        $user->setAttribute('cpfnumber', $cpf);
        $user->setAttribute('wwwhomepage', $cpf);
        //$user->setUserPrincipalName($userName . "@dcro.gov");
        $user->setPassword($password);

        //salva usuario
        //pra poder salvar usuario tem que aver um arquivo de certificado no diretorio abaixo
        //C:\OpenLDAP\sysconf\certdcro.cer e um arquivo ldap.conf apontando para o certificado
        $isAddNewUser = $user->save();
        $isSetPassword = false;
        $isEnableUser = false;

        //cria senha do usuario
        if ($isAddNewUser) {
            $isSetPassword = $user->changePassword(null, $password, true);
        }

        //abilita usuario
        if ($isSetPassword) {
            $ac = new \Adldap\Objects\AccountControl();
            $ac->accountIsNormal();
            $user->setUserAccountControl($ac);
            $isEnableUser = $user->save(); // Save the user-enable
        }

        if ($isAddNewUser & $isSetPassword & $isEnableUser) {
            return true;
        }

        return $isAddNewUser;
    }

    public function updateUserEmailCPFByName($fullName, $cpf = null, $email = null)
    {
        $user = $this->adldap->search()->newQueryBuilder()->find($fullName);

        if ($user) {
            $samaccountname = $user->getAttribute('samaccountname');
            $samaccountname = is_array($samaccountname) ? $samaccountname[0] : null;
            if ($samaccountname) {
                $user = $this->adldap->users()->find($samaccountname);
                if ($user) {
                    if ($cpf) {
                        $user->setAttribute('cpfnumber', $cpf);//cPFNumber
                        //$user->setAttribute('wWWHomePage', $cpf);
                    }
                    if ($email) {
                        $user->setAttribute('mail', $email);//mail
                        //$user->setAttribute('cPFNumber',$cpf);
                    }
                    // $user->setAttribute('ExtensionAttribute1', $cpf);
                    $user = $user->save();
                }

            }
        }

        return $user;
    }

    public function updateUserByLogin($login, $cpf, $email, $descricao)
    {
        $user = $this->adldap->users()->find($login);
        if ($user) {

            if ($cpf != null && $cpf != '' && $cpf != 'null') {
                $user->setAttribute('cpfnumber', $cpf);//cPFNumber
                //$user->setAttribute('wWWHomePage', $cpf);//wWWHomePage
            }
            if ($email != null && $email != '' && $email != 'null') {
                $user->setAttribute(ActiveDirectory::EMAIL, $email);//mail
            }

            if ($descricao != null && $descricao != '' && $descricao != 'null') {
                $user->setAttribute(ActiveDirectory::DESCRIPTION, $descricao);//description
            }

            $user = $user->save();

            if (!$user) {
                throw new \Exception('Não foi possível atualizar este usuário!');
            }
        }
        return $user;
    }

    public function findUser($userName)
    {
        return $this->adldap->users()->find($userName);
    }

    public function search($key, $value)
    {
        //return $this->adldap->search()->newQueryBuilder()->where($key, '=', $value)->get();
        return $this->adldap->search()->newQueryBuilder()->find($value);
    }

    public function searchAdvanced($key, $value, $operator = 'contains', $isUser = false, $filds = ['cn', 'userprincipalname', 'givenname', 'sn', 'cpfnumber', 'mail'])
    {
        $query = $this->adldap->users()->search();
        if (!$isUser) {
            $query = $this->adldap->search()->newQueryBuilder();
        }

        if ($filds) {
            $query->select($filds);
        }

        if ($operator == 'is null') {

            $result = $query->whereNotHas($key)->get();

        } else if ($operator == 'is not null') {

            $result = $query
                ->whereHas($key)->get();

        } else {
            $result = $query->where($key, $operator, $value)->get();
        }

        if (!$result->count()) {
            return null;
        }
        return $result->toArray();


        // return $this->adldap->search()->newQueryBuilder()->find($value);
    }

    public function getAllHierarchyOU($owner = 'PMRO', $recursionCount = 3)
    {
        $recursionCount++;
        if ($recursionCount < 20) {
            $query = $this->adldap->ous()->search();
            $query->select(['ou', 'distinguishedname', 'name', 'dn']);
            $data = $query->get()->toArray();

            $lista = array();
            if ($data != null) {
                foreach ($data as $item) {
                    if ($this->isChildren($item['dn'], $owner, $recursionCount)) {
                        $ou = array();
                        $ou['name'] = $item['name'][0];
                        $ou['dn'] = $item['dn'];
                        $ou['type'] ='ou';

                        //get groups from OU
                        $queryGroup = $this->adldap->groups()->search();//distinguishedname
                        $queryGroup->select(['dn', 'name', 'samaccountname', 'cn']);//member //objectclass //whencreated //objectcategory
                        // $queryGroup->where('distinguishedname', 'contains', $ou['dn']);
                        $allGroups = $queryGroup->get()->toArray();
                        $ouGroups = array();
                        foreach ($allGroups as $group) {
                            if (strpos($group['dn'], $ou['dn']) !== false) {
                                $ouGroup = array();
                                $ouGroup['dn'] = $group['dn'];
                                $ouGroup['name'] = $group['name'][0];
                                $ouGroup['type'] ='group';
                                array_push($ouGroups, $ouGroup);
                            }
                        }
                        //text
                        $childrens = $this->getAllHierarchyOU($ou['name'], $recursionCount);
                        if ($childrens != null) {
                            $ou['nodes'] = array_merge($childrens,$ouGroups) ;
                        }else if(count($ouGroups) > 0){
                            $ou['nodes'] = $ouGroups ;
                        }
                        array_push($lista, $ou);
                    }
                }
            }
        }
        return count($lista) == 0 ? null : $lista;
    }

    private function isChildren($dn, $owner, $limit)
    {
        $from = array("OU=", "DC=");
        $to = array("", "");
        $newDN = str_replace($from, $to, $dn);
        $ous = explode(",", $newDN);

        if (count($ous) > $limit) {
            return false;
        }

        if (count($ous) < $limit) {
            return false;
        }

        foreach ($ous as $item) {
            if ($owner == $item) {
                return true;
            }
        }

        return false;
    }

    public function getAllGroups()
    {
        return $query = $this->adldap->groups()->all();
    }

    //Listar todos os usuários no grupo
    public function getAllUserOffGroup()
    {
        /*// By DN:
        $dn ='cn=Accounting,ou=Groups,dc=acme,dc=org';
        $group = $provider->search()->findByDn($dn);
        // By name:
        $group = $provider->search()->groups()->find('Accounting');
        $members = $group->getMembers();

        foreach($members as $member) {
            echo $member->getDn();
        }*/
    }

    public function changeUserPassword($userName, $currentPassword, $newPassword, $replace = false)
    {
        //'samaccountname'
        $user = $this->adldap->users()->find($userName);
        if (!$user) {
            throw new \Exception('Usuario invalido ou inexistente!');
        }
        if (!$replace) {
            $isUserSetPass = $user->changePassword($currentPassword, $newPassword);
        } else {
            $isUserSetPass = $user->changePassword(null, $newPassword, true);
        }
        return $isUserSetPass;
    }

    public function gelAllUser($itemsPerPage, $offset, $search = null, $orderBy = null, $ordeDir = 'asc')
    {
        $query = $this->adldap->users()->search();

        $currentPage = $offset == 0 ? $offset : $offset / $itemsPerPage;

        $query->select([
            ActiveDirectory::COMMON_NAME,
            ActiveDirectory::ACCOUNT_NAME,
            'cpfnumber',
            ActiveDirectory::EMAIL,
            ActiveDirectory::DESCRIPTION,
            ActiveDirectory::MEMBER_OF
        ]);

        if ($search != null & $search != '') {
            $query->orWhere(ActiveDirectory::COMMON_NAME, 'contains', $search);
            $query->orWhere(ActiveDirectory::ACCOUNT_NAME, 'contains', $search);
        }

        if ($orderBy != null) {
            $query->sortBy($orderBy, $ordeDir);
        } else {
            $query->sortBy(ActiveDirectory::COMMON_NAME, 'asc');
        }

        // $allUsers = $this->adldap->users()->all([ActiveDirectory::ACCOUNT_NAME]);
        //  $totalRecords = count($allUsers);

        $paginator = $query->paginate($itemsPerPage, $currentPage);
        $totalRecords = $paginator->count();
        $users = $paginator->getIterator();

        $data = array();
        if ($users) {
            foreach ($users as $user) {
                $login = $user['samaccountname'][0];
                if ($login != 'Administrador' && $login != 'desenvolvimento') {
                    $item = array();
                    $item['login'] = $login;
                    $item['nome'] = $user['cn'][0];
                    $item['cpfnumber'] = $user['cpfnumber'][0];
                    $item['mail'] = $user['mail'][0];
                    $item['description'] = $user['description'][0];
                    $item['memberof'] = $user['memberof'];
                    //$item['unicodepwd'] = $user['unicodepwd'];
                    //unicodepwd
                    array_push($data, $item);
                }
            }
        }

        $result = array();
        $result['recordsTotal'] = $totalRecords;
        $result['recordsFiltered'] = $totalRecords;
        $result['data'] = $data;
        return $result;
    }

}