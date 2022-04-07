{{-- Modal Add New Transaction --}}
<div class="modal fade" id="modal-xl">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Permintaan Barang</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row px-2">
                    {{-- Select NIK --}}
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>NIK Pemohon :</label>
                            <select id="nik" class="form-control select2" style="height: 520px">
                                <option selected disabled>-</option>
                            </select>
                        </div>
                    </div>
                    {{-- END NIK --}}

                    {{-- Nama --}}
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Nama :</label>
                            <input class="form-control" type="text" id="name" disabled>
                        </div>
                    </div>
                    {{-- End Nama --}}

                    {{-- Departemen --}}
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Departemen :</label>
                            <input class="form-control" type="text" id="department" disabled>
                        </div>
                    </div>
                    {{-- END Departemen --}}

                    {{-- Tanggal Permintaan --}}
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Tanggal Permintaan :</label>
                            <div class="input-group date" data-target-input="nearest">
                                <input type="text" id="reservationdatetime" class="form-control datetimepicker-input">
                                <div class="input-group-append">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- END Tanggal Permintaan --}}
                </div>
                <hr>
                <div class="py-2"></div>
                <h3>Daftar Barang</h3>
                <table id="productTable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>
                                #
                            </th>
                            <th>
                                Barang
                            </th>
                            <th>
                                Lokasi
                            </th>
                            <th>
                                Tersedia
                            </th>
                            <th>
                                Kuantiti
                            </th>
                            <th>
                                Satuan
                            </th>
                            <th>
                                Keterangan
                            </th>
                            <th>
                                Status
                            </th>
                            <th>
                                *
                            </th>
                        </tr>
                    </thead>
                    <tbody class="profile-tbody">
                        <tr>
                            <td>
                                1.
                            </td>
                            <td>
                                <div class="form-group">
                                    <select onchange="setInputVal(0)" id="product0" name="products[]" class="product form-control select2">
                                        <option selected disabled>Select Product</option>
                                    </select>
                                </div>
                            </td>
                            <td>
                                <input class="form-control" type="text" id="location0" disabled>
                            </td>
                            <td>
                                <input class="form-control" type="text" id="stock0" disabled>
                            </td>
                            <td>
                                <input class="form-control qty" required disabled type="number" min="0" name="qtys[]" id="qty0" onfocusout="setStatus(this)">
                            </td>
                            <td>
                                <input class="form-control" type="text" id="unit0" disabled>
                            </td>
                            <td>
                                <input class="form-control" type="text" name="desc[]" id="desc0">
                            </td>
                            <td>
                                <div id="status0">
                                </div>
                                {{-- <span class="badge badge-pill badge-success">Tersedia</span> --}}
                                {{-- <span class="badge badge-pill badge-danger">Tidak Tersedia</span> --}}
                            </td>
                            <td>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="row d-flex flex-row-reverse">
                    <div>
                        <button id="addRow" type="button" class="btn btn-success btn-block" disabled><i class="fa fa-plus"></i> Add</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-light justify-content-center">
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                <button disabled type="button" id="send" class="btn btn-success"><i class="fa fa-paper-plane"></i> Send Request</button>
            </div>
        </div>
    </div>
</div>
