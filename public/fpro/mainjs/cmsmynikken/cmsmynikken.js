function saveNotification(){
    var titulo = $("#alertTittle").val();
    var alertDate = $("#alertDate").val();
    var mensaje = $("#alertMsg").val();

    if(titulo.trim() == '' || alertDate.trim() == '' || mensaje.trim() == ''){
        swal({
            title: 'Ups...!',
            text: "Todos los campos son requeridos",
            type: 'error',
            padding: '2em'
        })
    }
    else{
        var data = {titulo:titulo, alertDate:alertDate, mensaje:mensaje};
        $.ajax({
            type: "GET",
            url: "/addNotifyMyNikken",
            data: data,
            cache:false,
            contentType: false,
            processData: false,
            beforeSend: function(){
                $("#alertTittle").attr('disabled', true);
                $("#alertDate").attr('disabled', true);
                $("#alertMsg").attr('disabled', true);
                $("#btnsave").attr('disabled', true);
            },
            success: function (response) {
                if(response == 'add'){
                    swal({
                        title: 'OK!',
                        text: "La alerta ha sido guardada y se publicara en breve en MyNikken",
                        type: 'success',
                        padding: '2em'
                    })
                    $("#alertTittle").attr('disabled', false);
                    $("#alertDate").attr('disabled', false);
                    $("#alertMsg").attr('disabled', false);
                    $("#alertTittle").val('');
                    $("#alertDate").val('');
                    $("#alertMsg").val('');
                    $("#btnsave").attr('disabled', false);
                }
                else{
                    swal({
                        title: 'Ups...!',
                        text: "No fue posible guardar la información.",
                        type: 'error',
                        padding: '2em'
                    })
                }
            },
            fail: function(){
                if(response == 'add'){
                    swal({
                        title: 'OK!',
                        text: "La alerta ha sido guardada y se publicara en breve en MyNikken",
                        type: 'success',
                        padding: '2em'
                    })
                }
                else{
                    swal({
                        title: 'Ups...!',
                        text: "No fue posible guardar la información.",
                        type: 'error',
                        padding: '2em'
                    })
                }
            }
        });
    }
}

$('#saveAlertForm').on('submit', function(e) {
    console.log('event form init');
    // evito que propague el submit
    e.preventDefault();
    //deshabilitamos el boton para que solo se haga una peticion de registro
    $("#btneventc").attr('disabled', true);

    // agrego la data del form a formData
    var formData = new FormData(this);
    formData.append('_token', $('input[name=_token]').val());
    var titulo = $("#alertTittle").val();
    var alertDate = $("#alertDate").val();
    var mensaje = $("#alertMsg").val();

    if(titulo.trim() == '' || alertDate.trim() == '' || mensaje.trim() == ''){
        swal({
            title: 'Ups...!',
            text: "Todos los campos son requeridos",
            type: 'error',
            padding: '2em'
        })
    }
    else{
        $.ajax({
            type:'POST',
            url: '/addNotifyMyNikken',
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            beforeSend: function(){
                $("#alertTittle").attr('disabled', true);
                $("#alertDate").attr('disabled', true);
                $("#alertMsg").attr('disabled', true);
                $("#btnsave").attr('disabled', true);
            },
            success:function(data){
                if(data == 'add'){
                    swal({
                        title: 'OK!',
                        text: "La alerta ha sido guardada y se publicara en breve en MyNikken",
                        type: 'success',
                        padding: '2em'
                    })
                    $("#alertTittle").attr('disabled', false);
                    $("#alertDate").attr('disabled', false);
                    $("#alertMsg").attr('disabled', false);
                    $('#saveAlertForm').trigger('reset');
                    $("#btnsave").attr('disabled', false);
                    setDate();
                }
                else{
                    swal({
                        title: 'Ups...!',
                        text: "No fue posible guardar la información.",
                        type: 'error',
                        padding: '2em'
                    })
                    $("#alertTittle").attr('disabled', false);
                    $("#alertDate").attr('disabled', false);
                    $("#alertMsg").attr('disabled', false);
                    $("#btnsave").attr('disabled', false);
                    setDate();
                }
            },
            error: function(jqXHR, text, error){
                Swal.fire({
                    type: 'error',
                    title: 'Error',
                    text: 'Error al guardar la información',
                })
                $("#alertTittle").attr('disabled', false);
                $("#alertDate").attr('disabled', false);
                $("#alertMsg").attr('disabled', false);
                $("#btnsave").attr('disabled', false);
                setDate()
            }
        });
    }
});

$('#comunicados').DataTable({
	destroy: true,
	info: false,
	pageLength: 13,
	searching: true,
    ordering: false,
	lengthChange: false,
    "language": {
        "paginate": { "previous": "<i class='flaticon-arrow-left-1'></i>", "next": "<i class='flaticon-arrow-right'></i>" },
        "info": "Showing page _PAGE_ of _PAGES_"
    }
});

function setDate(){
    Date.prototype.toDateInputValue = (function() {
        var local = new Date(this);
        local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
        return local.toJSON().slice(0,10);
    });
    
    $('#alertDate').val(new Date().toDateInputValue());
}
setDate()

$("#allCountries").change(function () {
    $("#chckCol, #chckMex, #chckPer, #chckCri, #chckEcu, #chckSlv, #chckGtm, #chckPan, #chckChl").prop('checked', $(this).prop("checked"));
});
