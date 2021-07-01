$('#FormDados').submit(function(e){
    e.preventDefault();
    
    var formData = new FormData(this);
    var url_atual = window.location.href;
    $.ajax({
        url: url_atual,
        type:  'POST',
        data: formData,
        dateType: 'json',
        cache: false,
        contentType: false,
        processData: false
    }).done(function(result){

        if( result[2] == true || result[0] !== 'ERROR'){

            btn_up = url_atual.split('/');
            
            if(result[0] == 'UPDATE'){
                tabela = $(btn_up).get(-2);
                id = $(btn_up).get(-1);
                manterURL = '/admin/app/'+tabela+'/'+id;
                novoRegistroURL = '/admin/app/'+tabela;
                mensagem = 'Atualizar pagina';
            }
            else{

                tabela = $(btn_up).get(-1);
                id = result[0].id.replace(/[\\"]/g, '');
                manterURL = '/admin/app/'+tabela+'/'+id;
                novoRegistroURL = '/admin/app/'+tabela;
                mensagem = 'Editar Ultimo registro';
            }

            swal(result[1], {
                icon: "success",
                  buttons: {
                    catch: {
                      text: mensagem,
                      value: "update",
                    },
                    defeat: {
                      text: "Novo",
                      value: "new",
                    }
                  },
                })
                .then((value) => {
                  switch (value) {
                    case "new":
                        window.location = novoRegistroURL; 
                    break;
                    case "update":
                        window.location = manterURL;
                    break;
                  }
        
                });
        }else{
            swal(result[1], {
                icon: "error",
            });
        }

    
    });

    $('#form').each (function(){
        this.reset();
    });
    
    
});


$('.idUser').each(function() {
    
    $(this).on('click',function(){ 
        var id = $(this).attr('id');
        
        $("#getIdUser").val(id);
    })
   
});

/**Formulario com nivel de acesso */

$('#lockConfirme').submit(function(e){

    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        url: '/admin/verificar/usuario',
        type:  'POST',
        data: formData,
        dateType: 'json',
        cache: false,
        contentType: false,
        processData: false
    }).done(function(result){

        if(result[0] == true){
            window.location = '/admin/user/delete/'+  result[3] + '/' + result[2];
        }else{
            swal(result[1], {
                icon: "error",
            });
           
             
        }
    });
});






$('#updatePassword').submit(function(e){

    e.preventDefault();
    
    var x_password = $("#password").val();
    var y_password = $("#u_password").val();
    var formData = new FormData(this);

    if(x_password === y_password){
        $.ajax({
            url: '/admin/user/admin_usuarios',
            type: 'POST',
            data: formData,
            dateType: 'json',
            cache: false,
            contentType: false,
            processData: false
        }).done(function(result){

            if(result[0]){
                $("#messege").removeClass("alert-danger");
                $("#messege").removeClass("alert-primary");
                $("#messege").addClass("alert-success");
                $("#messege").text(result[1])
                $("#bloquear").attr("disabled","disabled")
                $("#bloquear").text("Salvo!")
                $("#fechar").text("Voltar")
            }else{
                $("#messege").removeClass("alert-primary");
                $("#messege").addClass("alert-danger");
                $("#messege").text(result[1])
            }
        })
    }else{
        $("#messege").removeClass("alert-primary");
        $("#messege").addClass("alert-danger");
        $("#messege").text('As senhas não conferem.');
    }
    
    
});


$('#contact').submit(function(e){

    e.preventDefault();
    
    var formData = new FormData(this);
    $.ajax({
        url: '/contato',
        type:  'POST',
        data: formData,
        dateType: 'json',
        cache: false,
        contentType: false,
        processData: false
    }).done(function(result){

        if(result[0]){
            swal({
                title: result[2],
                icon: "success",
            });
        }else{
            
            switch(result[1]){
                case 'CPF':
                    $("#cpf").addClass("is-invalid");
                    $(".invalid-feedback").text(result[2])
                    break;
                case 'RECAPTCHA':
                    swal({
                        title: result[2],
                        icon: "warning",
                    });
                    $("#message").text(result[2]);
                    break;
                case 'CEP':
                $("#cep").addClass("is-invalid");
                $(".invalid-feedback").text(result[2])
                break;
            }

        }
        
       
    });
    
});

$(function(){

    $("#category").change(function(e){
        e.preventDefault();
       
        var u_table  =  $(this).data("table");
        var u_where  =  $(this).data("where");

        if($(this).val()){
            $.getJSON('/admin/json?tabela=',{where: u_where + ' = ' + $(this).val(), table: u_table , ajax: 'true'}, function(j){

            var options = '<option value="0">Nenhuma</option>';  

            if(j){
                
                for (var i = 0; i < j.length; i++) {
    
                    options += '<option value="'+j[i].id+'">'+j[i].titulo+'</option>';
                    
                }
        
                $('#idsubcategory').html(options).show(); 
            }
            
            }); 
    
            }else{
                ('#category').html('<option value="0">Nenhuma</option>').show();
            } 
      
    });
  
  });

  $(document).ready(function(){
    $("#titulo").on("input", function(){
        var textoDigitado = $(this).val();
        $("#url").val(textoDigitado);
    });
  });