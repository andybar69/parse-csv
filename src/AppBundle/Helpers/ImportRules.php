<?php
/**
 * Created by PhpStorm.
 * User: barabash
 * Date: 24.10.2017
 * Time: 17:53
 */

namespace AppBundle\Helpers;


class ImportRules extends BaseHelper
{
    public function apply($arr, &$skipped)
    {
        foreach ($arr as $key => $row) {
            if (! $this->checkCost($row[self::PRODUCT_COST_KEY]) ||
                ! $this->checkCostAndStock($row[self::PRODUCT_COST_KEY], $row[self::PRODUCT_STOCK_KEY])) {
                $skipped[] = $row;
                unset($arr[$key]);
            }
        }

        return $arr;
    }

    protected function checkCost($val)
    {
        $res = ($val > self::MAX_COST_AMOUNT) ? false : true;
        return $res;
    }

    protected function checkCostAndStock($cost, $amount)
    {
        $res = ($cost < self::MIN_COST_AMOUNT && $amount < self::MAX_IN_STOCK) ? false : true;
        return $res;
    }

}