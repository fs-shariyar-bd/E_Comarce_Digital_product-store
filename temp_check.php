<?php
require 'vendor/autoload.php';
$class = new ReflectionClass('Illuminate\Pagination\Paginator');
$methods = $class->getMethods();
$bootstrapMethods = array_filter($methods, function($method) {
    return strpos($method->name, 'bootstrap') !== false;
});
foreach ($bootstrapMethods as $method) {
    echo $method->name . PHP_EOL;
}
?>