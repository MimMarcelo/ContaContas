<script>
$(function(){
    $('form[name="formCurrency"]').submit(function(e){
        e.preventDefault();
        // alert();
        $.ajax({
            url: "{{route('currencies.store')}}",
            type: "post",
            data: $(this).serialize(),
            dataType: "json",
            success: function(response){
                if(response.success){
                    $("#currencyModal").modal('toggle');
                    $("#message-box").removeClass('d-none');
                    $("#message").text(response.message);
                    $(".table").load(location.href+" .table");
                }
            }
        });
    });
});
</script>