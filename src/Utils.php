<?php

namespace SevenShores\Hubspot;

/**
 * Class Utils.
 *
 * @method \SevenShores\Hubspot\Utils\OAuth2   oAuth2()
 * @method \SevenShores\Hubspot\Utils\Webhooks Webhooks()
 */
class Utils
{
    public function __call(string $name, $arguments = null)
    {
        $resource = 'SevenShores\\Hubspot\\Utils\\'.ucfirst($name);

        return new $resource();
    }

    public static function getFactory()
    {
        return new static();
    }
}
