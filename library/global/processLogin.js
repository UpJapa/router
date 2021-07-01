$(document).ready(function(){

    var count = 0;
    var pass = true;

    $(".fa").addClass("fa-lock");

    $('#processLogin').submit(function(e){
    e.preventDefault();

    $(".fa").removeClass("fa-lock");
    $(".fa").addClass("fa-spinner fa-spin");

    count++;
        
    var u_login = $('#login').val();
    var u_password = $('#password').val();
    var u_cod = $('#cod').val();
    var u_token = $('#token').val();
    var url_admin = $("#ADMIN").val();
    var url_login = '/' + url_admin + '/login';

    
    if($.trim(u_login).length == 0) {
			jQuery("#messege").text('Informe seu Login!');
			jQuery("#messege").show();
			return false;
	}
		
    if($.trim(u_password).length == 0) {
        jQuery("#messege").text('Informe sua Senha!');
        jQuery("#messege").show();
        return false;
    }
    

    if(count > 3){

        $(".fa").removeClass("fa-spinner fa-spin");
        $(".fa").addClass("fa-lock"); 

        pass = false;
        token = u_token.substr(0, 4);
        $("#key").text(token);
        $("#verifyCod").css("display",'block');
       
        if(u_cod == token){
            pass = true;
        }else if($.trim(u_cod).length > 2 && u_cod !== token){
            jQuery("#messege").text('Código invalido!');
            jQuery("#messege").show();
        }
        
    }
    
    if(pass == true){

        $.ajax({

            url: url_login,
            method: 'POST',
            data: {login: u_login, password:u_password},
            dataType: 'json',
            
        }).done(function(result){
          
          if(result.login === true){
           
            $("#messege").text(result.messege);
            setTimeout(function(){
              window.location = '/' + url_admin;
            }, 100);
            
          }else{

              $(".fa").removeClass("fa-spinner fa-spin");
              $(".fa").addClass("fa-lock");
              
              $("#messege").ready(function(){
              $("#messege").css("color", "#000000");
              $("#messege").text(result.messege);
            });
           
          }
          
        });

    }
    


    });
   
});