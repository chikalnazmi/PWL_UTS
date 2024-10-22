@extends('layouts.template')
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Daftar Stok Barang</h3>
        <div class="card-tools">
            <button onclick="modalAction('{{ url('/stok/import') }}')" class="btn btn-info">Import Stok</button>
            <a href="{{ url('/stok/export_excel') }}" class="btn btn-primary"><i class="fa fa-file-excel"></i> Export Stok (Excel)</a>
            <a href="{{ url('/stok/export_pdf') }}" class="btn btn-warning"><i class="fa fa-file-pdf"></i> Export Stok (PDF)</a>
            <button onclick="modalAction('{{ url('/stok/create_ajax') }}')" class="btn btn-success">Tambah Stok (Ajax)</button>
        </div>
    </div>
    
    <div class="card-body">
        <!-- Filter Data -->
        <div id="filter" class="form-horizontal filter-date p-2 border-bottom mb-2">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group form-group-sm row text-sm mb-0">
                        <label for="filter" class="col-md-1 col-form-label">Filter</label>

                        <!-- Filter Supplier -->
                        <div class="col-md-3">
                            <select name="filter_supplier" class="form-control form-control-sm filter_supplier">
                                <option value="">- Semua Supplier -</option>
                                @foreach($supplier as $s)
                                    <option value="{{ $s->supplier_id }}">{{ $s->supplier_nama }}</option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">Supplier Barang</small>
                        </div>

                        <!-- Filter User -->
                        <div class="col-md-3">
                            <select name="filter_user" class="form-control form-control-sm filter_user">
                                <option value="">- Semua User -</option>
                                @foreach($user as $u)
                                    <option value="{{ $u->id }}">{{ $u->nama }}</option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">User</small>
                        </div>

                        <!-- Filter Barang -->
                        <div class="col-md-3">
                            <select name="filter_barang" class="form-control form-control-sm filter_barang">
                                <option value="">- Semua Barang -</option>
                                @foreach($barang as $b)
                                    <option value="{{ $b->barang_id }}">{{ $b->barang_nama }}</option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">Barang</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pesan Sukses dan Error -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <!-- Tabel Stok Barang -->
        <table class="table table-bordered table-sm table-striped table-hover" id="table-stok">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Supplier</th>
                    <th>User</th>
                    <th>Jumlah Stok</th>
                    <th>Tanggal Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade animate shake" tabindex="-1" data-backdrop="static" data-keyboard="false" data-width="75%"></div>
@endsection

@push('js')
<script>
    // Fungsi untuk menampilkan modal
    function modalAction(url = '') {
        $('#myModal').load(url, function() {
            $('#myModal').modal('show');
        });
    }

    var tableStok;
    $(document).ready(function() {
        // Inisialisasi DataTables
        tableStok = $('#table-stok').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ url('stok/list') }}", // Mengambil data dari stok controller
                dataType: "json",
                type: "POST",
                data: function(d) {
                    d.filter_supplier = $('.filter_supplier').val();
                    d.filter_user = $('.filter_user').val();
                    d.filter_barang = $('.filter_barang').val();
                }
            },
            columns: [
                {
                    data: "DT_RowIndex",
                    className: "text-center",
                    orderable: false,
                    searchable: false
                },
                {
                    data: "barang.barang_nama",
                    className: "",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "supplier.supplier_nama",
                    className: "",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "user.nama", // Pastikan data ini ada
                    className: "",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "stok_jumlah", // Pastikan nama field ini benar
                    className: "",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "stok_tanggal", // Pastikan nama field ini benar
                    className: "",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "aksi",
                    className: "",
                    orderable: false,
                    searchable: false
                } 
            ]
        });

        // Pencarian DataTables dengan tombol Enter
        $('#table-stok_filter input').unbind().bind().on('keyup', function(e) {
            if (e.keyCode == 13) { // Enter
                tableStok.search(this.value).draw();
            }
        });

        // Filter supplier, user, dan barang
        $('.filter_supplier, .filter_user, .filter_barang').change(function() {
            tableStok.draw(); // Memanggil ulang DataTables dengan filter baru
        });
    });
</script>
@endpush
