<?php

namespace App\Http\Controllers;

// use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\StokModel;
use App\Models\SupplierModel;
use App\Models\UserModel;
use App\Models\BarangModel;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Yajra\DataTables\Facades\DataTables;
use Barryvdh\DomPDF\Facade\Pdf;


class StokController extends Controller
{
    
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Stok',
            'list' => ['Home', 'Stok']
        ];

        $page = (object) [
            'title' => 'Daftar stok yang terdaftar dalam sistem'
        ];

        $activeMenu = 'stok'; // Set menu yang sedang aktif

        // Ambil data dari model
        $supplier = SupplierModel::all();
        $barang = BarangModel::all();
        $user = UserModel::all(); 

        // Kirim semua data yang diperlukan ke view
        return view('stok.index', [
            'breadcrumb' => $breadcrumb, 
            'page' => $page, 
            'supplier' => $supplier,
            'barang' => $barang, // Tambahkan barang ke view
            'user' => $user,     // Tambahkan user ke view
            'activeMenu' => $activeMenu
        ]);
    }


    public function list(Request $request)
    {
        $stoks = StokModel::select('stok_id', 'stok_tanggal', 'stok_jumlah', 'fk_supplier_id', 'fk_barang_id', 'fk_user_id')
            ->with('supplier', 'barang', 'user');
        
            
        // Filter data stok berdasarkan supplier_id
        if ($request->supplier_id) {
            $stoks->where('fk_supplier_id', $request->supplier_id);
        }
        
        // Filter data stok berdasarkan barang_id
        if ($request->barang_id) {
            $stoks->where('fk_barang_id', $request->barang_id);
        }

        // Filter data stok berdasarkan user_id
        if ($request->user_id) {
            $stoks->where('fk_user_id', $request->user_id);
        }
        return DataTables::of($stoks) // Pastikan $stoks di sini
            ->addIndexColumn()
            ->addColumn('aksi', function ($stok) {
                // $btn = '<a href="' . url('/stok/' . $stok->stok_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                // $btn .= '<button onclick="modalAction(\'' . url('/stok/' . $stok->stok_id . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                // $btn .= '<button onclick="modalAction(\'' . url('/stok/' . $stok->stok_id . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';
                // return $btn;
                $btn = '<button onclick="modalAction(\''.url('/stok/' . $stok->stok_id. '/show_ajax').'\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\''.url('/stok/' . $stok->stok_id . '/edit_ajax').'\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\''.url('/stok/' . $stok->stok_id . '/delete_ajax').'\')" class="btn btn-danger btn-sm">Hapus</button> ';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah stok',
            'list' => ['Home', 'stok', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah stok baru'
        ];

        $supplier = SupplierModel::all();
        $barang = BarangModel::all();
        $user = UserModel::all(); 
        $activeMenu = 'stok'; 

        return view('stok.create', [
            'breadcrumb' => $breadcrumb, 
            'page' => $page, 
            'supplier' => $supplier, 
            'activeMenu' => $activeMenu]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'stok_tanggal' => 'required|string|max:10|unique:m_stok,stok_tanggal',
            'stok_jumlah' => 'required|string|max:100',
            'fk_supplier_id' => 'required|integer',
            'fk_barang_id' => 'required|integer',
            'fk_user_id' => 'required|integer'

        ]);

        StokModel::create([
            'stok_tanggal' => $request->stok_tanggal,
            'stok_jumlah' => $request->stok_jumlah,
            'fk_supplier_id' => $request->fk_supplier_id,
            'fk_barang_id' => $request->fk_barang_id,
            'fk_user_id' => $request->fk_user_id
        ]);
        return redirect('/stok')->with('success', 'Data stok berhasil disimpan');
    }
    
    public function show(string $id)
    {
        $stok = StokModel::with('supplier')->find($id);

        $breadcrumb = (object) [
            'title' => 'Detail stok',
            'list' => ['Home', 'stok', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail stok'
        ];

        $activeMenu = 'stok'; // set menu yang sedang aktif

        return view('stok.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'stok' => $stok, 'activeMenu' => $activeMenu]);
    }

    // Menampilkan halaman form edit stok
    public function edit(string $id)
    {
        $stok = StokModel::find($id);

        $supplier = SupplierModel::all();
        $barang = BarangModel::all();
        $user = UserModel::all();

        $breadcrumb = (object) [
            'title' => 'Edit stok',
            'list' => ['Home', 'stok', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit stok'
        ];

        $activeMenu = 'stok'; // set menu yang sedang aktif

        return view('stok.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'stok' => $stok, 'supplier' => $supplier, 'activeMenu' => $activeMenu]);
    }

    // Menyimpan perubahan data stok
    public function update(Request $request, string $id)
{
    $request->validate([
        'stok_tanggal' => 'required|string|max:10',
        'stok_jumlah' => 'required|string|max:100',
        'fk_supplier_id' => 'required|integer',
        'fk_barang_id' => 'required|integer',
        'fk_user_id' => 'required|integer'
    ]);

    // Update data stok
    $stok = StokModel::find($id);
    if (!$stok) {
        return redirect('/stok')->with('error', 'Data stok tidak ditemukan');
    }

    $stok->update([
        'stok_tanggal' => $request->stok_tanggal,
        'stok_jumlah' => $request->stok_jumlah,
        'fk_supplier_id' => $request->fk_supplier_id,
        'fk_barang_id' => $request->fk_barang_id,
        'fk_user_id' => $request->fk_user_id
    ]);

    return redirect('/stok')->with('success', 'Data stok berhasil diubah');
    }

    // Menghapus data stok
    public function destroy(string $id)
    {
        $check = StokModel::find($id);

        if (!$check) {
            // untuk mengecek apakah data stok dengan id yang dimaksud ada atau tidak
            return redirect('/stok')->with('error', 'Data stok tidak ditemukan');
        }

        try {
            StokModel::destroy($id); // Hapus data supplier

            return redirect('/stok')->with('success', 'Data stok berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            // Jika terjadi error ketika menghapus data, redirect kembali ke halaman dengan membawa pesan error
            return redirect('/stok')->with('error', 'Data stok gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
    public function create_ajax()
    {
        $supplier = SupplierModel::select('supplier_id', 'supplier_nama')->get();
        $barang = BarangModel::select('barang_id', 'barang_nama')->get();
        $user = UserModel::select('user_id', 'nama')->get();
        return view('stok.create_ajax')
            ->with('supplier', $supplier)
            ->with('barang', $barang)
            ->with('user', $user);
    }
    public function store_ajax(Request $request)
    {
        // cek apakah request berupa ajax
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'fk_supplier_id'   => 'required|integer', // Menggunakan fk_supplier_id
                'stok_tanggal'      => 'required|string|max:10|unique:m_stok,stok_tanggal',
                'stok_jumlah'      => 'required|string|max:100',
                'fk_user_id'       => 'required|integer',
                'fk_barang_id'       => 'required|integer',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status'    => false,
                    'message'   => 'Validasi Gagal',
                    'msgField'  => $validator->errors(),
                ]);
            }
            StokModel::create($request->all());
            return response()->json([
                'status'    => true,
                'message'   => 'Data stok berhasil disimpan'
            ]);
        }
        redirect('/');
    }
    public function edit_ajax($id)
{
    $stok = StokModel::find($id);
    if (!$stok) {
        return response()->json(['status' => false, 'message' => 'Data tidak ditemukan']);
    }

    $supplier = SupplierModel::select('supplier_id', 'supplier_nama')->get();
    $barang = BarangModel::select('barang_id', 'barang_nama')->get();
    $user = UserModel::select('user_id', 'nama')->get();
    
    return view('stok.edit_ajax', [
        'stok' => $stok,
        'supplier' => $supplier,
        'barang' => $barang,
        'user' => $user
    ]);


    }

    public function update_ajax(Request $request, $id)
    {
        // cek apakah request dari ajax
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'fk_supplier_id'   => 'required|integer', // Menggunakan fk_supplier_id
                'stok_tanggal'      => 'required|string|max:10',
                'stok_jumlah'      => 'required|string|max:100', 
                'fk_user_id'       => 'required|integer',
                'fk_barang_id'       => 'required|integer',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi gagal.',
                    'msgField' => $validator->errors()
                ]);
            }
            $check = StokModel::find($id);
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
        $stok = StokModel::find($id);
        return view('stok.confirm_ajax', ['stok' => $stok]);
    }

    public function delete_ajax(Request $request, $id)
    {
        // cek apakah request dari ajax
        if ($request->ajax() || $request->wantsJson()) {
            $stok = StokModel::find($id);
            if ($stok) {
                $stok->delete();
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
        return view('stok.import');
    }
    public function import_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                // validasi file harus xls atau xlsx, max 1MB
                'file_stok' => ['required', 'mimes:xlsx', 'max:1024']
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors()
                ]);
            }
            $file = $request->file('file_stok'); // ambil file dari request
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
                            'fk_supplier_id' => $value['A'],
                            'stok_tanggal' => $value['B'],
                            'stok_jumlah' => $value['C'],
                            'fk_user_id' => $value['D'],
                            'fk_barang_id' => $value['E'],
                            'created_at' => now(),
                        ];
                    }
                }
                if (count($insert) > 0) {
                    // insert data ke database, jika data sudah ada, maka diabaikan
                    StokModel::insertOrIgnore($insert);
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
        // ambil data stok yang akan di export
        $stok = StokModel::select('fk_supplier_id', 'stok_tanggal', 'stok_jumlah', 'fk_user_id', 'fk_barang_id')
            ->orderBy('fk_supplier_id')
            ->with('supplier')
            ->get();
        // load library excel
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet(); // ambil sheet yang aktif
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Kode stok');
        $sheet->setCellValue('C1', 'Nama stok');
        $sheet->setCellValue('D1', 'Harga Bel');
        $sheet->setCellValue('E1', 'Barang');
        $sheet->setCellValue('F1', 'Supplier');
        $sheet->getStyle('A1:F1')->getFont()->setBold(true); // bold header
        $no = 1; // nomor data dimulai dari 1
        $baris = 2; // baris data dimulai dari baris ke 2
        foreach ($stok as $key => $value) {
            $sheet->setCellValue('A' . $baris, $no);
            $sheet->setCellValue('B' . $baris, $value->stok_tanggal);
            $sheet->setCellValue('C' . $baris, $value->stok_jumlah);
            $sheet->setCellValue('D' . $baris, $value->fk_user_id);
            $sheet->setCellValue('E' . $baris, $value->fk_barang_id);
            $sheet->setCellValue('F' . $baris, $value->supplier->supplier_nama); // ambil nama supplier
            $baris++;
            $no++;
        }
        foreach (range('A', 'F') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true); // set auto size untuk kolom
        }
        
        $sheet->setTitle('Data stok'); // set title sheet
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $filename = 'Data stok ' . date('Y-m-d H:i:s') . '.xlsx';
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
        $stok = StokModel::select('fk_supplier_id', 'stok_tanggal', 'stok_jumlah', 'fk_user_id', 'fk_barang_id')
                                                                                                ->orderBy('fk_supplier_id')
                                                                                                ->orderBy('stok_tanggal')
                                                                                                ->with('supplier')
                                                                                                ->get();
    
        // use Barryvdh\DomPDF\Facade\Pdf;
        $pdf = Pdf::loadView('stok.export_pdf', ['stok' => $stok]);
    
        $pdf->setPaper('a4', 'portrait'); // set ukuran kertas dan orientasi
        $pdf->setOption("isRemoteEnabled", true); // set true jika ada gambar dari uri
        $pdf->render();
    
        return $pdf->stream('Data stok '.date('Y-m-d H:i:s').'.pdf');
    }    
}