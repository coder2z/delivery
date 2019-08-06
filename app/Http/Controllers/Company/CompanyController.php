<?php

namespace App\Http\Controllers\Company;

use App\Model\Company;
use App\Http\Controllers\Controller;
use App\Model\Nexus;
use App\Model\Ranges;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    public function index()
    {
        return response()->json(Company::get());
    }

    public function del(Request $request)
    {
        if (Auth::guard('user')->user()->token == 2) {
            Company::where('id', $request->id)->delete();
            $result2=Nexus::where('company_id', $request->id)->delete();
            return response()->json($result2);
        }
    }
    public function getrange(){
        return response()->json(Ranges::get());
    }
    public function getnexus(){
        return response()->json(Nexus::get());
    }
    public function add(Request $request){
        $this->validate($request, [
            'name' => 'required|max:18',
            'contacts' => 'required|max:7',
            'tel' => 'required|max:11',
            'address' => 'required|max:50',
        ]);
        $company_id = Company::insertGetId([
                'name' => $request->name,
                'contacts' => $request->contacts,
                'tel' => $request->tel,
                'address' => $request->address,
        ]);
        $range=array($request->input('range'));
        $num=count($range[0]);
       for($i=0;$i<31;$i++) {
           if (isset($range[0][$i])) {
               Nexus::insert([
                   'ranges_id' => $range[0][$i],
                   'company_id' => $company_id,
               ]);
           }
        }
        return $num;
    }
    public function allranges(Request $request){
        $result=Nexus::where('company_id', $request->id)->join('ranges', 'nexus.ranges_id', '=', 'ranges.id')->get();
        return response()->json($result);
    }
    public function update(Request $request){
        Company::where('id',$request->id)->update([
            'name' => $request->name,
            'contacts' => $request->contacts,
            'tel' => $request->tel,
            'address' => $request->address,
        ]);
        $range=array($request->input('range'));
        $num=count($range[0]);
        Nexus::where('company_id',$request->id)->delete();
        for($i=0;$i<34;$i++) {
            if (isset($range[0][$i])) {
                Nexus::insert([
                    'ranges_id' => $range[0][$i],
                    'company_id' => $request->id,
                ]);
            }
        }
        return $num;
    }
    public function get(Request $request){
        return response()->json(Company::where('id', $request->id)->first());
    }
}