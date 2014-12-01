<?php
namespace Mine\Sweeper;

/**
 * 入力チェック
 * エラーの場合はfalseを返す
 * Class Validation
 * @package Mine\Sweeper
 */
class Validation
{

    /*
    *  選択されたレベルが正しいか
    */
    public function validateLevel( $value )
    {
        if( (int)$value === BEGGINER || (int)$value === FAIR || (int)$value === EXPERT ) {
            return true;
        }
        return false;
    }

    /*
    *  数値が入力されているか
    */ 
    public function validateNumeric( $value )
    {
        return is_numeric( $value );
    }

    /*
    *  整数値が入力されているか
    */
    public function validateInt( $value )
    {
        return is_int( $value );
    }

    /*
    *   最大値
    */
    public function validateMax( $value, $option )
    {
        return ( $option >= $value );
    }

    /*
     *   最小値
     */
    public function validateMin( $value, $option )
    {
        return ( $value >= $option );
    }

}
