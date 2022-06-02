$(document).ready(function () {
    $(document).on("click", ".cartActionBtn", function (e) {
        let productId = $(this).attr("productId");
        console.log(productId)

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: `/cart/add`,
            data: {productId},
            dataType: "json",
            success: function (response) {
                if(response.status === 200){
                   console.log(response)
                }
            },
        });
    });
});
