@include('layouts.admin_header')
  @include('pages.listesClient')
@include('layouts.admin_footer')
<script type="text/javascript">
 //Suppression de compte client
 $('.del').click(function(){
    var idCl = $(this).attr('id');
    var nom  = $(this).attr('nom');
    var data = {idClient:idCl};
    Swal.fire({
         title: 'GESTION DE COMPTE',
         text: "Voulez-vous supprimer "+nom+" ?",
         icon: 'error',
         showCancelButton: true,
         confirmButtonColor: '#3085d6',
         cancelButtonColor: '#d33',
         cancelButtonText: 'non',
         confirmButtonText: 'oui , supprimer!',
         backdrop: `rgba(240,15,83,0.4)`
       }).then((result)=>{
         if (result.value) {
           $.ajax({
              url:'delClient',
              method:'GET',
              data:data,
              dataType:'json',
              success:function(data){
                if (data.code==2) {
                  Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: nom+' a été Supprimée avec succès',
                    showConfirmButton: false,
                    timer: 1500
                  });
                  window.location="clients_liste";
                }
              },
              error:function(data){
                console.log('error');
              }
           });
         }
       });
 });

 //Modification de compte client
  $('.edit').click(function(){
     var idCl = $(this).attr('id');
     var data = {idClient:idCl};
     $.ajax({
       url:'readClID',
       method:'GET',
       data:data,
       dataType:'json',
       success:function(data){
           $('.nom').val(data.nom);
           $('.prenom').val(data.prenom);
           $('.mail').val(data.mail);
           $('.entrep').val(data.entreprise);
           $('.tel').val(data.tel);
           $('.pass').val(data.pass);
           $('.id').val(data.id);
           $('#exampleModalLong').modal('show');
       },
       error:function(data){
         console.log("error");
       }
     });


  });

//Validation des mises à jour
  $('.reservBtn').click(function(){
    var id = $('.id').val();
    var nom = $('.nom').val();
    var prenom = $('.prenom').val();
    var mail = $('.mail').val();
    var entrep = $('.entrep').val();
    var tel = $('.tel').val();
    var pass = $('.pass').val();
    var nf = nom+' '+prenom;
    var data = {nom:nom,prenom:prenom,mail:mail,entrep:entrep,tel:tel,pass:pass,id:id};
    $.ajax({
      url:'modif',
      method:'GET',
      data:data,
      dataType:'json',
      success:function(data){
        Swal.fire({
          position: 'top-end',
          icon: 'success',
          title: nf+' a été modifié avec succès',
          showConfirmButton: false,
          timer: 1500
        });
        window.location="clients_liste";
      },
      error:function(data){console.log(data);}
    });
  });

//Filtre de recherche automatique
$('.search').keyup(function(){
   var valeur = $(this).val();
   var attribut  = $('.pays').children("option:selected").val();
   var data = {attribut:attribut,valeur:valeur};
   console.log('attribut:'+attribut+'valeur:'+valeur);
   if (valeur=="") {
       window.location="clients_liste";
   }else{
     $.ajax({
        url:'filtreCl',
        method:'GET',
        data:data,
        dataType:'html',
        success:function(data){
          $('.searchClient').html(data);
        },
        error:function(data){console.log('error');}
     });
   }



});


</script>
