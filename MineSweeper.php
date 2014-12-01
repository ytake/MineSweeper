<?php
require_once "vendor/autoload.php";

use \Mine\Sweeper;

/**
 * Class MineSweeper
 */
class MineSweeper
{

    /** @var \Mine\Sweeper\User $user ユーザーオブジェクト */
    private $user;

    /** @var \Mine\Sweeper\Mine $mine 爆弾 */
    private $mine;

    /** @var \Mine\Sweeper\Config  */
    protected $config;

    /**
     * @param \Mine\Sweeper\Config $config
     * @param \Mine\Sweeper\User $user
     */
    public function __construct(
        Sweeper\Config $config,
        Sweeper\User $user
    ) {
       $this->config = $config;
       $this->user = $user;
        //爆弾を作成
       $this->mine = new Sweeper\Mine(
            $this->config->side[ $this->user->get( 'level') ][ 'x' ],
            $this->config->side[ $this->user->get( 'level') ][ 'y' ],
            $this->config->mine[ $this->user->get( 'level') ]
        );
        //ゲーム板を作成
        $this->board = new Sweeper\Board(
            $this->config->side[ $this->user->get( 'level') ][ 'x' ],
            $this->config->side[ $this->user->get( 'level') ][ 'y' ],
            $this->mine
        );
    }

    /**
     *
     */
    public function start()
    {
        try {
            $this->board->show();
            $this->next();
        } catch(Sweeper\CongratulationsException $e ) {
            echo "Finish a Game";
            echo $e->getMessage();
        } catch(Sweeper\GameOverException $e ) {
            $this->board->show();
            echo "GAME OVER" . PHP_EOL;
            echo $e->getMessage() . PHP_EOL;
        } catch(Sweeper\InputException $e ) {
            echo $e->getMessage() . PHP_EOL;
            //戻る
            $this->start();
        } catch(\Exception $e ) {
            echo "予想外のエラーがありました。";
        }
    }

    /**
     * @throws Sweeper\CongratulationsException
     * @throws Sweeper\GameOverException
     * @throws Sweeper\InputException
     */
    public function next()
    {
        $in = $this->user->choose();
        if( $this->mine->is( $in[0], $in[1] )) {
            throw new Sweeper\GameOverException( '爆弾です' );
        }
        $this->board->open( $in[0], $in[1] );
        $this->board->show();
        if( $this->board->getNoOpen() === count( $this->mine->mine )) {
            throw new Sweeper\CongratulationsException( "おめでとうございます" );
        }
        echo "非表示個数:" . $this->board->getNoOpen() . PHP_EOL;
        echo "爆弾個数  :" . count($this->mine->mine)  . PHP_EOL;
        $this->next();
    }
}

$minesweeper = new MineSweeper(new Sweeper\Config, new Sweeper\User);
$minesweeper->start();
