<?php

namespace AppBundle\Helpers\Output;

use AppBundle\Entity;
use AppBundle\Helpers\DataHandler;

/**
 * Class SaveOutput
 * Prepare data for being persisted to DB
 * @package AppBundle\Helpers\Output
 */
class SaveOutput extends BaseOutput
{
    /**
     * @param $em
     * @param $data
     * @param $skipped
     */
    public function output($em, $data, $skipped)
    {
        $this->showProcessedData(count($data), $skipped);
        $data = $this->fromArray($data);
        foreach ($data as $obj) {
            $em->persist($obj);
        }

        $em->flush();
        echo PHP_EOL . "All data successfully saved" . PHP_EOL;
    }

    /**
     * Creates entity object
     * @param $arr
     * @return Entity\Import
     */
    protected function buildEntity($arr)
    {
        $o = new Entity\Import();
        $o->setProductName($arr[DataHandler::PRODUCT_NAME_KEY]);
        $o->setProductDesc($arr[DataHandler::PRODUCT_DESC_KEY]);
        $o->setProductCode($arr[DataHandler::PRODUCT_CODE_KEY]);
        $o->setProductCost($arr[DataHandler::PRODUCT_COST_KEY]);
        $o->setProductStockAmount((int)$arr[DataHandler::PRODUCT_STOCK_KEY]);
        $o->setAdded(new \DateTime());
        $o->setDiscontinued($arr[DataHandler::PRODUCT_DISCONT_KEY]);

        return $o;
    }

    /**
     * Creates array of entities
     * @param $data
     * @return array
     */
    protected function fromArray($data)
    {
        $arEntities = array();
        foreach ($data as $row) {
            $arEntities[] = $this->buildEntity($row);
        }
        return $arEntities;
    }
}
