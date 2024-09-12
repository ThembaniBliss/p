<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

use App\Student;
use App\Owner;
use App\Property;
use App\Order;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {    
        
        $cs = Student::all()->count();
        $co = Owner::all()->count();
        $cp = Property::all()->count();
        $corders = Order::all()->count();
        // dd($co);
        return view('admin',[
              'students_count' => $cs ,
              'owners_count' => $co ,
              'properties_count' => $cp ,
              'orders_count' => $corders
              ]);
    }
}