<?php

require_once ('../functions.php');
use PHPUnit\Framework\TestCase;

class StackTest extends TestCase
{
    public function testSuccessDisplayShoppingList() {
        $expected = '<div>
                    <ul>name</ul>
                    </div>';
        $input = [['name'=>'value']];
        $case = displayShoppingList($input);
        $this->assertEquals($expected, $case);
    }
}