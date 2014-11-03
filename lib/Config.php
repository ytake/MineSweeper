<?php
class Config{
    //最大x,y座標 
    public $side = [
        BEGGINER => [ 'x' => 9, 'y' => 9 ],
        FAIR     => [ 'x' =>16 ,'y' =>16 ],
        EXPERT   => [ 'x' =>30 ,'y' =>16 ]
    ];
    //最大爆弾数
    public $mine = [ BEGGINER => 10, FAIR => 16, EXPERT => 99];
}

