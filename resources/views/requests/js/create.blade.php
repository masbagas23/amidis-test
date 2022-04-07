<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript">
    let readyHtml = ``;
    let dataUser;
    let dataProduct;
    let countSelect = 0;

    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2();
    });
    let reqDate = $("#reservationdatetime").flatpickr({
        enableTime: true,
        altInput: true,
        altFormat: "j F Y H:i",
        dateFormat: "Y-m-d H:i",
    });

    const appendUser = function(data) {
        data.forEach(e => {
            $('#nik').append($('<option>', {
                value: e.nik,
                text: e.nik
            }));
        });
    };

    const appendProduct = function(data) {
        data.forEach(e => {
            readyHtml += `<option value="${e.id}">${e.name}</option>`;
        });
        $("#product0").append(readyHtml);
    }

    $.ajax({
        url: "{{ route('requests.create') }}",
        type: "GET",
        dataType: 'json',
        success: function(data) {
            dataUser = data.data_user;
            dataProduct = data.data_product;
            appendUser(dataUser);
            appendProduct(dataProduct);
        },
        error: function(data) {
            console.log('Error:', data);
        }
    });
    $("#addRow").click(function() {
        let countForm = $('.profile-tbody tr').length;
        const html = `<tr>
                                <td>
                                    ${countForm+1}.
                                </td>
                                <td>
                                    <div class="form-group">
                                        <select onchange="setInputVal(${countForm})" id="product${countForm}" name="products[${countForm}]" class="product form-control select2">
                                            <option selected disabled>Select Product</option>
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <input class="form-control" type="text" id="location${countForm}" disabled>
                                </td>
                                <td>
                                    <input class="form-control" type="text" id="stock${countForm}" disabled>
                                </td>
                                <td>
                                    <input class="form-control qty" type="number" id="qty${countForm}" onfocusout="setStatus(this)">
                                </td>
                                <td>
                                    <input class="form-control" type="text" id="unit${countForm}" disabled>
                                </td>
                                <td>
                                    <input class="form-control" type="text" id="desc">
                                </td>
                                <td>
                                    <div id="status${countForm}"></div
                                </td>
                                <td>
                                    <div id="action${countForm}">
                                        
                                    </div>
                                </td>
                            </tr>`;

        $("#productTable tbody").append(html);
        $(".product").select2();
        $("#product" + countForm).append(readyHtml);
        // // Create the element

        // var script = document.createElement("script");
        // script.type = "text/javascript";

        // // Add script content

        // script.innerHTML = `$("#product${countForm}").on('change',function (ev) {
        //     const val = $("#product${countForm}").val();
        //     const indexData = dataProduct.findIndex(function(item, i){
        //         return item.id === parseInt(val);
        //     });
        //     $("#location${countForm}").val(dataProduct[indexData].location);
        //     $("#stock${countForm}").val(dataProduct[indexData].stock);
        //     $("#unit${countForm}").val(dataProduct[indexData].unit);
        // });`;

        // // Append

        // document.body.appendChild(script);
        $('option').prop('disabled', false); //reset all the disabled options on every change event
        $('select').each(function() { //loop through all the select elements
            var val = this.value;
            $('select').not(this).find('option').filter(
                function() { //filter option elements having value as selected option
                    return this.value === val;
                }).prop('disabled', true); //disable those option elements
        });
        if (countForm === 1) {
            $("#action" + countForm).append('<span onclick="removeRow(' + countForm +
                ')" class="badge badge-pill badge-danger">X</span>');
        } else {
            $("#action" + (countForm - 1)).empty();
            $("#action" + countForm).append('<span onclick="removeRow(' + countForm +
                ')" class="badge badge-pill badge-danger">X</span>');
        }
    });

    const removeRow = function(index) {
        // $("#product"+index+" option:selected").removeAttr('disabled');
        $(".profile-tbody tr:eq(" + index + ")").remove();
        let countForm = $('.profile-tbody tr').length;
        if (countForm !== 1) {
            $("#action" + (countForm - 1)).append('<span onclick="removeRow(' + (countForm - 1) +
                ')" class="badge badge-pill badge-danger">X</span>');
        }
    }



    $("#nik").on('change', function() {
        const val = this.value;
        var index = dataUser.findIndex(function(item, i) {
            return item.nik === val
        });
        $("#name").val(dataUser[index].name);
        $("#department").val(dataUser[index].department);
    });
    // $("#product0").on('change', function(ev) {
    //     const val = $("#product0").val();
    //     const indexData = dataProduct.findIndex(function(item, i) {
    //         return item.id === parseInt(val);
    //     });
    //     $("#location0").val(dataProduct[indexData].location);
    //     $("#stock0").val(dataProduct[indexData].stock);
    //     $("#unit0").val(dataProduct[indexData].unit);
    // });

    const setInputVal = function(index) {
        const val = $("#product" + index).val();
        const indexData = dataProduct.findIndex(function(item, i) {
            return item.id === parseInt(val);
        });

        $("#addRow").prop('disabled', false);
        $("#send").prop('disabled', false);
        $("#location" + index).val(dataProduct[indexData].location);
        $("#stock" + index).val(dataProduct[indexData].stock);
        $("#unit" + index).val(dataProduct[indexData].unit);

        // rm disable from input qty & desc
        $("#qty" + index).prop("disabled", false);

    }

    const setStatus = function(e) {
        const formIndex = $(".qty").index(e);
        const val = parseInt(e.value);
        const stock = parseInt($("#stock" + formIndex).val());
        const divStatus = $("#status" + formIndex);
        let html;

        if (stock >= val) {
            html = '<span class="badge badge-pill badge-success">Tersedia</span>';
            $("#send").prop("disabled", false);
        } else {
            html = '<span class="badge badge-pill badge-danger">Tidak Tersedia</span>';
            $("#send").prop("disabled", true);
        };
        divStatus.empty();
        divStatus.append(html);
    };

    $("#send").click(function() {
        const nik = $("#nik").val();
        const products = [];
        var valid = true;
        validate();
        $(".product option:selected").each(function(k, e) {
            const qty = parseInt($("#qty" + k).val());
            const desc = $("#desc" + k).val();
            const json = {
                "product_id": parseInt(e.value),
                "qty": qty,
                "desc": desc ? desc : ""
            };
            products.push(json);
        });
        const data = {
            "_token": $('meta[name="csrf-token"]').attr('content'),
            "nik": nik,
            "request_date": reqDate.altInput.value,
            "products": products
        };
        console.log(data);
        sendReq(data);
    });

    const validate = function() {
        const nik = $("#nik").val();

        let valid = true;

        $.each($(".qty"), function(index, value) {
            if (!$(value).val()) {
                valid = false;
            }
        });
        if (valid) {
            $("#send").attr("disabled", false);
        } else {
            errValidate("Isi form kuantiti");
        };

        if (nik === null) {
            errValidate("Pilih NIK Pemohon");
        }

        if (reqDate.altInput.value === "") {
            errValidate("Pilih Tanggal & Waktu Permintaan");
        }
    }

    const errValidate = function(msg) {
        alert(msg)
    }

    const sendReq = function(jsonBody) {
        $(".modal-content").append('<div class="overlay"> <i class="fas fa-2x fa-sync fa-spin"></i> </div>');
        setTimeout(function() {
            $.ajax({
                url: "{{ route('requests.store') }}",
                type: "POST",
                data: jsonBody,
                success: function(response) {
                    console.log(response);
                    $(".overlay").remove();
                    location.reload();
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }, 2000);
    }
</script>
