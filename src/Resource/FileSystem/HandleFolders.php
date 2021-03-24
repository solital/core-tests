<?php

namespace Solital\Core\Resource\FileSystem;

use FilesystemIterator;
use RecursiveIteratorIterator;
use Solital\Core\Exceptions\NotFoundException;

class HandleFolders
{
    /**
     * @var string
     */
    protected string $folder;

    /**
     * @var array
     */
    protected array $files = [];

    /**
     * @param string $folder
     * @return HandleFiles
     */
    public function folder(string $folder): HandleFiles
    {
        $this->folder = $folder . DIRECTORY_SEPARATOR;
        return $this;
    }

    /**
     * @param string $dir
     * @param int $permission
     * @return bool
     */
    public function create(string $dir, int $permission = 0777): bool
    {
        if (!is_dir($dir)) {
            \mkdir($dir, $permission, true);
            \chmod($dir, $permission);
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param string $dir
     * @param bool $safe
     * @return bool
     */
    public function remove(string $dir, bool $safe = true): bool
    {
        $dir = dir($dir);

        while (($files = $dir->read()) !== false) {
            if (($files != '.') && ($files != '..')) {
                $this->files[] = $this->folder . $files;
            }
        }

        $dir->close();

        if (is_dir($dir->path)) {
            if ($safe == false) {
                $this->removeFiles($dir->path);
                return true;
            }

            if (is_array($this->files)) {
                return false;
            }

            \rmdir($dir->path);

            return true;
        } else {
            return false;
        }
    }

    /**
     * @param string $dir
     * @return bool
     */
    private function removeFiles(string $dir): bool
    {
        $di = new \RecursiveDirectoryIterator($dir, FilesystemIterator::SKIP_DOTS);
        $ri = new \RecursiveIteratorIterator($di, RecursiveIteratorIterator::CHILD_FIRST);

        foreach ($ri as $file) {
            $file->isDir() ?  \rmdir($file) : \unlink($file);
        }

        \rmdir($dir);

        return true;
    }
}
