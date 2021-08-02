@include('layouts.admin_header')
  @include('pages.singleImpClient')
@include('layouts.admin_footer')

<script type="text/javascript">

  //Filtre de recherche
  $('.filtExp').keyup(function(){
     var valeur = $('.filtExp').val();
     var attribut  = $('.attribut').children("option:selected").val();
     var data = {valeur:valeur,attribut:attribut};
     console.log(data);
     if (valeur=="") {
       window.location="new_import";
     }else{
       $.ajax({
          url:'filtreImp',
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
       url:'readImpDet',
       method:'GET',
       data:data,
       dataType:'json',
       success:function(data){
         console.log(data);
        //  console.log(data);
         if (data.doss=="aucun") {
           $('.doss').html('<input type="date" name="doss" class="dosse">');
         }else {
           $('.doss').text(data.doss);
           $('.dosse').val(data.doss);
         }

         if (data.fdi=="aucun") {
           $('.fdi').html('<input type="date" name="fdi" class="fdie">');
         }else {
           $('.fdi').text(data.fdi);
           $('.fdie').val(data.fdi);
         }

         if (data.bsc=="aucun") {
           $('.bsc').html('<input type="date" name="bsc" class="bsce">');
         }else {
           $('.bsc').text(data.bsc);
           $('.bsce').val(data.bsc);
         }

         if (data.rfcv=="aucun") {
           $('.rfcve').html('<input type="date" name="rfcv" class="rfcvee">');
         }else {
           $('.rfcve').text(data.rfcv);
           $('.rfcvee').val(data.rfcv);
         }

         if (data.td=="aucun") {
           $('.tde').html('<input type="date" name="tde" class="tdee">');
         }else {
           $('.tde').text(data.td);
           $('.tdee').val(data.td);
         }

         if (data.dd=="aucun") {
           $('.dd').html('<input type="date" name="dd" class="dde">');
         }else {
           $('.dd').text(data.dd);
           $('.dde').val(data.dd);
         }

         if (data.pfp=="aucun") {
           $('.pfp').html('<input type="date" name="pfp" class="pfpe">');
         }else {
           $('.pfp').text(data.pfp);
           $('.pfpe').val(data.pfp);
         }

         if (data.liv=="aucun") {
           $('.liv').html('<input type="date" name="liv" class="live">');
         }else {
           $('.liv').text(data.liv);
           $('.live').val(data.liv);
         }

         if (data.vsd=="aucun") {
           $('.vsd').html('<input type="date" name="vsd" class="vsde">');
         }else {
           $('.vsd').text(data.vsd);
           $('.vsde').val(data.vsd);
         }

         if (data.bed=="aucun") {
           $('.bed').html('<input type="date" name="bed" class="bede">');
         }else {
           $('.bed').text(data.bed);
           $('.bede').val(data.bed);
         }

        $('.descrp').text(data.descrp);
        $('.nom').text(data.nom);
        $('.entreprise').text(data.entreprise);
        $('.tel').text(data.tel);
        $('.mail').text(data.mail);
        $('.code').text(data.code);
        $('.idimp').val(data.id);
        $('#DetailsModalLong').modal('show');
       },
       error:function(data){
         console.log(data.booking);
       }
     });

  });

 //Valider les modifications
 $('.valExport').click(function(){
   var doss     = $('.dosse').val();
   var fdi      = $('.fdie').val();
   var bsc      = $('.bsce').val();
   var rfcv     = $('.rfcvee').val();
   var td       = $('.tdee').val();
   var dd       = $('.dde').val();
   var pfp      = $('.pfpe').val();
   var liv      = $('.live').val();
   var vsd      = $('.vsde').val();
   var bed      = $('.bede').val();
   var idimp    = $('.idimp').val();
   //var data    = {fret:fret,booking:booking,emb:emb,ae:ae,chg:chg,td:td,ded:ded,bd:bd,pfp:pfp,dn:dn,rc:rc,idexp:id};
   var datL    = {doss:doss,fdi:fdi,bsc:bsc,rfcv:rfcv,td:td};
   var datM    = {dd:dd,pfp:pfp,liv:liv,vsd:vsd,bed:bed,idimp:idimp};
   var data    = {doss:doss,fdi:fdi,bsc:bsc,rfcv:rfcv,td:td,dd:dd,pfp:pfp,liv:liv,vsd:vsd,bed:bed,idimp:idimp};
   //console.log(idimp);
   //console.log(datM);
   //console.log(datL);
   console.log(data);
   $.ajax({
     url:'import',
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
          title: 'VALIDATION DES IMPORTS',
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
                 url:'valideImp',
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
                    window.location="new_import";
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
           title: 'SUPPRESSION DES IMPORTS',
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
                  url:'DelImp',
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
                     window.location="new_import";
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
