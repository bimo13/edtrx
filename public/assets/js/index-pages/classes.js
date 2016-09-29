$(document).ready(function() {
    var datatable = $('#datatables').dataTable({
        "bSort" : true,
        "bFilter" : true,
        "bPaginate": true,
        "info": true,
        "sDom": '<"top">rt<"bottom"p><"clear">',
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": base_url + "/classes/getClassesData",
        "oLanguage": {
            "sProcessing": "",
            "sEmptyTable": "No data available"
        },
        "columnDefs": [
            { "sortable": false, "targets": [3] },
            { "sClass": "text-right", "targets": [1] },
            { "sClass": "text-center", "targets": [3] }
        ],
        "order": [[ 0, 'asc' ]]
    });
});

$('#modal-delete').on('show.bs.modal', function(e){
    var btn = $(e.relatedTarget);
    var id = btn.data('id');
    var title = btn.data('title');
    var preview = btn.data('preview');
    var modal = $(this)

    $("#form-delete").attr("action", base_url+"/classes/"+id);

    modal.find('.modal-body').empty();
    modal.find('.modal-body').html('Are you sure want to delete this data ?<br />'+preview)
    modal.find('#btn-delete').on('click', function(e){
        window.location.replace("/admin/"+title+"/destroy/"+id);
    });
});