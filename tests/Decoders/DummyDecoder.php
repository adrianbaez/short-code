<?php

namespace AdrianBaez\ShortCode\Tests\Decoders;

use AdrianBaez\ShortCode\Decoder\RegEx;

/**
 * Reemplaza las coincidencias de DummyCode por DummyCodeDecoded
 */
class DummyDecoder extends RegEx
{
    /**
     * Expresión regular de coincidencia
     * @var string
     */
    const REGEX = '/DummyCode/';

    /**
     * Devuelve una lista
     * @param array $match
     * @return string
     */
    public function replaceCallback(array $match) : string
    {
        return 'DummyCodeDecoded';
    }
}
