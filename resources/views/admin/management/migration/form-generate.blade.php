<div class="form-group">
    <label class="control-label col-md-2 col-sm-2 col-xs-12">{{trans('form.migration.type')}}</label>
    <div class="col-md-4 col-sm-4 col-xs-12">
        <select name="migration[column][{{$length}}][type]" id="dataTypeForm" class="form-control dataType">
            @foreach(getListDataType() as $dataType)
                <option value="{{$dataType}}">{{trans('form.migration.'.$dataType)}}</option>
            @endforeach
        </select>
    </div>
    <label class="control-label col-md-2 col-sm-2 col-xs-12">{{trans('form.migration.column_name')}}</label>
    <div class="col-md-4 col-sm-4 col-xs-12">
        <input type="text" value="{{@$migration['column_name']}}" name="migration[column][{{$length}}][column_name]" id="columnName" class="form-control">
    </div>
</div>
