@php
    $permissions = \Sentinel::check()->roles()->first()->permissions
@endphp
@if(@$url)
<button id='detailButton' data-toggle='modal' data-id='{{$data->uuid}}' data-url='{{$url}}' class='btn btn-primary'>
     <span class='fa fa-info' aria-hidden='true'></span> 
</button>
@endif

@if(@$viewPath && @$showOnly && in_array("$viewPath.form",$permissions) || in_array("*",$permissions))
<button id='updateModalButton' data-toggle='modal' data-id='{{$data->uuid}}' class='btn btn-primary'>
     <span class='fa fa-pencil' aria-hidden='true'></span> 
</button>
@endif

@if(@$viewPath && @$showOnly && in_array("$viewPath.delete",$permissions) || in_array("*",$permissions))
<button id='deleteModalButton' data-toggle='modal' data-id='{{$data->uuid}}' class='btn btn-primary'>
     <span class='fa fa-trash' aria-hidden='true'></span> 
</button>
@endif