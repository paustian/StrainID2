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
        return "This is a temp message";
        
    }

    /**
     * Display one item
     * @param type $args
     * @return string|boolean
     */
    public function display($args)
    {
        $this->throwForbiddenUnless(SecurityUtil::checkPermission('StrainID2::', '::', ACCESS_OVERVIEW), LogUtil::getErrorMsgPermission());
        $lid = isset($args['lid']) ? $args['lid'] : (int)$this->request->query->get('lid', null);
        if (!isset($lid)) {
            throw new Zikula_Exception_Fatal($this->__f('Error! Could not find download for ID #%s.', $lid));
        }
        return "This is a temp message";
    }

}
