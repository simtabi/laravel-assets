<?php

namespace Simtabi\Assets;

use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Support\HtmlString;
use function Simtabi\Assets\e;

class HtmlBuilder
{
    /**
     * The URL generator instance.
     *
     * @var UrlGenerator
     */
    protected $url;

    /**
     * HtmlBuilder constructor.
     * @param UrlGenerator $urlGenerator
     */
    public function __construct(UrlGenerator $urlGenerator)
    {
        $this->url = $urlGenerator;
    }

    /**
     * Generate a link to a JavaScript file.
     *
     * @param string $url
     * @param array $attributes
     * @param null|bool $secure
     *
     * @return HtmlString|string
     */
    public function script(string $url, array $attributes = [], null|bool $secure = null): string
    {
        if (!$url) {
            return '';
        }

        $attributes['src'] = $this->url->asset($url, $secure);

        return $this->toHtmlString('<script' . $this->attributes($attributes) . '></script>');
    }

    /**
     * Generate a link to a CSS file.
     *
     * @param string $url
     * @param array $attributes
     * @param null|bool $secure
     *
     * @return HtmlString|string
     */
    public function style(string $url, array $attributes = [], null|bool $secure = null): string
    {
        if (!$url) {
            return '';
        }

        $defaults = [
            'media' => 'all',
            'type'  => 'text/css',
            'rel'   => 'stylesheet',
        ];

        $attributes = array_merge($defaults, $attributes);

        $attributes['href'] = $this->url->asset($url, $secure);

        return $this->toHtmlString('<link' . $this->attributes($attributes) . '>');
    }

    /**
     * Build an HTML attribute string from an array.
     *
     * @param array $attributes
     *
     * @return string
     */
    public function attributes(array $attributes): string
    {
        $html = [];

        foreach ($attributes as $key => $value) {
            $element = is_numeric($key) ? $key : $this->attributeElement($key, $value);

            if (empty($element)) {
                continue;
            }

            $html[] = $element;
        }

        return count($html) > 0 ? ' ' . implode(' ', $html) : '';
    }

    /**
     * Transform the string to a Html serializable object.
     *
     * @param $html
     *
     * @return HtmlString
     */
    protected function toHtmlString($html): HtmlString
    {
        return new HtmlString($html);
    }

    /**
     * Build a single attribute element.
     *
     * @param string $key
     * @param string $value
     *
     * @return string
     */
    protected function attributeElement($key, $value): string
    {
        // Treat boolean attributes as HTML properties
        if (is_bool($value) && $key !== 'value') {
            return $value ? $key : '';
        }

        if (is_array($value) && $key === 'class') {
            return 'class="' . implode(' ', $value) . '"';
        }

        if (!empty($value)) {
            return $key . '="' . e($value, false) . '"';
        }

        return $value;
    }
}
