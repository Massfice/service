<?php

namespace Massfice\Service;

class ServiceObjectFactory {
    private $namespace;

    public function __construct(string $namespace) {
        $this->namespace = $namespace;
    }

    public function create(string $name) : ServiceObject {
        $name = "\\".$this->namespace."\\".$name;
        return new $name();
    }
}

?>