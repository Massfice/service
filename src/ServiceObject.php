<?php

namespace Massfice\Service;

interface ServiceObject extends ServiceData {
    public function url(array $data) : string;
    public function data(array $data) : ?ServiceData;
    public function prepare(&$curl, array $data) : array;
    public function callback(int $code, array $exec); 
}

?>