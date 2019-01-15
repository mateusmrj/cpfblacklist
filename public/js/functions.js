$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$('#btnVerifica').on("click", function (e) {
    (e).preventDefault();
    if ($("#txtCpf").val().length < 14) {
        swal({
            title: 'Atenção!',
            type: 'info',
            html: 'CPF Invalido!<br/> Numero de caracteres menor que o requerido.',
            showCloseButton: true,
            showCancelButton: false,
            focusConfirm: false
        });
        $("#txtCpf").val("");
    } else {

        check();
    }
});

$('#blockCpf').click(function (e) {
    e.preventDefault();

    let cpf = $("#txtCpf").val();
    $.ajax({
        url: "/adicionar",
        type: "get",
        data: {'cpf': cpf},
        dataType: "json",
        success: function (response) {
            swal("OK!", "CPF<br>" + response.cpf + "<br>adicionado a blacklist", "success");
            $('#freeCpf').hide();
            $('#blockCpf').hide();
            $("#txtCpf").val("");
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            swal({
                title: 'Atenção!',
                type: 'info',
                html: '<b>Ops!</b> Tente novamente ou reporte este erro (' + errorThrown + ').',
                showCloseButton: true,
                showCancelButton: false,
                focusConfirm: false
            });
        }
    });
});

$('#freeCpf').click(function (e) {
    e.preventDefault();

    let cpf = $("#txtCpf").val();
    $.ajax({
        url: "/remover",
        type: "get",
        data: {'cpf': cpf},
        dataType: "json",
        success: function (response) {
            swal("OK!", "CPF<br>" + response.cpf + "<br>removido da blacklist", "success");
//                            location.reload();
            $('#freeCpf').hide();
            $('#blockCpf').hide();
            $("#txtCpf").val("");
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            swal({
                title: 'Atenção!',
                type: 'info',
                html: '<b>Ops!</b> Tente novamente ou reporte este erro (' + errorThrown + ').',
                showCloseButton: true,
                showCancelButton: false,
                focusConfirm: false
            });
        }
    });
});

function check() {
    let cpf = $("#txtCpf").val();
    $.ajax({
        url: "/consulta",
        type: "get",
        data: {'cpf': cpf},
        dataType: "json",
        success: function (response) {
            //var msg = response;
            //console.log(msg[0]["cpf"]);]
            if (response.data.status == 1) {
                $('#freeCpf').show();
                $('#blockCpf').hide();
            } else {
                $('#blockCpf').show();
                $('#freeCpf').hide();
            }
            swal("" + response.data.description + "", "CPF<br>" + response.data.cpf + "", "success");

        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            swal({
                title: 'Atenção!',
                type: 'info',
                html: '<b>Ops!</b> Tente novamente ou reporte este erro (' + errorThrown + ').',
                showCloseButton: true,
                showCancelButton: false,
                focusConfirm: false
            });
        }
    });
}