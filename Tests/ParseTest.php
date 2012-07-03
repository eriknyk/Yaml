<?php
use Alchemy\Component\Yaml\Yaml;

class ParseTest extends PHPUnit_Framework_TestCase
{

    protected $yaml;
    protected $yamlContent;

    protected function setUp() {
      $this->yaml = new Yaml();
      $this->yamlContent = $this->yaml->load(HOME_DIR.'Tests/Fixtures/sample.yaml');
    }

    public function testMergeHashKeys()
    {
      $Expected =  array (
        array ('step' => array('instrument' => 'Lasik 2000', 'pulseEnergy' => 5.4, 'pulseDuration' => 12, 'repetition' => 1000, 'spotSize' => '1mm')),
        array ('step' => array('instrument' => 'Lasik 2000', 'pulseEnergy' => 5.4, 'pulseDuration' => 12, 'repetition' => 1000, 'spotSize' => '2mm')),
      );
      $Actual = $this->yaml->load(HOME_DIR.'Tests/Fixtures/indent_1.yaml');
      $this->assertEquals ($Expected, $Actual['steps']);
    }

    public function testDeathMasks()
    {
      $Expected = array ('sad' => 2, 'magnificent' => 4);
      $Actual = $this->yaml->load(HOME_DIR.'Tests/Fixtures/indent_1.yaml');
      $this->assertEquals ($Expected, $Actual['death masks are']);
    }

    public function testDevDb()
    {
      $Expected = array ('adapter' => 'mysql', 'host' => 'localhost', 'database' => 'rails_dev');
      $Actual = $this->yaml->load(HOME_DIR.'Tests/Fixtures/indent_1.yaml');
      $this->assertEquals ($Expected, $Actual['development']);
    }

    public function testNumericKey()
    {
      $this->assertEquals ("Ooo, a numeric key!", $this->yamlContent[1040]);
    }

    public function testMappingsString()
    {
      $this->assertEquals ("Anyone's name, really.", $this->yamlContent['String']);
    }

    public function testMappingsInt()
    {
      $this->assertSame (13, $this->yamlContent['Int']);
    }

    public function testMappingsBooleanTrue()
    {
      $this->assertSame (true, $this->yamlContent['True']);
    }

    public function testMappingsBooleanFalse()
    {
      $this->assertSame (false, $this->yamlContent['False']);
    }

    public function testMappingsZero()
    {
      $this->assertSame (0, $this->yamlContent['Zero']);
    }

    public function testMappingsNull()
    {
      $this->assertSame (null, $this->yamlContent['Null']);
    }

    public function testMappingsNotNull()
    {
      $this->assertSame ('null', $this->yamlContent['NotNull']);
    }

    public function testMappingsFloat()
    {
      $this->assertSame (5.34, $this->yamlContent['Float']);
    }

    public function testMappingsNegative()
    {
      $this->assertSame (-90, $this->yamlContent['Negative']);
    }

    public function testMappingsSmallFloat()
    {
      $this->assertSame (0.7, $this->yamlContent['SmallFloat']);
    }

    public function testNewline()
    {
      $this->assertSame ("\n", $this->yamlContent['NewLine']);
    }

    public function testSeq0()
    {
      $this->assertEquals ("PHP Class", $this->yamlContent[0]);
    }

    public function testSeq1()
    {
      $this->assertEquals ("Basic YAML Loader", $this->yamlContent[1]);
    }

    public function testSeq2()
    {
      $this->assertEquals ("Very Basic YAML Dumper", $this->yamlContent[2]);
    }

    public function testSeq3()
    {
      $this->assertEquals (array("YAML is so easy to learn.",
                      "Your config files will never be the same."), $this->yamlContent[3]);
    }

    public function testSeqMap()
    {
      $this->assertEquals (array("cpu" => "1.5ghz", "ram" => "1 gig",
                      "os" => "os x 10.4.1"), $this->yamlContent[4]);
    }

