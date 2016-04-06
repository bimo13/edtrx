$(document).ready(function() {
    var datatable = $('#datatables').dataTable({
        "bSort" : true,
        "bFilter" : true,
        "bPaginate": true,
        "info": true,
        "sDom": '<"top">rt<"bottom"p><"clear">',
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": base_url + "/students/getMyStudents",
        "oLanguage": {
            "sProcessing": "",
            "sEmptyTable": "No data available"
        },
        "columnDefs": [
            { "sortable": false, "targets": [2] },
            { "name": "student_no", "targets": [0] }
        ],
        "order": [[ 0, 'asc' ]]
    });

    $('#attendanceDate').datetimepicker({
        format: 'YYYY/MM/DD',
        ignoreReadonly: true
    });
});