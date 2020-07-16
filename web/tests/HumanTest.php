<?php
use PHPUnit\Framework\TestCase;
final class SakamotoTest extends TestCase{
    public function testA(){
        $obj = new Human();
        $this->assertSame("こんにちわ",$obj->helloString());
    }
    public function testB(){
        $obj = new Human();
        $this->assertSame("おーまいっが！",$obj->goodnightString());
    }
    public function testC(){
        $obj = new Human();
        $this->assertSame("おーまいっが！",$obj->goodnightString());
    }
    public function testD(){
        $obj = new Human();
        $this->assertSame("おーまいっが！",$obj->goodnightString());
    }
}