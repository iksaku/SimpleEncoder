<?php
$args = $argv;
array_shift($args);
$message = implode(' ', $args);

$nodes = [
    'k' => 'b',
    'a' => 'e',
    'r' => 't',
    'l' => 'f',
    'i' => 'u',
    'n' => 's'
];

foreach ($nodes as $k => $v) {
    $k = strtolower($k);
    $v = strtolower($v);
    if (!isset($nodes[$k])) $nodes[$k] = $v;
    if (!isset($nodes[$v])) $nodes[$v] = $k;

    $k = strtoupper($k);
    $v = strtoupper($v);
    if (!isset($nodes[$k])) $nodes[$k] = $v;
    if (!isset($nodes[$v])) $nodes[$v] = $k;
}

$sequence = join('', $nodes);
$message = preg_replace('/([' . $sequence . '])/', '{{$1}}', $message);

$message = preg_replace_callback('/\{\{(\w)\}\}/', function ($matches) use ($nodes) {
    if (isset($nodes[$matches[1]])) {
        return $nodes[$matches[1]];
    }
    return '';
}, $message);

echo "Mensaje procesado: \n\t" . $message . "\n";