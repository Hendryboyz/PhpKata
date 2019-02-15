<?php
if (file_exists(dirname(dirname(__FILE__)).'/vendor/autoload.php')) {
    require_once dirname(dirname(__FILE__)).'/vendor/autoload.php';
    echo 'load dependency packages successfully.\n';
} else {  // SSP is loaded as a library
    if (file_exists(dirname(dirname(__FILE__)).'/../../autoload.php')) {
        require_once dirname(dirname(__FILE__)).'/../../autoload.php';
    } else {
        throw new Exception('Unable to load Composer autoloader');
    }
}

$files = scandir('./');

foreach ($files as $file){
    $length = strlen('.php');
    if(substr($file, -$length) === '.php'){
        $file = './'.$file;
        require_once($file);
    }
}

$builder = new DI\ContainerBuilder();
$builder->addDefinitions('di_config.php');
$container = $builder->build();
$sp = $container->get('SP');
$sp->loadSomething();
?>
