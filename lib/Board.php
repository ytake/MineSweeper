<?php

class Board{
    //表示する横の長さ
    private $x;
    //表示する縦の長さ
    private $y;
    //爆弾
    private $mine;
    //マス
    private $box = array();
    //非表示個数
    private $no_open ;

    public function __construct( $x, $y, Mine $mine )
    {
        $this->x    = $x;
        $this->y    = $y;
        $this->mine = $mine;
        $this->make();
    }
    public function getNoOpen()
    {
        return $this->no_open;
    }
    public function make()
    {
        for($i=1; $i <= $this->y; $i++){
            for($j=1; $j <= $this->x; $j++){
                $this->box[$j][$i] = NORMAL;
            }
        }
    }
    public function show()
    {
        //非表示個数の初期化
        $this->no_open = 0;
        for($i=1; $i <= $this->y; $i++){
            for($j=1; $j <= $this->x; $j++){
                $this->disp( $this->box[$j][$i] );
            }
            echo PHP_EOL;
        }
    }
    public function disp( $disp )
    {
        switch($disp){
                case NORMAL:
                    echo "-";
                    $this->no_open++;
                break;
                case MINE:
                    echo "x";
                break;
                default:
                    echo $disp;
                break;
        }
    }
    public function open( $x, $y )
    {
        //範囲外は終了
        if( 1 > $x || $this->x < $x || 1 > $y || $this->y < $y ) return;
        //すでに開いているなら終了
        if($this->box[$x][$y] >= OPEN ) return;
        //爆弾だったら終了
        if( $this->mine->is( $x, $y)) return;
        //そのマスの周りの爆弾を調べる
        $this->box[$x][$y] = $this->around( $x, $y );
        //現在のboxが0だったら探索する
        if( $this->box[$x][$y] === OPEN ) $this->search( $x, $y);
    }
    //今のマスの周りの爆弾を調べる
    public function around( $x, $y )
    {
        $mine = OPEN;
        //上
        if( $this->mine->is( $x    , $y - 1 )) $mine++;
        //右上
        if( $this->mine->is( $x + 1, $y - 1 )) $mine++;
        //右
        if( $this->mine->is( $x + 1, $y     )) $mine++;
        //右下
        if( $this->mine->is( $x + 1, $y + 1 )) $mine++;
        //下
        if( $this->mine->is( $x    , $y + 1 )) $mine++;
        //左下
        if( $this->mine->is( $x - 1, $y + 1 )) $mine++;
        //左
        if( $this->mine->is( $x - 1, $y     )) $mine++;
        //左上
        if( $this->mine->is( $x - 1, $y - 1 )) $mine++;
        return $mine;
    }
    //探索 上,右,下,左
    public function search( $x, $y)
    {
        $this->up(    $x, $y );
        $this->right( $x, $y );
        $this->down(  $x, $y );
        $this->left(  $x, $y );
    }
    public function up( $x, $y )
    {
        return $this->open( $x , $y - 1  );
    }
    public function right($x, $y )
    {
        return $this->open( $x + 1 , $y );
    }
    public function down( $x, $y )
    {
        return $this->open( $x , $y + 1 );
    }
    public function left( $x, $y )
    {
        return $this->open( $x - 1 , $y );
    }
}

