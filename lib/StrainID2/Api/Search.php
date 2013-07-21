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
    
        $view->assign('strains', (!isset($args['StrainID']) || isset($args['active']['StrainID'])));
    
        return $view->fetch('search/options.tpl');
    }
    
    /**
     * Executes the actual search process.
     *
     * @param array $args List of arguments.
     *
     * @return boolean
     */
    public function search($args)
    {
        ModUtil::dbInfoLoad('Search');

        $sessionId = session_id();

        // this is a bit of a hacky way to ustilize this API for Doctrine calls.
        $where = Search_Api_User::construct_where($args, array('a.name'), null);
        if (!empty($where)) {
            $where = trim(substr(trim($where), 1, -1));
        }

        $qb = $this->entityManager->createQueryBuilder();
        $qb->select('a')
            ->from('StrainID2_Entity_StrainID2', 'a')
            ->where($where);
        $query = $qb->getQuery();
        $results = $query->getResult();

        foreach ($results as $result) {
            $record = array(
                'title' => $result->getName(),
                'text' => '',
                'extra' => '',
                'created' => $result->getDate()->format('Y-m-d h:m:s'),
                'module' => 'StraindID2',
                'session' => $sessionId
            );

            if (!DBUtil::insertObject($record, 'search_result')) {
                return LogUtil::registerError($this->__('Error! Could not save the search results.'));
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