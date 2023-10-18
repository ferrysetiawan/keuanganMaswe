<?php

namespace App\Http\Controllers\BE;

use App\Http\Controllers\Controller;
use App\Http\Requests\BE\InsertUserRequest;
use App\Http\Requests\BE\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:user_index',['only' => ['index']]);
        $this->middleware('permission:user_create',['only' => ['create','store']]);
        $this->middleware('permission:user_edit',['only' => ['edit','update']]);
        $this->middleware('permission:user_destroy',['only' => 'destroy']);
    }

    // set index page view
    public function index()
    {
        return view('be.user.index');
    }

    // handle fetch all eamployees ajax request
    public function all()
    {

        // <td><img src="/storage/images/' . $emp->image . '" width="50" class="img-thumbnail rounded-circle"></td>
        $emps = User::all();
        $output = '';
        $p = 1;
        $showAction = false; // Inisialisasi variabel untuk menentukan apakah harus menampilkan teks "Action"
        if ($emps->count() > 0) {
            $output .= '<table class="table table-bordered table-md" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
                <td>' . $p++ . '</td>
                <td>' . $emp->name . '</td>
                <td>' . $emp->email . '</td>';

                if (auth()->user()->can('user_edit') || auth()->user()->can('user_destroy')) {
                    $output .= '<td>';
                    if (auth()->user()->can('user_edit')) {
                        $output .= '<a href="#" id="' . $emp->id . '" class="text-success mx-1 editIcon" data-toggle="modal" data-target="#editKIModal"><i class="ion-edit h4" data-pack="default" data-tags="on, off"></i></a>';
                        $showAction = true; // Setel ke true jika tombol edit tampil
                    }

                    if (auth()->user()->can('user_destroy')) {
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

    public function getRole()
    {
        $roles = Role::all();
        return response()->json($roles);
    }

    // handle insert a new Tu ajax request
    public function store(InsertUserRequest $insertUserRequest)
    {

        $data = $insertUserRequest->all();
        $message = $insertUserRequest->messages();
        $rules = $insertUserRequest->rules();
        // dd($rules);
        $firstRule = Arr::first($rules);
        $validator = Validator::make($data, $firstRule, $message);

        if ($validator->passes()) {
            $empData = [
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'password_asli' => $data['password']
            ];
            $user = User::create($empData);
            $user->assignRole($data['role']);
            return response()->json(['success' => 'Data berhasil ditambahkan']);
        } else {
            // dd('else');
            return response()->json(['error' => $validator->errors()->all()]);
        }
    }

    // handle edit an Tu ajax request
    public function edit($id)
    {
        $user = User::find($id);
        return view('be.user.edit',[
            'user' => $user,
            'roles' => Role::all()
        ]);
    }

    // handle update an Tu ajax request
    public function update(UpdateUserRequest $updateUserRequest, $id)
    {
        // dd($updateUserRequest);

        $requestUpdate = $updateUserRequest->all();
        $messageUpdate = $updateUserRequest->messages();
        $rulesUpdate = Arr::first($updateUserRequest->rules());


        $user = User::findOrFail($id);
        $validator = Validator::make($requestUpdate, $messageUpdate, $rulesUpdate);

        if ($validator->passes()) {
            $empData = [
                'name' => $requestUpdate['name'],
                'email' => $requestUpdate['email'],
                'password' => Hash::make($requestUpdate['password']),
                'password_asli' => $requestUpdate['password']
            ];
            // dd($request->all());
            $user->update($empData);
            $user->syncRoles($requestUpdate['role']);
            return redirect()->route('user')->with(['success' => 'Data berhasil diubah!']);
        } else {
            return redirect()->back()->with(['error' => $validator->errors()->all()]);
        }
    }

    // handle delete an Tu ajax request
    public function delete(Request $request)
    {
        $id = $request->id;
        $emp = User::find($id);
        User::destroy($id);
        return response()->json(['success' => 'Data berhasil dihapus']);
    }
}
