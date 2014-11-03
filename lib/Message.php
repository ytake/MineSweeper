<?php

/*
* メッセージリスト
*/
class Message{
    public $level = [
        'info' => '遊ぶレベルを選んでください' ,
        'list' => '初級:0,中級:1,上級:2'
    ];
    public $choose = [
        'x' => 'Choose Number (x)',
        'y' => 'Choose Number (y)',
    ];
    public $errors = [
        'gameover' => 'GAMEOVER',
        'bom'      => '爆弾です。',
        'level'    => '選択されたレベルが間違ってます'
    ];
}

