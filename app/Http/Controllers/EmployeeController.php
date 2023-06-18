<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(Request $request){

        if($request->has('search')){
            $data = Employee::where('nama', 'LIKE', '%' .$request->search.'%')->paginate(5);


        }else{
            $data = Employee::paginate(5);

        }

        // dd($data);
        return view('datawarga', compact('data'));
    }

    public function tambahwarga(){
        return view('tambahdata');
    }

    public function insertdata(Request $request){
        // dd($request->all());
        $data = Employee::create($request->all());
        if($request->hasFile('foto')){
            $request->file('foto')->move('fotowarga/', $request->file('foto')->getClientOriginalName());
            $data->foto = $request->file('foto')->getClientOriginalName();

            $data->save();
        }
        return redirect()->route('warga')->with('success', 'Data Berhasil ditambah');
    }

    public function tampildata($id){

        $data = Employee::find($id);
        // dd($data);

        return view('tampildata', compact('data'));
    }

    public function updatedata(Request $request, $id){
        $data = Employee::find($id);
        $data->update($request->all());

        return redirect()->route('warga')->with('success', 'Data Berhasil diedit');
    }

    public function delete(Request $request, $id){
        $data = Employee::find($id);
        $data->delete();

        return redirect()->route('warga')->with('success', 'Data Berhasil dihapus');
    }

}
