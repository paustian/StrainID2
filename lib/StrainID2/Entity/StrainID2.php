<?php

/**
 * StrainID2
 *
 * @license GNU/LGPLv3 (or at your option, any later version).
 */
use Doctrine\ORM\Mapping as ORM;

/**
 * Download entity class
 *
 * Annotations define the entity mappings to database.
 *
 * @ORM\Entity(repositoryClass="StrainID2_Entity_Repository_StrainID2Repository")
 * @ORM\Table(name="strainid2_strainid2")
 */
class StrainID2_Entity_StrainID2 extends Zikula_EntityAccess
{
    

    /**
     * id field (record id)
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $sid;

    /**
     * item name
     * 
     * @ORM\Column(length=255)
     */
    private $name = '';

    /**
     * item indole
     * 
     * @ORM\Column(length=1)
     */
    private $indole = '+';
    
    /**
     * item methyl_red
     * 
     * @ORM\Column(length=1)
     */
    private $methylred = '+';
    
    /**
     * item vogues_proskauer
     * 
     * @ORM\Column(length=1)
     */
    private $voguesproskauer = '+';
    
    /**
     * item simmons_citrate
     * 
     * @ORM\Column(length=1)
     */
    private $simmonscitrate = '+';
    
    /**
     * item h2s
     * 
     * @ORM\Column(length=1)
     */
    private $h2s = '+';
    
    /**
     * item phenylalanine
     * 
     * @ORM\Column(length=1)
     */
    private $phenylalanine = '+';
    
    /**
     * item lysine
     * 
     * @ORM\Column(length=1)
     */
    private $lysine = '+';
    
    /**
     * item ornithine
     * 
     * @ORM\Column(length=1)
     */
    private $ornithine = '+';

    /**
     * item motility
     * 
     * @ORM\Column(length=1)
     */
    private $motility = '+';
    
    /**
     * item lactose
     * 
     * @ORM\Column(length=1)
     */
    private $lactose = '+';
    /**
     * Constructor 
     */
    public function __construct()
    {
    }

    public function getSid()
    {
        return $this->sid;
    }

    public function setSid($sid)
    {
        $this->sid = $sid;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }
    
    public function getIndole()
    {
        return $this->indole;
    }

    public function setIndole($indole)
    {
        $this->indole = $indole;
    }
    public function getMethylred()
    {
        return $this->methylred;
    }

    public function setMethylred($methylred)
    {
        $this->methylred = $methylred;
    }

    public function getVoguesproskauer()
    {
        return $this->voguesproskauer;
    }

    public function setVoguesproskauer($voguesproskauer)
    {
        $this->voguesproskauer = $voguesproskauer;
    }

    public function getSimmonscitrate()
    {
        return $this->simmonscitrate;
    }

    public function setSimmonscitrate($simmonscitrate)
    {
        $this->simmonscitrate = $simmonscitrate;
    }

    public function getH2s()
    {
        return $this->h2s;
    }

    public function setH2s($h2s)
    {
        $this->h2s = $h2s;
    }

    public function getPhenylalanine()
    {
        return $this->phenylalanine;
    }

    public function setPhenylalanine($phenylalanine)
    {
        $this->phenylalanine = $phenylalanine;
    }

    public function getLysine()
    {
        return $this->lysine;
    }

    public function setLysine($lysine)
    {
        $this->lysine = $lysine;
    }

    public function getOrnithine()
    {
        return $this->ornithine;
    }

    public function setOrnithine($ornithine)
    {
        $this->ornithine = $ornithine;
    }

    public function getMotility()
    {
        return $this->motility;
    }

    public function setMotility($motility)
    {
        $this->motility = $motility;
    }

    public function getLactose()
    {
        return $this->lactose;
    }

    public function setLactose($lastose)
    {
        $this->lactose = $lastose;
    }

}
