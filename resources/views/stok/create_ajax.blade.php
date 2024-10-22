<form action="{{ url('/stok/ajax') }}" method="POST" id="form-tambah" enctype="multipart/form-data">
    @csrf
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Stok Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>User</label>
                    <select name="fk_user_id" id="fk_user_id" class="form-control" required>
                        <option value="">- Pilih User -</option>
                        @foreach ($user as $l)
                            <option value="{{ $l->fk_user_id }}">{{ $l->nama}} </option>
                        @endforeach
                    </select>
                    <small id="error-fk_user_id" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Supplier</label>
                    <select name="fk_supplier_id" id="fk_supplier_id" class="form-control" required>
                        <option value="">- Pilih Supplier -</option>
                        @foreach ($supplier as $l)
                            <option value="{{ $l->fk_supplier_id }}">{{ $l->supplier->supplier_nama }}</option>
                        @endforeach
                    </select>
                    <small id="error-fk_supplier_id" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Barang</label>
                    <select name="fk_barang_id" id="fk_barang_id" class="form-control" required>
                        <option value="">- Pilih Barang -</option>
                        @foreach ($barang as $l)
                            <option value="{{ $l->fk_barang_id }}">{{ $l->barang->barang_nama}}</option>
                        @endforeach
                    </select>
                    <small id="error-fk_barang_id" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Stok Tanggal</label>
                    <div class="col-11">
                        <input type="datetime-local" class="form-control" id="stok_tanggal" name="stok_tanggal" required>
                        <small id="error-stok_tanggal" class="error-text form-text text-danger"></small>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Stok Jumlah</label>
                    <div class="col-11">
                        <input type="text" class="form-control" id="stok_jumlah" name="stok_jumlah" required>
                        <small id="error-stok_jumlah" class="error-text form-text text-danger"></small>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-warning">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</form>

<script>
    $(document).ready(function() {
        $("#form-tambah").validate({
            rules: {
                fk_supplier_id: {
                        required: true,
                        number: true
                    },
                    fk_barang_id: {
                        required: true,
                        number: true
                    },
                    fk_user_id: {
                        required: true,
                        number: true
                    },
                    stok_tanggal: {
                        required: true,
                    },
                    stok_jumlah: {
                        required: true
                    }
            },
            submitHandler: function(form) {
            var formData = new FormData(form); // Gunakan FormData untuk file upload

            $.ajax({
                url: form.action,
                type: form.method,
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.status) {
                        // Menampilkan notifikasi berhasil
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.message
                        }).then(function() {
                            // Reload halaman atau update data setelah Swal ditutup
                            if (typeof dataStok !== 'undefined') {
                                dataStok.ajax.reload(); // Reload data table jika ada
                            } else {
                                location.reload(); // Reload halaman jika tidak ada dataStok
                            }
                        });
                    } else {
                        // Menampilkan error dari validasi field
                        $('.error-text').text('');
                        $.each(response.msgField, function(prefix, val) {
                            $('#error-' + prefix).text(val[0]);
                        });

                        Swal.fire({
                            icon: 'error',
                            title: 'Terjadi Kesalahan',
                            text: response.message
                        });
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Terjadi kesalahan. Silakan coba lagi nanti.'
                    });
                }
            });
            return false;
        },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>
