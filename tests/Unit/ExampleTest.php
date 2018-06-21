<?php
namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $this->assertTrue(true);
    }

    public function testT()
    {
        $arr = [2, 3, 1, 5];
        $check = [];
        $getArrkey = array_keys($arr);
        dd($getArrkey);
        $check = array_diff($arr, $getArrkey);
        dd($check);
        //array_values($check)[0];
    }
}
