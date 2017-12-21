var ajax = function (url,body,headers,type) {
    this.url = url
    this.body = body
    this.headers = headers
    this.type = type

    ajax.prototype.getResult = function(){
        return this.result
    }
    ajax.prototype.getDataFromForm = function (){
        var indexed_array = {};
        $.map(this.body, function(n, i){
            indexed_array[n['name']] = n['value'];
        });
        this.body = indexed_array;
        return this;
    }
    ajax.prototype.execAjax = function(){
        this.result = $.ajax({
            url : this.url,
            type : this.type,
            headers : this.headers,
            data : this.body,
        });
        return this;
    }
}

function getDataFromForm (form) {
    var indexed_array = {};
    $.map(form, function(n, i){
        indexed_array[n['name']] = n['value'];
    });
    return (indexed_array);
}
