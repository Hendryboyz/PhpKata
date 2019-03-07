<?php
declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use Kata\Replacer\DictionaryReplacer;
use Kata\Strategy\ReplaceStrategy;
use Kata\Strategy\CharacterReplaceStrategy;

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

    public function testCanHanle()
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

    public function normalCaseData(): array
    {
        return array(
            array("\$greeting\$ world", array("greeting" => "hello"), "hello world"),
            array("\$greeting\$ greeting world", array("greeting" => "hello"), "hello greeting world")
        );
    }

    /**
     * @dataProvider normalCaseData
     */
    public function testGivenNormalInputAndDictionary_WhenHandle_ThenReturnResult($input, $dictionary, $expected)
    {
        $this->handleAndAssert($input, $dictionary, $expected);
    }

    public function testGivenInputAndDictionary_WhenHandle_ThenHandleByStrategy()
    {
        $fakeReplaceStrategy = $this->getMockBuilder(ReplaceStrategy::class)
                                    ->setMethods(['handle'])
                                    ->getMock();
        $fakeReplaceStrategy->method('handle')
                            ->willReturn("");
        $this->replacer = new DictionaryReplacer($fakeReplaceStrategy);
        $input = "";
        $dictionary = array();
        $fakeReplaceStrategy->expects($this->once())
                            ->method('handle')
                            ->with($this->equalTo($input), $this->equalTo($dictionary));


        $this->handleAndAssert($input, $dictionary, "");
    }

    /**
     * @dataProvider normalCaseData
     */
    public function testGivenNormalInputAndDictionary_WhenHandle_ThenCheckCharacterReplaceStrategyResult(
        $input, $dictionary, $expected)
    {
        $characterReplaceStrategy = new CharacterReplaceStrategy();
        $this->replacer = new DictionaryReplacer($characterReplaceStrategy);

        $this->handleAndAssert($input, $dictionary, $expected);
    }
}

?>