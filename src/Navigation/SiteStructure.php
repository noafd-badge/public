<?php

declare(strict_types=1);

use Symfony\Component\Yaml\Yaml;

final class SiteStructure
{
    private array $structure;

    public function __construct(string $filename)
    {
        if (!is_file($filename)) {
            throw new RuntimeException(
                "Navigation file not found: {$filename}"
            );
        }

        $structure = Yaml::parseFile($filename);

        if (!is_array($structure)) {
            throw new RuntimeException(
                'Invalid navigation structure.'
            );
        }

        $this->structure = $structure;
    }

    public function navigation(string $area): array
    {
        return $this->normalizeItems(
            $this->structure[$area] ?? []
        );
    }

    public function pages(): array
    {
        $pages = [];

        foreach ($this->structure as $items) {
            if (!is_array($items)) {
                continue;
            }

            $this->collectPages($items, $pages);
        }

        return $pages;
    }

    private function normalizeItems(array $items): array
    {
        return array_map(
            function (array $item): array {
                $item['href'] = $this->resolveHref($item);

                if (isset($item['children'])) {
                    $item['children'] = $this->normalizeItems(
                        $item['children']
                    );
                }

                return $item;
            },
            $items
        );
    }

    private function resolveHref(array $item): ?string
    {
        if (isset($item['href'])) {
            return $item['href'];
        }

        if (isset($item['anchor'])) {
            return '/#' . $item['anchor'];
        }

        if (isset($item['page'])) {
            return '/' . trim($item['page'], '/') . '/';
        }

        return null;
    }

    private function collectPages(
        array $items,
        array &$pages
    ): void {
        foreach ($items as $item) {
            if (isset($item['page'])) {
                $slug = trim($item['page'], '/');

                $pages[$slug] = [
                    'title' => $item['page_title']
                        ?? $item['title'],
                    'content' => $item['content']
                        ?? $slug,
                ];
            }

            if (isset($item['children'])) {
                $this->collectPages(
                    $item['children'],
                    $pages
                );
            }
        }
    }
}