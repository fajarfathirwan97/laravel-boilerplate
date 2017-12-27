@extends('layout.master')
@section('title')
    {{translateUrl()}}
@endsection
@section('content')
<table id="dTable" class="table table-striped table-responsive table-bordered">
    <thead>
        <tr>
            <th>Name</th>
            <th>Position</th>
            <th>Office</th>
            <th>Age</th>
        </tr>
    </thead>
    <tbody>
        
    </tbody>
</table>
@endsection
@section('script')
<script>
    $(document).ready(function(){
        dt = new DatatableCustomClass(`{{route('admin.management.menu.datatables')}}`,`{{route('admin.management.menu.datatablesColumn')}}`,'#dTable');
        dt.renderDatatables()
        $("div.dataTables_wrapper div.dataTables_filter input").hide();
    })
</script>
@endsection
