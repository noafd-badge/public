<?php

function clearDirectory(string $directory): void
{
    if (!is_dir($directory)) {
        return;
    }

    foreach (
        new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator(
                $directory,
                FilesystemIterator::SKIP_DOTS
            ),
            RecursiveIteratorIterator::CHILD_FIRST
        ) as $item
    ) {
        $item->isDir()
            ? rmdir($item->getPathname())
            : unlink($item->getPathname());
    }
}
