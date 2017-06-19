<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;

use App\Mitra;
use App\Kegiatan;
use App\Statistik;

class MitraController extends Controller
{
    public function index(){
    	$data['mitra'] = Mitra::get();
    	$data['kegiatan'] = Kegiatan::get();
    	$data['statistik'] = Statistik::get();

    	// dd(Statistik::where('mitra_id',1)->select(['*','mitra_id as itu'])->get());

    	return view('mitra/index',$data);
    }
    public function store(){
    	$request = Input::all();
    	// dd($request);

    	$db=Mitra::create([
    		"nama"=>$request['nama'],
    		"nik"=>$request['nik']
    		]);
    	$mitra = Mitra::where('nik',$request['nik'])->first();

    	for ($i=1; $i <= $request['totalItem']; $i++) { 
    		Statistik::create([
    			"mitra_id"=>$mitra['id'],
    			"kegiatan_id"=> $request['kegiatan'.$i],
    			"value"=>$request['nilaiKegiatan'.$i]
    			]);
    	}

    	return redirect('admin/mitra');
    }
    public function getValue(){
    	$request = Input::all();

    	$result = Statistik::join('kegiatan','statistik.kegiatan_id','=','kegiatan.id')->where('mitra_id',$request['id'])->get();

    	return Response::json($result);
    }
}
