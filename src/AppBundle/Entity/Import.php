<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Import
 *
 * @ORM\Table(name="tblProductData")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ImportRepository")
 */
class Import
{
    /**
     * @var int
     *
     * @ORM\Column(name="intProductDataId", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="strProductName", type="string", length=50)
     */
    private $productName;

    /**
     * @var string
     *
     * @ORM\Column(name="strProductDesc", type="string", length=255)
     */
    private $productDesc;

    /**
     * @var string
     *
     * @ORM\Column(name="strProductCode", type="string", length=10, unique=true)
     */
    private $productCode;

    /**
     * @var string
     *
     * @ORM\Column(name="dclProductCost",  type="decimal", precision=18, scale=2)
     *
     */
    private $productCost;

    /**
     * @var int
     *
     * @ORM\Column(name="intStockAmount", type="integer")
     */
    private $productStockAmount;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dtmAdded", type="datetime", nullable=true)
     */
    private $added;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dtmDiscontinued", type="datetime", nullable=true)
     */
    private $discontinued;

    /**
     * @var int
     *
     * @ORM\Column(name="stmTimestamp", type="datetime")
     */
     private $timeStamp;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set productName
     *
     * @param string $productName
     * @return Import
     */
    public function setProductName($productName)
    {
        $this->productName = $productName;

        return $this;
    }

    /**
     * Get productName
     *
     * @return string 
     */
    public function getProductName()
    {
        return $this->productName;
    }

    /**
     * Set productDesc
     *
     * @param string $productDesc
     * @return Import
     */
    public function setProductDesc($productDesc)
    {
        $this->productDesc = $productDesc;

        return $this;
    }

    /**
     * Get productDesc
     *
     * @return string 
     */
    public function getProductDesc()
    {
        return $this->productDesc;
    }

    /**
     * Set productCode
     *
     * @param string $productCode
     * @return Import
     */
    public function setProductCode($productCode)
    {
        $this->productCode = $productCode;

        return $this;
    }

    /**
     * Get productCode
     *
     * @return string 
     */
    public function getProductCode()
    {
        return $this->productCode;
    }

    /**
     * @param $productCost
     * @return $this
     */
    public function setProductCost($productCost)
    {
        $this->productCost = $productCost;

        return $this;
    }

    /**
     * @return string
     */
    public function getProductCost()
    {
        return $this->productCost;
    }

    /**
     * @param $stockAmount
     * @return $this
     */
    public function setProductStockAmount($stockAmount)
    {
        $this->productStockAmount = $stockAmount;

        return $this;
    }

    /**
     * @return int
     */
    public function getProductStockAmount()
    {
        return $this->productStockAmount;
    }

    /**
     * Set added
     *
     * @param \DateTime $added
     * @return Import
     */
    public function setAdded($added)
    {
        $this->added = $added;

        return $this;
    }

    /**
     * Get added
     *
     * @return \DateTime 
     */
    public function getAdded()
    {
        return $this->added;
    }

    /**
     * Set discontinued
     *
     * @param \DateTime $discontinued
     * @return Import
     */
    public function setDiscontinued($discontinued = null)
    {
        if ($discontinued == 'yes')
            $this->discontinued = new \DateTime(date('Y-m-d H:i:s'));
        else
            $this->discontinued = null;

        return $this;
    }

    /**
     * Get discontinued
     *
     * @return \DateTime 
     */
    public function getDiscontinued()
    {
        return $this->discontinued;
    }

    /**
     * Set timeStamp
     *
     * @param \DateTime $timeStamp
     * @return Import
     */
    /*public function setTimeStamp($timeStamp)
    {
        $this->timeStamp = $timeStamp;

        return $this;
    }*/

    /**
     * Get timeStamp
     *
     * @return integer
     */
    public function getTimeStamp()
    {
        return $this->timeStamp;
    }


}
