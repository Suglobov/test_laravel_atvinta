<?php

use \Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

$user_id = Auth::user() ? Auth::user()->getAuthIdentifier() : null;

$publicList = DB::table('pasta_datas AS pd')
    ->join('reference_access AS ra', 'ra.id', '=', 'pd.access_id')
    ->where('pd.user_id', '=', $user_id)
    ->where(function (\Illuminate\Database\Query\Builder $query) {
        $now = Carbon::now();
        $query
            ->where('pd.time_of_del', '>', $now)
            ->orWhere('pd.time_of_del');
    })
    ->whereNotNull('pd.short_link')
    ->orderByDesc('pd.id')
    ->paginate(10);
//echo '<pre>', print_r($publicList, 1), '</pre>';
?>
@if($user_id)
    <p>личные</p>
    @foreach ($publicList as $p)
        <p>
            <a href="/pasta/{{ $p->short_link }}">{{ $p->title }}</a>
        </p>
    @endforeach
    {{ $publicList->links() }}
@endif
