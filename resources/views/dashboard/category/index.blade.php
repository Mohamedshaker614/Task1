@extends('dashboard.layout.layout')
@section('contant')
    <meta name="csrf-token" content="{!! csrf_token() !!}">
    @php
        use App\Utility\Guard;
    @endphp
    <div id="content-page" class="contant-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 col-12">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">{{__('profile.المنتجات')}} </h4>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <div id="table" class="table-editable">
                                <span class="table-add float-right mb-3 mr-2">
                                    @if (Auth::guard(Guard::ADMINS)->user()->can('Category Add'))
                                        <button class="btn btn-sm iq-bg-success openModal" data-target="#add"
                                            data-toggle="modal"><i class="ri-add-fill"><span class="pl-1">{{__('profile.إضافة')}}</span></i>
                                        </button>
                                    @endif
                                </span>
                                <table id="myTable" class="table table-striped table-bordered mt-4 cont-data"
                                    role="grid" aria-describedby="user-list-page-info">
                                    <thead>
                                        <tr>
                                            <th>{{__('profile.ID')}}</th>
                                            <th> {{__('profile.Name')}}</th>
                                            <th>{{__('profile.Details')}}</th>
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
    </div>
    <!-- add -->
    @include('dashboard.category.addModal')
    <!-- End Basic modal -->
@endsection
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
                ajax: "{{ route('categories.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
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
                    $(".updateCategory").submit(function(e) {
                        e.preventDefault();
                        var elem = $(this).attr('id');
                        var formData = new FormData(jQuery('#' + elem)[0]);
                        var idRow = $(this).data('id');
                        $.ajax({
                            url: "/updateCategory/" + idRow,
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



            $("#addCategory").submit(function(e) {
                e.preventDefault();
                var formData = new FormData(jQuery('#addCategory')[0]);
                console.log(formData);
                $.ajax({
                    url: "{{ url('/categories') }}",
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
                if (confirm("Are you sure you want to delete this Category ?")) {
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