    public function testMappedSequence()
    {
      $this->assertEquals (array("yaml.org", "php.net"), $this->yamlContent['domains']);
    }

    public function testAnotherSequence()
    {
      $this->assertEquals (array("program" => "Adium", "platform" => "OS X",
                      "type" => "Chat Client"), $this->yamlContent[5]);
    }

    public function testFoldedBlock()
    {
      $this->assertEquals ("There isn't any time for your tricks!\nDo you understand?", $this->yamlContent['no time']);
    }

    public function testLiteralAsMapped() {
      $this->assertEquals ("There is nothing but time\nfor your tricks.", $this->yamlContent['some time']);
    }

    public function testCrazy()
    {
      $this->assertEquals (array( array("name" => "spartan", "notes" =>
                                      array( "Needs to be backed up",
                                             "Needs to be normalized" ),
                                       "type" => "mysql" )), $this->yamlContent['databases']);
    }

    public function testColons()
    {
      $this->assertEquals ("like", $this->yamlContent["if: you'd"]);
    }

    public function testInline()
    {
      $this->assertEquals (array("One", "Two", "Three", "Four"), $this->yamlContent[6]);
    }

    public function testNestedInline()
    {
      $this->assertEquals (array("One", array("Two", "And", "Three"), "Four", "Five"), $this->yamlContent[7]);
    }

    public function testNestedNestedInline()
    {
      $this->assertEquals (array( "This", array("Is", "Getting", array("Ridiculous", "Guys")),
                  "Seriously", array("Show", "Mercy")), $this->yamlContent[8]);
    }

    public function testInlineMappings()
    {
      $this->assertEquals (array("name" => "chris", "age" => "young", "brand" => "lucky strike"), $this->yamlContent[9]);
    }

    public function testNestedInlineMappings()
    {
      $this->assertEquals (array("name" => "mark", "age" => "older than chris",
                       "brand" => array("marlboro", "lucky strike")), $this->yamlContent[10]);
    }

    public function testReferences() {
      $this->assertEquals (array('Perl', 'Python', 'PHP', 'Ruby'), $this->yamlContent['dynamic languages']);
    }

    public function testReferences2()
    {
      $this->assertEquals (array('C/C++', 'Java'), $this->yamlContent['compiled languages']);
    }

    public function testReferences3()
    {
      $this->assertEquals (array(
                                    array('Perl', 'Python', 'PHP', 'Ruby'),
                                    array('C/C++', 'Java')
                                   ), $this->yamlContent['all languages']);
    }

    public function testEscapedQuotes()
    {
      $this->assertEquals ("you know, this shouldn't work.  but it does.", $this->yamlContent[11]);
    }

    public function testEscapedQuotes_2()
    {
      $this->assertEquals ( "that's my value.", $this->yamlContent[12]);
    }

    public function testEscapedQuotes_3()
    {
      $this->assertEquals ("again, that's my value.", $this->yamlContent[13]);
    }

    public function testQuotes()
    {
      $this->assertEquals ("here's to \"quotes\", boss.", $this->yamlContent[14]);
    }

    public function testQuoteSequence()
    {
      $this->assertEquals ( array( 'name' => "Foo, Bar's", 'age' => 20), $this->yamlContent[15]);
    }

    public function testShortSequence()
    {
      $this->assertEquals (array( 0 => "a", 1 => array (0 => 1, 1 => 2), 2 => "b"), $this->yamlContent[16]);
    }

    public function testHash_1()
    {
      $this->assertEquals ("Hash", $this->yamlContent['hash_1']);
    }

    public function testHash_2()
    {
      $this->assertEquals ('Hash #and a comment', $this->yamlContent['hash_2']);
    }

    public function testHash_3()
    {
      $this->assertEquals ('Hash (#) can appear in key too', $this->yamlContent['hash#3']);
    }

