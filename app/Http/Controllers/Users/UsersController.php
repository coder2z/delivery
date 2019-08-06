<?php

namespace App\Http\Controllers\Users;

use App\Http\Requests\RegisterRequest;
use App\Model\Users;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    public function login(Request $request)
    {
        $this->validate($request, [
            'number' => 'required|max:18',
            'password' => 'required|max:16',
        ]);
        $check=Users::where('number',$request->number)->where('check','1')->get();
        if (count($check)!=null){
            $result = Auth::guard('user')->attempt(['number' => $request->number, 'password' => $request->password,'check' => 1],false);
        }else{
            $result=[
                'check' => '0',
            ];
        }
        return response()->json($result);
    }

    public function register(RegisterRequest $request)
    {
        $result = Users::insert([
            [
                'name' => $request->name,
                'password' => bcrypt($request->password),
                'number' => $request->number,
                'token' => $request->token,
                'tel' => $request->tel,
            ],
        ]);
        return response()->json($result);
    }

    public function logout()
    {
        Auth::guard('user')->logout();
        return redirect('/');
    }

    public function index()
    {
        return  response()->json(DB::select('select users.id,name,tel,number,profession.profession,users.check from users  JOIN profession WHERE users.token = profession.id'));
    }

    public function add(RegisterRequest $request){
        $result = Users::insert([
            [
                'name' => $request->name,
                'password' => bcrypt($request->password),
                'number' => $request->number,
                'token' => $request->token,
                'tel' => $request->tel,
                'check'=>'1',
            ],
        ]);
        return response()->json($result);
    }

    public function check(Request $request){
        if ($request->check){
            return  response()->json(Users::where('id',$request->id)->update([
                'check'=>'0',
            ]));
        }else{
            return  response()->json(Users::where('id',$request->id)->update([
                'check'=>'1',
            ]));
        }
    }
    public function del(Request $request){
        if (Auth::guard('user')->user()->token==2){
            return  response()->json(Users::where('id',$request->id)->delete());
        }else{
            return view('error.403');
        }
    }
    public function update(Request $request){
        if (Auth::guard('user')->user()->token==2){
            return  response()->json(Users::where('id',$request->id)->update([
                'password'=>bcrypt($request->password),
            ]));
        }else{
            return view('error.403');
        }
    }
}
