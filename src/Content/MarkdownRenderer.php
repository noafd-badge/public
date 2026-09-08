<?php

declare(strict_types=1);

use League\CommonMark\GithubFlavoredMarkdownConverter;

final class MarkdownRenderer
{
    private GithubFlavoredMarkdownConverter $converter;

    public function __construct()
    {
        $this->converter = new GithubFlavoredMarkdownConverter([
            // Wer HTML braucht, benutzt bewusst den .html-Override.
            'html_input' => 'strip',
            'allow_unsafe_links' => false,
        ]);
    }

    public function render(string $markdown): string
    {
        return (string) $this->converter->convert($markdown);
    }
}