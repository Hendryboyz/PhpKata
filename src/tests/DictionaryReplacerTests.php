<?php
declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use Kata\Replacer\DictionaryReplacer;
use Kata\Strategy\ReplaceStrategy;
use Kata\Strategy\StrReplaceStrategy;
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

    public function testCanHandle(): void
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
            array("\$greeting\$ greeting world", array("greeting" => "hello"), "hello greeting world"),

        );
    }

    /**
     * @dataProvider normalCaseData
     */
    public function testGivenNormalInputAndDictionary_WhenHanle_ThenReturnResult($input, $dictionary, $expected)
    {
        $this->handleAndAssert($input, $dictionary, $expected);
    }

    public function testGivenEmptyInputAndDictionary_WhenHandle_ThenHandleByStrategy()
    {
        $fakeRepalceStrategy = $this->getMockBuilder(ReplaceStrategy::class)
                                    ->setMethods(["handle"])
                                    ->getMock();
        $fakeRepalceStrategy->method("handle")
                            ->willReturn("");
        $this->replacer = new DictionaryReplacer($fakeRepalceStrategy);

        $fakeRepalceStrategy->expects($this->once())
                            ->method("handle")
                            ->with($this->equalTo(""), $this->equalTo(array()));

        $input = "";
        $dictionary = array();

        $this->handleAndAssert($input, $dictionary, "");

    }

    /**
     * @dataProvider normalCaseData
     */
    public function testGivenNormalCaseInputAndDictionary_WhenHandle_ThenReturnStrReplaceStrategyResult($input, $dictionary, $expected)
    {
        $replaceStrategy = new StrReplaceStrategy();
        $this->replacer = new DictionaryReplacer($replaceStrategy);
        $this->handleAndAssert($input, $dictionary, $expected);
    }

    /**
     * @dataProvider normalCaseData
     */ 
    public function testGivenNormalCaseInputAndDictionary_WhenHandle_ThenReturnCharacterStrategyReuslt($input, $dictionary, $expected)
    {
        $replaceStrategy = new CharacterReplaceStrategy();
        $this->replacer = new DictionaryReplacer($replaceStrategy);
        $this->handleAndAssert($input, $dictionary, $expected);
    }
}
?>