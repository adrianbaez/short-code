<?php

namespace AdrianBaez\ShortCode;

use AdrianBaez\ShortCode\Interfaces\DecoderCollectionInterface;
use AdrianBaez\ShortCode\Interfaces\DecoderInterface;

/**
 * Implementación básica de DecoderCollectionInterface
 */
class DecoderCollection implements DecoderCollectionInterface
{
    /**
     * @var DecoderInterface[] $decoders
     */
    private $decoders = [];

    /**
     * @inheritDoc
     */
    public function add(DecoderInterface $decoder): DecoderCollectionInterface
    {
        $this->decoders[] = $decoder;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function decode(string $encoded): string
    {
        foreach ($this->decoders as $decoder) {
            if ($decoder->supports($encoded)){
                $encoded = $decoder->decode($encoded);
            }
        }
        return $encoded;
    }
}
