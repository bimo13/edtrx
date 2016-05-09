$(function () {
    $(document).ready(function(){
        $('#attendanceDate').datetimepicker({
            format: 'YYYY/MM/DD',
            ignoreReadonly: true,
            defaultDate: curDate
        });

        $('.attLate').datetimepicker({
            format: 'HH:mm',
            ignoreReadonly: true
        });

        $('#chAtt, #chApp, .studentsAttendance, .studentsApparel').iCheck({
            checkboxClass: 'icheckbox_square-edutrax',
            radioClass: 'iradio_square-edutrax',
            increaseArea: '20%' // optional
        });

        // Check-all and Uncheck-all attendance checkboxes
        $('#chAtt').on('ifChecked', function(event){
            var numberOfChecked = $('.studentsAttendance:checked').length;
            if (numberOfChecked == 0) $('.studentsAttendance').iCheck('check');
        });
        $('#chAtt').on('ifUnchecked', function(event){
            var numberOfChecked = $('.studentsAttendance:checked').length;
            var totalCheckboxes = $('.studentsAttendance').length;
            if (numberOfChecked == totalCheckboxes) $('.studentsAttendance').iCheck('uncheck');
        });

        // Check-all and Uncheck-all apparel checkboxes
        $('#chApp').on('ifChecked', function(event){
            var numberOfChecked = $('.studentsApparel:checked').length;
            if (numberOfChecked == 0) $('.studentsApparel').iCheck('check');
        });
        $('#chApp').on('ifUnchecked', function(event){
            var numberOfChecked = $('.studentsApparel:checked').length;
            var totalCheckboxes = $('.studentsApparel').length;
            if (numberOfChecked == totalCheckboxes) $('.studentsApparel').iCheck('uncheck');
        });

        $('.studentsAttendance').on('ifChecked', function(event){
            var numberOfChecked = $('.studentsAttendance:checked').length;
            var totalCheckboxes = $('.studentsAttendance').length;
            if (numberOfChecked == totalCheckboxes) $('#chAtt').iCheck('check');
        });
        $('.studentsAttendance').on('ifUnchecked', function(event){
            var numberOfChecked = $('.studentsAttendance:checked').length;
            var totalCheckboxes = $('.studentsAttendance').length;
            if (numberOfChecked != totalCheckboxes) $('#chAtt').iCheck('uncheck');
        });

        $('.studentsApparel').on('ifChecked', function(event){
            var numberOfChecked = $('.studentsApparel:checked').length;
            var totalCheckboxes = $('.studentsApparel').length;
            if (numberOfChecked == totalCheckboxes) $('#chApp').iCheck('check');
        });
        $('.studentsApparel').on('ifUnchecked', function(event){
            var numberOfChecked = $('.studentsApparel:checked').length;
            var totalCheckboxes = $('.studentsApparel').length;
            if (numberOfChecked != totalCheckboxes) $('#chApp').iCheck('uncheck');
        });
    });
});