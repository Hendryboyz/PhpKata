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

    public function testCanHandle(): void
    {
        $input = "";
        $dictionary = array();
        $result = $this->replacer->handle($input, $dictionary);
        $this->assertEquals("", $result);   
    }

    /**
     * @dataProvider normalCaseData
     */
    public function testGivenInputAndDictionary_WhenHandle_ThenReturnReplacedResult(
        $input, $dictionary, $expected)
    {
        $result = $this->replacer->handle($input, $dictionary);
        $this->assertEquals($expected, $result);   
    }

    public function normalCaseData()
    {
        return array(
            0 => array("\$greeting\$ world", array("greeting" => "hello"), "hello world"),
            1 => array("\$greeting\$ \$target\$", array(
                "greeting" => "hello",
                "target" => "henry"
            ), "hello henry"),
            2 => array("\$greeting\$ greeting world", array(
                "greeting" => "hello"
            ), "hello greeting world")
        );
    }
}

?>