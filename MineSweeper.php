<?php

include_once "./lib/Mine.php";
include_once "./lib/Config.php";
include_once "./lib/Message.php";
include_once "./lib/Define.php";
include_once "./lib/Input.php";
include_once "./lib/Board.php";
include_once "./lib/User.php";
include_once "./lib/Validate.php";
include_once "./lib/GameOverException.php";
include_once "./lib/InputException.php";
include_once "./lib/CongratulationsException.php";

class MineSweeper{

    //ユーザーオブジェクト
    private $user;
    //爆弾
    private $mine;
    public function __construct()
    {
       $this->config  = new Config;
       $this->user    = new User();
        //爆弾を作成
       $this->mine = new Mine( 
            $this->config->side[ $this->user->get( 'level') ][ 'x' ],
            $this->config->side[ $this->user->get( 'level') ][ 'y' ],
            $this->config->mine[ $this->user->get( 'level') ]
        );
        //ゲーム板を作成
        $this->board = new Board(
            $this->config->side[ $this->user->get( 'level') ][ 'x' ],
            $this->config->side[ $this->user->get( 'level') ][ 'y' ],
            $this->mine
        );
    }
    public function start()
    {
        try{
            $this->board->show();
            $this->next();
        }catch( CongratulationsException $e ){
            echo "Finish a Game";
            echo $e->getMessage();
        }catch( GameOverException $e ){
            $this->board->show();
            echo "GAME OVER" . PHP_EOL;
            echo $e->getMessage() . PHP_EOL;
        }catch( InputException $e ){
            echo $e->getMessage() . PHP_EOL;
            //戻る
            $this->start();
        }catch( Exception $e ){
            echo "予想外のエラーがありました。";
        }
    }
    public function next()
    {
        $in = $this->user->choose();
        if( $this->mine->is( $in[0], $in[1] )) throw new GameOverException( '爆弾です' );
        $this->board->open( $in[0], $in[1] );
        $this->board->show();
        if( $this->board->getNoOpen() === count( $this->mine->mine )) throw new CongratulationsException( "おめでとうございます" );
        echo "非表示個数:" . $this->board->getNoOpen() . PHP_EOL;
        echo "爆弾個数  :" . count($this->mine->mine)  . PHP_EOL;
        $this->next();
    }
}

$minesweeper = new MineSweeper;
$minesweeper->start();
