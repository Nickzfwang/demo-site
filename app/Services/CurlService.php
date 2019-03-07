<?php

namespace App\Services;

use App\Repositories\CurlRepository;

class CurlService
{
    protected $curl = null;

    public function __construct(CurlRepository $curl)
    {
        $this->curl = $curl;
    }

    public function dealCurlData($params)
    {
        $datas = [];
        $name = null;
        $htmlBase = new \DOMDocument();

        libxml_use_internal_errors(true);

        $htmlBase->loadHTML($params);

        $tables = $htmlBase->getElementsByTagName('p');

        $getTitles = $htmlBase->getElementsByTagName('span');

        foreach ($tables as $key => $table) {
            $datas[] = $table->nodeValue;
        }

        return $datas;
    }

    public function createCurlData($datas, $date, $name)
    {
        $this->curl->createConstellation($datas, $date, $name);
    }

    public function curlData($url)
    {
        $agent= 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSLVERSION,'CURL_SSLVERSION_TLSv1_2');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, $agent);
        $data = curl_exec($ch);
        curl_close($ch);
        return trim($data, "\xEF\xBB\xBF");
    }

    public function getConstellationInfo()
    {
        return $this->curl->constellationInfo();
    }
}