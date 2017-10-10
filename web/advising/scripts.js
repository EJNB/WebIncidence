///**
// * Created by jorge.fernandez on 2/15/2017.
// */
//function markAsRead(idItem){
//    var url =$('#link-details-item-'+idItem).attr('data-url-mark');
//    var showOption = $('.showHideOptions:checked').val();
//    var filter = $('#find_reference').val();
//    $.post(url, {idItem: idItem, showOption:showOption, filter:filter}, function (response) {
//        $('#table-ajax').html(response);
//        markRow(idItem);
//    });
//}
//
//function showHideItem(idItem){
//    var url =$('#link-show-hide-'+idItem).attr('data-url');
//    var id = $('#link-show-hide-'+idItem).attr('data-value');
//    var showOption = $('.showHideOptions:checked').val();
//    var filter = $('#find_reference').val();
//    var holdyDiv = $('<div></div>').attr('id', 'blocker');
//    holdyDiv.appendTo('body');
//    $('#blocker').addClass('blocker');
//    $('#img-loading').removeClass('hide-elemento');
//    $.post(url, {idItem: id, showOption:showOption, filter:filter}, function (response) {
//        $('#table-ajax').html(response);
//        $('#blocker').remove();
//        $('#img-loading').addClass('hide-elemento');
//    });
//}
//
//function readUnreadItem(idItem){
//    var url =$('#link-read-unread-'+idItem).attr('data-url');
//    var id = $('#link-read-unread-'+idItem).attr('data-value');
//    var showOption = $('.showHideOptions:checked').val();
//    var filter = $('#find_reference').val();
//    var holdyDiv = $('<div></div>').attr('id', 'blocker');
//    holdyDiv.appendTo('body');
//    $('#blocker').addClass('blocker');
//    $('#img-loading').removeClass('hide-elemento');
//    $.post(url, {idItem: id, showOption:showOption, filter:filter}, function (response) {
//        $('#table-ajax').html(response);
//        $('#blocker').remove();
//        $('#img-loading').addClass('hide-elemento');
//    });
//    markRow(idItem);
//}
//
//function detailsByRef(reference){
//    var url =$('#details-ref-'+reference).attr('data-url');
//    $.post(url, {ref: reference}, function (response) {
//        $('#modal-body-details-ref').html(response);
//        $('#modal-details-ref').modal();
//    });
//}
//
//function hideAllItemsByRef(reference){
//    var url =$('#hide-all-ref-'+reference).attr('data-url');
//    var showOption = $('.showHideOptions:checked').val();
//    var holdyDiv = $('<div></div>').attr('id', 'blocker');
//    holdyDiv.appendTo('body');
//    $('#blocker').addClass('blocker');
//    $('#img-loading').removeClass('hide-elemento');
//    $.post(url, {ref: reference, showOption:showOption}, function (response) {
//        $('#table-ajax').html(response);
//        $('#blocker').remove();
//        $('#img-loading').addClass('hide-elemento');
//    });
//}
//
//function showAllItemsByRef(reference){
//    var url =$('#show-all-ref-'+reference).attr('data-url');
//    var showOption = $('.showHideOptions:checked').val();
//    //alert(showOption);
//    var holdyDiv = $('<div></div>').attr('id', 'blocker');
//    holdyDiv.appendTo('body');
//    $('#blocker').addClass('blocker');
//    $('#img-loading').removeClass('hide-elemento');
//    $.post(url, {ref: reference, showOption:showOption}, function (response) {
//        $('#table-ajax').html(response);
//        $('#blocker').remove();
//        $('#img-loading').addClass('hide-elemento');
//    });
//}
//
//function detailsByItem(id,where){
//    var url =$('#link-details-item-'+id).attr('data-url');
//    $.post(url, {id: id}, function (response) {
//        $('#modal-body-details-ref').html(response);
//        $('#modal-details-ref').modal();
//
//    });
//    if(where!='finder'){
//        markAsRead(id);
//    }
//    markRow(id);
//
//}
//
//function passReasignReferenceToModal(reference){
//    $('#link-popup-reasignar').attr('data-value',reference);
//
//    var url =$('#reasign-ref-'+reference).attr('data-url');
//    $('#link-popup-reasignar').attr('data-url',url);
//    $('#modal-reasign-ref').modal();
//}
//
//function reasignRef(){
//    var url = $('#link-popup-reasignar').attr('data-url');
//    var reference = $('#link-popup-reasignar').attr('data-value');
//    var showOption = $('.showHideOptions:checked').val();
//    var user = $('#select-user').val();
//    var comment = $('#note_comment').val();
//    //alert(comment);
//    $.post(url, {ref: reference, showOption:showOption, user:user, comment:comment}, function (response) {
//        $('#table-ajax').html(response);
//        $('#modal-reasign-ref').modal('toggle');
//    });
//}
//
//function createNote(item){
//    $("#modal-item-id").val(item);
//    $("#modal-item-ref").val($('#create-note-'+item).attr('data-ref'));
//    $('#modal-create-notification').modal('toggle');
//}
//
//function saveNote(){
//    $('#form-create-note').submit();
//}
//
//function markRow(id){
//
//    $(".table-selected tbody tr.to-mark").each(function () {
//        $(this).removeClass('row-selected');
//    });
//    $('#tr-'+id).addClass('row-selected');
//
//}

