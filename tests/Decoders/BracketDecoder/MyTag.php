<?php

namespace AdrianBaez\ShortCode\Tests\Decoders\BracketDecoder;

use AdrianBaez\ShortCode\Interfaces\BracketDecoderTagInterface;

class MyTag implements BracketDecoderTagInterface
{
    /**
     * @var string $externalProperty
     */
    protected $externalProperty = 'External property';
    /**
     * @inheritDoc
     */
    public function getTag(): string
    {
        return 'my-tag';
    }

    /**
     * @inheritDoc
     */
    public function decode(array $attributes): string
    {
        $ids = $attributes['ids'] ?? '';
        $ids = explode(',', $ids);
        $text = $attributes['text'] ?? '';
        return sprintf('My tag contains "%s" as ids, "%s" as text and a "%s"', implode('-', $ids), $text, $this->externalProperty);
    }
}
