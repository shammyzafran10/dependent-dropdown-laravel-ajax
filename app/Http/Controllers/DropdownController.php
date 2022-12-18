<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\dropdown;
use App\Models\provinsi;
use App\Models\kabkota;
use App\Models\kecamatan;
use App\Models\keldes;
use DataTables;

class DropdownController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $kabkota = kabkota::get();
        $provinsis = provinsi::get();
        $kecamatans = kecamatan::get();
        $keldes = keldes::get();
        $Dependents = dropdown::with('DataProvinsi','DataKabkota','DataKecamatan','DataKeldes')->get();
        if ($request->ajax()) {
            $allData = DataTables::of($Dependents)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="' .
                        $row->id . '"  class=" text-white btn btn-primary btn-sm " id="edit"><i class="bi bi-pencil-square"></i></a>&nbsp';
                    $btn.= '<a href="javascript:void(0)" data-toggle="tooltip" data-id="' .
                        $row->id . '"  class=" text-white btn btn-danger btn-sm " id="delete"><i class="bi bi-trash"></i></a>';
                    return  $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
            return $allData;
        }
        $content = [
            'Dependents' => $Dependents,
            'kabkotas' => $kabkota,
            'provinsis' => $provinsis,
            'kecamatans' => $kecamatans,
            'keldes' => $keldes,
        ];
        return view('Dropdown.index', $content);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Dependents= dropdown::create(
            [
                'nama' => $request->nama,
                'id_provinsi' => $request->id_provinsi,
                'id_kabkota' => $request->id_kabkota,
                'id_kecamatan' => $request->id_kecamatan,
                'id_keldes' => $request->id_keldes,
            ],
        );
            return response()->json([
                'success' => true,
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Dependents = dropdown::find($id);

        return response()->json($Dependents);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        dropdown::updateOrCreate(
            [
                'id'=>$request->id_dependent
            ],
            [
                'nama' => $request->nama,
                'id_provinsi' => $request->id_provinsi,
                'id_kabkota' => $request->id_kabkota,
                'id_kecamatan' => $request->id_kecamatan,
                'id_keldes' => $request->id_keldes,
            ],
        );
    return response()->json(['success' => 'Data Sudah Ter Update']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dropdown::find($id)->delete();
        return response()->json(['success' => 'Data Sudah Ter Delete']);
    }
}