$(document).ready( function() {
    PNotify.prototype.options.styling = "bootstrap3";
    
    //$('select:not(.select-standard)').select2();

    //setTimeout(function() {
    //    $( ".ui-pnotify" ).fadeOut(1000, function () {
    //        $(".ui-pnotify").remove();
    //    });
    //},6000);

    $('.content').css('min-height', ($(window).innerHeight()-200));

    $(".link-eliminar").click(function (event) {
        $("#link-popup-eliminar").attr("href", $(this).attr("data-url"));
        $("#text-descripcion-popup-eliminar").html($(this).attr("data-descripcion"));
    });


    //$('.link-tooltip').hover(function(){
    //    $(this).tooltip('show');
    //})
    //
    //$(".link-details-item").click(function (event) {
    //    $("#descripcion-popup").html($(this).attr("data-descripcion"));
    //});
    //
    //$('.showHideOptions').click(function (event) {
    //    //alert($('input:name=""').val());
    //    //$(this).attr('checked','checked');
    //    $('#form-reference').submit();
    //});
    //
    //$('#finder-date-from').datetimepicker({
    //    format: 'YYYY-MM-DD',
    //    locale: 'es',
    //    showClear: true
    //});
    //$('#finder-date-to').datetimepicker({
    //    useCurrent: false, //Important! See issue #1075
    //    format: 'YYYY-MM-DD',
    //    locale: 'es',
    //    showClear: true
    //});
    //$("#finder-date-from").on("dp.change", function (e) {
    //    $('#finder-date-to').data("DateTimePicker").minDate(e.date);
    //});
    //$("#finder-date-to").on("dp.change", function (e) {
    //    $('#finder-date-from').data("DateTimePicker").maxDate(e.date);
    //});
    //
    //$('#finder-search').click(function (event) {
    //    $('#finder-form').submit();
    //});
    //
    //$('#service-search').click(function (event) {
    //    $('#form-service-filter').submit();
    //});
    //
    //$('.showNote').click(function (event) {
    //    $('#note-id').val($(this).attr('data-id'));
    //    $('#note-description').html($(this).attr('data-description'));
    //});
    //
    //$('#link-note-hide').click(function(event){
    //
    //    var id = $('#note-id').val();
    //    $('#form-delete-note').attr('action',$('#note-id-'+id).attr('data-url-show-hide'));
    //    $('#form-delete-note').submit();
    //});
    //
    //$('#link-note-delete').click(function(event){
    //    var id = $('#note-id').val();
    //    $('#form-delete-note').attr('action',$('#note-id-'+id).attr('data-url-delete'));
    //    $('#form-delete-note').submit();
    //});
    //
    //$('#link-service-create-from-fix').click(function (event) {
    //    if($('#modal-service-code').val()!=''&&$('#modal-service-desc').val()!=''){
    //        $('#form-create-service-from-fix').submit();
    //    }else{
    //        new PNotify({
    //            title: 'Error!',
    //            text: 'No se pueden dejar campos vacíos.',
    //            type: 'error'
    //        });
    //    }
    //
    //});
    //$('#link-status-create-from-fix').click(function (event) {
    //    if($('#modal-status-desc').val()!=''){
    //        $('#form-create-status-from-fix').submit();
    //    }else{
    //        new PNotify({
    //            title: 'Error!',
    //            text: 'No se pueden dejar campos vacíos.',
    //            type: 'error'
    //        });
    //    }
    //
    //});
    //$('#link-comment-create-from-fix').click(function (event) {
    //    if($('#modal-comment-desc').val()!=''){
    //        $('#form-create-comment-from-fix').submit();
    //    }else{
    //        new PNotify({
    //            title: 'Error!',
    //            text: 'No se pueden dejar campos vacíos.',
    //            type: 'error'
    //        });
    //    }
    //});
    //
    //$('#show-count-out').html($('#list-notifications li').size());
    //$('#show-count-in').html('Tiene '+$('#list-notifications li').size()+' notificacion(es)');
    //
    //$('#ref-search').click(function (event) {
    //    $('#form-reference').submit();
    //});
    ////
    ////if($('#login-box').html()){
    ////    $('body').css('background-color','#F6F6F6');
    ////}
    //$('#range-date-from').datetimepicker({
    //    format: 'YYYY-MM-DD',
    //    locale: 'es',
    //    showClear: true
    //});
    //$('#range-date-to').datetimepicker({
    //    useCurrent: false, //Important! See issue #1075
    //    format: 'YYYY-MM-DD',
    //    locale: 'es',
    //    showClear: true
    //});
    //$("#range-date-from").on("dp.change", function (e) {
    //    $('#range-date-to').data("DateTimePicker").minDate(e.date);
    //});
    //$("#range-date-to").on("dp.change", function (e) {
    //    $('#range-date-from').data("DateTimePicker").maxDate(e.date);
    //});
    //
    //$('#count-range-search').click(function (event) {
    //    if($("#range-date-from").val()!='' && $("#range-date-to").val()!=''){
    //        $('#count-in-range').submit();
    //    }else{
    //        new PNotify({
    //            title: 'Error!',
    //            text: 'Seleccione ambas fechas.',
    //            type: 'error'
    //        });
    //    }
    //
    //});
    //
    //$('#select_all_notes').change(function () {
    //    if($(this).is(':checked')){
    //        $(".check_note").prop('checked',true);
    //    }
    //    else{
    //        $(".check_note").prop('checked',false);
    //    }
    //})
    //
    //$('#delete_note_select').click(function () {
    //    $('#notes_index_form').submit();
    //});

    //quitar el label

});