<?php

/**
 * StrainID2
 *
 * @license GNU/LGPLv3 (or at your option, any later version).
 */
class StrainID2_Form_Handler_Admin_Edit extends Zikula_Form_AbstractHandler {

    /**
     * id of strain.
     *
     * When set this handler is in edit mode.
     *
     * @var integer
     */
    private $sid;

    /**
     * Setup form.
     *
     * @param Zikula_Form_View $view Current Zikula_Form_View instance.
     *
     * @return boolean
     */
    public function initialize(Zikula_Form_View $view) {
        $sid = FormUtil::getPassedValue('sid', null, 'GET', FILTER_SANITIZE_NUMBER_INT);

        if ($sid) {
            // load record with id
            $file = $this->entityManager->getRepository('StrainID2_Entity_StrainID2')->find($sid);

            if ($file) {
                // switch to edit mode
                $this->sid = $sid;
                $file_fields = $file->toArray();
                // assign current values to form fields
                $view->assign($file->toArray());
                $view->assign('mode', 'edit');
            }
        } else {
           $view->assign('mode', 'create');
        }
        $items = array(array('text' => '+', 'value' => '+'),
            array('text' => '-', 'value' => '-'),
            array('text' => 'v', 'value' => 'v'),
            array('text' => 'u', 'value' => 'u'));

        $view->assign('reaction', $items);  // Supply items

        if (!SecurityUtil::checkPermission('StrainID2::', '::', ACCESS_ADMIN)) {
            $view->setStateData('returnurl', ModUtil::url('StrainID2', 'user', 'main'));
        } else {
            $view->setStateData('returnurl', ModUtil::url('StrainID2', 'admin', 'main'));
        }

        return true;
    }

    /**
     * Handle form submission.
     *
     * @param Zikula_Form_View $view  Current Zikula_Form_View instance.
     * @param array     &$args Args.
     *
     * @return boolean
     */
    public function handleCommand(Zikula_Form_View $view, &$args) {
        $returnurl = $view->getStateData('returnurl');

        // process the cancel action
        if ($args['commandName'] == 'cancel') {
            return $view->redirect($returnurl);
        }

        if ($args['commandName'] == 'delete') {
            if (SecurityUtil::checkPermission('StrainID2::', '::', ACCESS_DELETE)) {
                $file = $this->entityManager->getRepository('StrainID2_Entity_StrainID2')->find($this->sid);
                $name = $file['name'];
                $this->entityManager->remove($file);
                $this->entityManager->flush();
                ModUtil::apiFunc('StrainID2', 'user', 'clearItemCache', $file);
                LogUtil::registerStatus($this->__f('Item [name %s] deleted!', $name));
                return $view->redirect(ModUtil::url('StrainID2', 'admin', 'main'));
            } else {
                $view->setPluginErrorMsg('title', $this->__('You are not authorized to delete this entry!'));
                return false;
            }
        }

        // check for valid form
        if (!$view->isValid()) {
            return false;
        }

        // load form values
        $data = $view->getValues();

        // switch between edit and create mode
        if ($this->sid) {
            if (SecurityUtil::checkPermission('StrainID2::', '::', ACCESS_EDIT)) {
                $file = $this->entityManager->getRepository('StrainID2_Entity_StrainID2')->find($this->sid);
            } else {
                $view->setPluginErrorMsg('title', $this->__('You are not authorized to edit this entry!'));
                return false;
            }
            $file->merge($data['strain']);
        } else {
            $file = new StrainID2_Entity_StrainID2();
            $file->merge($data['strain']);
            $this->entityManager->persist($file);
        }

        try {
            $this->entityManager->flush();
        } catch (Zikula_Exception $e) {
            echo "<pre>";
            var_dump($e->getDebug());
            echo "</pre>";
            die;
        }

        ModUtil::apiFunc('StrainID2', 'user', 'clearItemCache', $file);

        return $view->redirect($returnurl);
    }

}
