<?php

declare(strict_types=1);

final class ContentLoader
{
    public function __construct(
        private readonly string $contentRoot,
        private readonly MarkdownRenderer $markdownRenderer,
    ) {
    }

    public function load(
        string $name,
        bool $required = true,
    ): string {
        $this->assertValidName($name);

        $basePath = sprintf(
            '%s/%s',
            rtrim($this->contentRoot, '/'),
            ltrim($name, '/'),
        );

        // HTML ist der explizite Override.
        $htmlFile = $basePath . '.html';

        if (is_file($htmlFile)) {
            return $this->read($htmlFile);
        }

        // Markdown ist der Normalfall.
        $markdownFile = $basePath . '.md';

        if (is_file($markdownFile)) {
            return $this->markdownRenderer->render(
                $this->read($markdownFile)
            );
        }

        if (!$required) {
            return '';
        }

        throw new RuntimeException(
            "Content not found: {$name}"
        );
    }

    private function read(string $filename): string
    {
        $content = file_get_contents($filename);

        if ($content === false) {
            throw new RuntimeException(
                "Could not read content: {$filename}"
            );
        }

        return $content;
    }

    private function assertValidName(string $name): void
    {
        if (
            $name === ''
            || str_contains($name, '..')
            || !preg_match('#^[a-zA-Z0-9/_-]+$#', $name)
        ) {
            throw new InvalidArgumentException(
                "Invalid content name: {$name}"
            );
        }
    }
}