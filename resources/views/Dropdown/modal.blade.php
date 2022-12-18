{{-- Modal Tambah --}}
<div style="overflow-x:auto;">
    <div class="modal fade" id="ajaxModel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalHeading"></h4>

                </div>
                <div class="modal-body">
                    
                    <form id="DependentCreate" name="DependentCreate">
                        <div class="form-group mb-3">
                            <input type="text" name="nama" value="" class="form-control" >
                        </div>
                        <div class="form-group mb-3">
                            <select  id="provinsi" name="id_provinsi" class="form-control">
                                <option value="">-- Pilih Provinsi --</option>
                                @foreach ($provinsis as $data)
                                <option  value="{{$data->id}}">
                                    {{$data->nama}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <select id="kabupaten" name="id_kabkota" class="form-control">
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <select id="kecamatan" name="id_kecamatan" class="form-control">
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <select id="kelurahan" name="id_keldes" class="form-control">
                            </select>
                        </div>
                        <br>
                        <button type="submit" id="saveBtn" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- Modal Edit --}}
<div style="overflow-x:auto;">
    <div class="modal fade" id="ajaxModel1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalHeading1"></h4>

                </div>
                <div class="modal-body">
                    <form id="DependentUpdate" name="DependentUpdate">
                        <div class="form-group mb-3">
                            <input type="hidden" name="id_dependent" id="id_dependent">
                            <input type="text" id="nama" name="nama" value="" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <select  id="id_provinsi" name="id_provinsi" class="form-control">
                                <option value="">-- Pilih Provinsi --</option>
                                @foreach ($provinsis as $data)
                                <option  value="{{$data->id}}">
                                    {{$data->nama}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <select class="form-control" name="id_kabkota" id="id_kabupaten" required >

                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <select class="form-control" name="id_kecamatan" id="id_kecamatan" required >

                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <select class="form-control" name="id_keldes" id="id_kelurahan" required >

                            </select>
                        </div>
                        <br>
                        <button type="submit" id="saveBtn" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


