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
function initiCheck() {
    $('.icheck').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
    });
}

//busco los servicios asociados a un booking
function findServicesByBooking(url,reference){
    $.post(url, {reference:reference}, function(response) {
        $('#container_select_service').html(response);
        $('#service_selection').selectpicker('refresh');
    });
}

//find incidences asociadas a un booking
function findIncidencesByBooking(booking){
    var url_booking_incidences = Routing.generate('incidence_ajax_get_incidences_by_booking');
    $.post(url_booking_incidences, {reference:booking}, function(response) {
        // pongo todas las incidencias en el modal
        $('div.incidences-content').html(response)
        // $('#container_incidences_by_booking').html(response)
        new PNotify({
            title: '!!Aviso',
            text: 'Este booking contiene incidencias asociadas, si necesita verlas haga click aqui <div class="pull-rigth" style="display:inline-block"><a href="javascript:void(0)" data-toggle="modal" data-target="#viewIncidencesModal"><span class="glyphicon glyphicon-eye-open"></span></a></div>',
            type: 'warning',
            delay : 10000,
            reference: {
                put_thing: true
            }
        });

    });
}

//find incidences asociadas a un booking
// function findIncidencesByBooking(booking){
//     var url_booking_incidences = Routing.generate('incidence_ajax_get_incidences_by_booking');
//     $.post(url_booking_incidences, {reference:booking}, function(response) {
//         $('div#container_incidences_by_booking').html(response);
//         // new PNotify({
//         //     title: 'Reference Module',
//         //     text: 'The reference module is a basic module that demonstrates how to write a PNotify module by implementing many of its features. You can find it in pnotify.reference.js.',
//         //     type: 'info',
//         //     reference: {
//         //         put_thing: true
//         //     }
//         // });
//     });
// }

//find booking in turplan db
function findBooking(data) {
    var reference = $('#find_booking').val();

    var url_booking_detail = Routing.generate('incidence_ajax_get_booking_detail');
    $.post(url_booking_detail, {reference:reference}, function(response) {
        $('#container_booking_detail').html(response);
    });

    //busqueda de los servicios del booking
    var url_services_description = Routing.generate('incidence_ajax_get_services_description');
    findServicesByBooking(url_services_description,reference);

    //busqueda de los clientes de ese booking
    var url_booking_clients = Routing.generate('incidence_ajax_get_booking_client_names');
    $.post(url_booking_clients, {reference:reference}, function(response) {
        $('#container_booking_clients').html(response);
        $('#client_selection').selectpicker('refresh');
    });

    //ejecuto la funcion q busca las incidencias asociadas a ese booking
    findIncidencesByBooking(reference);

    //aqui pongo el codigo del booking en el input hidden
    $('#select_reference').val(reference);
}

//select fields for incidences types
function showByTypes(id) {

    var reference = $('#select_reference').val();
    var div = $('.altern-result');
    switch(id) {
        //intern incidence case
        case '1':
            //$('#container_booking_suppliers').html('');
            div.html('');
            //$('#container_booking_clients').html('');
            //hacer select con personas
            var url_booking_persons = Routing.generate('incidence_ajax_get_booking_person_names');
            $.post(url_booking_persons, {reference:reference}, function(response) {
                //console.log($(response).wrap("<div class='new'></div>"));
                div.html(response);
                if (! div.parent().is( "div.col-md-3" ) ) {
                    //div.unwrap();
                    div.wrap( "<div class='col-md-3'></div>" );
                }// else {
                //    div.wrap( "<div class='col-md-3'></div>" );
                //}
                //div.wrap("<div class='col-md-3'></div>");
                $('#select-responsable').selectpicker('refresh');
            });
            break;
        //supplier incidence case
        case '2':
            //$('#container_booking_clients').html('');
            div.html('');
            var url_booking_suppliers = Routing.generate('incidence_ajax_get_booking_suppliers');
            $.post(url_booking_suppliers, {reference:reference}, function(response) {
                div.html(response);
                //div.html(response);
                if (!div.parent().is( "div.col-md-3" ) ) {
                    //div.unwrap();
                    div.wrap( "<div class='col-md-3'></div>" );
                }// else {
                //    div.wrap( "<div class='col-md-3'></div>" );
                //}
                //div.wrap("<div class='col-md-3'></div>");
                //$('.altern-result').wrap("<div class='col-md-3'></div>");
                $('#supplier_selection').selectpicker('refresh');
            });
            break;
        //clients incidence case
        case '3':
            $('.altern-result').html('');
            //$('#container_booking_suppliers').html('');
            //$('#container_booking_persons').html('');
            //var url_booking_clients = Routing.generate('incidence_ajax_get_booking_client_names');
            //$.post(url_booking_clients, {reference:reference}, function(response) {
            //    $('#container_booking_clients').html(response);
            //    $('#client_selection').selectpicker('refresh');
            //});
            break;
        default:
            //$('#container_booking_suppliers').html('');
            //$('#container_booking_clients').html('');
            //$('#container_booking_persons').html('');
    }
}

//esta funcion recibe un proveedor y me devuelve los servicios asociados a ese proveedor\
function showServicesBySupplier(data) {
    var url_booking_services_suppliers = Routing.generate('incidence_ajax_get_booking_services_supplier');
    var reference = $('#select_reference').val();
    $.post(url_booking_services_suppliers, {supplier:data, reference:reference}, function(response) {
        $('#container_select_service').html(response);
        $('#service_selection').selectpicker('refresh');
    });
}

