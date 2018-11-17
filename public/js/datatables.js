var DatatableCustomClass = function (url,fetchColumnUrl,target,data){
    this.url = url;
    this.fetchColumnUrl = fetchColumnUrl;
    this.target = target;
    this.data = data;
    this.table = null;
    DatatableCustomClass.prototype.renderDatatables = function(){
        if(!this.table){
            new ajax(this.fetchColumnUrl,[],[],'GET').execAjax().getResult().then(res=>{
                this.table = $(this.target).DataTable({
                    "processing" : true,
                    "serverSide" : true,
                    "ajax" : { 
                        headers : { 'Content-Type' : 'multipart/form-data'},
                        url : this.url,
                        type : 'GET',
                        data : this.serializeObject(),
                    },
                    "columns" : res.body.content,
                    "columnDefs": [
                        {"className": "dt-center", "targets": "_all"}
                    ],
                })
            });    
        }else{
            this.table.destroy();
            this.table = null;
            this.renderDatatables();
        }
    }
    DatatableCustomClass.prototype.serializeObject = function(){
        var json = {};
        var arr = this.data.serializeArray();
        $.each(arr, function() {
            if (json[this.name]) {
                if (!json[this.name].push) {
                    json[this.name] = [json[this.name]];
                }
                json[this.name].push(this.value || '');
            } else {
                json[this.name] = this.value || '';
            }
        });
        return json;
    }
    DatatableCustomClass.prototype.getTable = function(){
        return this.table;
    }
}