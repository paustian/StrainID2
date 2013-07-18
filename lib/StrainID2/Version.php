<?php

/**
 * StrainID2
 *
 * @license GNU/LGPLv3 (or at your option, any later version).
 */

/**
 * Class to control Version information
 */
class StrainID2_Version extends Zikula_AbstractVersion
{

    public function getMetaData()
    {
        $meta = array();
        $meta['displayname'] = $this->__('StrainID2');
        $meta['url'] = $this->__(/* !used in URL - nospaces, no special chars, lcase */'strainid2');
        $meta['description'] = $this->__('Tutorial Module For Zikula');
        $meta['version'] = '1.0.0';

        $meta['securityschema'] = array('StrainID2::' => '::',
            'StrainID:Strain:' => 'Strain ID::');
        $meta['core_min'] = '1.3.3'; // requires minimum 1.3.3 or later
        $meta['core_max'] = '1.3.99';
        
        return $meta;
    }
}
