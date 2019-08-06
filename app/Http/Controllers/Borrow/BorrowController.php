<?php

namespace App\Http\Controllers\Borrow;

use App\Model\Borrow;
use App\Model\Ranges;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BorrowController extends Controller
{
    public function index()
    {
        return response()->json(Borrow::get());
    }

    public function add(Request $request)
    {
        $this->validate($request, [
            'receiver' => 'required|max:18',
            'rangs_id' => 'required|max:5',
            'site' => 'required|max:50',
            'tel' => 'required|max:11',
            'goods' => 'required|max:50',
            'specifications' => 'required|max:50',
            'number' => 'required|max:11',
            'sale' => 'required|max:11',
            'enddate' => 'required|max:5',
            'weight' => 'required|max:5',
        ]);
        return response()->json(Borrow::insert([
            'receiver' => $request->receiver,
            'rangs_id' => $request->rangs_id,
            'site' => $request->site,
            'tel' => $request->tel,
            'goods' => $request->goods,
            'weight' => $request->weight,
            'specifications' => $request->specifications,
            'number' => $request->number,
            'sale' => $request->sale,
            'enddate' => $request->enddate,
            'order_time' => date('Y-m-d', time()),
            'user_id' => Auth::guard('user')->user()->id,
        ]));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'receiver' => 'required|max:18',
            'rangs_id' => 'required|max:5',
            'site' => 'required|max:50',
            'tel' => 'required|max:11',
            'weight' => 'required|max:5',
            'goods' => 'required|max:50',
            'specifications' => 'required|max:50',
            'number' => 'required|max:11',
            'sale' => 'required|max:11',
            'enddate' => 'required|max:5',
        ]);

        if (Auth::guard('user')->user()->token == 2) {
            return response()->json(Borrow::where('id',$request->id)->update([
                'receiver' => $request->receiver,
                'rangs_id' => $request->rangs_id,
                'site' => $request->site,
                'weight' => $request->weight,
                'tel' => $request->tel,
                'goods' => $request->goods,
                'specifications' => $request->specifications,
                'number' => $request->number,
                'sale' => $request->sale,
                'enddate' => $request->enddate,
            ]));
        } else {
            return response()->json(Borrow::where('user_id', Auth::guard('user')->where('id',$request->id)->update([
                'receiver' => $request->receiver,
                'rangs_id' => $request->rangs_id,
                'site' => $request->site,
                'tel' => $request->tel,
                'goods' => $request->goods,
                'weight' => $request->weight,
                'specifications' => $request->specifications,
                'number' => $request->number,
                'sale' => $request->sale,
                'enddate' => $request->enddate,])));
        }
    }

    public function rangs()
    {
        return response()->json(Ranges::get());
    }

    public function useradd()
    {
        return response()->json(Borrow::where('user_id', Auth::guard('user')->user()->id)->get());
    }

    public function del(Request $request)
    {
        if (Auth::guard('user')->user()->token == 2) {
            return response()->json(Borrow::where('id', $request->id)->delete());
        } else {
            return response()->json(Borrow::where('user_id', Auth::guard('user'))->where('id', $request->id)->delete());
        }
    }

    public function get(Request $request)
    {
        return response()->json(Borrow::where('id', $request->id)->first());
    }
}
