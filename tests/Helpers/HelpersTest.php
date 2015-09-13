<?php
namespace App\Tests\Controllers;

use App\Tests\TestCase;

class HelpersTest extends TestCase {

	public function testAlwaysArray()
	{
        $item = 'foo';
        $array = always_array($item);

        $this->assertTrue(is_array($array));
        $this->assertArrayHasKey(0, $array);
        $this->assertArrayNotHasKey(1, $array);

        $item = ['foo'];
        $array = always_array($item);

        $this->assertArrayHasKey(0, $array);
        $this->assertArrayNotHasKey(1, $array);
    }

}
