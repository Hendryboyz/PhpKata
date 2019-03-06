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

    public function testCanHandle(): void
    {
        $input = "";
        $dictionary = array();
        $this->handleAndAssert($input, $dictionary, "");
    }

    private function handleAndAssert($input, $dictionary, $expected): void
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

    public function normalCaseData(): array
    {
        return array(
            array("\$greeting\$ world", array("greeting" => "hello"), "hello world"),
            array("\$greeting\$ greeting world", array("greeting" => "hello"), "hello greeting world"),
        );
    }

    public function testEmptyValue_WhenHandle_ThenHandleByStrategy()
    {
        // arrange
        $input = "";
        $dictionary = array();
        $fakeReplaceStrategy = $this->getMockBuilder(ReplaceStrategy::class)
                                    ->setMethods(['handle'])
                                    ->getMock();
        $fakeReplaceStrategy->method('handle')
                            ->willReturn("");
        $this->replacer = new DictionaryReplacer($fakeReplaceStrategy);

        // assert
        $fakeReplaceStrategy->expects($this->once())
                            ->method('handle')
                            ->with($this->equalTo($input), $this->equalTo($dictionary));

        // action
        $this->handleAndAssert($input, $dictionary, "");
    }
}

?>