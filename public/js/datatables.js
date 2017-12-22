var DatatableCustomClass = function (url,fetchColumnUrl,target){
    this.url = url;
    this.fetchColumnUrl = fetchColumnUrl;
    this.target = target;
    DatatableCustomClass.prototype.renderDatatables = function(){
        new ajax(this.fetchColumnUrl,[],[],'GET').execAjax().getResult().then(res=>{
            this.table = $(this.target).DataTable({
                "processing" : true,
                "serverSide" : true,
                "ajax" : this.url,
                "columns" : res.body.content,
                "sDom": '<"top">rt<"bottom"flp><"clear">'
            })
        });
    }
}