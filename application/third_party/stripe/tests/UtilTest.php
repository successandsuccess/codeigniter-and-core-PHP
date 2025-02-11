<?php

namespace Stripe;

class UtilTest extends TestCase
{
    public function testIsList()
    {
        $list = array(5, 'nstaoush', array());
        $this->assertTrue(Util\Util::isList($list));

        $notlist = array(5, 'nstaoush', array(), 'bar' => 'baz');
        $this->assertFalse(Util\Util::isList($notlist));
    }

    public function testThatPHPHasValueSemanticsForArrays()
    {
        $original = array('php-arrays' => 'value-semantics');
        $derived = $original;
        $derived['php-arrays'] = 'reference-semantics';

        $this->assertSame('value-semantics', $original['php-arrays']);
    }

    public function testConvertStripeObjectToArrayIncludesId()
    {
        $customer = self::createTestCustomer();
        $this->assertTrue(array_key_exists("id", $customer->__toArray(true)));
    }

    public function testUtf8()
    {
        // UTF-8 string
        $x = "\xc3\xa9";
        $this->assertSame(Util\Util::utf8($x), $x);

        // Latin-1 string
        $x = "\xe9";
        $this->assertSame(Util\Util::utf8($x), "\xc3\xa9");

        // Not a string
        $x = true;
        $this->assertSame(Util\Util::utf8($x), $x);
    }

    public function testUrlEncode()
    {
        $a = array(
            'my' => 'value',
            'that' => array('your' => 'example'),
            'bar' => 1,
            'baz' => null
        );

        $enc = Util\Util::urlEncode($a);
        $this->assertSame('my=value&that%5Byour%5D=example&bar=1', $enc);

        $a = array('that' => array('your' => 'example', 'foo' => null));
        $enc = Util\Util::urlEncode($a);
        $this->assertSame('that%5Byour%5D=example', $enc);

        $a = array('that' => 'example', 'foo' => array('bar', 'baz'));
        $enc = Util\Util::urlEncode($a);
        $this->assertSame('that=example&foo%5B%5D=bar&foo%5B%5D=baz', $enc);

        $a = array(
            'my' => 'value',
            'that' => array('your' => array('cheese', 'whiz', null)),
            'bar' => 1,
            'baz' => null
        );

        $enc = Util\Util::urlEncode($a);
        $expected = 'my=value&that%5Byour%5D%5B%5D=cheese'
              . '&that%5Byour%5D%5B%5D=whiz&bar=1';
        $this->assertSame($expected, $enc);

        // Ignores an empty array
        $enc = Util\Util::urlEncode(array('foo' => array(), 'bar' => 'baz'));
        $expected = 'bar=baz';
        $this->assertSame($expected, $enc);

        $a = array('foo' => array(array('bar' => 'baz'), array('bar' => 'bin')));
        $enc = Util\Util::urlEncode($a);
        $this->assertSame('foo%5B0%5D%5Bbar%5D=baz&foo%5B1%5D%5Bbar%5D=bin', $enc);
    }
}
