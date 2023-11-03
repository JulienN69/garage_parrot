<?php

namespace App\Data;

use Symfony\Component\Validator\Constraints as Assert;

class SearchCarData 
{
    public $page = 1;

    protected int $priceMin = 0;
    protected int $priceMax = 150000;

    protected int $yearMax = 2023;
    protected int $yearMin = 1980;

    protected int $milesMax = 200000;
    protected int $milesMin = 0;


    /**
     * Get the value of yearMax
     */ 
    public function getYearMax()
    {
        return $this->yearMax;
    }

    /**
     * Set the value of yearMax
     *
     * @return  self
     */ 
    public function setYearMax($yearMax)
    {
        $this->yearMax = $yearMax;

        return $this;
    }

    /**
     * Set the value of yearMin
     *
     * @return  self
     */ 
    public function setYearMin($yearMin)
    {
        $this->yearMin = $yearMin;

        return $this;
    }

    /**
     * Get the value of yearMin
     */ 
    public function getYearMin()
    {
        return $this->yearMin;
    }


    /**
     * Get the value of priceMin
     */ 
    public function getPriceMin()
    {
        return $this->priceMin;
    }

    /**
     * Set the value of priceMin
     *
     * @return  self
     */ 
    public function setPriceMin($priceMin)
    {
        $this->priceMin = $priceMin;

        return $this;
    }

    /**
     * Get the value of priceMax
     */ 
    public function getPriceMax()
    {
        return $this->priceMax;
    }

    /**
     * Set the value of priceMax
     *
     * @return  self
     */ 
    public function setPriceMax($priceMax)
    {
        $this->priceMax = $priceMax;

        return $this;
    }

    /**
     * Get the value of milesMax
     */ 
    public function getMilesMax()
    {
        return $this->milesMax;
    }

    /**
     * Set the value of milesMax
     *
     * @return  self
     */ 
    public function setMilesMax($milesMax)
    {
        $this->milesMax = $milesMax;

        return $this;
    }

    /**
     * Get the value of milesMin
     */ 
    public function getMilesMin()
    {
        return $this->milesMin;
    }

    /**
     * Set the value of milesMin
     *
     * @return  self
     */ 
    public function setMilesMin($milesMin)
    {
        $this->milesMin = $milesMin;

        return $this;
    }
}