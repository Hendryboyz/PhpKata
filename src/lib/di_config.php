<?php
use function DI\create;
use function DI\get;

return [
    'number' => 123,
    'ConfigLoader' => create('My\MemcacheConfigLoader'),
    'SP' => create('sspmod_saml_Auth_Source_TMSP')
        ->constructor(get('ConfigLoader'))
];
?>
