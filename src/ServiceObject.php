<?php

namespace Massfice\Service;

interface ServiceObject extends ServiceData {
    public function url() : string;
    public function data(array $data) : ?ServiceData;
    public function prepare(&$curl);
    public function callback(int $code, array $exec); 
}

?>