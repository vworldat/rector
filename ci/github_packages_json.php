<?php

declare(strict_types=1);

// get top 10 packages names
$page = (int) ($argv[1] ?? 1);

$packagistPackageProvider = new PackagistPackageProvider();
$packagistPackageProvider->providePackageJsonListForPage($page);

final class PackagistPackageProvider
{
    public function providePackageJsonListForPage(int $page): void
    {
        $json = file_get_contents('https://packagist.org/explore/popular.json?page=' . $page);
        $array = json_decode($json, true);

        $packageNames = [];
        foreach ($array['packages'] as $package) {
            if ($this->isMetaPackage($package['name'])) {
                continue;
            }


            $packageNames[] = $package['name'];
        }

        echo json_encode(['package_name' => $packageNames]);
    }

    private function isMetaPackage(string $packageName): bool
    {
        // skip metapackages
        [$organization, $project] = explode('/', $packageName);
        if ($organization === 'psr') {
            return true;
        }

        if (strpos($project, 'polyfill') !== false) {
            return true;
        }

        return false;
    }
}
