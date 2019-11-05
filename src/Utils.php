<?php

namespace SevenShores\Hubspot;

/**
 * Class Utils.
 *
 * @method \SevenShores\Hubspot\Utils\OAuth2 oAuth2()
 */
class Utils
{
    public static function getFactory()
    {
        return new static();
    }

    public function __call($name, $arguments = null)
    {
        $resource = 'SevenShores\\Hubspot\\Utils\\'.ucfirst($name);

        return new $resource();
    }
}
