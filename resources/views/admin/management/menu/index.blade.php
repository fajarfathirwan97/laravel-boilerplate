@extends('layout.master')
@section('title')
    {{translateUrl()}}
@endsection

@section('content')
<div class='row'>
    <div class='col-lg-1 col-md-1 col-xs-12 pull-right'>
        <button class="btn btn-primary searchButton">
            <span class="fa fa-search" aria-hidden="true"></span>
        </button>
    </div>
    <div class='col-lg-6 col-md-6 col-xs-12'>
        <div class="control-label col-md-3 col-sm-3 col-xs-12">
            <select name='search[field]' class="form-control col-md-7 col-xs-12">
                <option value=''>Field</option>
                {!! $field !!}
            </select>
        </div>
        <div class="control-label col-md-2 col-sm-2 col-xs-12">
            <select name='search[operator]' class="form-control col-md-7 col-xs-12">
                <option value="equal">{{trans('form.equal')}}</option>
                <option value="not_equal">{{trans('form.not_equal')}}</option>
            </select>
        </div>
        <div class="control-label col-md-5 col-sm-5 col-xs-12">
            <input name="search[keyword]" placeholder="Keyword" type='text' class="form-control col-md-7 col-xs-12">
        </div>
    </div>
</div>
<table id="dTable" class="table table-striped table-responsive table-bordered">
<div class='row'>
    <div class='col-lg-1 col-md-1 col-xs-12 pull-right'>
        <button id='addModalButton' data-toggle="modal" data-target="#addModal" class="btn btn-primary">
            <span class="fa fa-plus-square" aria-hidden="true"></span>
        </button>
    </div>    
</div>
    <thead>
        <tr>
            <th>Name</th>
            <th>Url</th>
        </tr>
    </thead>
    <tbody>
        
    </tbody>
</table>
@endsection

@section('specific_modal')
<div id="addModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Menu</h4>
      </div>
      <div class="modal-body col-md-12">
          <form id='menuForm' method="POST" action="#" class='form-horizontal form-label-left'>
            <div class='form-group'>
                <label class="control-label col-md-2 col-sm-2 col-xs-12">{{trans('form.menu.name')}}</label>
                <div class="col-md-10 col-sm-10 col-xs-12">
                    <input type="text" value="{{@$menu['name']}}" name="menu[name]" id="name" class="form-control col-md-7 col-xs-12">
                </div>
            </div>
            <div class='form-group'>          
                <label class="control-label col-md-2 col-sm-2 col-xs-12">{{trans('form.menu.href')}}</label>
                <div class="col-md-10 col-sm-10 col-xs-12">
                    <input type="text" value="{{@$menu['href']}}" name="menu[href]" id="href" class="form-control col-md-7 col-xs-12">
                </div>
            </div>
            <div class='form-group'>            
                <label class="control-label col-md-2 col-sm-2 col-xs-12">{{trans('form.menu.icon')}}</label>
                <div class="col-md-10 col-sm-10 col-xs-12">
                    <input type="text" value="{{@$menu['icon']}}" name="menu[icon]" id="icon" class="form-control col-md-7 col-xs-12">
                </div>
            </div>
            <div class='form-group'>            
                <label class="control-label col-md-2 col-sm-2 col-xs-12">{{trans('form.menu.slug')}}</label>
                <div class="col-md-10 col-sm-10 col-xs-12">
                    <input type="text" value="{{@$menu['slug']}}" name="menu[slug]" id="slug" class="form-control col-md-7 col-xs-12">
                </div>
            </div>
            <div class='form-group'>
                <label class="control-label col-md-2 col-sm-2 col-xs-12">{{trans('form.menu.is_parent')}}</label>
                <div class="col-md-10 col-sm-10 col-xs-12">
                    <input type="text" value="{{@$menu['is_parent']}}" name="menu[is_parent]" id="is_parent" class="form-control col-md-7 col-xs-12">
                </div>
            </div>
            <div class='form-group'>
                <label class="control-label col-md-2 col-sm-2 col-xs-12">{{trans('form.menu.parent_id')}}</label>
                <div class="col-md-10 col-sm-10 col-xs-12">
                    <input type="text" value="{{@$menu['parent_id']}}" name="menu[parent_id]" id="parent_id" class="form-control col-md-7 col-xs-12">
                </div>
            </div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function(){
        var target = '#dTable';
        dt = new DatatableCustomClass(`{{route('admin.management.menu.datatables')}}`,`{{route('admin.management.menu.datatablesColumn')}}`,target,$('[name*=search]'));
        dt.renderDatatables()
        $('.searchButton').on('click',function(){
            dt.renderDatatables();
        });
        $('[name*=search]').on('change',function(){
            dt.renderDatatables();
        });
        $('#menuForm input').on('keyup',function(e){
            if(e.keyCode == 13){
                submit = new ajax(`{{route('admin.management.menu.post')}}`,$('#menuForm').serializeArray(),{},'POST').execAjax();
                submit.getResult().then(function(res){
                },function(err){
                    PNotify.removeAll();
                    var message = '';
                     $.each(err.responseJSON,function(key,item){
                        message = message.concat(item[0],' <br>')
                    })
                    var notice = new PNotify({
                        title: 'Click to Close Notice',
                        text: `${message}`,
                        buttons: {
                            closer: false,
                            sticker: false
                        }
                    });
                    notice.get().click(function() {
                        notice.remove();
                    });
                })
            }
        })
        
    })

</script>
@endsection