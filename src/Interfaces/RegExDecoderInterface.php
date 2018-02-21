<?php

namespace AdrianBaez\ShortCode\Interfaces;

/**
 * Interfaz para los decodificadores
 */
interface RegExDecoderInterface extends DecoderInterface
{
    /**
     * Obtiene la expresión regular de coincidencia
     * @return string
     */
    public function getRegEx() : string;

    /**
     * Callback llamada para cada coincidencia
     * @param array $match
     * @return string
     */
    public function replaceCallback(array $match) : string;
}
