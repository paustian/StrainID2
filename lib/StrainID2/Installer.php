<?php

/**
 * StrainID2
 *
 * @license GNU/LGPLv3 (or at your option, any later version).
 */

/**
 * Class to control Installer interface
 */
class StrainID2_Installer extends Zikula_AbstractInstaller
{

    /**
     * Initializes a new install
     *
     * This function will initialize a new installation.
     * It is accessed via the Zikula Admin interface and should
     * not be called directly.
     *
     * @return  boolean    true/false
     */
    public function install()
    {        
        // create the table
        try {
            DoctrineHelper::createSchema($this->entityManager, array('StrainID2_Entity_StrainID2'));
        } catch (Exception $e) {
            return false;
        }
        $this->createDefaultData();
        return true;
    }

    
    /**
     * Create the default data for StrainID2
     *
     * @return void
     */
    protected function createDefaultData()
    {
        $strain1 = new StrainID2_Entity_StrainID2();
        $strain2 = new StrainID2_Entity_StrainID2();
        $strain3 = new StrainID2_Entity_StrainID2();
        $strain4 = new StrainID2_Entity_StrainID2();
        $strain5 = new StrainID2_Entity_StrainID2();
        
        $strain1->setName('Esherichia coli');
        $strain1->setIndole('+');
        $strain1->setMethylRed('+');
        $strain1->setVoguesProskauer('-');
        $strain1->setSimmonsCitrate('-');
        $strain1->setH2s('-');
        $strain1->setPhenylAlanine('-');
        $strain1->setLysine('+');
        $strain1->setOrnithine('v');
        $strain1->setMotility('+');
        $strain1->setLactose('+');
        
        $strain2->setName('Budvicia aquatica');
        $strain2->setIndole('-');
        $strain2->setMethylRed('+');
        $strain2->setVoguesProskauer('-');
        $strain2->setSimmonsCitrate('-');
        $strain2->setH2s('+');
        $strain2->setPhenylAlanine('-');
        $strain2->setLysine('-');
        $strain2->setOrnithine('-');
        $strain2->setMotility('v');
        $strain2->setLactose('+');
        
        $strain3->setName('Enterobacter taylorae');
        $strain3->setIndole('+');
        $strain3->setMethylRed('+');
        $strain3->setVoguesProskauer('+');
        $strain3->setSimmonsCitrate('+');
        $strain3->setH2s('+');
        $strain3->setPhenylAlanine('+');
        $strain3->setLysine('+');
        $strain3->setOrnithine('+');
        $strain3->setMotility('+');
        $strain3->setLactose('+');
        
        $strain4->setName('Enterobacter aerogenes');
        $strain4->setIndole('-');
        $strain4->setMethylRed('-');
        $strain4->setVoguesProskauer('+');
        $strain4->setSimmonsCitrate('+');
        $strain4->setH2s('-');
        $strain4->setPhenylAlanine('-');
        $strain4->setLysine('+');
        $strain4->setOrnithine('+');
        $strain4->setMotility('+');
        $strain4->setLactose('+');
        
        $strain5->setName('Yersinia pestis');
        $strain5->setIndole('-');
        $strain5->setMethylRed('+');
        $strain5->setVoguesProskauer('-');
        $strain5->setSimmonsCitrate('-');
        $strain5->setH2s('-');
        $strain5->setPhenylAlanine('-');
        $strain5->setLysine('-');
        $strain5->setOrnithine('-');
        $strain5->setMotility('-');
        $strain5->setLactose('-');
        
        
        // execute the workflow action for each entity
        try {
            $this->entityManager->persist($strain1);
            $this->entityManager->persist($strain2);
            $this->entityManager->persist($strain3);
            $this->entityManager->persist($strain4);
            $this->entityManager->persist($strain5);
            $this->entityManager->flush();
        } catch(\Exception $e) {
            LogUtil::registerError($this->__('Sorry, but an unknown error occured during example data creation. Possibly not all data could be created properly!'));
        }
    }
    
    /**
     * Upgrades an old install
     *
     * This function is used to upgrade an old version
     * of the module.  It is accessed via the Zikula
     * Admin interface and should not be called directly.
     *
     * @param   string    $oldversion Version we're upgrading
     * @return  boolean   true/false
     */
    public function upgrade($oldversion)
    {
        $this->throwForbiddenUnless(SecurityUtil::checkPermission('StrainID2::', '::', ACCESS_ADMIN), LogUtil::getErrorMsgPermission());

        switch ($oldversion) {
        }

        return true;
    }

    /**
     * removes an install
     *
     * This function removes the module from your
     * Zikula install and should be accessed via
     * the Zikula Admin interface
     *
     * @return  boolean    true/false
     */
    public function uninstall()
    {
        // drop tables
        DoctrineHelper::dropSchema($this->entityManager, array('StrainID2_Entity_StrainID2'));

        return true;
    }

}