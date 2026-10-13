<?php
/**
 * Mime Type: application/x-www-urlencoded
 * @author Nathan Good <me@nategood.com>
 */

namespace Httpful\Handlers;

class FormHandler extends MimeHandlerAdapter
{
    /**
     * @param string $body
     * @return mixed
     */
    public function parse($body)
    {
        $parsed = [];
        // Same BOM handling as the JSON/XML handlers; otherwise the first key
        // keeps the invisible mark ("\u{feff}a" instead of "a").
        parse_str($this->stripBom($body), $parsed);
        return $parsed;
    }

    /**
     * @param mixed $payload
     * @return string
     */
    public function serialize($payload): string
    {
        return http_build_query($payload, "", '&');
    }
}
