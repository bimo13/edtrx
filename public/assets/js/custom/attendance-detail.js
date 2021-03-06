$(document).ready(function() {

    var datatable = $('#datatables').dataTable({
        "bSort" : true,
        "bFilter" : true,
        "bPaginate": true,
        "info": true,
        "sDom": '<"top">rt<"bottom"p><"clear">',
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": base_url + "/attendance/getDetail/" + student_id,
        "oLanguage": {
            "sProcessing": "",
            "sEmptyTable": "No data available"
        },
        "columnDefs": [
            { "sortable": false, "targets": [1,2,3,4] },
            { className: "dt-center", "targets": [ 1,2,3 ] }
        ],
        "order": [[ 0, 'desc' ]]
    });

    /*
    var datatable_api= new $.fn.dataTable.Api("#datatables");
    $('#datatable-paging').change(function() {
        datatable.fnSettings()._iDisplayLength = parseInt(this.value);
        datatable.fnDraw();
    });

    $('#modal-search').on('shown.bs.modal', function(e){
        $("#student_no").val("");
        $("#full_name").val("");
    });

    $('.search').on('click', function(e) {
        datatable.fnSettings().oFeatures.bProcessing=true;
        datatable.fnSettings().oFeatures.bServerSide=true;
        datatable_api.column(0).search($("#student_no").val());
        datatable_api.column(1).search($("#full_name").val());
        datatable.fnDraw();
        $('#modal-search').modal('toggle');
        return false;
    });

    $('#refresh-btn').on('click', function() {
        datatable.fnSettings().oFeatures.bProcessing=true;
        datatable.fnSettings().oFeatures.bServerSide=true;
        datatable_api.column(0).search("");
        datatable_api.column(1).search("");
        datatable.fnDraw();
        return false;
    });
    */

});