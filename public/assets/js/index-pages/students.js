$('#modal-delete').on('show.bs.modal', function(e){
    var btn = $(e.relatedTarget);
    var id = btn.data('id');
    var title = btn.data('title');
    var preview = btn.data('preview');
    var modal = $(this)

    $("#form-delete").attr("action", base_url+"/students/"+id);

    modal.find('.modal-body').empty();
    modal.find('.modal-body').html('Are you sure want to delete this data ?<br />'+preview)
    modal.find('#btn-delete').on('click', function(e){
        window.location.replace("/admin/"+title+"/destroy/"+id);
    });
});