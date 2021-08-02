@include('layouts.admin_header')
  @include('pages.devisDemande')
@include('layouts.admin_footer')
<script type="text/javascript">

 //Filtre de recherche automatique
 $('.search').keyup(function(){
   var valeur = $(this).val();
   var attribut  = $('.attribut').children("option:selected").val();
   var data = {attribut:attribut,valeur:valeur};
   console.log('attribut:'+attribut+'valeur:'+valeur);
   if (valeur=="") {
       window.location="devis_demande";
   }else{
     $.ajax({
        url:'filtreNewDv',
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

 //Validation du devis
 $('.valide').click(function(){
    var id = $(this).attr('id');
    var nom = $(this).attr('nom');
    var data = {id:id,nom:nom};
    console.log('nom: '+nom+'id: '+id);
    Swal.fire({
         title: 'GESTION DE DEVIS',
         text: "Voulez-vous valider le devis "+nom+" ?",
         icon: 'error',
         showCancelButton: true,
         confirmButtonColor: '#3085d6',
         cancelButtonColor: '#d33',
         cancelButtonText: 'non',
         confirmButtonText: 'oui , valider!',
         backdrop: `rgba(240,15,83,0.4)`
       }).then((result)=>{
         if (result.value) {
           $.ajax({
              url:'valideDevis',
              method:'GET',
              data:data,
              dataType:'json',
              success:function(data){
                if (data.code==2) {
                  Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Le devis '+nom+' a été validé avec succès',
                    showConfirmButton: false,
                    timer: 1500
                  });
                  window.location="devis_demande";
                }
              },
              error:function(data){
                console.log('error');
              }
           });
         }
       });
 });

 //Rejet du devis
 $('.rejete').click(function(){
    var id = $(this).attr('id');
    var nom = $(this).attr('nom');
    var data = {id:id,nom:nom};
    console.log('nom: '+nom+'id: '+id);
    Swal.fire({
         title: 'GESTION DE DEVIS',
         text: "Voulez-vous rejeter le devis "+nom+" ?",
         icon: 'error',
         showCancelButton: true,
         confirmButtonColor: '#3085d6',
         cancelButtonColor: '#d33',
         cancelButtonText: 'non',
         confirmButtonText: 'oui , rejeter!',
         backdrop: `rgba(240,15,83,0.4)`
       }).then((result)=>{
         if (result.value) {
           $.ajax({
              url:'rejeteDevis',
              method:'GET',
              data:data,
              dataType:'json',
              success:function(data){
                if (data.code==2) {
                  Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Le devis '+nom+' a été rejeté avec succès',
                    showConfirmButton: false,
                    timer: 1500
                  });
                  window.location="devis_demande";
                }
              },
              error:function(data){
                console.log('error');
              }
           });
         }
       });
 });

 //Suppression de devis
 $('.del').click(function(){
    var id = $(this).attr('id');
    var nom = $(this).attr('nom');
    var data = {id:id,nom:nom};
    console.log('nom: '+nom+'id: '+id);
    Swal.fire({
         title: 'GESTION DE DEVIS',
         text: "Voulez-vous supprimer le devis "+nom+" ?",
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
              url:'supDevis',
              method:'GET',
              data:data,
              dataType:'json',
              success:function(data){
                if (data.code==2) {
                  Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Le devis '+nom+' a été supprimé avec succès',
                    showConfirmButton: false,
                    timer: 1500
                  });
                  window.location="devis_demande";
                }
              },
              error:function(data){
                console.log('error');
              }
           });
         }
       });
 });


</script>
