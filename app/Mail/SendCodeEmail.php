<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendCodeEmail extends Mailable
{
    use Queueable, SerializesModels;
    // 定义成员变量
    public $code;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($code)
    {
        // 接受初始值 并赋值给成员变量
        $this->code = $code;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->subject('注册全国最大珠宝商城验证码')->view('index.sendcode',['code'=>$this->code]);
    }
}
