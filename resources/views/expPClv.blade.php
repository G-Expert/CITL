@include('layouts.admin_header')
  @include('pages.exPv')
@include('layouts.admin_footer')
<script type="text/javascript">

  //Filtre de recherche
  $('.filtExp').keyup(function(){
     var valeur = $('.filtExp').val();
     var attribut  = $('.attribut').children("option:selected").val();
     var data = {valeur:valeur,attribut:attribut};
     if (valeur=="") {
       window.location="new_export";
     }else{
       $.ajax({
          url:'filtreExp',
          method:'GET',
          dataType:'html',
          data:data,
          success:function(data){
            $('.searchClient').html(data);
          },
          error:function(data){
            console.log('error');
          }
       });

     }

  });

 //Modal de détails
  $('.details').click(function(){
     var idExp = $(this).attr('id');
     var data = {idExp:idExp};
     console.log(idExp);
     $.ajax({
       url:'readDet',
       method:'GET',
       data:data,
       dataType:'json',
       success:function(data){
         console.log(data);
         if (data.fret=="aucun") {
           $('.fret').html('<input type="date" name="frt" class="frt">');
         }else {
           $('.fret').text(data.fret);
           $('.frt').val(data.fret);
         }

         if (data.booking=="aucun") {
           $('.booking').html('<input type="date" name="book" class="book">');
         }else {
           $('.booking').text(data.booking);
           $('.book').val(data.booking);
         }

         if (data.emb=="aucun") {
           $('.embtg').html('<input type="date" name="emb" class="emb">');
         }else {
           $('.embtg').text(data.emb);
           $('.emb').val(data.emb);
         }

         if (data.ae=="aucun") {
           $('.export').html('<input type="date" class="ae" name="ae">');
         }else {
           $('.export').text(data.ae);
           $('.ae').val(data.ae);
         }

         if (data.chg=="aucun") {
           $('.change').html('<input type="date" name="chg" class="chg">');
         }else {
           $('.change').text(data.chg);
           $('.chg').val(data.chg);
         }

         if (data.td=="aucun") {
           $('.td').html('<input type="date" name="td" class="ted">');
         }else {
           $('.td').text(data.td);
           $('.ted').val(data.td);
         }

         if (data.ded=="aucun") {
           $('.deD').html('<input type="date" name="ded" class="ded">');
         }else {
           console.log(data.ded);
           $('.deD').text(data.ded);
           $('.ded').val(data.ded);
         }

         if (data.bd=="aucun") {
           $('.enlD').html('<input type="date" name="bd" class="bd">');
         }else {
           $('.enlD').text(data.bd);
           $('.bd').val(data.bd);
         }

         if (data.pfp=="aucun") {
           $('.port').html('<input type="date" name="pfp" class="pfp">');
         }else {
           $('.port').text(data.pfp);
           $('.pfp').val(data.pfp);
         }

         if (data.rc=="aucun") {
           $('.rtc').html('<input type="date" name="rc" class="rc">');
         }else {
           $('.rtc').text(data.rc);
           $('.rc').val(data.rc);
         }

         if (data.dn=="aucun") {
           $('.depNv').html('<input type="date" name="dn" class="dn">');
         }else {
           $('.depNv').text(data.dn);
           $('.dn').val(data.dn);
         }

        $('.descrp').text(data.descrp);
        $('.nom').text(data.nom);
        $('.entreprise').text(data.entreprise);
        $('.tel').text(data.tel);
        $('.mail').text(data.mail);
        $('.code').text(data.code);
        $('.idex').val(data.id);
        $('#DetailsModalLong').modal('show');
       },
       error:function(data){
         console.log(data.booking);
       }
     });

  });

 //Valider les modifications
 $('.valExport').click(function(){
   var fret    = $('.frt').val();
   var booking = $('.book').val();
   var emb     = $('.emb').val();
   var ae      = $('.ae').val();
   var chg     = $('.chg').val();
   var td      = $('.ted').val();
   var ded     = $('.ded').val();
   var bd      = $('.bd').val();
   var pfp     = $('.pfp').val();
   var rc      = $('.rc').val();
   var dn      = $('.dn').val();
   var id      = $('.idex').val();
   //var data    = {fret:fret,booking:booking,emb:emb,ae:ae,chg:chg,td:td,ded:ded,bd:bd,pfp:pfp,dn:dn,rc:rc,idexp:id};
   var datL    = {td:td,ded:ded,bd:bd,pfp:pfp,rc:rc,dn:dn};
   var datM    = {fret:fret,booking:booking,emb:emb,ae:ae,chg:chg,idexp:id};
   var data    = {td:td,ded:ded,bd:bd,pfp:pfp,rc:rc,dn:dn,fret:fret,booking:booking,emb:emb,ae:ae,chg:chg,idexp:id};
   console.log(id);
   console.log(datM);
   console.log(datL);
   console.log(data);
   $.ajax({
      url:'export',
      method:'GET',
      data:data,
      dataType:'json',
      success:function(data){
        if (data.code==2) {
         Swal.fire({
           position: 'top-end',
           icon: 'success',
           title: 'Mise en etat effectué avec succès',
           showConfirmButton: false,
           timer: 1500
         });
         window.location="new_export";
       }
      },
      error:function(data){
         console.log(data);
      }

   });
 });

 //Validation de l'exportation
  $('.valide').click(function(){
     var code = $(this).attr('nom');
     var id   = $(this).attr('id');
     var data = {id:id};
     Swal.fire({
          title: 'VALIDATION DES EXPORTS',
          text: "Voulez-vous valider l'opération "+code+" ?",
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
                 url:'valideExp',
                 method:'GET',
                 data:data,
                 dataType:'json',
                  success:function(data){
                    if (data.code==2) {
                    Swal.fire({
                      position: 'top-end',
                      icon: 'success',
                      title: "L'opération "+code+' a été validée avec succès',
                      showConfirmButton: false,
                      timer: 1500
                    });
                    window.location="new_export";
                  }

                  },
                  error:function(data){
                     console.log(data);
                  }
               });
            }
        });
  });

  //Suppression de l'exportation
   $('.sup').click(function(){
      var code = $(this).attr('nom');
      var id   = $(this).attr('id');
      var data = {id:id};
      Swal.fire({
           title: 'SUPPRESSION DES EXPORT',
           text: "Voulez-vous Supprimer l'opération "+code+" ?",
           icon: 'error',
           showCancelButton: true,
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           cancelButtonText: 'non',
           confirmButtonText: 'oui , supprimé!',
           backdrop: `rgba(240,15,83,0.4)`
         }).then((result)=>{
             if (result.value) {
                $.ajax({
                  url:'DelExp',
                  method:'GET',
                  data:data,
                  dataType:'json',
                   success:function(data){
                    if (data.code==2) {
                     Swal.fire({
                       position: 'top-end',
                       icon: 'success',
                       title: "L'opération "+code+' a été supprimée avec succès',
                       showConfirmButton: false,
                       timer: 1500
                     });
                     window.location="new_export";
                    }
                   },
                   error:function(data){
                      console.log(data);
                   }
                });
             }
         });
   });

</script>
