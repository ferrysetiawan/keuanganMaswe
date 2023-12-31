<?php

namespace App\Http\Controllers\BE;

use App\Http\Controllers\Controller;
use App\Models\KategoriOut;
use App\Models\Pembelian;
use Illuminate\Http\Request;

class PembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
    {
        $this->middleware('permission:pembelian_index',['only' => ['index','all']]);
        $this->middleware('permission:pembelian_create',['only' => ['store','getCategories']]);
        $this->middleware('permission:pembelian_detail',['only' => 'show','getCategories']);
        $this->middleware('permission:pembelian_edit',['only' => ['edit','update']]);
        $this->middleware('permission:pembelian_destroy',['only' => 'delete']);

    }

    public function index()
    {
        return view('be.pembelian.index');
    }

    public function getCategories()
    {
        $categories = KategoriOut::all();
        return response()->json($categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all()
    {

        // <td><img src="/storage/images/' . $emp->image . '" width="50" class="img-thumbnail rounded-circle"></td>
        $emps = Pembelian::orderBy('tanggal','desc')->get();
        $output = '';
        $p = 1;
        $showAction = false; // Inisialisasi variabel untuk menentukan apakah harus menampilkan teks "Action"
        if ($emps->count() > 0) {
            $output .= '<table class="table table-bordered table-md" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Keterangan</th>
                <th>Kategori</th>
                <th>Total</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
                <td>' . $p++ . '</td>
                <td>' . $emp->tanggal . '</td>
                <td>' . $emp->keterangan . '</td>
                <td>' . $emp->kategori->nama_kategori . '</td>
                <td>' . moneyFormat($emp->total) . '</td>';

                if (auth()->user()->can('pembelian_edit') || auth()->user()->can('pembelian_destroy')) {
                    $output .= '<td>';
                    if (auth()->user()->can('pembelian_edit')) {
                        $output .= '<a href="#" id="' . $emp->id . '" class="text-success mx-1 editIcon" data-toggle="modal" data-target="#editKIModal"><i class="ion-edit h4" data-pack="default" data-tags="on, off"></i></a>';
                        $showAction = true; // Setel ke true jika tombol edit tampil
                    }

                    if (auth()->user()->can('pembelian_destroy')) {
                        $output .= '<a href="#" id="' . $emp->id . '" class="text-danger mx-1 deleteIcon"><i class="ion-trash-a h4" data-pack="default" data-tags="on, off"></i></a>';
                        $showAction = true; // Setel ke true jika tombol delete tampil
                    }
                    $output .= '</td>';
                }
                $output .= '</tr>';


            }
            if (!$showAction) {
                // Jika tidak ada tombol edit atau delete, maka teks "Action" akan dihilangkan
                $output = str_replace('<th>Action</th>', '', $output);
            }
            $output .= '</tbody></table>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
            $pembelian = new Pembelian();
            $pembelian->tanggal = $data['tanggal'];
            $pembelian->keterangan = $data['keterangan'];
            $pembelian->kategori_id = $data['kategori_id'];
            $pembelian->total = $data['total'];
            $pembelian->save();
            return response()->json(['success' => 'Data berhasil ditambahkan']);
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
        $pembelian = Pembelian::find($id);
        return response()->json($pembelian);
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
        $data = $request->all();
        $pembelian = Pembelian::find($data['id']);
        $pembelian->tanggal = $data['tanggal'];
        $pembelian->keterangan = $data['keterangan'];
        $pembelian->kategori_id = $data['kategori_id'];
        $pembelian->total = $data['total'];
        $pembelian->save();

        return response()->json(['success' => 'Data berhasil diubah']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $id = $request->id;
        $pembelian = Pembelian::findOrFail($id);
        Pembelian::destroy($id);
        return response()->json(['success' => 'Data berhasil dihapus']);
    }
}
