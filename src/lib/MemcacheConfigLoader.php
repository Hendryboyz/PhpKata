<?php
namespace My;

class MemcacheConfigLoader
{
    public function __construct()
    {
    }

    public function loadSaml20IdpRemote()
    {
        echo 'load saml 2.0 idp remote from memcached.';
    }

    public function loadAuthSources()
    {
        echo 'load authsources from memcached.';
    }
}
