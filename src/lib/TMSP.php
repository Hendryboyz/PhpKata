<?php
    class sspmod_saml_Auth_Source_TMSP
    {
        private $config_loader;

        public function __construct(My\MemcacheConfigLoader $config_loader)
        {
            $this->config_loader = $config_loader;
        }

        public function loadSomething()
        {
            $this->config_loader->loadSaml20IdpRemote();
            $this->config_loader->loadAuthSources();
        }
    }

