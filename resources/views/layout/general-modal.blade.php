<div id="deleteModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">{{trans('form.confirmation.title_delete')}}</h4>
      </div>
      <div class="modal-body col-md-12">
          {{trans('form.confirmation.delete')}}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" id ='confrimationDeleteNo' data-dismiss="modal">{{trans('form.confirmation.no')}}</button>
        <button type="button" class="btn btn-default" id ='confrimationDeleteYes' data-dismiss="modal">{{trans('form.confirmation.yes')}}</button>
      </div>
    </div>

  </div>
</div>

<div id="updateModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">{{trans('form.confirmation.title_update')}}</h4>
      </div>
      <div class="modal-body col-md-12">
          {{trans('form.confirmation.update')}}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" id ='confrimationUpdateNo' data-dismiss="modal">{{trans('form.confirmation.no')}}</button>
        <button type="button" class="btn btn-default" id ='confrimationUpdateYes'>{{trans('form.confirmation.yes')}}</button>
      </div>
    </div>

  </div>
</div>