<?php

class User {
    //インプットオブジェクト
    private $input;
    //レベル
    private $level;
    //入力チェック
    private $validation;
    public function __construct()
    {
        $this->input      = new Input;
        $this->message    = new Message;
        $this->config     = new Config;
        $this->validation = new Validation;
        #レベルを決めてもらう
        $this->input->message( $this->message->level['info'] );
        $this->input->message( $this->message->level['list'] );
        try{
            $this->level = $this->input->scan();
            if(! $this->validation->validateLevel( $this->level ) ) throw new Exception( $this->message->errors['level'] );
        }catch( Exception $e ){
            echo $e->getMessage();
            exit;
        }
    }
    public function get( $accseser )
    {
        return $this->$accseser;
    }
    public function choose()
    {
        $this->input->message( $this->message->choose['x'] );
        $x = $this->input->scan();
        if(! $this->validation->validateNumeric( $x ) ||
           ! $this->validation->validateMin( $x, 1 )  ||
           ! $this->validation->validateMax( $x, $this->config->side[ $this->level ]['x'] ))
            throw new InputException( 'xの入力値が間違ってます' );
        $this->input->message( $this->message->choose['y'] );
        $y = $this->input->scan();
        if(! $this->validation->validateNumeric( $y ) ||
           ! $this->validation->validateMin( $y, 1 )  ||
           ! $this->validation->validateMax( $y, $this->config->side[ $this->level ]['y'] ))
            throw new InputException( 'yの入力値が間違ってます' );
 
        return [ $x, $y ];
    }
}

