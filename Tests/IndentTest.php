<?php
use Alchemy\Component\Yaml\Yaml;

class IndentTest extends PHPUnit_Framework_TestCase
{
    protected $yamlText;
    protected $yaml;

    protected function setUp()
    {
        $this->yaml = new Yaml();
        $this->yamlText = $this->yaml->load(HOME_DIR.'Tests/Fixtures/indent_1.yaml');
    }

    public function testIndent1()
    {
        $this->assertEquals(array('child_1' => 2, 'child_2' => 0, 'child_3' => 1), $this->yamlText['root']);
    }

    public function testIndent2()
    {
        $this->assertEquals(array('child_1' => 1, 'child_2' => 2), $this->yamlText['root2']);
    }

    public function testIndent3()
    {
        $this->assertEquals(
            array(array('resolutions' => array(1024 => 768, 1920 => 1200), 'producer' => 'Nec')),
            $this->yamlText['display']
        );
    }

    public function testIndent4()
    {
        $this->assertEquals(
            array(
                array('resolutions' => array(1024 => 768)),
                array('resolutions' => array(1920 => 1200)),
            ),
            $this->yamlText['displays']
        );
    }

    public function testIndent5()
    {
        $this->assertEquals(array(array(
            'row' => 0,
            'col' => 0,
            'headsets_affected' => array(
                array(
                  'ports' => array(0),
                  'side' => 'left',
                )
            ),
            'switch_function' => array(
              'ics_ptt' => true
            )
        )), $this->yamlText['nested_hashes_and_seqs']);
    }

    public function testIndent6()
    {
        $this->assertEquals(array(
            'h' => array(
                array('a' => 'b', 'a1' => 'b1'),
                array('c' => 'd')
            )
        ), $this->yamlText['easier_nest']);
    }

    public function testIndentSpace()
    {
        $this->assertEquals("By four\n  spaces", $this->yamlText['one_space']);
    }

    public function testListAndComment()
    {
        $this->assertEquals(array('one', 'two', 'three'), $this->yamlText['list_and_comment']);
    }
}

