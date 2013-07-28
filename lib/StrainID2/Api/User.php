<?php

/**
 * StrainID2
 *
 * @license GNU/LGPLv3 (or at your option, any later version).
 */

/**
 * Class to control User interface
 */
class StrainID2_Api_User extends Zikula_AbstractApi
{
    static public function generate_strain_table($view, $repository, $do_edit_links, $where = "") {
        $orderBy = 'name';
        $strains = $repository->getStrains($orderBy, $where);
        //Now assign this to a template variable
        $view->assign('strains', $strains);
        $view->assign('is_admin', $do_edit_links);
        //create the strain table.
        return $view->fetch('user/strainTbl.tpl');
    }
    
    
    public function getlinks(){
        return null;
    }
    /**
     * get strains filtered as requested
     * @param type $args
     * @return array of objects
     */
    public function getall($args)
    {
       $where = isset($args['where']) ? $args['where']: '';
       $orderby = isset($args['orderby']) ? $args['orderby'] : 'name';
       
       $strains = $this->entityManager->getRepository('StrainID2_Entity_StrainID2')
                ->getStrains($orderby, $where);

        $result = array();
        foreach ($strains as $key => $strain) {
            if ((!SecurityUtil::checkPermission('StrainID2::Item', $strain->getSid() . '::', ACCESS_OVERVIEW))) {
                continue;
            } else {
                $result[$key] = $strain;
            }
        }
        return $result;
    }

    /**
     * cound the number of results in the query
     * @param array $args
     * @return integer
     */
    public function countQuery($args)
    {
        $args['limit'] = -1;
        $items = $this->getall($args);
        return count($items);
    }
}
