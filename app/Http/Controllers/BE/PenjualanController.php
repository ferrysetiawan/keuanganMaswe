<?php

namespace App\Http\Controllers\BE;

use App\Http\Controllers\Controller;
use App\Http\Requests\BE\InsertPenjualanRequest;
use App\Models\KategoriIn;
use App\Models\Kolam;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;

class PenjualanController extends Controller
{
    public function index()
    {
        return view("be.penjualan.index");
    }

    public function getCategories()
    {
        $categories = KategoriIn::all();
        return response()->json($categories);
    }

    public function getKolam(Request $request)
    {
        $kolam = [];
        if($request->has('q')){
            $kolam = Kolam::select('id','nama_kolam')->search($request->q)->get();
        } else {
            $kolam = Kolam::select('id','nama_kolam')->limit(10)->get();
        }

        return response()->json($kolam);
    }

    public function all()
    {
        $emps = Penjualan::all();
        $output = '';
        $p = 1;
        if ($emps->count() > 0) {
            $output .= '<table class="table table-bordered table-md" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Nama Pembeli</th>
                <th>Kolam</th>
                <th>Kelas</th>
                <th>Qty</th>
                <th>Unit</th>
                <th>Harga</th>
                <th>Total</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
                <td>' . $p++ . '</td>
                <td>' . $emp->tanggal . '</td>
                <td>' . $emp->pembeli . '</td>
                <td>' ; foreach($emp->kolam as $kolam) {  $output .='<span class="badge badge-info mr-2">'. $kolam->nama_kolam .'</span>'  ; }  $output .='</td>
                <td>' . $emp->kategori->nama_kategori . '</td>
                <td>' . $emp->qty . '</td>
                <td>' . $emp->unit . '</td>
                <td>' . $emp->harga . '</td>
                <td>' . $emp->total . '</td>
                <td>
                  <a href="#" data-id="' . $emp->id . '" class="text-success mx-1 editIcon" data-toggle="modal" data-target="#editKIModal"><i class="ion-edit h4" data-pack="default" data-tags="on, off"></i></a>
                  <a href="#" id="' . $emp->id . '" class="text-danger mx-1 deleteIcon"><i class="ion-trash-a h4" data-pack="default" data-tags="on, off"></i></a>
                </td>
              </tr>';
            }
            $output .= '</tbody></table>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
        }
    }

    public function store(Request $insertPenjualanRequest)
    {
        $data = $insertPenjualanRequest->all();
            $penjualan = new Penjualan();
            $penjualan->tanggal = $data['tanggal'];
            $penjualan->pembeli = $data['pembeli'];
            $penjualan->kategori_id = $data['kategori_id'];
            $penjualan->unit = $data['unit'];
            $penjualan->harga = $data['harga'];
            $penjualan->qty = $data['qty'];
            $penjualan->total = $data['total'];
            $penjualan->save();

            $penjualan->kolam()->attach($data['kolam_id']);

            return response()->json(['success' => 'Data berhasil ditambahkan']);
    }

    public function edit($id)
    {
        $penjualan = Penjualan::find($id);
        $selectedData = $penjualan->kolam->pluck('id');
        $allData = Kolam::all();
        return response()->json([
            'penjualan' => $penjualan,
            'selectedData' => $selectedData,
            'allData' => $allData
        ]);
    }

    public function update(Request $request)
    {
        $data = $request->all();
        $penjualan = Penjualan::find($data['id']);
        $penjualan->tanggal = $data['tanggal'];
        $penjualan->pembeli = $data['pembeli'];
        $penjualan->kategori_id = $data['kategori_id'];
        $penjualan->unit = $data['unit'];
        $penjualan->harga = $data['harga'];
        $penjualan->qty = $data['qty'];
        $penjualan->total = $data['total'];
        $penjualan->save();

        $penjualan->kolam()->sync($data['kolam_id']);
        return response()->json(['success' => 'Data berhasil diubah']);

    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $emp = Penjualan::find($id);
        $emp->kolam()->detach();
        Penjualan::destroy($id);
        return response()->json(['success' => 'Data berhasil dihapus']);
    }
}
