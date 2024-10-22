<?php

namespace App\Http\Controllers;

// use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\TransaksiModel;
use App\Models\UserModel;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Yajra\DataTables\Facades\DataTables;
use Barryvdh\DomPDF\Facade\Pdf;


class TransaksiController extends Controller
{
    
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar transaksi',
            'list' => ['Home', 'transaksi']
        ];

        $page = (object) [
            'title' => 'Daftar transaksi yang terdaftar dalam sistem'
        ];

        $activeMenu = 'transaksi'; // set menu yang sedang aktif
        $user = UserModel::all(); // ambil data user untuk filter user
        return view('transaksi.index', [
            'breadcrumb' => $breadcrumb, 
            'page' => $page, 
            'user' => $user,
            'activeMenu' => $activeMenu]);
    }

    public function list(Request $request)
    {
        $transaksis = TransaksiModel::select( 'fk_user_id', 'penjualan_kode', 'pembeli', 'penjualan_tanggal')
            ->with('user');

        // Filter data transaksi berdasarkan user_id
        if ($request->user_id) {
            $transaksis->where('fk_user_id', $request->user_id);
        }
        return DataTables::of($transaksis) // Pastikan $transaksis di sini
            ->addIndexColumn()
            ->addColumn('aksi', function ($transaksi) {
                // $btn = '<a href="' . url('/transaksi/' . $transaksi->transaksi_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                // $btn .= '<button onclick="modalAction(\'' . url('/transaksi/' . $transaksi->transaksi_id . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                // $btn .= '<button onclick="modalAction(\'' . url('/transaksi/' . $transaksi->transaksi_id . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';
                // return $btn;
                $btn = '<button onclick="modalAction(\''.url('/transaksi/' . $transaksi->transaksi_id. '/show_ajax').'\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\''.url('/transaksi/' . $transaksi->transaksi_id . '/edit_ajax').'\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\''.url('/transaksi/' . $transaksi->transaksi_id . '/delete_ajax').'\')" class="btn btn-danger btn-sm">Hapus</button> ';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah transaksi',
            'list' => ['Home', 'transaksi', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah transaksi baru'
        ];

        $user = UserModel::all(); 
        $activeMenu = 'transaksi'; 

        return view('transaksi.create', [
            'breadcrumb' => $breadcrumb, 
            'page' => $page, 
            'user' => $user, 
            'activeMenu' => $activeMenu]);
    }

    public function store(Request $request)
    {
        $request->validate([

            'fk_user_id' => 'required|integer',
            'penjualan_kode' => 'required|string|max:10|unique:t_penjualan,penjualan_kode',
            'pembeli' => 'required|string', 
            'penjualan_tanggal' => 'required|string'

        ]);

        TransaksiModel::create([
            'fk_user_id' => $request->fk_user_id,
            'penjualan_kode' => $request->penjualan_kode,
            'pembeli' => $request->pembeli,
            'penjualan_tanggal' => $request->penjualan_tanggal,
            
        ]);
        return redirect('/transaksi')->with('success', 'Data transaksi berhasil disimpan');
    }
    
    public function show(string $id)
    {
        $transaksi = TransaksiModel::with('user')->find($id);
        $breadcrumb = (object) ['title' => 'Detail transaksi', 'list' => ['Home', 'transaksi', 'Detail']];
        $page = (object) ['title' => 'Detail transaksi'];
        $activeMenu = 'transaksi'; // set menu yang sedang aktif
        return view('transaksi.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'transaksi' => $transaksi, 'activeMenu' => $activeMenu]);
    }

    // Menampilkan halaman form edit transaksi
    public function edit(string $id)
    {
        $transaksi = TransaksiModel::find($id);

        $user = UserModel::all();

        $breadcrumb = (object) [
            'title' => 'Edit transaksi',
            'list' => ['Home', 'transaksi', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit transaksi'
        ];

        $activeMenu = 'transaksi'; // set menu yang sedang aktif

        return view('transaksi.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'transaksi' => $transaksi, 'user' => $user, 'activeMenu' => $activeMenu]);
    }

    // Menyimpan perubahan data transaksi
    public function update(Request $request, string $id)
{
    $request->validate([
        'penjualan_kode' => 'required|string|max:10',
        'transaksi_nama' => 'required|string|max:100',
        'fk_user_id' => 'required|integer',
        'harga_jual' => 'required|integer',
        'harga_beli' => 'required|integer'
    ]);

    // Update data transaksi
    $transaksi = TransaksiModel::find($id);
    if (!$transaksi) {
        return redirect('/transaksi')->with('error', 'Data transaksi tidak ditemukan');
    }

    $transaksi->update([
        'penjualan_kode' => $request->penjualan_kode,
        'transaksi_nama' => $request->transaksi_nama,
        'fk_user_id' => $request->fk_user_id,
        'harga_jual' => $request->harga_jual,
        'harga_beli' => $request->harga_beli
    ]);

    return redirect('/transaksi')->with('success', 'Data transaksi berhasil diubah');
    }

    // Menghapus data transaksi
    public function destroy(string $id)
    {
        $check = TransaksiModel::find($id);

        if (!$check) {
            // untuk mengecek apakah data transaksi dengan id yang dimaksud ada atau tidak
            return redirect('/transaksi')->with('error', 'Data transaksi tidak ditemukan');
        }

        try {
            TransaksiModel::destroy($id); // Hapus data user

            return redirect('/transaksi')->with('success', 'Data transaksi berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            // Jika terjadi error ketika menghapus data, redirect kembali ke halaman dengan membawa pesan error
            return redirect('/transaksi')->with('error', 'Data transaksi gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
    public function show_ajax(string $id)
    {
        $transaksi = TransaksiModel::with('user')->find($id);

        return view('transaksi.show_ajax', ['transaksi' => $transaksi]);
    }
    public function create_ajax()
    {
        $user = UserModel::select('user_id', 'user_nama')->get();
        return view('transaksi.create_ajax')
            ->with('user', $user);
    }
    public function store_ajax(Request $request)
    {
        // cek apakah request berupa ajax
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'fk_user_id'   => 'required|integer', // Menggunakan fk_user_id
                'penjualan_kode'      => 'required|string|max:10|unique:m_transaksi,penjualan_kode',
                'transaksi_nama'      => 'required|string|max:100',
                'harga_beli'       => 'required|integer',
                'harga_jual'       => 'required|integer',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status'    => false,
                    'message'   => 'Validasi Gagal',
                    'msgField'  => $validator->errors(),
                ]);
            }
            TransaksiModel::create($request->all());
            return response()->json([
                'status'    => true,
                'message'   => 'Data transaksi berhasil disimpan'
            ]);
        }
        redirect('/');
    }
    public function edit_ajax($id)
    {
    $transaksi = TransaksiModel::find($id);
    $user = UserModel::select('user_id', 'user_nama')->get();
    return view('transaksi.edit_ajax', ['transaksi' => $transaksi, 'user' => $user]);
    }

    public function update_ajax(Request $request, $id)
    {
        // cek apakah request dari ajax
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'fk_user_id'   => 'required|integer', // Menggunakan fk_user_id
                'penjualan_kode'      => 'required|string|max:10',
                'transaksi_nama'      => 'required|string|max:100', 
                'harga_beli'       => 'required|integer',
                'harga_jual'       => 'required|integer',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi gagal.',
                    'msgField' => $validator->errors()
                ]);
            }
            $check = TransaksiModel::find($id);
            if ($check) {
                $check->update($request->all());
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
        return redirect('/');
    }
    public function confirm_ajax(string $id)
    {
        $transaksi = TransaksiModel::find($id);
        return view('transaksi.confirm_ajax', ['transaksi' => $transaksi]);
    }

    public function delete_ajax(Request $request, $id)
    {
        // cek apakah request dari ajax
        if ($request->ajax() || $request->wantsJson()) {
            $transaksi = TransaksiModel::find($id);
            if ($transaksi) {
                $transaksi->delete();
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
        return redirect('/');
    }
    public function import()
    {
        return view('transaksi.import');
    }
    public function import_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                // validasi file harus xls atau xlsx, max 1MB
                'file_transaksi' => ['required', 'mimes:xlsx', 'max:1024']
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors()
                ]);
            }
            $file = $request->file('file_transaksi'); // ambil file dari request
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
                            'fk_user_id' => $value['A'],
                            'penjualan_kode' => $value['B'],
                            'transaksi_nama' => $value['C'],
                            'harga_beli' => $value['D'],
                            'harga_jual' => $value['E'],
                            'created_at' => now(),
                        ];
                    }
                }
                if (count($insert) > 0) {
                    // insert data ke database, jika data sudah ada, maka diabaikan
                    TransaksiModel::insertOrIgnore($insert);
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
        // ambil data transaksi yang akan di export
        $transaksi = TransaksiModel::select('fk_user_id', 'penjualan_kode', 'transaksi_nama', 'harga_beli', 'harga_jual')
            ->orderBy('fk_user_id')
            ->with('user')
            ->get();
        // load library excel
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet(); // ambil sheet yang aktif
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Kode transaksi');
        $sheet->setCellValue('C1', 'Nama transaksi');
        $sheet->setCellValue('D1', 'Harga Beli');
        $sheet->setCellValue('E1', 'Harga Jual');
        $sheet->setCellValue('F1', 'user');
        $sheet->getStyle('A1:F1')->getFont()->setBold(true); // bold header
        $no = 1; // nomor data dimulai dari 1
        $baris = 2; // baris data dimulai dari baris ke 2
        foreach ($transaksi as $key => $value) {
            $sheet->setCellValue('A' . $baris, $no);
            $sheet->setCellValue('B' . $baris, $value->penjualan_kode);
            $sheet->setCellValue('C' . $baris, $value->transaksi_nama);
            $sheet->setCellValue('D' . $baris, $value->harga_beli);
            $sheet->setCellValue('E' . $baris, $value->harga_jual);
            $sheet->setCellValue('F' . $baris, $value->user->user_nama); // ambil nama user
            $baris++;
            $no++;
        }
        foreach (range('A', 'F') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true); // set auto size untuk kolom
        }
        
        $sheet->setTitle('Data transaksi'); // set title sheet
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $filename = 'Data transaksi ' . date('Y-m-d H:i:s') . '.xlsx';
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
        $transaksi = TransaksiModel::select('fk_user_id', 'penjualan_kode', 'transaksi_nama', 'harga_beli', 'harga_jual')
                                                                                                ->orderBy('fk_user_id')
                                                                                                ->orderBy('penjualan_kode')
                                                                                                ->with('user')
                                                                                                ->get();
    
        // use Barryvdh\DomPDF\Facade\Pdf;
        $pdf = Pdf::loadView('transaksi.export_pdf', ['transaksi' => $transaksi]);
    
        $pdf->setPaper('a4', 'portrait'); // set ukuran kertas dan orientasi
        $pdf->setOption("isRemoteEnabled", true); // set true jika ada gambar dari uri
        $pdf->render();
    
        return $pdf->stream('Data transaksi '.date('Y-m-d H:i:s').'.pdf');
    }    
}