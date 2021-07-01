$(document).ready(function(){

    $('#Forgot').submit(function(e){
        e.preventDefault();

        u_passNew = $("#passNew").val();
        u_passCof = $("#passCof").val();
        u_id = jQuery(this).data('id');
        
        if(u_passCof === u_passNew)
        {
            $.ajax({
                url: '/admin/forgot/reset',
                method: 'POST',
                data: {password: u_passNew, iduser:u_id},
                dataType: 'json',
            }).done(function(result){
                console.log(result);
              if(result[0]){
                     setTimeout(function(){
                        window.location = '/admin/forgot/success';
                    }, 100);
                }
              else{
                swal("Error!",result[1], "error");
              }

            });

        }else
        {
            swal("Senhas não conferem!",'Tente novamente', "error");
        }

    });
});