    public function testEndloop()
    {
      $this->assertEquals ("Does this line in the end indeed make Spyc go to an infinite loop?", $this->yamlContent['endloop']);
    }

    public function testReallyLargeNumber()
    {
      $this->assertEquals ('115792089237316195423570985008687907853269984665640564039457584007913129639936', $this->yamlContent['a_really_large_number']);
    }

    public function testFloatWithZeros()
    {
      $this->assertSame ('1.0', $this->yamlContent['float_test']);
    }

    public function testFloatWithQuotes()
    {
      $this->assertSame ('1.0', $this->yamlContent['float_test_with_quotes']);
    }

    public function testFloatInverse()
    {
      $this->assertEquals ('001', $this->yamlContent['float_inverse_test']);
    }

    public function testIntArray()
    {
      $this->assertEquals (array (1, 2, 3), $this->yamlContent['int array']);
    }

    public function testArrayOnSeveralLines()
    {
      $this->assertEquals (array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19), $this->yamlContent['array on several lines']);
    }

    public function testmoreLessKey()
    {
      $this->assertEquals ('<value>', $this->yamlContent['morelesskey']);
    }

    public function testArrayOfZero()
    {
      $this->assertSame (array(0), $this->yamlContent['array_of_zero']);
    }

    public function testSophisticatedArrayOfZero()
    {
      $this->assertSame (array('rx' => array ('tx' => array (0))), $this->yamlContent['sophisticated_array_of_zero']);
    }

    public function testSwitches()
    {
      $this->assertEquals (array (array ('row' => 0, 'col' => 0, 'func' => array ('tx' => array(0, 1)))), $this->yamlContent['switches']);
    }

    public function testEmptySequence()
    {
      $this->assertSame (array(), $this->yamlContent['empty_sequence']);
    }

    public function testEmptyHash()
    {
      $this->assertSame (array(), $this->yamlContent['empty_hash']);
    }

    public function testEmptykey()
    {
      $this->assertSame (array('' => array ('key' => 'value')), $this->yamlContent['empty_key']);
    }

    public function testMultilines()
    {
      $this->assertSame (array(array('type' => 'SomeItem', 'values' => array ('blah', 'blah', 'blah', 'blah'), 'ints' => array(2, 54, 12, 2143))), $this->yamlContent['multiline_items']);
    }

    public function testManyNewlines()
    {
      $this->assertSame ('A quick
fox


jumped
over





a lazy



dog', $this->yamlContent['many_lines']);
    }

    public function testWerte()
    {
      $this->assertSame (array ('1' => 'nummer 1', '0' => 'Stunde 0'), $this->yamlContent['werte']);
    }

    /* public function testNoIndent() {
      $this->assertSame (array(
        array ('record1'=>'value1'),
        array ('record2'=>'value2')
      )
      , $this->yamlContent['noindent_records']);
    } */

    public function testColonsInKeys()
    {
      $this->assertSame (array (1000), $this->yamlContent['a:1']);
    }

    public function testColonsInKeys2()
    {
      $this->assertSame (array (2000), $this->yamlContent['a:2']);
    }

    public function testSpecialCharacters()
    {
      $this->assertSame ('[{]]{{]]', $this->yamlContent['special_characters']);
    }

    public function testAngleQuotes()
    {
      $Quotes = $this->yaml->load(HOME_DIR.'Tests/Fixtures/quotes.yaml');
      $this->assertEquals (array ('html_tags' => array ('<br>', '<p>'), 'html_content' => array ('<p>hello world</p>', 'hello<br>world'), 'text_content' => array ('hello world')),
          $Quotes);
    }

    public function testFailingColons()
    {
      $Failing = $this->yaml->load(HOME_DIR.'Tests/Fixtures/failing1.yaml');
      $this->assertSame (array ('MyObject' => array ('Prop1' => array ('key1:val1'))),
          $Failing);
    }
}