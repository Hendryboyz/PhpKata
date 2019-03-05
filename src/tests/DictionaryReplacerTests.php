<?php
declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use Kata\Replacer\DictionaryReplacer;
use Kata\Strategy\ReplaceStrategy;

final class DictionaryReplacerTests extends TestCase
{
    private $replacer;

    public function testCanCreate(): void
    {
        $this->replacer = new DictionaryReplacer();
        $this->assertNotNull($this->replacer);
    }

    public function setUp(): void
    {
        $this->testCanCreate();
    }

    public function testCanHandle()
    {
        $input = "";
        $dictionary = array();
        $this->handleAndAssert($input, $dictionary, "");
    }

    private function handleAndAssert($input, $dictionary, $expected)
    {
        $result = $this->replacer->handle($input, $dictionary);
        $this->assertEquals($expected, $result);
    }

    /**
     * @dataProvider normalCaseData
     */
    public function testGivenInputAndDictionary_WhenHandle_ThenReturnResult($input, $dictionary, $expected)
    {
        $this->handleAndAssert($input, $dictionary, $expected);
    }

    public function normalCaseData()
    {
        return [
            ["\$greeting\$ world", array("greeting" => "hello"), "hello world"],
            ["\$greeting\$ greeting world", array("greeting" => "hello"), "hello greeting world"],
        ];
    }

    public function whenGivenInputAndDictionary_WhenHandle_ThenHandleByStrategy()
    {
        $input = "";
        $dictionary = array();
        $fakeConvertStrategy = $this->getMockBuilder(ReplaceStrategy::class)
                                ->setMethods(['handle'])
                                ->getMock();
        $fakeConvertStrategy->method('handle')
                            ->willReturn("");

        $this->replacer = new DictionaryReplacer($fakeConvertStrategy);
        $this->replacer->handle($input, $dictionary);

        $fakeConvertStrategy->expects($this->once())
                            ->method('handle')
                            ->with($this->equalTo($input), $this->equalTo($dictionary));
    }
}

?>