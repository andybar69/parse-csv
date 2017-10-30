<?php

namespace AppBundle\Helpers;

/**
 *
 * Class BaseHelper
 * @package AppBundle\Helpers
 */
class BaseHelper
{
    const TEST_MODE = 'test';
    const CSV_DELIMITER = ",";
    const FILE_NAME = 'stock.csv';
    const IGNORE_FIRST_LINE = false;
    const PRODUCT_NAME_KEY = 'Product Name';
    const PRODUCT_CODE_KEY = 'Product Code';
    const PRODUCT_DESC_KEY = 'Product Description';
    const PRODUCT_STOCK_KEY = 'Stock';
    const PRODUCT_COST_KEY = 'Cost in GBP';
    const PRODUCT_DISCONT_KEY = 'Discontinued';
    const MAX_COST_AMOUNT = 1000;
    const MIN_COST_AMOUNT = 5;
    const MAX_IN_STOCK = 10;
}