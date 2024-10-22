<?php

namespace App\Http\Controllers;

// use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\UserModel;
use App\Models\LevelModel;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Yajra\DataTables\Facades\DataTables;
use Barryvdh\DomPDF\Facade\Pdf;


class UserController extends Controller
{
    
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar User',
            'list' => ['Home', 'User']
        ];

        $page = (object) [
            'title' => 'Daftar user yang terdaftar dalam sistem'
        ];

        $activeMenu = 'user'; // set menu yang sedang aktif
        $level = LevelModel::all(); // ambil data level untuk filter level
        return view('user.index', [
            'breadcrumb' => $breadcrumb, 
            'page' => $page, 
            'level' => $level,
            'activeMenu' => $activeMenu]);
    }

    public function list(Request $request)
    {
        $users = UserModel::select('user_id', 'username', 'nama', 'user_profile', 'level_id')
            ->with('level');

        // Filter data user berdasarkan level_id
        if ($request->level_id) {
            $users->where('level_id', $request->level_id);
        }

        return DataTables::of($users)
        ->addIndexColumn() // Menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
            ->addColumn('aksi', function ($user) { // Menambahkan kolom aksi
                $btn = '<button onclick="modalAction(\''.url('/user/' . $user->user_id . '/show_ajax').'\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\''.url('/user/' . $user->user_id . '/edit_ajax').'\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\''.url('/user/' . $user->user_id . '/delete_ajax').'\')" class="btn btn-danger btn-sm">Hapus</button> ';
                return $btn;
            })
            ->rawColumns(['aksi']) // Memberitahu bahwa kolom aksi adalah HTML
            ->make(true);
    }

    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah User',
            'list' => ['Home', 'User', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah user baru'
        ];

        $level = LevelModel::all(); 
        $activeMenu = 'user'; 

        return view('user.create', [
            'breadcrumb' => $breadcrumb, 
            'page' => $page, 
            'level' => $level, 
            'activeMenu' => $activeMenu]);
    }

    public function store(Request $request)
    {
        $request->validate([
            // username harus diisi, berupa string, minimal 3 karakter, dan bernilai unik di tabel user kolom username
            'username' => 'required|string|min:3|unique:m_user,username',

            // nama harus diisi, berupa string, dan maksimal 100 karakter
            'nama' => 'required|string|max:100',

            // password harus diisi dan minimal 5 karakter
            'password' => 'required|min:5',

            // level_id harus diisi dan berupa angka
            'level_id' => 'required|integer',

            'user_profile' => 'text'
        ]);

        UserModel::create([
            'username' => $request->username,
            'nama' => $request->nama,
            'password' => bcrypt($request->password), // password dienkripsi sebelum disimpan
            'level_id' => $request->level_id,
            'user_profile' => $request->user_profile
        ]);
        return redirect('/user')->with('success', 'Data user berhasil disimpan');
        
    }

    public function show(string $id)
    {
        // Cari user dengan relasi 'level'
        $user = UserModel::with('level')->find($id);

        // Jika data user tidak ditemukan, redirect dengan pesan error
        if (!$user) {
            return redirect()->back()->withErrors('Data user tidak ditemukan.');
        }

        // Definisi breadcrumb
        $breadcrumb = (object) [
            'title' => 'Detail User',
            'list' => ['Home', 'User', 'Detail']
        ];

        // Definisi halaman
        $page = (object) [
            'title' => 'Detail User'
        ];

        $activeMenu = 'user'; // set menu yang sedang aktif

        // Return view dengan data yang dibutuhkan
        return view('user.show', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'user' => $user,
            'activeMenu' => $activeMenu
        ]);
    }


    // Menampilkan halaman form edit user
    public function edit(string $id)
    {
        $user = UserModel::find($id);

        $level = LevelModel::all();

        $breadcrumb = (object) [
            'title' => 'Edit User',
            'list' => ['Home', 'User', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit user'
        ];

        $activeMenu = 'user'; // set menu yang sedang aktif

        return view('user.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'user' => $user, 'level' => $level, 'activeMenu' => $activeMenu]);
    }

    // Menyimpan perubahan data user
    public function update(Request $request, string $id)
    {
        $request->validate([
            // username harus diisi, berupa string, minimal 3 karakter,
            // dan bernilai unik di tabel m_user kolom username kecuali untuk user dengan id yang sedang diedit
            'username' => 'required|string|min:3|unique:m_user,username,' . $id . ',user_id',

            'nama' => 'required|string|max:100', // nama harus diisi, berupa string, dan maksimal 100 karakter

            'password' => 'nullable|min:5', // password bisa diisi (minimal 5 karakter) dan bisa tidak diisi

            'level_id' => 'required|integer', // level_id harus diisi dan berupa angka
            'user_profile' => 'nullable|text'
        ]);

        UserModel::find($id)->update([
            'username' => $request->username,
            'nama' => $request->nama,
            'password' => $request->password ? bcrypt($request->password) : UserModel::find($id)->password,
            'level_id' => $request->level_id,
            'user_profile' => $request->user_profile
        ]);

        return redirect('/user')->with('success', 'Data user berhasil diubah');
    }

    // Menghapus data user
    public function destroy(string $id)
    {
        $check = UserModel::find($id);

        if (!$check) {
            // untuk mengecek apakah data user dengan id yang dimaksud ada atau tidak
            return redirect('/user')->with('error', 'Data user tidak ditemukan');
        }

        try {
            UserModel::destroy($id); // Hapus data level

            return redirect('/user')->with('success', 'Data user berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            // Jika terjadi error ketika menghapus data, redirect kembali ke halaman dengan membawa pesan error
            return redirect('/user')->with('error', 'Data user gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }

    public function create_ajax()
    {
        $level = LevelModel::select('level_id', 'level_nama')->get();
        return view('user.create_ajax')
            ->with('level', $level);
    }
    public function store_ajax(Request $request) 
    {
        // Validasi input data
        $request->validate([
            'username' => 'required|string|min:3|unique:m_user,username',
            'nama' => 'required|string|max:100',
            'password' => 'required|min:6',
            'level_id' => 'required|integer',
            'user_profile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // validasi file gambar
        ]);

        // Siapkan data user yang akan disimpan
        $userData = [
            'username' => $request->username,
            'nama' => $request->nama,
            'password' => bcrypt($request->password), // enkripsi password sebelum disimpan
            'level_id' => $request->level_id,
        ];

        // Jika ada file gambar user_profile yang diupload
        if ($request->hasFile('user_profile')) {
            $file = $request->file('user_profile');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/profile_pics'), $fileName);
            $userData['user_profile'] = $fileName; // Simpan nama file di database
        }

        // Simpan data user ke databasesupplier
        UserModel::create($userData);

        return response()->json(['success' => 'Data user berhasil disimpan']);
    }

    // Menampilkan halaman form edit user ajax
    public function edit_ajax(string $id) {
        $user = UserModel::find($id);
        $level = LevelModel::select('level_id', 'level_nama')->get();
        return view('user.edit_ajax', ['user' => $user, 'level' => $level]);
    }
    public function update_ajax(Request $request, $id)
    {
        // cek apakah request dari ajax
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'level_id' => 'required|integer',
                'username' => 'required|max:20|unique:m_user,username,' . $id . ',user_id',
                'nama' => 'required|max:100',
                'password' => 'nullable|min:6|max:20',
                'user_profile'      => 'nullable|mimes:jpeg,png,jpg|max:4096'
            ];
            // use Illuminate\Support\Facades\Validator;
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false, // respon json, true: berhasil, false: gagal
                    'message' => 'Validasi gagal.',
                    'msgField' => $validator->errors() // menunjukkan field mana yang error
                ]);
            }
            $check = UserModel::find($id);
            if ($check) {
                if (!$request->filled('password')) { // jika password tidak diisi, maka hapus dari request
                    $request->request->remove('password');
                }
                if ($request->has('user_profile')) {
                    $file = $request->file('user_profile');
                    $extension = $file->getClientOriginalExtension();

                    $filename = time() . '.' . $extension;

                    $path = 'image/profile/';
                    $file->move($path, $filename);
                }
                // $fileName = time() . $request->file('user_profile')->getClientOriginalExtension();
                // $path = $request->file('user_profile')->storeAs('images', $fileName);
                // $request['user_profile'] = '/storage/' . $path;

                if (!$request->filled('user_profile')) { // jika password tidak diisi, maka hapus dari request 
                    $request->request->remove('user_profile');
                }

                $check->update([
                    'username'  => $request->username,
                    'nama'      => $request->nama,
                    'password'  => $request->password ? bcrypt($request->password) : UserModel::find($id)->password,
                    'level_id'  => $request->level_id,
                    'user_profile'      => $path.$filename
                ]);
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil diupdate'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }
        return redirect('/user');
    }

    

    public function confirm_ajax(string $id) {
        $user = UserModel::find($id);
    
        return view('user.confirm_ajax', ['user' => $user]);
    }
    public function delete_ajax(Request $request, $id) {
        // cek apakah request dari ajax
        if($request->ajax() || $request->wantsJson()){
            $user = UserModel::find($id);
    
            if($user){
                $user->delete();
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil dihapus'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }
    
        return redirect('/user');
    }
    public function import()
    {
        return view('user.import');
    }
    public function import_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                // validasi file harus xls atau xlsx, max 1MB
                'file_user' => ['required', 'mimes:xlsx', 'max:1024']
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors()
                ]);
            }
            $file = $request->file('file_user'); // ambil file dari request
            $reader = IOFactory::createReader('Xlsx'); // load reader file excel
            $reader->setReadDataOnly(true); // hanya membaca data
            $spreadsheet = $reader->load($file->getRealPath()); // load file excel
            $sheet = $spreadsheet->getActiveSheet(); // ambil sheet yang aktif
            $data = $sheet->toArray(null, false, true, true); // ambil data excel
            $insert = [];
            if (count($data) > 1) { // jika data lebih dari 1 baris
                foreach ($data as $baris => $value) {
                    if ($baris > 1) { // baris ke 1 adalah header, maka lewati
                        $insert[] = [
                            'level_id' => $value['A'],
                            'username' => $value['B'],
                            'nama' => $value['C'],
                            'created_at' => now(),
                        ];
                    }
                }
                if (count($insert) > 0) {
                    // insert data ke database, jika data sudah ada, maka diabaikan
                    UserModel::insertOrIgnore($insert);
                }
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil diimport'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Tidak ada data yang diimport'
                ]);
            }
        }
        return redirect('/');
    }
    public function export_excel()
    {
        // ambil data user yang akan di export
        $user = UserModel::select('level_id', 'username', 'nama')
            ->orderBy('level_id')
            ->with('level')
            ->get();
        // load library excel
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet(); // ambil sheet yang aktif
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Kode user');
        $sheet->setCellValue('C1', 'Nama user');
        $sheet->setCellValue('D1', 'Level');
        $sheet->getStyle('A1:D1')->getFont()->setBold(true); // bold header
        $no = 1; // nomor data dimulai dari 1
        $baris = 2; // baris data dimulai dari baris ke 2
        foreach ($user as $key => $value) {
            $sheet->setCellValue('A' . $baris, $no);
            $sheet->setCellValue('B' . $baris, $value->username);
            $sheet->setCellValue('C' . $baris, $value->nama);
            $sheet->setCellValue('D' . $baris, $value->level->level_nama); // ambil nama level
            $baris++;
            $no++;
        }
        foreach (range('A', 'D') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true); // set auto size untuk kolom
        }
        
        $sheet->setTitle('Data user'); // set title sheet
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $filename = 'Data user ' . date('Y-m-d H:i:s') . '.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        header('Cache-Control: max-age=1');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Last-Modified:' . gmdate('D, d M Y H:i:s') . ' GMT');
        header('Cache-Control: cache, must-revalidate');
        header('Pragma: public');
        $writer->save('php://output');
        exit;
    } // end function export_excel
    public function export_pdf() {
        set_time_limit(600);
        $user = UserModel::select('level_id', 'username', 'nama')
                                                                                                ->orderBy('level_id')
                                                                                                ->orderBy('username')
                                                                                                ->with('level')
                                                                                                ->get();
    
        // use Barryvdh\DomPDF\Facade\Pdf;
        $pdf = Pdf::loadView('user.export_pdf', ['user' => $user]);
    
        $pdf->setPaper('a4', 'portrait'); // set ukuran kertas dan orientasi
        $pdf->setOption("isRemoteEnabled", true); // set true jika ada gambar dari uri
        $pdf->render();
    
        return $pdf->stream('Data user '.date('Y-m-d H:i:s').'.pdf');
    }



    // public function index(){

        // $data = [
        //     'username' => 'Customer-1',
        //     'nama' => 'Pelanggan' ,
        //     'password' => Hash::make('12345'),
        //     'level_id' => 4
        // ];
        // UserModel::insert ($data);
        

        // $data = [
        //     'nama' => 'Pelanggan Pertama',
        // ];
        // UserModel::where('username','customer-1')->update($data);
        
        // $data = [
        //     'level_id' => 2,
        //     'username' => 'manager_dua',
        //     'nama' => 'Manager 2' ,
        //     'password' => Hash::make('12345')
        // ];
        // UserModel::create ($data);

    //     $data = [
    //         'level_id' => 2,
    //         'username' => 'manager_tiga',
    //         'nama' => 'Manager 3' ,
    //         'password' => Hash::make('12345')
    //     ];
    //     UserModel::create ($data);

    // $user = UserModel::all();
    // return view('user',['data'=> $user]);

    // $user = UserModel::find(1);
    // $user = UserModel::where ('level_id', 1)->first();
    // $user = UserModel::firstWhere ('level_id', 1);

    // $user = UserModel::findOr (1, ['username', 'nama'], function (){
    //     abort(404);
    // });
    // $user = UserModel::findOr (20, ['username', 'nama'], function (){
    //     abort(404);
    // });

    // $user = UserModel::findOrFail(1);
    // $user = UserModel::where ('username', 'manager9') -> firstOrFail();

    // $user = UserModel::where ('level_id', 2) -> count(); 
    // // dd($user);
    // return view('user',['data'=> $user]);

    // $userCount = UserModel::where('level_id', 2)->count(); 
    // return view('user', ['data' => $userCount]); 

    // $user = UserModel::firstOrCreate(
    //     [
    //         'username' => 'manager',
    //         'nama' => 'Manager',
    //     ],
    // );

    // $user = UserModel::firstOrCreate(
    //     [
    //         'username' => 'manager22',
    //         'nama' => 'Manager Dua Dua',
    //         'password' => Hash::make('12345'),
    //         'level_id' => 2
    //     ],
    // );

    // $user = UserModel::firstOrNew(
    //     [
    //         'username' => 'manager',
    //         'nama' => 'Manager',
    //     ],
    // );

    // $user = UserModel::firstOrNew(
    //     [
    //         'username' => 'manager33',
    //         'nama' => 'Manager Tiga Tiga',
    //         'password' => Hash::make('12345'),
    //         'level_id' => 2
    //     ],
    // );
    // $user->save();

    // return view('user', ['data' => $user]);

    // $user = UserModel::create(
    //     [
    //         'username' => 'manager55',
    //         'nama' => 'Manager55',
    //         'password' => Hash::make('12345'),
    //         'level_id' => 2,
    //     ],
    // );


    // $user->username = 'manager56';

    // $user->isDirty(); // true
    // $user->isDirty('username'); // true $user->isDirty('nama'); // false $user->isDirty(['nama', 'username']); // true
    // $user->isDirty ('nama'); // true
    // $user->isDirty (['nama', 'username']); // false

    // $user->isclean(); // false
    // $user->isClean ('username'); // false
    // $user->isClean ('nama'); // true
    // $user->isClean (['nama', 'username']); // false

    // $user->save();
    
    // $user->isDirty(); // false
    // $user->isClean(); // true.
    // dd($user->isDirty());

    // $user = UserModel::create(
    //     [
    //         'username' => 'manager11',
    //         'nama' => 'Manager11',
    //         'password' => Hash::make('12345'),
    //         'level_id' => 2,
    //     ],
    // );


    // $user->username = 'manager11';
    
    // $user->save();

    // $user->wasChanged(); // true
    // $user->wasChanged('username'); // true
    // $user->wasChanged(['username', 'level_id']); // true $user->wasChanged('nama'); // false
    // $user->wasChanged('nama'); // false
    // dd($user->wasChanged(['nama', 'username'])); // true

    // $user = UserModel::all();
    // return view('user', ['data' => $user]);
    // }

    // public function tambah ()
    // {
    //     return view('user_tambah');
    // }

    // public function tambah_simpan (Request $request)
    // {
    //     UserModel::create(
    //             [
    //                 'username' => $request->username,
    //                 'nama' => $request->nama,
    //                 'password' => Hash::make('$request->password'),
    //                 'level_id' => $request->level_id
    //             ],
    //         );
    //     return redirect ('/user');
    // }
    // public function ubah ($id)
    // {
    //     $user = UserModel::find($id);
    //     return view('user_ubah', ['data' => $user]);
    // }

    // public function ubah_simpan ($id, Request $request)
    // {
    //     $user = UserModel::find($id);

    //     $user->username = $request->username;
    //     $user->nama = $request->nama;
    //     $user->password = Hash::make('$request->password');
    //     $user->level_id = $request->level_id;

    //     $user ->save();

    //     return redirect ('/user');
    // }
    // public function hapus ($id)
    // {
    //     $user = UserModel::find($id);
    //     $user ->delete();

    //     return redirect ('/user');
    // }


    // public function index(){
    //     $user = UserModel::with('level')->get();
    //     dd($user);
    // }

    // public function index(){
    //     $user = UserModel::with('level')->get();
    //     return view('user', ['data' => $user]);
    // }
}