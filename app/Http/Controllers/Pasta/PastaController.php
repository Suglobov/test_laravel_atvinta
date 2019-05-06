<?php

namespace App\Http\Controllers\Pasta;

use App\PastaData;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use \Carbon\Carbon;
use Hashids\Hashids;

class PastaController extends Controller
{
    public function create(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'time' => 'required|in:10min,1hour,3hour,1day,1month,nolimit',
            'access' => 'required|in:public,unlisted,private',
            'text' => 'required',
        ]);

        $now = Carbon::now();
        $time_of_del = null;
        switch ($request->get('time')) {
            case '10min':
                $time_of_del = $now->addMinute(10);
                break;
            case '1hour':
                $time_of_del = $now->addHour(1);
                break;
            case '3hour':
                $time_of_del = $now->addHour(3);
                break;
            case '1day':
                $time_of_del = $now->addDay(1);
                break;
            case '1month':
                $time_of_del = $now->addMonth(1);
                break;
        }

        $user_id = Auth::user() ? Auth::user()->getAuthIdentifier() : null;
        $access_id = DB::table('reference_access')
            ->where('name', '=', $request->get('access'))
            ->pluck('id')
            ->first();

        $newPastaData = PastaData::create([
            'user_id' => $user_id,
            'access_id' => $access_id,
            'time_of_del' => $time_of_del,
            'title' => $request->get('title'),
            'text' => $request->get('text'),
        ]);

        $hashids = new Hashids('', 8);
        $id = $newPastaData->id;
        $tmpPastaData = PastaData::find($id);
        $tmpPastaData->short_link = $hashids->encode($id);
        $tmpPastaData->save();

        return Redirect::back();
    }

    public function curent($short_link)
    {
        $user_id = Auth::user() ? Auth::user()->getAuthIdentifier() : null;

        $rows = DB::table('pasta_datas AS pd')
            ->join('reference_access AS ra', 'ra.id', '=', 'pd.access_id')
            ->where('pd.short_link', '=', $short_link)
//            ->where('pd.short_link', '=', 'zzz')
            ->where(function (\Illuminate\Database\Query\Builder $query) {
                $now = Carbon::now();
                $query
                    ->where('pd.time_of_del', '>', $now)
                    ->orWhere('pd.time_of_del');
            })
            ->get();

        if ($rows->count() === 0) {
            abort(404);
            return;
        }
        $row = $rows->first();
        $access = $row->name;
//        echo '<pre>', print_r([$row, $user_id, $access], 1), '</pre>';

        if ($access === 'private') {
            if (!(
                $user_id !== null
                && (int)$row->user_id === (int)$user_id
            )) {
                abort(404);
                return;
            }
        }
//        echo '<pre>', print_r($row, 1), '</pre>';
        return view('pasta.curent', ['row' => $row]);
    }
}
