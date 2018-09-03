<?php

class FirstTest extends \PHPUnit\Framework\TestCase
{
    public function getData()
    {
        return array(
            'key1' => 'value1',
            'key2' => 'value2',
            'key3' => 'value3'
        );
    }


    public function testShould_ArrayHasKey()
    {
        $array = $this->getData();


        $this->assertArrayHasKey('key1', $array);
    }

    public function testShould_CountElements()
    {
        $array = $this->getData();

        $this->assertCount(3, $array);
    }

}