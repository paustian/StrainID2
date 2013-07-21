<?php
/**
 * StrainID2
 *
 * @license GNU/LGPLv3 (or at your option, any later version).
 */

/**
 * Class to control Admin interface
 */
class StrainID2_Api_Admin extends Zikula_AbstractApi
{
    /**
     * 
     * @return array
     * This adds the amin links to the top of the admin interface. 
     * These links appear in any interface that has {adminheader} in its template.
     */
    
    public function getlinks()
    {
        $links[] = array(
                       'url' => ModUtil::url('StrainID2', 'admin', 'edit'),
                        'text' => 'Enter New Strain');
        return $links;   
    }
}
