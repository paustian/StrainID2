<?php

/**
 * StrainID2
 *
 * @license GNU/LGPLv3 (or at your option, any later version).
 */

/**
 * Class to control User interface
 */
class StrainID2_Controller_User extends Zikula_AbstractController
{

    /**
     * main (default) method
     */
    public function main()
    {
        $this->redirect(ModUtil::url('StrainID2', 'user', 'view'));
    }

    /**
     * This method provides a generic item list overview.
     *
     * @return string|boolean Output.
     */
    public function view()
    {
        // check module permissions
        $this->throwForbiddenUnless(SecurityUtil::checkPermission('StrainID2::', '::', ACCESS_OVERVIEW), LogUtil::getErrorMsgPermission());
        $repository = $this->entityManager->getRepository('StrainID2_Entity_StrainID2');
        $strain_table = StrainID2_Api_User::generate_strain_table($this->view, $repository, true);
        $this->view->assign('strain_table', $strain_table);

        return $this->view->fetch('user/view.tpl');
        
    }

    /**
     * Display one item
     * @param type $args
     * @return string|boolean
     */
    public function display($args)
    {
        $this->redirect(ModUtil::url('StrainID2', 'user', 'view'));
    }
    
    public function search($args)
    {
        $this->throwForbiddenUnless(SecurityUtil::checkPermission('StrainID::', '::', ACCESS_OVERVIEW));
        // create new Form reference
        $view = FormUtil::newForm($this->name, $this);
        $strain_table = SessionUtil::getVar('search_results');
        $view->assign('strain_table', $strain_table);
        return $view->execute('user/search.tpl', new StrainID2_Form_Handler_User_Search());
    }

}
