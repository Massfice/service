<?php

namespace Massfice\Service;

class ServiceExecutor {
    public static function execute(ServiceObject $object, array $data = []) : ServiceObject {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_USERAGENT,
            'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.17 (KHTML, like Gecko) Chrome/24.0.1312.52 Safari/537.17');
        curl_setopt($curl, CURLOPT_AUTOREFERER, true); 
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl, CURLOPT_VERBOSE, 1);
        curl_setopt($curl, CURLOPT_URL, $object->url($data));
        $d = $object->data($data);
        if($d !== null) curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($d));
        $headers = $object->prepare($curl,$data);
        if(count($headers) > 0) curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        $exec = curl_exec($curl);

        $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close($curl);

        if(empty($exec)) {
            $exec = [];
        } else {
            $exec = json_decode($exec,true);
        }

        $object->callback($code, $exec);
        return $object;
    }
}

?>