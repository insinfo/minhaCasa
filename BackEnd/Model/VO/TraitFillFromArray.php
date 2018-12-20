<?php
/**
 * Created by PhpStorm.
 * User: isaque
 * Date: 14/05/2018
 * Time: 15:35
 */

namespace Jubarte\Model\VO;

trait TraitFillFromArray
{
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
}