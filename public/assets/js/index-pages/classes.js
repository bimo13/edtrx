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
            { "sClass": "text-right", "targets": [1,3] }
        ],
        "order": [[ 0, 'asc' ]]
    });
});