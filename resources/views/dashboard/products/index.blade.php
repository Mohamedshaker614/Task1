@extends('dashboard.layout.layout')
@section('css')
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection
@section('contant')
    @php
        use App\Utility\Guard;
    @endphp
    <meta name="csrf-token" content="{!! csrf_token() !!}">
    <div id="content-page" class="">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">Product List</h4>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <div class="table-responsive">
                                <div class="table-add  mb-3 mr-2" style="text-align: right">
                                    @if (Auth::guard(Guard::ADMINS)->user()->can('Product Add'))
                                        <button class="btn btn-primary openModal" data-target="#add" data-toggle="modal"><i
                                                class="ri-add-fill"><span class="pl-1">Add
                                                    New</span></i>
                                        </button>
                                    @endif
                                </div>
                                <div class="row justify-content-between">
                                    <div class="col-sm-12 col-md-12">
                                        <div id="user_list_datatable_info" class="dataTables_filter">
                                            <form class="mr-3 position-relative row">
                                                <div class="col-3">
                                                    <div class="form-group">
                                                        <label for="from">Name</label>
                                                        <input type="text" id="name" name="name"
                                                            class="form-control" value="{{ request('name', '') }}">
                                                    </div>
                                                </div>
                                                <div class="col-3">
                                                    <div class="form-group">
                                                        <label for="from">Brand</label>
                                                        <input type="text" id="brand" name="brand"
                                                            class="form-control" value="{{ request('brand', '') }}">
                                                    </div>
                                                </div>
                                                <div class="col-3">
                                                    <div class="form-group">
                                                        <label for="from">price from</label>
                                                        <input type="number" id="from" name="from"
                                                            class="form-control" value="{{ request('from', '') }}">
                                                    </div>
                                                </div>
                                                <div class="col-3">
                                                    <div class="form-group">
                                                        <label for="to"> price to</label>
                                                        <input type="number" id="to" name="to"
                                                            class="form-control" value="{{ request('to', '') }}">
                                                    </div>
                                                </div>
                                                <div class="col-12" style="text-align: center;padding:10px">

                                                    <button type="submit" class="btn btn-primary">Search</button>

                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <table id="myTable" class="table table-striped table-bordered mt-4 cont-data"
                                    role="grid" aria-describedby="user-list-page-info">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Product Name</th>
                                            <th>Category Name</th>
                                            <th>Price</th>
                                            <th>Brand</th>
                                            <th>Image</th>
                                            <th>Details</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/div-->
    </div>

    @foreach ($data as $product)
        @include('dashboard.products.editModal')
    @endforeach
    @include('dashboard.products.addModal')
@endsection
<!-- add -->
<!-- End Basic modal -->

@section('script')
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(function() {
            var table = $('#myTable').DataTable({
                processing: true,
                serverSide: true,
                paging: true,
                ajax: {
                    url: "{{ route('products.index') }}",
                    data: function(d) {
                        let searchParams = new URLSearchParams(window.location.search)
                        d.from = searchParams.get('from'),
                            d.to = searchParams.get('to')
                    }
                },
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'category',
                        name: 'category'
                    },
                    {
                        data: 'price',
                        name: 'price'
                    },
                    {
                        data: 'brand',
                        name: 'brand'
                    },
                    {
                        data: 'image',
                        name: 'image'
                    },
                    {
                        data: 'details',
                        name: 'details'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                ],
                drawCallback: function(settings) {
                    $(".updateProduct").submit(function(e) {

                        e.preventDefault();

                        var elem = $(this).attr('id');
                        var formData = new FormData(jQuery('#' + elem)[0]);
                        var idRow = $(this).data('id');
                        $.ajax({
                            url: "/updateProduct/" + idRow,
                            type: "POST",
                            data: formData,
                            contentType: false,
                            processData: false,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                    'content')
                            },
                            success: function(dataBack) {
                                console.log(dataBack);
                                reloadTable();
                                $("#edit-" + idRow).modal('hide');
                                $("#error-" + idRow).html('');
                            },
                            error: function(xhr, status, error) {
                                $("#error-" + idRow).html('');
                                $.each(xhr.responseJSON.errors, function(key,
                                    item) {
                                    $("#error-" + idRow).prepend(
                                        "<li class='alert alert-danger text-center p-1'>" +
                                        item + " </li>");
                                });
                            }
                        });
                    });
                }
            });


            function reloadTable() {
                table.ajax.reload();
            }


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $("#addProduct").submit(function(e) {
                e.preventDefault();
                var formData = new FormData(jQuery('#addProduct')[0]);
                console.log(formData);
                $.ajax({
                    url: "{{ url('/products') }}",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(dataBack) {
                        $("#error").html(
                            "<li class='alert alert-success text-center p-1'> Added Success </li>"
                        );
                        $(".cont-data").prepend(dataBack);
                        $('#add').modal('hide');
                        reloadTable();
                        $("#error").html('');
                    },
                    error: function(xhr, status, error) {
                        $("#error").html('');
                        $.each(xhr.responseJSON.errors, function(key, item) {
                            $("#error").prepend(
                                "<li class='alert alert-danger text-center p-1'>" +
                                item + " </li>");
                        });
                    }
                });
            });




            $(document).on("click", ".openModal", function() {
                $($(this).data('target')).modal('show');
            });



            $(document).on("click", ".delete", function() {
                var route = $(this).attr("data-route");
                if (confirm("Are you sure you want to delete this Product ?")) {
                    $.ajax({
                        type: "DELETE",
                        url: route,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {
                            reloadTable();
                        }
                    });
                }
            });
        });
    </script>
@endsection
