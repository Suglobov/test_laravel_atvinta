<?php

use \Carbon\Carbon;
use Illuminate\Support\Facades\DB;

$now = Carbon::now();

$publicList = DB::table('pasta_datas')
    ->join('reference_access', 'reference_access.id', '=', 'pasta_datas.access_id')
    ->get();
//    ->where('time_of_del', '<', $now)
//->where();
echo '<pre>', print_r($publicList, 1), '</pre>';
?>
{{--@foreach ($publicList as $p)--}}
{{--<p>{{ $p->id }}</p>--}}
{{--@endforeach--}}
