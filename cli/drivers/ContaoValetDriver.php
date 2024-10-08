<?php
namespace Valet\Drivers;

class ContaoValetDriver extends ValetDriver
{
    /**
     * Determine if the driver serves the request.
     *
     * @param string $sitePath
     * @param string $siteName
     * @param string $uri
     * @return bool
     */
    public function serves($sitePath, $siteName, $uri)
    {
        return is_dir($sitePath . '/vendor/contao') && file_exists($sitePath . '/web/app.php');
    }

    /**
     * Determine if the incoming request is for a static file.
     *
     * @param string $sitePath
     * @param string $siteName
     * @param string $uri
     * @return string|false
     */
    public function isStaticFile($sitePath, $siteName, $uri)
    {
        if ($this->isActualFile($staticFilePath = $sitePath . '/web' . $uri)) {
            return $staticFilePath;
        }

        return false;
    }

    /**
     * Get the fully resolved path to the application's front controller.
     *
     * @param string $sitePath
     * @param string $siteName
     * @param string $uri
     * @return string
     */
    public function frontControllerPath($sitePath, $siteName, $uri)
    {
        if ($uri === '/install.php') {
            return $sitePath . '/web/install.php';
        }

        if (0 === strncmp($uri, '/app_dev.php', 12)) {
            $_SERVER['SCRIPT_NAME'] = '/app_dev.php';
            $_SERVER['SCRIPT_FILENAME'] = $sitePath . '/app_dev.php';

            return $sitePath . '/web/app_dev.php';
        }

        return $sitePath . '/web/app.php';
    }
}
