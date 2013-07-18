<?php
/**
 * StrainID2
 *
 * @license GNU/LGPLv3 (or at your option, any later version).
 */

/**
 * Class to control Admin interface
 */
class StrainID2_Controller_Admin extends Zikula_AbstractController
{

    /**
     * This method provides a generic item list overview.
     *
     * @return string|boolean Output.
     */
    public function main()
    {
        $this->throwForbiddenUnless(SecurityUtil::checkPermission('StrainID2::', '::', ACCESS_ADMIN), LogUtil::getErrorMsgPermission());
        $repository = $this->entityManager->getRepository('StrainID2_Entity_StrainID2');
        $strain_table = StrainID2_Api_User::generate_strain_table($this->view, $repository, true);
        $this->view->assign('strain_table', $strain_table);

        return $this->view->assign('mode', 'edit')
                        ->fetch('admin/main.tpl');
    }


    /**
     * Create or edit record.
     *
     * @return string|boolean Output.
     */
    public function edit()
    {
        $this->throwForbiddenUnless(SecurityUtil::checkPermission('StrainID2::', '::', ACCESS_ADD), LogUtil::getErrorMsgPermission());
        $form = FormUtil::newForm('StrainID2', $this);
        return $form->execute('admin/edit.tpl', new StrainID2_Form_Handler_Admin_Edit());
    }

    public function categoryList(){
    
    }
    /**
     * @desc set caching to false for all admin functions
     * @return      null
     */
    public function postInitialize()
    {
        $this->view->setCaching(false);
    }

}
