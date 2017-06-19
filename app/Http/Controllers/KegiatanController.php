<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use App\Kegiatan;

class KegiatanController extends Controller
{
    public function index(){
    	$data['kegiatan']=Kegiatan::get();

    	return view('kegiatan/index',$data);
    }
    public function store(){
    	$request = Input::all();
    	// dd($request);
    	$db = Kegiatan::create([
    		"kegiatan"=>$request['kegiatan']
    		]);
    	
    	return redirect('admin/kegiatan');
    }
    public function delete(){
    	$request = Input::all();
    	// dd($request);
    	$db = Kegiatan::where('id',$request['id'])->delete();

    	return redirect('admin/kegiatan');
    }
}
