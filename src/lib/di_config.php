<?php
use function DI\create;
use function DI\get;

return [
    'BuiltinStrategy' => create('Kata\Strategy\BuiltinReplaceStrategy'),
    'CharacterStrategy' => create('Kata\Strategy\CharacterStrategy'),
    'DictionaryReplacer' => create('Kata\Replacer\DictionaryReplacer')->constructor(get('BuiltinStrategy'))
];
?>
