@extends('layout.master')
@section('title')
    {{translateUrl()}}
@endsection

@section('content')
<div class='row'>
    <div class='col-lg-1 col-md-1 col-xs-12 pull-rigdt'>
        <button class="btn btn-primary searchButton">
            <span class="fa fa-search" aria-hidden="true"></span>
        </button>
    </div>

</div>
<table id="dTable" data-value='{{$data}}' class="table table-striped table-responsive table-bordered">
<div class='row'>
    <div class='col-lg-1 col-md-1 col-xs-12 pull-right'>
        <a href="{{route('admin.management.migration.form')}}">
            <button id='addModalButton' class="btn btn-primary">
                <span class="fa fa-plus-square" aria-hidden="true"></span>
            </button>
        </a>
    </div>    
</div>
    <thead>
        <tr>
            <th>IsRun</th>
            <th>Name</th>
        </tr>
    </thead>
    <tbody>
        <tr>
        </tr>        
    </tbody>
</table>
@endsection

@section('script')
<script>
var target = $('#dTable')
$(document).ready(function(){
    $(target).DataTable({
        data : $(target).data('value'),
        columns : [
            {data : 0},
            {data : 1},
        ]
    });
})

</script>
@endsection