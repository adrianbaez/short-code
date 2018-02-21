<?php

namespace AdrianBaez\ShortCode\Tests;

use AdrianBaez\ShortCode\DecoderCollection;
use AdrianBaez\ShortCode\Tests\Decoders\DummyDecoder;
use AdrianBaez\ShortCode\Tests\Decoders\HtmlListDecoder;
use PHPUnit\Framework\TestCase;

class DecoderCollectionTest extends TestCase
{
    /**
     * Si no hay decoders, decode debe devolver el código
     */
    public function testDecodeEmpty()
    {
        $decoderCollection = new DecoderCollection;
        $this->assertEquals('I have a DummyCode.', $decoderCollection->decode('I have a DummyCode.'));
    }

    /**
     * Si hay decoders, debe decodificar
     */
    public function testDecode()
    {
        $decoderCollection = new DecoderCollection;
        $decoderCollection->add(new DummyDecoder);
        $decoderCollection->add(new HtmlListDecoder);
        // Simple DummyDecoder
        $this->assertEquals('I have a DummyCodeDecoded.', $decoderCollection->decode('I have a DummyCode.'));
        // Multiple DummyDecoder
        $this->assertEquals('I have a DummyCodeDecoded a dummycode and another DummyCodeDecoded.', $decoderCollection->decode('I have a DummyCode a dummycode and another DummyCode.'));
        // Simple HtmlListDecoder
        $expected = 'My list: <ul><li>item 1</li><li>item 2</li></ul> is decoded.';
        $this->assertEquals($expected, $decoderCollection->decode('My list: [html-list items=item 1,item 2] is decoded.'));

        // Multiple HtmlListDecoder
        $expected = 'Lists: <ul><li>item 1</li><li>item 2</li></ul> <ul><li>item 3</li><li>item 4</li></ul> decoded.';
        $this->assertEquals($expected, $decoderCollection->decode('Lists: [html-list items=item 1,item 2] [html-list items=item 3,item 4] decoded.'));

        // Multiple Mixed
        $expected = 'Lists: <ul><li>DummyCodeDecoded 1</li><li>DummyCodeDecoded 2</li></ul> <ul><li>DummyCodeDecoded 3</li><li>DummyCodeDecoded 4</li></ul> decoded.';
        $this->assertEquals($expected, $decoderCollection->decode('Lists: [html-list items=DummyCode 1,DummyCode 2] [html-list items=DummyCode 3,DummyCode 4] decoded.'));
    }
}
