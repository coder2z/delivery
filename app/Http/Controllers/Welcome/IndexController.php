<?php

namespace App\Http\Controllers\Welcome;

use App\Model\Borrow;
use App\Http\Controllers\Controller;
use App\Model\Users;

class IndexController extends Controller
{
    public function index(){
        $unshipped=Borrow::where('status','0')->count();
        $shipped=Borrow::where('status','1')->count();
        $order=Borrow::count();
        $users=Users::count();
        $result=[
            'unshipped'=>$unshipped,
            'shipped'=>$shipped,
            'order'=>$order,
            'users'=>$users,
        ];
        return response()->json($result);
    }
}
