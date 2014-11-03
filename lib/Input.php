<?php
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

