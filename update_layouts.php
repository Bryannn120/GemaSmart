<?php
$files = ['kampus', 'pendamping', 'validator'];
foreach ($files as $file) {
    $path = 'c:/sibibit/resources/views/layouts/' . $file . '.blade.php';
    if (file_exists($path)) {
        $content = file_get_contents($path);
        // Replace route('role.module') ?? '#' with route('role.module.index')
        $content = preg_replace('/route\(\'(' . $file . '\.[a-zA-Z0-9\-]+)\'\)\s*\?\?\s*\'#\'/', 'route(\'$1.index\')', $content);
        // Sometimes it doesn't have ?? '#' in validator or pendamping
        $content = preg_replace('/route\(\'(' . $file . '\.[a-zA-Z0-9\-]+)\'\)/', 'route(\'$1.index\')', $content);
        // Fix routeIs
        $content = preg_replace('/routeIs\(\'(' . $file . '\.[a-zA-Z0-9\-]+)\'\)/', 'routeIs(\'$1.*\')', $content);
        file_put_contents($path, $content);
        echo "Updated $file\n";
    }
}
