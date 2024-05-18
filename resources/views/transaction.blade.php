<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>App Cashier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <style>
        @media print {
            #no-print {
                visibility: hidden;
            }
        }
    </style>
</head>

<body class="d-flex justify-content-center align-items-center">
    <div class="col m-2" id="no-print">
        <nav class="navbar bg-body-secondary mb-2">
            <div class="container-fluid">
                <strong class="navbar-brand" href="#">App Cashier</strong>
                <a class="text-decoration-none" href= "{{ asset('/register') }}">
                    <small class="navbar-brand" href="#">Register</small>
                </a>
            </div>
        </nav>
        <form action="{{ route('transaction.store') }}" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-sm-4 mb-3 mb-sm-0">
                    <div class="card mb-4">
                        <div class="card-body">
                            {{-- <form action="" method="POST" enctype="multipart/form-data">
                                @csrf --}}
                            <div class="form-group mb-3">
                                <label for="name" class="form-label mb-2" style="font-weight: bold">Name</label>
                                <select class="js-example-basic-single form-select mb-4" name="customer_id">
                                    <option selected>Select Customer</option>
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="name" class="form-label mb-2" style="font-weight: bold">Tenant</label>
                                <select class="js-example-basic-single form-select mb-4" name="tenant_id"
                                    id="tenant-select">
                                    <option selected>Select Tenant</option>
                                    @foreach ($tenants as $tenant)
                                        <option value="{{ $tenant->id }}">{{ $tenant->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <form enctype="multipart/form-data">
                                @csrf
                                <div class="form-group mb-3">
                                    <div class="form-group mb-3">
                                        <div id="">
                                            <strong>Total Price : </strong>Rp.
                                            <input style="border: none" type="text" id="amount" name="amount"
                                                readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-3">

                                    <div class="input-group">
                                        <input type="text" id="voucher-code" class="form-control"
                                            placeholder="Input voucher (jika ada)" aria-label=""
                                            aria-describedby="basic-addon1">
                                        <span class="input-group-text" id="basic-addon1">
                                            <button type="" class="" id="check-voucher-btn"
                                                style="border:none; background-color:white; font-weight:500">Apply</button>
                                        </span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-2 mb-sm-0 mt-4 pt-2 me-4">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                    @if (session('success'))
                                        <div class="col-sm-6 mb-sm-0 mt-4 pt-2">
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal">
                                                Get Voucher
                                            </button>
                                        </div>
                                    @endif
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8 mb-3 mb-sm-0">
                    <div class="card">
                        <div class="card-body">
                            <form id="productForm">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="name" style="font-weight: bold"
                                                class="form-label mb-2">Product
                                                -
                                                Price</label>
                                            <select class="js-example-basic-single form-select" name="product_id"
                                                id="product-select">
                                                <option selected>Select Product</option>
                                                @foreach ($products as $product)
                                                    <option data-tenant="{{ $product->tenant_id }}"
                                                        data-price="{{ $product->price }}" value="{{ $product->id }}">
                                                        {{ $product->name }} -
                                                        {{ number_format($product->price, 0, ',', '.') }}
                                                    </option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-sm-4 mb-3 mb-sm-0">
                                        <div class="mb-3">
                                            <label for="quantity" style="font-weight: bold"
                                                class="form-label">Quantity</label>
                                            <input name="quantity" class="form-control" id="quantity">
                                        </div>
                                    </div>
                                    <div class="col-sm-2 mb-sm-0 mt-4 pt-2 me-0">
                                        <button type="" class="btn btn-primary">Add</button>
                                    </div>
                                </div>
                            </form>
                            <div>
                                <strong class="">Shopping List :</strong>
                                <ul id="productList"></ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    {{-- Modal Get Voucher --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body d-flex align-items-center justify-content-center">
                    <div class="row text-center">
                        <div class="col-sm-8 pe-0 ">
                            <div class="border rounded-end" style="height: 100px; width:300px">
                                <div class="" style="text-align: left;">
                                    <span class="badge bg-success" class=" d-flex align-items-left "> <i
                                            class="fa-solid fa-tag fa-sm"></i>
                                        <small style="font-size: 12px"> Rp
                                            {{ number_format(session('amount'), 0, ',', '.') }}</small>
                                    </span>
                                </div>
                                <div class="col d-flex align-items-center justify-content-center text-center h-100">
                                    {{-- <strong class="" style="font-size: 24px; margin-top: -3rem">12345</strong> --}}
                                    <strong class=""
                                        style="font-size: 24px; margin-top: -3rem">{{ session('voucherCode') }}</strong>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 ps-0">
                            <div class="border rounded-start center-content" style="height: 100px; width:150px">
                                <div class="row mt-4">
                                    <small class="m-0" style="font-weight: 500">Expired :</small>
                                    <small>{{ session('expired') }}</small>
                                    {{-- <small>123456</small> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" id="no-print">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                            class="fa-solid fa-xmark"></i></button>
                    <button type="button" class="btn btn-primary" onclick="window.print()"><i
                            class="fa-solid fa-download"></i></button>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    {{-- <script>
        function printModal() {
            $('#exampleModal').modal('show');

            setTimeout(function() {
                window.print();
                $('#exampleModal').modal('hide');
            }, 500);
        }
    </script> --}}
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });

        $(document).ready(function() {

            var productOptions = $('#product-select').html();

            $('#tenant-select').change(function() {
                var selectedTenant = $(this).val();
                $('#product-select').html(productOptions);

                $('#product-select option').each(function() {
                    if ($(this).data('tenant') != selectedTenant && selectedTenant !== "") {
                        $(this).remove();
                    }
                });

                if ($('#product-select option').length <= 1) {
                    $('#product-select').hide();
                } else {
                    $('#product-select').show();
                }
            });

            var totalPrice = 0;



            $('#productForm').on('submit', function(e) {
                e.preventDefault();

                var productID = $('#product-select').val();
                var quantity = parseInt($('#quantity').val());
                var productName = $('#product-select option:selected').text();
                var productPrice = parseInt($('#product-select option:selected').data('price'));

                if (productID && quantity > 0) {
                    var subtotal = productPrice * quantity;
                    totalPrice += subtotal;

                    // Menambahkan produk ke daftar tampilan tanpa menyimpan ke database
                    $('#productList').append('<li>' + productName + ' x ' + quantity);

                    // Update total price
                    $('#totalPrice').text(totalPrice.toLocaleString('id-ID'));
                    $('#amount').val(totalPrice);

                    // Reset form
                    $('#quantity').val(1);
                    $('#product-select').val('');
                } else {
                    alert('Please select a product and enter a valid quantity.');
                }
            });
        });

        // Reedeem Voucher
        $('#check-voucher-btn').click(function() {
            var code = $('#voucher-code').val();

            alert('Kode voucher yang dimasukkan: ' + code);

            $.ajax({
                url: '/check-voucher',
                type: 'POST',
                data: {
                    code: code
                },
                success: function(response) {
                    if (response.success) {
                        var discount = response.discount;
                        // Lakukan sesuatu dengan nilai diskon yang diterima, misalnya tampilkan ke pengguna
                        alert('Diskon: ' + discount);
                    } else {
                        var message = response.message;
                        // Tampilkan pesan kesalahan kepada pengguna
                        alert(message);
                    }
                },
                error: function(xhr, status, error) {
                    // Handle error jika permintaan Ajax gagal
                    console.error(error);
                }
            });
        });
    </script>

</body>

</html>
