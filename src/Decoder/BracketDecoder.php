<?php

namespace AdrianBaez\ShortCode\Decoder;

use AdrianBaez\ShortCode\Interfaces\BracketDecoderTagInterface;

/**
 * BracketDecoder
 */
class BracketDecoder extends RegEx
{
    /**
     * @var callable[] $callbacks
     */
    protected $callbacks = [];

    /**
     * @inheritDoc
     */
    public function getRegEx(): string
    {
        return sprintf('/\[((?:%s))([\s\S]*)]/U', implode('|', $this->getAvailableTags()));
    }

    /**
     * @inheritDoc
     */
    public function supports(string $encoded): bool
    {
        return count($this->getAvailableTags()) > 0 && parent::supports($encoded);
    }

    /**
     * @param string   $tag
     * @param callable $callback
     * @return static
     */
    public function addTag(string $tag, callable $callback)
    {
        $this->callbacks[$tag] = $callback;
        return $this;
    }

    /**
     * @param BracketDecoderTagInterface $tagDecoder
     * @return static
     */
    public function addTagDecoder(BracketDecoderTagInterface $tagDecoder)
    {
        $this->addTag($tagDecoder->getTag(), [$tagDecoder, 'decode']);
        return $this;
    }

    /**
     * @return string[]
     */
    public function getAvailableTags()
    {
        return array_keys($this->callbacks);
    }

    /**
     * @inheritDoc
     */
    public function replaceCallback(array $match): string
    {
        if (!isset($this->callbacks[$match[1]])) {
            return $match[0];
        }
        return $this->callbacks[$match[1]]($this->getAttributes($match[2]));
    }

    /**
     * Obtiene los atributos que se pasaran al callbacks
     * @param  string $string
     * @return array
     */
    public function getAttributes(string $string)
    {
        $re = '/(\S+)=["\']?((?:.(?!["\']?\s+(?:\S+)=|[>"\']))+.)["\']?/';
        $out = [];
        if (preg_match_all($re, $string, $matches, PREG_SET_ORDER, 0)) {
            foreach ($matches as $match) {
                $out[$match[1]] = $match[2];
            }
        }
        return $out;
    }
}
