@if(@$url)
<button id='detailButton' data-toggle='modal' data-id='{{$data->uuid}}' data-url='{{$url}}' class='btn btn-primary'>
     <span class='fa fa-info' aria-hidden='true'></span> 
</button>
@endif
<button id='updateModalButton' data-toggle='modal' data-id='{{$data->uuid}}' class='btn btn-primary'>
     <span class='fa fa-pencil' aria-hidden='true'></span> 
</button>
<button id='deleteModalButton' data-toggle='modal' data-id='{{$data->uuid}}' class='btn btn-primary'>
     <span class='fa fa-trash' aria-hidden='true'></span> 
</button>