<?php
namespace Valet\Drivers;

class JigsawValetDriver extends BasicValetDriver
{
    /**
     * Mutate the incoming URI.
     *
     * @param string $uri
     * @return string
     */
    public function mutateUri($uri)
    {
        return rtrim('/build_local' . $uri, '/');
    }

    /**
     * Determine if the driver serves the request.
     *
     * @param string $sitePath
     * @param string $siteName
     * @param string $uri
     * @return void
     */
    public function serves($sitePath, $siteName, $uri)
    {
        return is_dir($sitePath . '/build_local');
    }
}
