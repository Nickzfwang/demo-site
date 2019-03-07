<?php

namespace App\Repositories;

use App\Entities\Constellation;

class CurlRepository
{
    public function createConstellation($datas, $date, $name)
    {
	   Constellation::updateOrCreate([
	       'date' => $date,
	       'name' => $name
        ], [
	       'date' => $date,
	       'name' => $name,
	       'overall_fortune' => $datas[3] . $datas[4],
	       'love_fortune' => $datas[5] . $datas[6],
	       'career_fortune' => $datas[7] . $datas[8],
	       'wealth_fortune' => $datas[9] . $datas[10]
        ]);
    }

    public function constellationInfo()
    {
        $start = date('Y-m-d') . ' 00:00:00';
        $end = date('Y-m-d') . ' 23:59:59';

        return Constellation::whereBetween('created_at', [$start, $end])
                    ->get();
    }
}