<?php

namespace App\Http\Controllers\Curl;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\CurlService;

class CurlController extends Controller
{
	protected $curlService = null;

	public function __construct(CurlService $curlService)
    {
        $this->curlService = $curlService;
    }

    public function getConstellationsData()
    {
    	for ($i=0; $i < 12; $i++) {
    		$url = 'http://astro.click108.com.tw/daily_6.php?iAstro=' . $i;

	    	$curlReturn = $this->curlService->curlData($url);

	    	$datas = $this->curlService->dealCurlData($curlReturn);

	        $date = date('Y') . '年' . date('m') . '月' . date('d') . '日 ' . $datas[1];

	        $name = mb_substr($datas[0], 11, 3, 'utf-8');

	        $this->curlService->createCurlData($datas, $date, $name);
	    }
    }
}
