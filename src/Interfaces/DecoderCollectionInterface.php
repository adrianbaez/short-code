<?php

namespace AdrianBaez\ShortCode\Interfaces;

/**
 * Interfaz de una colección de decodificadores
 */
interface DecoderCollectionInterface
{
    /**
     * Indica si soporta el código
     * @param DecoderInterface $decoder
     * @return DecoderCollectionInterface
     */
    public function add(DecoderInterface $decoder) : DecoderCollectionInterface;

    /**
     * Decodifica un texto codificado
     * En caso de que en la colección de decodificadores ninguno soporte
     * debería devolver el texto original
     * @param string $encoded
     * @return string
     */
    public function decode(string $encoded) : string;
}
