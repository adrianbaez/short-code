<?php

namespace AdrianBaez\ShortCode\Interfaces;

/**
 * Interfaz para los decodificadores
 */
interface DecoderInterface
{
    /**
     * Indica si soporta el código
     * @param string $encoded
     * @return bool
     */
    public function supports(string $encoded) : bool;

    /**
     * Decodifica un código
     * @param string $encoded
     * @return string
     */
    public function decode(string $encoded) : string;
}
