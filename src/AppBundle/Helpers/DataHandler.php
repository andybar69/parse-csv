<?php
namespace AppBundle\Helpers;

use Symfony\Component\Finder\Finder;

/**
 * Class DataHandler
 * @package AppBundle\Helpers
 */
class DataHandler extends BaseHelper
{
     protected $data;
     protected $validator;
     protected $upload;
     protected $skipped;
     private $storage;
     private $strategy;

    /**
     * DataHandler constructor.
     * @param $oValidator
     * @param $pathToDir
     */
     public function __construct($oValidator, $pathToDir)
     {
         $this->data = $this->skipped = array();
         $this->validator = $oValidator;
         $this->upload = $pathToDir;
         $this->storage = array();
     }

    /**
     * Main front process data function
     */
     public function process()
     {
         $arRows = $this->parseCSV();
         $arr = $this->normalize($arRows);
         $this->applyBusinessRules($arr);
     }

    /**
     * @param $o
     */
     public function setStrategy($o)
     {
         $this->strategy = $o;
     }

    /**
     * Reads csv file
     * @return array
     */
     protected function parseCSV()
     {
         $finder = new Finder();
         $finder->files()
             ->in($this->upload . DIRECTORY_SEPARATOR)
             ->name(self::FILE_NAME);
         $csv = null;
         foreach ($finder as $file) {
             $csv = $file;
         }

         $rows = array();
         if (($handle = fopen($csv->getRealPath(), "r")) !== false) {
             $i = 0;
             while (($data = fgetcsv($handle, null, self::CSV_DELIMITER)) !== false) {
                 $i++;
                 if (self::IGNORE_FIRST_LINE && $i == 1) {
                     continue;
                 }
                 $rows[] = $data;
             }
             fclose($handle);
         }

         return $rows;
     }

    /**
     * Handles raw csv array and performs data verification
     * @param $data
     * @return array
     */
     protected function normalize($data)
     {
         $arHeader = array_slice($data, 0, 1);
         $arHeader = end($arHeader);
         unset($data[0]);

         $arData = array_values($data);
         $columns = count($arHeader);
         $output = array();
         foreach ($arData as $row) {
             $arTemp = array();
             if (!$this->checkLength($columns, $row)) {
                 continue;
             }
             for ($i = 0; $i < count($row); $i++) {
                 $arTemp[$arHeader[$i]] = trim($row[$i]);
             }

             if ($this->checkProductCode($arTemp)) {
                 $output[$arTemp[self::PRODUCT_CODE_KEY]] = $arTemp;
             }
         }
         $this->removeDuplicates($output);
         return $output;
     }

    /**
     * Applies business rules to data
     * @param $arr
     */
     protected function applyBusinessRules($arr)
     {
         $this->data = $this->validator->apply($arr, $this->skipped);
         unset($arr);
     }

    /**
     * Removes entries with the same product Code. Cannot guess which of them is correct
     * @param $arr
     */
     protected function removeDuplicates(&$arr)
     {
         $arCodes = array();
         foreach ($this->skipped as $item) {
             if (array_key_exists(self::PRODUCT_CODE_KEY, $item)) {
                 $arCodes[] = $item[self::PRODUCT_CODE_KEY];
             } else {
                 $arCodes[] = $item[0];
             }
         }
         $d = array_intersect($arCodes, array_keys($arr));
         $arDelete = array_values($d);
         foreach ($arDelete as $val) {
             $this->skipped[] = $arr[$val];
             unset($arr[$val]);
         }
     }

    /**
     * Check csv row for having the same amount of fields as header does
     * @param $columns
     * @param $items
     * @return bool
     */
     protected function checkLength($columns, $items)
     {
         if ($columns != count($items)) {
             $this->skipped[] = $items;
             return false;
         }

         return true;
     }

    /**
     * Filter out duplicate rows based on Product Code
     * @param $data
     * @return bool
     */
     protected function checkProductCode($data)
     {
         $product_code = $data[self::PRODUCT_CODE_KEY];
         if (in_array($product_code, $this->storage)) {
             $this->skipped[] = $data;
             return false;
         } else {
             $this->storage[] = $product_code;
         }

         return true;
     }

    /**
     * Handle data output depending on launch mode (test or dev)
     * @param $em
     */
     public function saveOutput($em)
     {
         $this->strategy->output($em, $this->data, $this->skipped);
     }
}