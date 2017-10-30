<?php

namespace AppBundle\Helpers\Output;
use AppBundle\Helpers\DataHandler;

/**
 * Class BaseOutput
 * @package AppBundle\Helpers\Output
 */
class BaseOutput
{
    /**
     * Reports processing result
     * @param $dataAmount
     * @param $skipped
     */
    protected function showProcessedData($dataAmount, $skipped)
    {
        $skippedAmount = count($skipped);
        echo "Total items processed: " . ($dataAmount + $skippedAmount) . PHP_EOL;
        echo "Successfully: {$dataAmount}" . PHP_EOL;
        echo "Failed to process: {$skippedAmount}" . PHP_EOL;
        echo $this->listSkippedRows($skipped);
    }

    /**
     * Displays invalid rows
     * @param $arRows
     * @return string
     */
    protected function listSkippedRows($arRows)
    {
        $text = PHP_EOL . '';
        foreach ($arRows as $row) {
            $text .= implode(DataHandler::CSV_DELIMITER, $row).PHP_EOL;
        }

        return $text;
    }
}