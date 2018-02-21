<?php

namespace AdrianBaez\ShortCode\Interfaces;

/**
 * Interfaz para añadir tags a BracketDecorer
 */
interface BracketDecoderTagInterface
{
    /**
     * @return string
     */
    public function getTag() : string;

    /**
     * @param array $attributes
     * @return string
     */
    public function decode(array $attributes) : string;
}
