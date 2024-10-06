@extends('layouts.app')
@section('site_title',$site_title)
@section('content')
<!-- Default box -->
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">{{ $title }}</h3>

        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                title="Collapse">
                <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip"
                title="Remove">
                <i class="fa fa-times"></i></button>
        </div>
    </div>
    <div class="box-body">
        Start creating your amazing application!
    </div>
    <!-- /.box-body -->
</div>
<!-- /.box -->
@endsection
