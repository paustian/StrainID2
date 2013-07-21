<?php

/**
 * PostCalendar
 * 
 * @license MIT
 * @copyright   Copyright (c) 2012, Craig Heydenburg, Sound Web Development
 *
 * Please see the NOTICE file distributed with this source code for further
 * information regarding copyright and licensing.
 */
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use StrainID2_Entity_StrainID2 as StrainID2;

class StrainID2_Entity_Repository_StrainID2Repository extends EntityRepository
{

    /**
     * Get a collection of items for display
     * 
     * @param string $orderBy -- How to order the strains
     * @param string $where -- search statement
     * @return array of objects 
     */
    public function getStrains($orderBy, $where='')
    {
        $dql = "SELECT a FROM StrainID2_Entity_StrainID2 a";
        
        if (!empty($where)) {
            $dql .= ' WHERE ' . $where;
        }

        $dql .= " ORDER BY a.$orderBy $orderDir";

        // generate query
        $query = $this->_em->createQuery($dql);


        try {
            $result = $query->getResult();
        } catch (Exception $e) {
            echo "<pre>";
            var_dump($e->getMessage());
            var_dump($query->getDQL());
            var_dump($query->getParameters());
            var_dump($query->getSQL());
            die;
        }
        return $result;
    }
    
    public function selectSearchAnd($items_to_search, $orderBy = '')
    {
        $where = '';    
        foreach($items_to_search as $key => $item){
             $item = DataUtil::formatForStore($item);
             $search_strings = explode("|", $item);
             $whereSub = '';
             foreach($search_strings as $search_string){
                 $whereSub .= ((!empty($whereSub)) ? ' OR ' : '') . 'a.' . $key . ' LIKE \'%' . $search_string . '%\'';
             }
             $where .= ((!empty($where)) ? ' AND (' . $whereSub . ')' : '(' . $whereSub . ')');
        }
        return $this->getStrains($orderBy, $where);
    }

}