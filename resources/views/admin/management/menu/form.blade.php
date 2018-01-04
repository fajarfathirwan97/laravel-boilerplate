@extends('layout.master')

@section('title')
    {{translateUrl()}}
@endsection

@section('content')
<div class="clearfix"></div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
            <h2>{{translateUrl()}}</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
            </ul>
            <div class="clearfix"></div>
            </div>
            <div class="x_content">
            <br />
            <form action="{{route('admin.management.menu.post')}}" method="POST" data-parsley-validate class="form-horizontal form-label-left">
                {{csrf_field()}}
                <div class="form-group {{$errors->has('menu.is_parent') ? 'has-error' : ''}}">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">{{trans('form.menu.is_parent')}}*</label>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                        <select name="menu[is_parent]" id="is_parent" required="required" class="form-control col-md-7 col-xs-12">
                            <option value=1>Yes</option>
                            <option value=0>No</option>
                        </select>
                    </div>
                </div>
                @if($errors->has('menu.is_parent'))
                    <span class="help-block">{{$errors->first('menu.is_parent')}}</span>
                @endif
                <div id='parentIdBlock' class='form-group'>
                <label class="control-label col-md-2 col-sm-2 col-xs-12">{{trans('form.menu.parent_id')}}</label>
                <div class="col-md-10 col-sm-10 col-xs-12">
                    <select name="menu[parent_id]" id="parent_id" class="form-control col-md-7 col-xs-12">
                    </select>
                </div>
                @if($errors->has('menu.parent_id'))
                    <span class="help-block">{{$errors->first('menu.parent_id')}}</span>
                @endif
                </div>
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
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <select name="menu[icon]" id="icon" class="form-control col-md-7 col-xs-12">
                            @foreach(getListIcon() as $icon)
                            <option value="{{$icon}}">{{$icon}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 text-center">
                          <h4>
                            Preview Icon : <span id='previewIcon'></span>
                          </h4>
                    </div>
                </div>
                <div class='form-group'>            
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">{{trans('form.menu.slug')}}</label>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                        <input type="text" value="{{@$menu['slug']}}" name="menu[slug]" id="slug" class="form-control col-md-7 col-xs-12">
                    </div>
                </div>
                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <button class="btn btn-primary" type="button">Cancel</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
<form id='menuForm' method="POST" action="#" class='form-horizontal form-label-left'>
    
</form>
@endsection

@section('script')
<script>
    $(document).ready(function(){
        $('#icon').select2();
        function formCheck(){
            if(parseInt($('#is_parent').val()))
                $('#parentIdBlock').hide()
            else
                $('#parentIdBlock').show()
            
        }
        formCheck();
        $('#is_parent').on('click',formCheck);
        $('#icon').on('select2:select',function(){
            $('#previewIcon').removeClass()            
            $('#previewIcon').addClass('fa '+$(this).val())
        })
        $('#parent_id').select2({
            ajax: {
                type:"POST",
                delay : 1000,
                data: function (params) {
                    var query = {
                      search: params.term,
                      type: 'public'
                    }
              
                    return query;
                },
                url: '{{route("admin.management.menu.select2")}}',
                processResults: function (data) {
                    return {
                        results: data.results
                    };
                }
            }
        });        
    })
</script>
@endsection