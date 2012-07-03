<?php
use Alchemy\Component\Yaml\Yaml;

function roundTrip($a) {
  $yaml = new Yaml();
  return $yaml->loadString($yaml->dump(array('x' => $a)));
}


class RoundTripTest extends PHPUnit_Framework_TestCase
{
    private $yaml;

    protected function setUp()
    {
        $this->yaml = new Yaml();
    }

    public function testNull()
    {
      $this->assertEquals (array ('x' => null), roundTrip (null));
    }

    public function testY()
    {
      $this->assertEquals (array ('x' => 'y'), roundTrip ('y'));
    }

    public function testExclam()
    {
      $this->assertEquals (array ('x' => '!yeah'), roundTrip ('!yeah'));
    }

    public function test5()
    {
      $this->assertEquals (array ('x' => '5'), roundTrip ('5'));
    }

    public function testSpaces()
    {
      $this->assertEquals (array ('x' => 'x '), roundTrip ('x '));
    }

    public function testApostrophes()
    {
      $this->assertEquals (array ('x' => "'biz'"), roundTrip ("'biz'"));
    }

    public function testNewLines()
    {
      $this->assertEquals (array ('x' => "\n"), roundTrip ("\n"));
    }

    public function testHashes()
    {
      $this->assertEquals (array ('x' => array ("#color" => '#fff')), roundTrip (array ("#color" => '#fff')));
    }

    public function testWordWrap()
    {
      $this->assertEquals (array ('x' => "aaaaaaaaaaaaaaaaaaaaaaaaaaaa  bbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb"), roundTrip ("aaaaaaaaaaaaaaaaaaaaaaaaaaaa  bbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb"));
    }

    public function testABCD()
    {
      $this->assertEquals (array ('a', 'b', 'c', 'd'), $this->yaml->loadString($this->yaml->dump(array('a', 'b', 'c', 'd'))));
    }

    public function testABCD2()
    {
        $a = array('a', 'b', 'c', 'd'); // Create a simple list
        $b = $this->yaml->dump($a);        // Dump the list as YAML
        $c = $this->yaml->loadString($b);        // Load the dumped YAML
        $d = $this->yaml->dump($c);        // Re-dump the data

        $this->assertSame($b, $d);
    }
}