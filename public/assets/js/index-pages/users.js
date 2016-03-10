$(document).ready(function() {
    var datatable = $('#datatables').dataTable({
        "bSort" : true,
        "bFilter" : true,
        "bPaginate": true,
        "info": true,
        "sDom": '<"top">rt<"bottom"p><"clear">',
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": base_url + "/users/getUsersData",
        "oLanguage": {
            "sProcessing": "",
            "sEmptyTable": "No data available"
        },
        "columnDefs": [
            { "sortable": false, "targets": [3] },
            { "sClass": "text-right", "targets": [3] },
            { "name": "teacher_no", "targets": [0] }
        ],
        "order": [[ 0, 'asc' ]]
    });
});