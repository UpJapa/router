jQuery(document).on('click', '#Ustatus', function(e) {
    
    var u_id = jQuery(this).data('id');
    var u_table = jQuery(this).data('table');
    var u_status = jQuery(this).data('status');

    if(u_status != ''){

        $.ajax({
            url: '/admin/status/'+u_table,
            type:  'POST',
            data: {id: u_id, table: u_table, status: u_status},
            dateType: 'json',
            cache: false
        }).done(function(result){
            
                if(result[0]){

                    if(result[1] == 'N'){

                        $("#icon_"+u_id).removeClass('bi-check-square-fill');
                        $("#icon_"+u_id).addClass('bi-square');
                        $(".status_"+u_id).data('status', result[1]);
                        $("#status_"+u_id).addClass('statusOff');


                    }else if(result[1] == 'Y'){
            
                        $("#icon_"+u_id).removeClass('bi-square');
                        $("#icon_"+u_id).addClass('bi-check-square-fill');
                        $('.status_'+u_id).data('status', result[1]);
                        $("#status_"+u_id).removeClass('statusOff');
                    }

                }else{

                    swal(result[1], {
                        icon: "error",
                    });

                }
            
        })

    }
    
    
       
});



function marcarTodos(marcardesmarcar){
    $('.marcar').each(function () {
        this.checked = marcardesmarcar;
    });
}

$('#checkboxCustom').click(function() {

    var checado = $("#checkboxCustom").is(':checked')
    if(checado == true){
        $('#btn_check').removeClass("oculto")
    }else{
        $('#btn_check').addClass("oculto")
    }

});

$('.marcar').click(function() {

    var checado = $(".marcar").is(':checked')
    if(checado == true){
        $('#btn_check').removeClass("oculto")
    }else{
        $('#btn_check').addClass("oculto")
    }

});


$('#deleteSelect').submit(function(e){

    e.preventDefault();
    var u_table = jQuery(this).data('table');
    var formData = new FormData(this); 
    swal("Você tem certeza que deseja excluir?", {
        dangerMode: true,
        buttons: true,
      }).then((value) => {
        switch (value) {
          case true:
            
            $.ajax({
                url: '/admin/delete/'+u_table,
                type:  'post',
                data: formData,
                dateType: 'json',
                cache: false,
                contentType: false,
                processData: false
                
            }).done(function(){
                window.location = '/admin/'+u_table;
            })
          break;
        }
      });

});




$(function(){

    $(".edit_gallery").change(function(){
        u_id  =  $(this).data("id");
        u_table  =  $(this).data("table");
        formData  = new FormData(this); 
        titulo = $("#titulo_"+u_id).val();
        $.ajax({
            url: '/admin/galeria/'+u_table+'/'+u_id+'/update',
            type:  'POST',
            data: formData,
            dateType: 'json',
            cache: false,
            contentType: false,
            processData: false,
        })
       $("#title_"+u_id).text(titulo)
      
    });
  
  });

  $('#deleteImage').click(function() {
   
    let u_file = $("#deleteImage").data('file');
    let u_id = $("#deleteImage").data('id');
    let u_tabela = $("#deleteImage").data('tabela');

    swal({
        title: "Você tem certeza?",
        text: "Uma vez excluído, você não poderá recuperar este arquivo!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: '/admin/deleteimage',
                    type:  'POST',
                    data: {file:u_file, id:u_id, tabela: u_tabela},
                    dateType: 'json',
                    cache: false,
                }).done(function(results){
                    
                    if(results){
                        swal("Feito! arquivo excluido com sucesso!", {
                            icon: "success"
                        });
                        $("#imgForm").attr("src", "/views/images/default.png");
                        $("#deleteImage").css('display','none')
                    }else{
                        swal("Falha ao excluir o arquivo!", {
                            icon: "error"
                        });
                    }
                });
            } 
      });
  });