<?php
namespace Mine\Sweeper;

/**
 * 爆弾
 * Class Mine
 * @package Mine\Sweeper
 */
class Mine
{

    //爆弾個数
    private $piece ;

    //爆弾
    public $mine = [];

    //爆弾座標
    public function __construct( $x, $y, $piece )
    {
        $this->piece = $piece;
        $this->set( $x, $y );
    }

    public function set( $x, $y )
    {
        for($i = 1; $i < $this->piece; $i++){
            $this->mine[] = $this->make( $x, $y );
        }
    }

    public function make( $x, $y )
    {
        return [ rand( 0, $x ) => [ rand( 0, $y ) => MINE ] ];
    }

    public function is( $x, $y )
    {
        foreach( $this->mine as $mine ){
            if( isset( $mine[$x][$y] ) ) return true;
        }
        return false;
    }
}

