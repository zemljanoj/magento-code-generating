<?php
/**
 * @copyright Copyright (c) 2016-2019 Etendo <etendo.se>. All rights reserved.
 * @author    Etendo AB <info@etendo.se>
 */

namespace Mcg\Model\Service\FileSystem;

class CreateFileService
{
    /**
     * Create file and put content inside
     *
     * @param string $filePath
     * @param string $content
     * @param bool $isBackupEnabled
     *
     * @return null|string
     */
    public function execute(string $filePath, string $content, bool $isBackupEnabled = true)
    {
        $this->createParentDirectory($filePath);
        $backupFilePath = $this->getBackupFilePath($filePath);
        $isBackupCreated = false;
        if ($isBackupEnabled && is_file($filePath) && file_get_contents($filePath) != $content) {
            rename($filePath, $backupFilePath);
            $isBackupCreated = true;
        }

        file_put_contents($filePath, $content);
        if ($isBackupCreated) {
            return $backupFilePath;
        }

        return null;
    }

    /**
     * Create parent directory
     *
     * @param string $filePath
     */
    private function createParentDirectory(string $filePath)
    {
        $directory = dirname($filePath);
        if (!is_dir($directory)) {
            mkdir($directory, 0775, true);
        }
    }

    /**
     * Get backup file path
     *
     * @param string $filePath
     *
     * @return string
     */
    private function getBackupFilePath(string $filePath)
    {
        return $filePath . '.bak';
    }
}
