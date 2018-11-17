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
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">

            <!-- start accordion -->
            <div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
              <div class="panel">
                <a class="panel-heading" role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <h4 class="panel-title">{{@$data->name}}</h4>
                </a>
                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                  <div class="panel-body">
                    <div class="row">
                      <div style="padding-bottom:2%;border-width:5px" class="col-xs-12">
                          <div class="col-xs-12">
                            <img width="200" width="200" src="http://{{@$data->logo}}"/>
                          </div>
                      </div>
                      <div class="col-xs-12">
                        <div class="col-xs-2">{{trans('form.organizations.name')}}</div>
                        <div class="col-xs-1">:</div>
                        <div class="col-xs-9">{{@$data->name}}</div>
                      </div>

                      <div class="col-xs-12">
                        <div class="col-xs-2">{{trans('form.organizations.email')}}</div>
                        <div class="col-xs-1">:</div>
                        <div class="col-xs-9">{{@$data->email}}</div>
                      </div>

                      <div class="col-xs-12">
                        <div class="col-xs-2">{{trans('form.organizations.phone')}}</div>
                        <div class="col-xs-1">:</div>
                        <div class="col-xs-9">{{@$data->phone}}</div>
                      </div>

                      <div class="col-xs-12">
                          <div class="col-xs-2">{{trans('form.organizations.website')}}</div>
                          <div class="col-xs-1">:</div>
                          <div class="col-xs-9">{{@$data->website}}</div>
                        </div>
                        
                    </div>
                  </div>
                </div>
              </div>
              <div class="panel">
                <a class="panel-heading" role="tab" id="headingTwo" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  <h4 class="panel-title">{{trans('detail.organizationUser')}}</h4>
                </a>
                <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                  <div class="panel-body">
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
                    <table id="dTable" class="col-xs-12 table table-striped table-responsive table-bordered">
                        <div class='row'>
                            <div class='col-lg-1 col-md-1 col-xs-12 pull-right'>
                                <a href="{{route('admin.management.organization.form')}}">
                                    <button id='addModalButton' class="btn btn-primary">
                                        <span class="fa fa-plus-square" aria-hidden="true"></span>
                                    </button>
                                </a>
                            </div>    
                        </div>
                      <thead>
                          <tr>
                              <th>Full Name</th>
                              <th>Avatar</th>
                              <th>Email</th>
                              <th>Phone</th>
                              <th>Position</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                          
                      </tbody>
                  </table>
                  </div>
                </div>
              </div>
            </div>
            <!-- end of accordion -->


          </div>
        </div>
      </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function(){
        var target = '#dTable';
        dt = new DatatableCustomClass(`{{route('admin.management.user.datatablesOrganization')}}`,`{{route('admin.management.user.datatablesColumnOrganization')}}`,target,$('[name*=search]'));
        dt.renderDatatables()
        $('.searchButton').on('click',function(){
            dt.renderDatatables();
        });
        $('[name*=search]').on('change',function(){
            dt.renderDatatables();
        });
    })
</script>
@endsection