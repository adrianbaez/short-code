<?php

namespace AdrianBaez\ShortCode\Tests\Decoders;

use AdrianBaez\ShortCode\Decoder\RegEx;

/**
 * Reemplaza las coincidencias del código por una lista html
 */
class HtmlListDecoder extends RegEx
{
    /**
     * Expresión regular de coincidencia
     * @var string
     */
    const REGEX = '/\[html-list items=(.*)\]/U';

    /**
     * Devuelve una lista
     * @param array $match
     * @return string
     */
    public function replaceCallback(array $match) : string
    {
        $items = explode(',', $match[1]);
        return sprintf('<ul><li>%s</li></ul>', implode('</li><li>', $items));
    }
}
