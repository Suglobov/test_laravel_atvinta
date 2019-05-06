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
        echo '<pre>', print_r($short_link, 1), '</pre>';
    }
}