//muestra un listado de servicios afectados
function showCompensationCost() {

    var url_booking_compensation_services = Routing.generate('incidence_ajax_get_compensation_service');
    var reference = $('#select_reference').val();
    $.post(url_booking_compensation_services, {reference:reference}, function(response) {
        $('#container_compensation_cost').html(response);
        $('#container_sustitution_cost_original').html('');
        $('#container_sustitution_cost_sustitute').html('');
    });

}

//muestra todos los servicios cancelados de costo por sustitucion
function showSustitutionOriginalCost() {
    var url_booking_sustitution_services = Routing.generate('incidence_ajax_get_sustitution_services');
    var reference = $('#select_reference').val();
    $.post(url_booking_sustitution_services, {reference:reference}, function(response) {
        $('#container_sustitution_cost_original').html(response);
        $('#container_compensation_cost').html('');
    });
}

//calculo de costo por sustitucion luego de seleccionar el servicio cancelado
function showSustitutionSustituteCost(type) {

    var url_booking_sustitution_services = Routing.generate('incidence_ajax_get_sustitution_services');
    var reference = $('#select_reference').val();
    // var service = $('#select_reference').val();
    $.post(url_booking_sustitution_services, {reference:reference, serviceType:type}, function(response) {
        $('#container_sustitution_cost_sustitute').html(response);
        // $('#container_compensation_cost').html('');
    });
}

function hideCost() {
    $('#container_sustitution_cost_sustitute').html('');
    $('#container_sustitution_cost_original').html('');
    $('#container_compensation_cost').html('');
    $('#elem-hidden').addClass('elem-hidden');
    $('.fa-arrow-circle-right').addClass('elem-hidden');
}

function test(data) {
    console.log($(data).attr('data-type'));
}

function calculateNoCost() {
    $('#final_cost').val(0);
    //$('input[name=cost_type]').val(1)
}

//calculo de costo por compensacion
function calculateCompensationCost(data) {
    var final_cost = $(data).parent().parent().find('.service_cost').html();
    $('#final_cost').val($(data).parent().parent().find('.service_cost').html());
    $('span#show-final-cost').html(final_cost);
    //$('input[name=cost_type]').val(2)
}

//calculo de costo por sustitucion
function calculateSustitutionCost(data) {
    var minuend  = $(data).parent().parent().find('.service_cost').html();
    var subtracting = $('input[name=cost_selected_original]:checked').parent().parent().find('.service_cost').html();
    var final = minuend - subtracting;
    $('#final_cost').val(final);
    $('span#show-final-cost').html(final);
    //$('input[name=cost_type]').val(3)
}

function calculateOtherCost(data) {
    $('#final_cost').val($(data).val());
    $('span#show-final-cost').html($(data).val());
    //$('input[name=cost_type]').val(4)
}

$(document).ready( function() {

    initiCheck();

    PNotify.prototype.options.styling = "bootstrap3";

    //cuando seleccione el tipo de la incidencia ejecuto la fnc q me muestra los tipos
    $('.radio_incidence_types').on('ifClicked',function(){
        showByTypes($(this).val());
    });

    //cuando de click en los tab
    $('a[data-toggle="tab"]').on('show.bs.tab',function(){
        switch ($(this).text()){
            case 'Acciones':
                $('small.text').html($(this).text());
            case 'Costos':
                $('small.text').html($(this).text());
            case 'Datos Generales':
                $('small.text').html($(this).text());
            //default:
            //    $('small.text').html('Datos Generales');
        }
    })
    //$('#myTab a:last').tab('show');asi es q se selecciona un tab y se visualiza


    //cuando sel el tipo de costo de compensacion
    $('#compensation_cost').on('ifClicked',function(){
        showCompensationCost();
        $('#elem-hidden').addClass('elem-hidden');
        $('.fa-arrow-circle-right').addClass('elem-hidden');
        $('span#show-final-cost').html(0);
    });

    $('#no_cost').on('ifClicked',function(){
        hideCost();
        calculateNoCost();
        $('span#show-final-cost').html(0);
    });
    
    $('#other_cost').on('ifClicked',function(){
        $('.other-cost').val('');
        $('.elem-hidden').removeClass('elem-hidden');
        $('#container_sustitution_cost_sustitute').html('');
        $('#container_sustitution_cost_original').html('');
        $('#container_compensation_cost').html('');
        $('.fa-arrow-circle-right').addClass('elem-hidden');
        $('span#show-final-cost').html(0);
    });

    //cuando seleciono el tipo de costo de no calidad por sustitucion
    $('#sustitution_cost').on('ifClicked',function(){
        showSustitutionOriginalCost();
        $('#elem-hidden').addClass('elem-hidden');
        $('.fa-arrow-circle-right').removeClass('elem-hidden');
        $('span#show-final-cost').html(0);
    });
    //
    // alert(window)
    // setTimeout(function() {
    //     $( ".ui-pnotify" ).fadeOut(1000, function () {
    //         $(".ui-pnotify").remove();
    //     });
    // },6000);

    $('.content').css('min-height', ($(window).innerHeight()-200));

    $(".link-eliminar").click(function (event) {
        $("#link-popup-eliminar").attr("href", $(this).attr("data-url"));
        $("#text-descripcion-popup-eliminar").html($(this).attr("data-descripcion"));
    });

    //configuracion del campo date
    $('#system_backendbundle_incidence_incidenceDate').datetimepicker({
       format: 'YYYY-MM-DD',
       locale: 'es',
       showClear: true
    });

    $('.link-tooltip').tooltip();

    // $('textarea').trumbowyg({
    //     lang: 'es'
    // });
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