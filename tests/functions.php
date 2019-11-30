<?php

require_once ('../functions.php');
use PHPUnit\Framework\TestCase;

class StackTest extends TestCase
{
    public function testSuccessDisplayShoppingList()
    {
        $expected = '<div>
                    <ul>value</ul>
                    </div>';
        $input = [['name' => 'value']];
        $case = displayShoppingList($input);
        $this->assertEquals($expected, $case);
    }

    public function testFailureDisplayShoppingList()
    {
        $expected = 'Incorrect SQL data; please contact administrator';
        $input = [['Lemons']];
        $case = displayShoppingList($input);
        $this->assertEquals($expected, $case);
    }

    public function testMalformedDisplayShoppingList() {
        $input = 'Lemons';
        $this->expectException(TypeError::class);
        displayShoppingList($input);
    }

    public function testSuccessSanitiseInput() {
        $expected = ['name'=>'Bananas'];
        $input = ['name'=>'Bananas'];
        $case = SanitiseInput($input);
        $this->assertEquals($expected, $case);
    }

    public function testFailureSanitiseInput()
    {
        $expected = 'Incorrect SQL data; please contact administrator';
        $input = [['Lemons']];
        $case = displayShoppingList($input);
        $this->assertEquals($expected, $case);
    }

    public function testMalformedSanitiseInput() {
        $input = 'Lemons';
        $this->expectException(TypeError::class);
        displayShoppingList($input);
    }

    public function testSuccessCheckValidInput() {
        $expected = ($valid = true);
        $input = ['name'=>'Bananas'];
        $case = checkValidInput($input);
        $this->assertEquals($expected, $case);
    }

    public function testFailureCheckValidInput()
    {
        $expected = 'Incorrect SQL data; please contact administrator';
        $input = [['Lemons']];
        $case = displayShoppingList($input);
        $this->assertEquals($expected, $case);
    }

    public function testMalformedCheckValidInput() {
        $input = 'Lemons';
        $this->expectException(TypeError::class);
        displayShoppingList($input);
    }

}