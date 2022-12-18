@extends('layout.main')
@section('content')
    <br>
    <div class="content-wrapper">
        <div class="card">
            <div class="card-header">
                <h4>Data Dependent DropDown</h4>
                <div class="card-header-action">
                    <a class="btn btn-primary" href="javascript:void(0)" id="create" style="float: left">Tambah</a>
                </div>
            </div>
            <div class="card-body card-responsive">
                <div style="overflow-x:auto;">
                    <table class="table table-bordered data-table" id="data-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Provinsi</th>
                                <th>Kabupaten</th>
                                <th>kecamatan</th>
                                <th>kelurahan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@include('Dropdown.modal')
@push('javascript-internal')
    {{-- Create --}}
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var table = $(".data-table").DataTable({
            severSide: true,
            processing: true,
            ajax: "{{ route('Dependent.index') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'id_provinsi',
                    render: function(data, type, full, meta) {
                        console.log(full.data_provinsi)
                        console.log(meta)
                        return full.data_provinsi.nama;
                    }
                },
                {
                    data: 'id_kabkota',
                    render: function(data, type, full, meta) {
                        console.log(full.data_kabkota)
                        console.log(meta)
                        return full.data_kabkota.nama;
                    }
                },
                {
                    data: 'id_kecamatan',
                    render: function(data, type, full, meta) {
                        console.log(full.data_kecamatan)
                        console.log(meta)
                        return full.data_kecamatan.nama;
                    }
                },
                {
                    data: 'id_keldes',
                    render: function(data, type, full, meta) {
                        console.log(full.data_keldes)
                        console.log(meta)
                        return full.data_keldes.nama;
                    }
                },
                {
                    data: 'action',
                    name: 'action'
                }
            ]
        });


        //menampilkan form create
        $("#create").click(function() {
            $("#id").val('');
            $("#DependentCreate").trigger("reset");
            $('#kabupaten').empty();
            $('#kecamatan').empty();
            $('#kelurahan').empty();
            $("#modalHeading").html("Tambah Dependent");
            $('#ajaxModel').modal('show');
            // $('#kabupaten').empty();

        });



        //Tambah
        var create = "{{ route('Dependent.store') }}"
        var back = "{{ route('Dependent.index') }}"
        $('body').on('submit', '#DependentCreate', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Apakah anda Yakin?',
                text: "Data Akan Ditambahkan",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                confirmButtonText: 'Konfirmasi'
            }).then((result) => {
                if (result.isConfirmed) {
                    var actionType = $('#saveBtn').val();
                    $('#saveBtn').html('Memproses..');
                    var formData = new FormData(this);
                    $.ajax({
                        type: 'POST',
                        url: create,
                        enctype: "multipart/form-data",
                        dataType: "json",
                        encode: true,
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: (data) => {
                            $('#saveBtn').html('Save');
                            var oTable = $('#data-table');
                            oTable.DataTable().ajax.reload();
                            $('#FormCreate').trigger("reset");
                            $('#ajaxModel').modal('hide');
                            Swal.fire(
                                'Berhasil',
                                'Data Berhasil Di Simpan',
                                'success'
                            );
                        },
                        error: function(data) {
                            console.log('Error:', data);
                            $('#saveBtn').html('Gagal Disimpan');
                            Swal.fire(
                                'Error',
                                'Data Gagal Di Simpan',
                                'error'
                            );
                        }
                    });
                }
            });
        });

        //Menampilkan Form edit
        $('body').on('click', '#edit', function() {
            var id = $(this).data('id');
            $.get("{{ route('Dependent.index') }}" +
                "/" +
                id + "/edit",
                function(data) {
                    $("#modalHeading1").html("Edit Dependent");
                    $('#ajaxModel1').modal('show')
                    $("#id_dependent").val(data.id);
                    $("#nama").val(data.nama);
                    $("#id_provinsi").val(data.id_provinsi).attr('selected',
                        'selected');
                    $("#id_kabupaten").val(data.id_kabupaten).attr('selected',
                        'selected');
                    var id_provinsi = data.id_provinsi;
                    var id_kabkota = data.id_kabkota;
                    var id_kecamatan = data.id_kecamatan;
                    var id_keldes = data.id_keldes;
                    if (id_provinsi) {
                        $.ajax({
                            url: '/Kabupaten/' + id_provinsi,
                            type: "GET",
                            data: {
                                "_token": "{{ csrf_token() }}"
                            },
                            dataType: "json",
                            success: function(data) {
                                if (data) {
                                    $('#id_kabupaten').append(
                                        '<option hidden>Pilih Kota/Kabupaten</option>'
                                    );
                                    $('#id_kabupaten').empty();
                                    $.each(data, function(key, kabkotas) {

                                        $('select[name="id_kabkota"]').append(
                                            `<option value="` + kabkotas
                                            .id + `" ` + (kabkotas.id ==
                                                id_kabkota ? 'selected' : ''
                                            ) + `>` +
                                            kabkotas.nama + `</option>`);
                                    });
                                }
                            }
                        });
                    }
                    if (id_kabkota) {
                        $.ajax({
                            url: '/Kecamatan/' + id_kabkota,
                            type: "GET",
                            data: {
                                "_token": "{{ csrf_token() }}"
                            },
                            dataType: "json",
                            success: function(data) {
                                if (data) {
                                    $('#id_kecamatan').empty();
                                    $('#id_kelurahan').empty();
                                    $('#id_kecamatan').append(
                                        '<option hidden>Pilih Kota/kecamatan</option>'
                                    );
                                    $.each(data, function(key, kecamatans) {

                                        $('select[name="id_kecamatan"]').append(
                                            `<option value="` + kecamatans
                                            .id + `" ` + (kecamatans.id ==
                                                id_kecamatan ? 'selected' :
                                                ''
                                            ) + `>` +
                                            kecamatans.nama + `</option>`);
                                    });
                                }
                            }
                        });
                    }
                    if (id_kecamatan) {
                        $.ajax({
                            url: '/Kelurahaan/' + id_kecamatan,
                            type: "GET",
                            data: {
                                "_token": "{{ csrf_token() }}"
                            },
                            dataType: "json",
                            success: function(data) {
                                if (data) {
                                    $('#id_kelurahan').empty();
                                    $('#id_kelurahan').append(
                                        '<option hidden>Pilih Kota/kelurahan</option>'
                                    );
                                    $.each(data, function(key, keldes) {

                                        $('select[name="id_keldes"]').append(
                                            `<option value="` + keldes
                                            .id + `" ` + (keldes.id ==
                                                id_keldes ? 'selected' :
                                                ''
                                            ) + `>` +
                                            keldes.nama + `</option>`);
                                    });
                                } else {
                                    $('#id_kelurahan').empty();
                                }
                            }
                        });
                    }
                });
        });


        //Aksi Update
        var update = "{{ route('Dependents.update') }}"
        var back = "{{ route('Dependent.index') }}"
        $('body').on('submit', '#DependentUpdate', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Apakah anda Yakin?',
                text: "Data Akan Di Edit",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                confirmButtonText: 'Konfirmasi'
            }).then((result) => {
                if (result.isConfirmed) {
                    var actionType = $('#saveBtn1').val();
                    $('#saveBtn1').html('Memproses..');
                    $("#saveBtn1").attr("disabled", true);
                    var formData = new FormData(this);
                    $.ajax({
                        type: 'POST',
                        url: update,
                        enctype: "multipart/form-data",
                        dataType: "json",
                        encode: true,
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: (data) => {
                            $('#saveBtn1').html('Save');
                            var oTable = $('#data-table');
                            oTable.DataTable().ajax.reload();
                            $('#FormUpdate').trigger("reset");
                            $('#ajaxModel1').modal('hide');
                            Swal.fire(
                                'Berhasil',
                                'Data Berhasil Di Update',
                                'success'
                            );
                            $("#saveBtn1").attr("disabled", false);
                        },
                        error: function(data) {
                            console.log('Error:', data);
                            $('#saveBtn1').html('Gagal Di Update');
                            Swal.fire(
                                'Error',
                                'Data Gagal Di Update',
                                'error'
                            );
                            $("#saveBtn1").attr("disabled", false);
                        }
                    });
                }
            });
        });

        //Delete
        $('body').on('click', '#delete', function() {
            let id = $(this).data("id");
            Swal.fire({
                title: 'Apakah anda Yakin?',
                text: "Data akan dihapus secara permanen",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                confirmButtonText: 'Hapus'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "DELETE",
                        url: `Dependent/${id}/delete`,
                        success: function(data) {
                            var oTable = $('#data-table');
                            oTable.DataTable().ajax.reload();
                            Swal.fire(
                                'Berhasil',
                                'Data Berhasil Dihapus',
                                'success'
                            );
                        },
                        error: function(data) {
                            console.log('Error:', data);
                            Swal.fire(
                                'Error',
                                'Data Gagal Dihapus',
                                'error'
                            );
                        }
                    });
                }
            });
        });
        //Kabupaten
        $('#provinsi').on('change', function() {
            var id_provinsi = $(this).val();
            if (id_provinsi) {
                $.ajax({
                    url: '/Kabupaten/' + id_provinsi,
                    type: "GET",
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    dataType: "json",
                    success: function(data) {
                        if (data) {
                            $('#kabupaten').empty();
                            $('#kecamatan').empty();
                            $('#kelurahan').empty();
                            $('#kabupaten').append(
                                '<option hidden>Pilih Kota/Kabupaten</option>');
                            $.each(data, function(key, kabkotas) {

                                $('select[name="id_kabkota"]').append(
                                    '<option value="' + kabkotas.id + '">' +
                                    kabkotas.nama + '</option>');
                            });
                        } else {
                            $('#kabupaten').empty();
                        }
                    }
                });
            } else {
                $('#kabupaten').empty();
            }
        });
        //Kecamatan
        $('#kabupaten').on('change', function() {
            var id_kabkota = $(this).val();
            if (id_kabkota) {
                $.ajax({
                    url: '/Kecamatan/' + id_kabkota,
                    type: "GET",
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    dataType: "json",
                    success: function(data) {
                        if (data) {
                            $('#kecamatan').empty();
                            $('#kelurahan').empty();
                            $('#kecamatan').append(
                                '<option hidden>Pilih Kota/kecamatan</option>');
                            $.each(data, function(key, kecamatans) {

                                $('select[name="id_kecamatan"]').append(
                                    '<option value="' + kecamatans.id + '">' +
                                    kecamatans.nama + '</option>');
                            });
                        } else {
                            $('#kecamatan').empty();
                        }
                    }
                });
            } else {
                $('#kecamatan').empty();
            }
        });
        //Keldes
        $('#kecamatan').on('change', function() {
            var id_kecamatan = $(this).val();
            if (id_kecamatan) {
                $.ajax({
                    url: '/Kelurahaan/' + id_kecamatan,
                    type: "GET",
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    dataType: "json",
                    success: function(data) {
                        if (data) {
                            $('#kelurahan').empty();
                            $('#kelurahan').append(
                                '<option hidden>Pilih Kota/kelurahan</option>');
                            $.each(data, function(key, keldes) {

                                $('select[name="id_keldes"]').append(
                                    '<option value="' + keldes.id + '">' +
                                    keldes.nama + '</option>');
                            });
                        } else {
                            $('#kelurahan').empty();
                        }
                    }
                });
            } else {
                $('#kelurahan').empty();
            }
        });





        $('#id_provinsi').on('change', function() {
            var id_provinsi = $(this).val();
            if (id_provinsi) {
                $.ajax({
                    url: '/Kabupaten/' + id_provinsi,
                    type: "GET",
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    dataType: "json",
                    success: function(data) {
                        if (data) {
                            // $("#id_kabupaten").prop('disabled', false);
                            // $("#test").remove();
                            $('#id_kabupaten').empty();
                            $('#id_kecamatan').empty();
                            $('#id_kelurahan').empty();
                            $('#id_kabupaten').append(
                                '<option hidden>Pilih Kota/Kabupaten</option>');
                            $.each(data, function(key, kabkotas) {

                                $('select[name="id_kabkota"]').append(
                                    '<option value="' + kabkotas.id + '">' +
                                    kabkotas.nama + '</option>');
                            });
                        } else {
                            $('#id_kabupaten').empty();
                        }
                    }
                });
            } else {
                $('#id_kabupaten').empty();
            }
        });
        //Kecamatan
        $('#id_kabupaten').on('change', function() {
            var id_kabkota = $(this).val();
            if (id_kabkota) {
                $.ajax({
                    url: '/Kecamatan/' + id_kabkota,
                    type: "GET",
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    dataType: "json",
                    success: function(data) {
                        if (data) {
                            $('#id_kecamatan').empty();
                            $('#id_kelurahan').empty();
                            $('#id_kecamatan').append(
                                '<option hidden>Pilih Kota/kecamatan</option>');
                            $.each(data, function(key, kecamatans) {

                                $('select[name="id_kecamatan"]').append(
                                    '<option value="' + kecamatans.id + '">' +
                                    kecamatans.nama + '</option>');
                            });
                        } else {
                            $('#id_kecamatan').empty();
                        }
                    }
                });
            } else {
                $('#id_kecamatan').empty();
            }
        });
        //Keldes
        $('#id_kecamatan').on('change', function() {
            var id_kecamatan = $(this).val();
            if (id_kecamatan) {
                $.ajax({
                    url: '/Kelurahaan/' + id_kecamatan,
                    type: "GET",
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    dataType: "json",
                    success: function(data) {
                        if (data) {
                            $('#id_kelurahan').empty();
                            $('#id_kelurahan').append(
                                '<option hidden>Pilih Kota/kelurahan</option>');
                            $.each(data, function(key, keldes) {

                                $('select[name="id_keldes"]').append(
                                    '<option value="' + keldes.id + '">' +
                                    keldes.nama + '</option>');
                            });
                        } else {
                            $('#id_kelurahan').empty();
                        }
                    }
                });
            } else {
                $('#id_kelurahan').empty();
            }
        });
    </script>
    {{-- Edit --}}
@endpush
