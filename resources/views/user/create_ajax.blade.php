user_ajax.blade.php
<form action="{{ url('/user/ajax') }}" method="POST" id="form-tambah">
    @csrf
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Level Pengguna</label>
                    <select name="level_id" id="level_id" class="form-control" required>
                        <option value="">- Pilih Level -</option>
                        @foreach($level as $l)
                            <option value="{{ $l->level_id }}">{{ $l->level_nama }}</option>
                        @endforeach
                    </select>
                    <small id="error-level_id" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" id="username" class="form-control" required>
                    <small id="error-username" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="nama" id="nama" class="form-control" required>
                    <small id="error-nama" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label for="user_profile">Foto Profil</label>
                    <input type="file" class="form-control" id="user_profile" name="user_profile">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                    <small id="error-password" class="error-text form-text text-danger"></small>
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
$(document).ready(function () {
    $('#form-tambah').validate({
        rules: {
            name: {
                required: true
            },
            username: {
                required: true
            },
            password: {
                required: true
            }
        },
        messages: {
            name: {
                required: "Nama harus diisi"
            },
            username: {
                required: "Username harus diisi"
            },
            password: {
                required: "Password harus diisi"
            }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        submitHandler: function (form) {
            // Tambahkan log untuk memastikan submitHandler terpanggil
            console.log('Submit handler triggered');
            
            // Perubahan kecil untuk ajax request
            $.ajax({
                type: "POST",
                url: "/user/ajax", // Pastikan URL endpoint benar
                data: $(form).serialize(), // Serialisasi data form
                dataType: "json",
                success: function (response) {
                    // Tambahkan log untuk memastikan respon diterima
                    console.log('Response received:', response);
                    if (response.success) {
                        // Jika berhasil, bisa lakukan sesuatu
                        alert("Data berhasil disimpan!");
                        // Refresh atau redirect sesuai kebutuhan
                    } else {
                        // Jika terjadi error
                        alert("Gagal menyimpan data.");
                    }
                },
                error: function (xhr, status, error) {
                    // Tangani error jika request ajax gagal
                    console.log('Error occurred:', xhr, status, error);
                    alert("Terjadi kesalahan saat menyimpan data.");
                }
            });
        }
    });
});
</script>