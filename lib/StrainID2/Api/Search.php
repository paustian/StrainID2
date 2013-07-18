<?php

class StrainID2_Api_Search extends Zikula_AbstractApi
{

    /**
     * Get search plugin information.
     *
     * @return array The search plugin information
     */
    public function info()
    {
        return array('title'     => $this->name,
                     'functions' => array($this->name => 'search'));
    }
    
    /**
     * Display the search form.
     *
     * @param array $args List of arguments.
     *
     * @return string template output
     */
    public function options(array $args = array())
    {
        if (!SecurityUtil::checkPermission($this->name . '::', '::', ACCESS_READ)) {
            return '';
        }
    
        $view = Zikula_View::getInstance($this->name);
    
        $view->assign('active_strain', (!isset($args['active_strain']) || isset($args['active']['active_strain'])));
    
        return $view->fetch('search/options.tpl');
    }
    
    /**
     * Executes the actual search process.
     *
     * @param array $args List of arguments.
     *
     * @return boolean
     */
    public function search(array $args = array())
    {
        if (!SecurityUtil::checkPermission($this->name . '::', '::', ACCESS_READ)) {
            return '';
        }
    
        // ensure that database information of Search module is loaded
        ModUtil::dbInfoLoad('Search');
    
        // save session id as it is used when inserting search results below
        $sessionId  = session_id();
    
        // retrieve list of activated object types
        $searchTypes = isset($args['objectTypes']) ? (array)$args['objectTypes'] : (array) FormUtil::getPassedValue('search_strainid_types', array(), 'GETPOST');
    
        $controllerHelper = new StrainID_Util_Controller($this->serviceManager);
        $utilArgs = array('api' => 'search', 'action' => 'search');
        $allowedTypes = $controllerHelper->getObjectTypes('api', $utilArgs);
        $entityManager = ServiceUtil::getService('doctrine.entitymanager');
        $currentPage = 1;
        $resultsPerPage = 50;
    
        foreach ($searchTypes as $objectType) {
            if (!in_array($objectType, $allowedTypes)) {
                continue;
            }
    
            $whereArray = array();
            $languageField = null;
            switch ($objectType) {
                case 'strain':
                    $whereArray[] = 'workflowState';
                    $whereArray[] = 'name';
                    $whereArray[] = 'indole';
                    $whereArray[] = 'methyl_red';
                    $whereArray[] = 'vogues_proskauer';
                    $whereArray[] = 'simmons_citrate';
                    $whereArray[] = 'h2s';
                    $whereArray[] = 'phenylalanine';
                    $whereArray[] = 'lysine';
                    $whereArray[] = 'ornithine';
                    $whereArray[] = 'motility';
                    $whereArray[] = 'lactose';
                    break;
            }
            $where = Search_Api_User::construct_where($args, $whereArray, $languageField);
    
            $entityClass = $this->name . '_Entity_' . ucwords($objectType);
            $repository = $entityManager->getRepository($entityClass);
    
            // get objects from database
            list($entities, $objectCount) = $repository->selectWherePaginated($where, '', $currentPage, $resultsPerPage, false);
    
            if ($objectCount == 0) {
                continue;
            }
    
            $idFields = ModUtil::apiFunc($this->name, 'selection', 'getIdFields', array('ot' => $objectType));
            $titleField = $repository->getTitleFieldName();
            $descriptionField = $repository->getDescriptionFieldName();
            foreach ($entities as $entity) {
                // create identifier for permission check
                $instanceId = '';
                foreach ($idFields as $idField) {
                    if (!empty($instanceId)) {
                        $instanceId .= '_';
                    }
                    $instanceId .= $entity[$idField];
                }
                if (!SecurityUtil::checkPermission($this->name . ':' . ucfirst($objectType) . ':', $instanceId . '::', ACCESS_OVERVIEW)) {
                    continue;
                }
    
                $title = ($titleField != '') ? $entity[$titleField] : $this->__('Item');
                $description = ($descriptionField != '') ? $entity[$descriptionField] : '';
                $created = (isset($entity['createdDate'])) ? $entity['createdDate'] : '';
    
                $searchItemData = array(
                    'title'   => $title,
                    'text'    => $description,
                    'extra'   => '',
                    'created' => $created,
                    'module'  => $this->name,
                    'session' => $sessionId
                );
    
                if (!DBUtil::insertObject($searchItemData, 'search_result')) {
                    return LogUtil::registerError($this->__('Error! Could not save the search results.'));
                }
            }
        }
    
        return true;
    }
    
    /**
     * Assign URL to items.
     *
     * @param array $args List of arguments.
     *
     * @return boolean
     */
    public function search_check(array $args = array())
    {
        // nothing to do as we have no display pages which could be linked
        return true;
    }

}