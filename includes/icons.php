<?php
function icon(string $name, string $class = 'app-icon', array $extraAttrs = []): string {
    $filePath = __DIR__ . '/../assets/icons/' . $name . '.svg';
    if (!file_exists($filePath)) {
        return '';
    }

    $svg = file_get_contents($filePath);

    $svg = preg_replace('/<\?xml.*?\?>/i', '', $svg);
    $svg = preg_replace('/<!--.*?-->/s', '', $svg);

    if (preg_match('/<svg\b([^>]*)>/i', $svg, $matches)) {
        $attrs = $matches[1];
        if (strpos($attrs, 'class=') !== false) {
            $attrs = preg_replace('/class="([^"]*)"/i', 'class="$1 ' . htmlspecialchars($class) . '"', $attrs);
        } else {
            $attrs .= ' class="' . htmlspecialchars($class) . '"';
        }
        $attrs .= ' aria-hidden="true" focusable="false"';
        foreach ($extraAttrs as $k => $v) {
            $attrs .= ' ' . htmlspecialchars($k) . '="' . htmlspecialchars($v) . '"';
        }
        $svg = preg_replace('/<svg\b[^>]*>/i', '<svg' . $attrs . '>', $svg, 1);
    }

    return trim($svg);
}
