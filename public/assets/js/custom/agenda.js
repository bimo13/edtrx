function getAgendaData(teacher_id,date) {
    $.ajax({
        url: base_url+"/agenda/getAgendaData/"+teacher_id+"/"+date,
        success: function(data) {
            if (data['status'] == 0) {
                $("#table-schedule").empty();
                var errMsg = "<tr>";
                errMsg += "<td class=\"desc\">"+data['message']+"</td>";
                errMsg += "</tr>";
                $("#table-schedule").append(errMsg);
            } else {
                $("#table-schedule").empty();

                for (x=0; x < data['data'].length; x++) {
                    var time_start = data['data'][x]['time_start'];
                    time_start = time_start.substring(0, time_start.length-3)
                    var time_end = data['data'][x]['time_end'];
                    time_end = time_end.substring(0, time_end.length-3)

                    var showAgenda = "<tr>";
                    showAgenda += "<td class=\"time\">"+time_start+" - "+time_end+"</td>";
                    showAgenda += "<td class=\"desc\">";
                    showAgenda += data['data'][x]['description'];
                    showAgenda += " ";
                    showAgenda += "[<a href=\""+base_url+"/agenda/"+data['data'][x]['id']+"/edit\">edit</a>]";
                    showAgenda += " ";
                    showAgenda += "[<a href=\"javascript:void(0);\" data-toggle=\"modal\" data-target=\"#modal-delete\" data-id=\""+data['data'][x]['id']+"\" data-title=\"agenda\" data-preview=\""+data['data'][x]['description']+"\">delete</a>]";
                    showAgenda += "</td>";
                    showAgenda += "</tr>";
                    $("#table-schedule").append(showAgenda);
                }
            }
        },
        dataType: "json"
    });
}

$('#modal-delete').on('show.bs.modal', function(e){
    var btn = $(e.relatedTarget);
    var id = btn.data('id');
    var title = btn.data('title');
    var preview = btn.data('preview');
    var modal = $(this)

    $("#form-delete").attr("action", base_url+"/agenda/"+id);

    modal.find('.modal-body').empty();
    modal.find('.modal-body').html('Are you sure want to delete this data ?<br /><br />'+preview)
    modal.find('#btn-delete').on('click', function(e){
        window.location.replace("/admin/"+title+"/destroy/"+id);
    });
});

// Populate data for current date
$(document).ready(function() {
    var date = new Date();
    var curDate = date.getDate();
    var curMonth = date.getMonth()+1;
    var curYear = date.getFullYear();
    var sysDate = curYear+"-"+curMonth+"-"+curDate;
    getAgendaData(teacher_id,sysDate);
});

$('#datepicker').datepicker().on('changeDate', function (es) {

    var tanggal = new Date($('#datepicker').val());
    var date = tanggal.getDate();
    var months = tanggal.getMonth() + 1;
    var years = tanggal.getFullYear();
    var weekday = new Array(7);

    weekday[0] = "SUNDAY";
    weekday[1] = "MONDAY";
    weekday[2] = "TUESDAY";
    weekday[3] = "WEDNESDAY";
    weekday[4] = "THURSDAY";
    weekday[5] = "FRIDAY";
    weekday[6] = "SATURDAY";
    var day = weekday[tanggal.getDay()];

    if (months == 1) {
        var month = 'JANUARY';
    } else if (months == 2) {
        var month = 'FEBRUARY';
    } else if (months == 3) {
        var month = 'MARCH';
    } else if (months == 4) {
        var month = 'APRIL';
    } else if (months == 5) {
        var month = 'MAY';
    } else if (months == 6) {
        var month = 'JUNE';
    } else if (months == 7) {
        var month = 'JULY';
    } else if (months == 8) {
        var month = 'AUGUST';
    } else if (months == 9) {
        var month = 'SEPTEMBER';
    } else if (months == 10) {
        var month = 'OCTOBER';
    } else if (months == 11) {
        var month = 'NOVEMBER';
    } else if (months == 12) {
        var month = 'DECEMBER';
    }

    $('#agenda-day, #agenda-date').empty();

    $('#agenda-day').html(day);
    $('#agenda-date').html(month + ' ' + date + ',' + ' ' + years);

    var sysDate = years+"-"+months+"-"+date;
    getAgendaData(teacher_id,sysDate);

});