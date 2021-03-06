<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use WowApi\ParameterBag;

class ParameterBagTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $this->testAll();
    }

    /**
     * @covers WowApi\ParameterBag::all
     */
    public function testAll()
    {
        $bag = new ParameterBag(array('foo' => 'bar'));
        $this->assertEquals(array('foo' => 'bar'), $bag->all(), '->all() gets all the input');
    }

    /**
     * @covers WowApi\ParameterBag::replace
     */
    public function testReplace()
    {
        $bag = new ParameterBag(array('foo' => 'bar'));

        $bag->replace(array('FOO' => 'BAR'));
        $this->assertEquals(array('FOO' => 'BAR'), $bag->all(), '->replace() replaces the input with the argument');
        $this->assertFalse($bag->has('foo'), '->replace() overrides previously set the input');
    }

    /**
     * @covers WowApi\ParameterBag::get
     */
    public function testGet()
    {
        $bag = new ParameterBag(array('foo' => 'bar', 'null' => null));

        $this->assertEquals('bar', $bag->get('foo'), '->get() gets the value of a parameter');
        $this->assertEquals('default', $bag->get('unknown', 'default'), '->get() returns second argument as default if a parameter is not defined');
        $this->assertNull($bag->get('null', 'default'), '->get() returns null if null is set');
    }

    public function testGetDoesNotUseDeepByDefault()
    {
        $bag = new ParameterBag(array('foo' => array('bar' => 'moo')));

        $this->assertNull($bag->get('foo[bar]'));
    }

    /**
     * @dataProvider getInvalidPaths
     * @expectedException \InvalidArgumentException
     */
    public function testGetDeepWithInvalidPaths($path)
    {
        $bag = new ParameterBag(array('foo' => array('bar' => 'moo')));

        $bag->get($path, null, true);
    }

    public function getInvalidPaths()
    {
        return array(
            array('foo[['),
            array('foo[d'),
            array('foo[bar]]'),
            array('foo[bar]d'),
        );
    }

    public function testGetDeep()
    {
        $bag = new ParameterBag(array('foo' => array('bar' => array('moo' => 'boo'))));

        $this->assertEquals(array('moo' => 'boo'), $bag->get('foo[bar]', null, true));
        $this->assertEquals('boo', $bag->get('foo[bar][moo]', null, true));
        $this->assertEquals('default', $bag->get('foo[bar][foo]', 'default', true));
        $this->assertEquals('default', $bag->get('bar[moo][foo]', 'default', true));
    }

    /**
     * @covers WowApi\ParameterBag::set
     */
    public function testSet()
    {
        $bag = new ParameterBag(array());

        $bag->set('foo', 'bar');
        $this->assertEquals('bar', $bag->get('foo'), '->set() sets the value of parameter');

        $bag->set('foo', 'baz');
        $this->assertEquals('baz', $bag->get('foo'), '->set() overrides previously set parameter');
    }

    /**
     * @covers WowApi\ParameterBag::has
     */
    public function testHas()
    {
        $bag = new ParameterBag(array('foo' => 'bar'));

        $this->assertTrue($bag->has('foo'), '->has() returns true if a parameter is defined');
        $this->assertFalse($bag->has('unknown'), '->has() return false if a parameter is not defined');
    }

    /**
     * @covers WowApi\ParameterBag::getAlpha
     */
    public function testGetAlpha()
    {
        $bag = new ParameterBag(array('word' => 'foo_BAR_012'));

        $this->assertEquals('fooBAR', $bag->getAlpha('word'), '->getAlpha() gets only alphabetic characters');
        $this->assertEquals('', $bag->getAlpha('unknown'), '->getAlpha() returns empty string if a parameter is not defined');
    }

    /**
     * @covers WowApi\ParameterBag::getAlnum
     */
    public function testGetAlnum()
    {
        $bag = new ParameterBag(array('word' => 'foo_BAR_012'));

        $this->assertEquals('fooBAR012', $bag->getAlnum('word'), '->getAlnum() gets only alphanumeric characters');
        $this->assertEquals('', $bag->getAlnum('unknown'), '->getAlnum() returns empty string if a parameter is not defined');
    }

    /**
     * @covers WowApi\ParameterBag::getDigits
     */
    public function testGetDigits()
    {
        $bag = new ParameterBag(array('word' => 'foo_BAR_012'));

        $this->assertEquals('012', $bag->getDigits('word'), '->getDigits() gets only digits as string');
        $this->assertEquals('', $bag->getDigits('unknown'), '->getDigits() returns empty string if a parameter is not defined');
    }

    /**
     * @covers WowApi\ParameterBag::getInt
     */
    public function testGetInt()
    {
        $bag = new ParameterBag(array('digits' => '0123'));

        $this->assertEquals(123, $bag->getInt('digits'), '->getInt() gets a value of parameter as integer');
        $this->assertEquals(0, $bag->getInt('unknown'), '->getInt() returns zero if a parameter is not defined');
    }
}
