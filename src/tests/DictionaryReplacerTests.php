<?php
declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use Kata\Replacer\DictionaryReplacer;

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
        $result = $this->replacer->handle("", array());
        $this->assertEquals("", $result);
    }

    /**
     * @dataProvider normalCaseProvider
     */
    public function testGivenInputAndDictionary_WhenHandle_ThenReturnReplacedResult($input, $dictionary, $expected)
    {
        $result = $this->replacer->handle($input, $dictionary);
        $this->assertEquals($expected, $result);
    }

    public function normalCaseProvider()
    {
        return [
            ["\$greeting\$ world", array("greeting" => "hello"), "hello world"]
        ];
    }
}

?>