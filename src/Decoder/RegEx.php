<?php

namespace AdrianBaez\ShortCode\Decoder;

use AdrianBaez\ShortCode\Interfaces\RegExDecoderInterface;

/**
 * Reemplaza las coincidencias mediante una expresión regular y un método replaceCallback
 */
abstract class RegEx implements RegExDecoderInterface
{

    /**
     * @var string REGEX
     */
    const REGEX = '';

    /**
     * @inheritDoc
     */
    public function getRegEx(): string
    {
        return static::REGEX;
    }

    /**
     * @inheritDoc
     */
    abstract public function replaceCallback(array $match): string;

    /**
     * @inheritDoc
     */
    public function supports(string $encoded): bool
    {
        return preg_match($this->getRegEx(), $encoded) > 0;
    }

    /**
     * @inheritDoc
     */
    public function decode(string $encoded): string
    {
        return preg_replace_callback($this->getRegEx(), [$this, 'replaceCallback'], $encoded);
    }
}
