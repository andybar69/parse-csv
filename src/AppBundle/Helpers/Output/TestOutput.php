<?php

namespace AppBundle\Helpers\Output;

/**
 * Class TestOutput
 * @package AppBundle\Helpers\Output
 */
class TestOutput extends BaseOutput
{
    /**
     * Displays report data
     * @param $em
     * @param $data
     * @param $skipped
     */
    public function output($em, $data, $skipped)
    {
        $this->showProcessedData(count($data), $skipped);
    }
}