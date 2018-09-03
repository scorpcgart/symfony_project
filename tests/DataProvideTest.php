<?php

class Discounter
{
    public function getDicount(int $order, int $sum)
    {
        return $sum / $order;
    }
}

class DataProvideTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider orderAndSumDataProvider
     */
    public function testShould($order, $sum, $expected)
    {
        $discounter = new Discounter();
        $discount = $discounter->getDicount($order, $sum);

        $this->assertEquals($expected,$discount);


    }

    public function orderAndSumDataProvider()
    {
        return [
            [20,200,10],
            [30,330,11],
            [11,110,10]
        ];
    }
}
