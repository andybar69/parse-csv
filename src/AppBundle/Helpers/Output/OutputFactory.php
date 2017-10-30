<?php

namespace AppBundle\Helpers\Output;

/**
 * Class OutputFactory
 * Creates appropriate output instance
 * @package AppBundle\Helpers\Output
 */
class OutputFactory
{
    /**
     * Creates instance based on launched mode param
     * @param $mode
     * @return SaveOutput|TestOutput
     */
    public static function create($mode)
    {
        if ($mode == 'test') {
            return new TestOutput();
        }
        else {
            return new SaveOutput();
        }
    }
}