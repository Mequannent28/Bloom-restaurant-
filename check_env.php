<?php
header('Content-Type: text/plain');
echo "=== Render Environment Diagnostics ===\n\n";

$vars = [
    'BLOOM_DB_HOST',
    'BLOOM_DB_NAME',
    'BLOOM_DB_USER',
    'BLOOM_DB_PASS',
    'BLOOM_DB_PORT',
    'DB_HOST',
    'MYSQLHOST',
    'DATABASE_URL',
    'RENDER',
    'REGION'
];

foreach ($vars as $v) {
    $val = getenv($v);
    echo "$v: " . ($val === false ? '[NOT SET]' : ($v == 'BLOOM_DB_PASS' || $v == 'DATABASE_URL' ? '******' : $val)) . "\n";
}

echo "\n=== DNS Resolution Test ===\n";
$targets = ['mysql', '127.0.0.1', 'localhost'];
foreach ($targets as $t) {
    $ip = gethostbyname($t);
    echo "Resolving '$t': " . ($ip === $t ? 'FAILED (Service Unknown)' : $ip) . "\n";
}

echo "\n=== PDO Drivers ===\n";
print_r(PDO::getAvailableDrivers());
?>