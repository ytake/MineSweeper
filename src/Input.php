<?php
namespace Mine\Sweeper;

/**
 * Class Input
 * @package Mine\Sweeper
 */
class Input
{

    public function message( $message )
    {
        echo $message . PHP_EOL;
    }

    public function scan()
    {
        fscanf(STDIN, "%s", $in);
        return $in;
    }
}

