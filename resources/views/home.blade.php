@extends('layouts.app')
@section('site_title',$site_title)
@section('content')

<div class="box box-solid">
    <div class="box-body">
        <form id="shorten_form" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-11">
                    <input type="text" class="form-control rounded-0" id="long_url" autocomplete="off" name="long_url" placeholder="Paste long url and shorten it">
                </div>
                <div class="col-md-1 pl-2">
                    <button type="submit" class="btn btn-sm btn-success rounded-0"><span></span> Shorten</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div id="shorten-data"></div>
<div class="box box-solid">
    <div class="box-header with-border">
        <h4 class="mb-0 box-title">URL Generate List</h4>
    </div>
    <div class="box-body">
        <table class="table table-sm table-responsive table-bordered" id="shorten-datatable">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Short URL</th>
                    <th>Long URL</th>
                    <th>Total Click</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>

@endsection

@push('scripts')
<script>
    table = $('#shorten-datatable').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        order: [], //Initial no order
        bInfo: true, //TO show the total number of data
        bFilter: false, //For datatable default search box show/hide
        ordering: false,
        lengthMenu: [
            [5, 10, 15, 25, 50, 100, -1],
            [5, 10, 15, 25, 50, 100, "All"]
        ],
        pageLength: "10", //number of data show per page
        ajax: {
            url: "{{ route('app.dashboard') }}",
            type: "GET",
            dataType: "JSON",
            data: function(d) {
                d._token = _token;
            },
        },
        columns: [
            {data: 'DT_RowIndex'},
            {data: 'short_url'},
            {data: 'long_url'},
            {data: 'clickable'},
            {data: 'action'}
        ],
        language: {
            processing: '<img src="{{ asset("img/table-loading.svg") }}">',
            emptyTable: '<strong class="text-danger">No Data Found</strong>',
            infoEmpty: '',
            zeroRecords: '<strong class="text-danger">No Data Found</strong>',
            oPaginate: {
                sPrevious: "Previous", // This is the link to the previous page
                sNext: "Next", // This is the link to the next page
            },
            lengthMenu: `_MENU_`,
        }
    });

    $(document).on('submit','#shorten_form',function(e){
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "{{ route('app.shorten') }}",
            data: new FormData(this),
            dataType: "JSON",
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function(){
                $('#save-btn span').addClass('border-spinner text-white');
            },
            complete: function(){
                $('#save-btn span').removeClass('border-spinner text-white');
            },
            success: function(response){
                $('#shorten_form').find('.is-invalid').removeClass('is-invalid');
                $('#shorten_form').find('.error').remove();
                if(response.status == false){
                    $.each(response.errors,function(key,value){
                        $('#shorten_form #'+key).addClass('is-invalid');
                        $('#shorten_form #'+key).parent().append('<span class="text-danger d-block error">'+value+'</span>');
                    });
                }else{
                    notification(response.status,response.message);
                    if(response.status == 'success'){
                        $('#shorten-data').append(`<div class="alert alert-success py-3"><strong>URL:</strong> `+response.data.short_url+`</div>`);
                        table.ajax.reload();
                    }
                }
            },
            error: function(error){
                console.log(error);
            }
        });
    });

    $(document).on('click','.delete_data',function(){
        var id = $(this).data('id');
        var url = "{{ route('app.shorten.delete') }}";
        Swal.fire({
            title: 'Are you sure to delete url?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancel',
            confirmButtonText: 'Confirm',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {id:id,_token:_token},
                    dataType: "JSON",
                }).done(function (response) {
                    if (response.status == "success") {
                        Swal.fire("Deleted", response.message, "success").then(function () {
                            table.ajax.reload();
                        });
                    }

                    if (response.status == "error") {
                        Swal.fire('Oops...', response.message, "error");
                    }
                }).fail(function () {
                    Swal.fire('Oops...', "Somthing went wrong with ajax!", "error");
                });
            }
        });
    });
</script>
@endpush
