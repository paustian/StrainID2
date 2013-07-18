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
    public function getStrains($orderBy, $where)
    {
        $dql = "SELECT a FROM StrainID2_Entity_StrainID2 a";
        $where = array();

        if (!empty($where)) {
            $dql .= ' WHERE ' . implode(' AND ', $where);
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

}