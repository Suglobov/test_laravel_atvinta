<?php

use \Carbon\Carbon;
use Illuminate\Support\Facades\DB;

$now = Carbon::now();

$publicList = DB::table('pasta_datas AS pd')
    ->select([
        'pd.short_link',
        'pd.title',
    ])
    ->join('reference_access AS ra', 'ra.id', '=', 'pd.access_id')
    ->where('ra.name', '=', 'public')
    ->where(function (\Illuminate\Database\Query\Builder $query) {
        $now = Carbon::now();
        $query
            ->where('pd.time_of_del', '>', $now)
            ->orWhere('pd.time_of_del');
    })
    ->whereNotNull('pd.short_link')
    ->orderByDesc('pd.id')
    ->limit(10)
    ->get();
?>
<p>10 последних публичных</p>
@foreach ($publicList as $p)
    <p>
        <a href="/pasta/{{ $p->short_link }}">{{ $p->title }}</a>
    </p>
@endforeach
