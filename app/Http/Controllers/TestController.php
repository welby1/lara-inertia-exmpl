<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Models\User;
use App\Models\Car;
use RedirectResponse;

class TestController extends Controller
{
    public function index(){

      if (Auth::check()) {
        return Inertia::render('Page1', [
            'title' => 'title Page1',
        ]);
      }
      
      return Redirect::route('form.login');
    }

    public function index2(){

      return inertia('Page2', [
        'title' => 'title Page 2',
      ]);

    }

    public function page3(){

      return inertia('Page3', [
        'title' => 'title Page 3',
      ]);

    }

    public function store(Request $r){

      $r->validate([
        'brand' => 'required|max:50',
        'model' => 'required|max:50',
      ]);
      
      Car::create([
        'brand' => $r->brand,
        'model' => $r->model
      ]);

      return back()->withInput();

    }

    public function page4(){

      return inertia('Page4', [
        'title' => 'title Page 4',
      ]);

    }

    public function send(Request $r){

      $data = $r->toArray();
      //return back()->withInput();
      return response()->json(['data'=>$data]);

    }

}
