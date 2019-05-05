<?php

use \Carbon\Carbon;
use Illuminate\Support\Facades\DB;

$now = Carbon::now();

$publicList = DB::table('pasta_datas')
    ->join('reference_access', 'reference_access.id', '=', 'pasta_datas.access_id')
    ->where('time_of_del', '>', $now)
    ->orWhere('time_of_del')
    ->whereNotNull('short_link')
    ->get();

//->where();
//echo '<pre>', print_r($publicList, 1), '</pre>';
?>
@foreach ($publicList as $p)
    <p>
        <a href="/pasta/{{ $p->short_link }}">{{ $p->title }}</a>
    </p>
@endforeach
