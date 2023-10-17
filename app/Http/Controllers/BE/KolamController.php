<?php

namespace App\Http\Controllers\BE;

use App\Http\Controllers\Controller;
use App\Http\Requests\BE\InsertKolamRequest;
use App\Http\Requests\BE\UpdateKolamRequest;
use App\Models\Kolam;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;

class KolamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("be.kolam.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all()
    {
        $emps = Kolam::all();
        $output = '';
        $p = 1;
        if ($emps->count() > 0) {
            $output .= '<table class="table table-bordered table-md" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Kolam</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
                <td>' . $p++ . '</td>
                <td>' . $emp->nama_kolam . '</td>
                <td>
                  <a href="#" id="' . $emp->id . '" class="text-success mx-1 editIcon" data-toggle="modal" data-target="#editKolamModal"><i class="ion-edit h4" data-pack="default" data-tags="on, off"></i></a>
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InsertKolamRequest $insertKolamRequest)
    {
        $data = $insertKolamRequest->all();
        $message = $insertKolamRequest->messages();
        $rules = $insertKolamRequest->rules();
        // dd($rules);
        $firstRule = Arr::first($rules);
        $validator = Validator::make($data, $firstRule, $message);

        if ($validator->passes()) {
            $empData = [
                'nama_kolam' => $data['nama_kolam'],
            ];
            Kolam::create($empData);
            return response()->json(['success' => 'Data berhasil ditambahkan']);
        } else {
            return response()->json(['error' => $validator->errors()->all()]);
        }
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
    public function edit(Request $request)
    {
        $id = $request->id;
        $emp = Kolam::find($id);
        return response()->json($emp);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(InsertKolamRequest $insertKolamRequest, UpdateKolamRequest $updateKolamRequest)
    {
        $requestUpdate = $updateKolamRequest->all();
        $messageUpdate = $updateKolamRequest->messages();
        $rulesUpdate = Arr::first($updateKolamRequest->rules());

        $requestInsert = $insertKolamRequest->all();
        $messageInsert = $insertKolamRequest->messages();
        $rulesInsert = Arr::first($insertKolamRequest->rules());

        $emp = Kolam::find($requestUpdate['id']);
        if ($requestUpdate['nama_kolam'] != $emp->nama_kolam) {
            $validator = Validator::make($requestInsert, $rulesInsert, $messageInsert);
        } else {
            $validator = Validator::make($requestUpdate, $rulesUpdate, $messageUpdate);
        }
        if ($validator->passes()) {
            $empData = [
                'nama_kolam' => $requestUpdate['nama_kolam']
            ];
            // dd($request->all());
            $emp->update($empData);
            return response()->json(['success' => 'Data berhasil di ubah']);
        } else {
            return response()->json(['error' => $validator->errors()->all()]);
        }
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
        $emp = Kolam::find($id);
        Kolam::destroy($id);
        return response()->json(['success' => 'Data berhasil dihapus']);
    }
}
