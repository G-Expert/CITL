@include('layouts.admin_header')
  @include('pages.addImport')
@include('layouts.admin_footer')
<script type="text/javascript">
   // Préfixe du numéro
   $("select.pays").change(function(){
      var prf = $(this).children("option:selected").val();
      $('.prfix').text(prf);
   });
</script>
