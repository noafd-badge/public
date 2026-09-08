<?php

declare(strict_types=1);

final class ReleaseRepository
{
    public function __construct(
        private readonly string $releaseRoot,
    ) {
    }

    public function latest(string $badgeId): ?string
    {
        $directory = $this->badgeDirectory($badgeId);

        if (!is_dir($directory)) {
            return null;
        }

        $versions = [];

        foreach (scandir($directory) ?: [] as $entry) {
            if (!preg_match('/^v(\d+)\.(\d+)$/', $entry, $matches)) {
                continue;
            }

            if (!is_dir($directory . '/' . $entry)) {
                continue;
            }

            $versions[] = [
                'version' => $entry,
                'major'   => (int) $matches[1],
                'minor'   => (int) $matches[2],
            ];
        }

        if ($versions === []) {
            return null;
        }

        usort(
            $versions,
            static fn (array $a, array $b): int =>
                [$b['major'], $b['minor']]
                <=>
                [$a['major'], $a['minor']]
        );

        return $versions[0]['version'];
    }

    public function next(
        string $badgeId,
        string $increment = 'minor',
    ): string {
        if (!in_array($increment, ['minor', 'major'], true)) {
            throw new InvalidArgumentException(
                'Increment must be "minor" or "major".'
            );
        }

        $current = $this->latest($badgeId);

        if ($current === null) {
            return $increment === 'major'
                ? 'v1.0'
                : 'v0.1';
        }

        [$major, $minor] = $this->parse($current);

        return match ($increment) {
            'major' => sprintf('v%d.0', $major + 1),
            'minor' => sprintf('v%d.%d', $major, $minor + 1),
        };
    }

    public function path(
        string $badgeId,
        string $version,
    ): string {
        return sprintf(
            '%s/%s/%s',
            rtrim($this->releaseRoot, '/'),
            $badgeId,
            $version,
        );
    }

    private function badgeDirectory(string $badgeId): string
    {
        return sprintf(
            '%s/%s',
            rtrim($this->releaseRoot, '/'),
            $badgeId,
        );
    }

    /**
     * @return array{0:int,1:int}
     */
    private function parse(string $version): array
    {
        if (!preg_match('/^v(\d+)\.(\d+)$/', $version, $matches)) {
            throw new RuntimeException(
                "Invalid release version: {$version}"
            );
        }

        return [
            (int) $matches[1],
            (int) $matches[2],
        ];
    }
}