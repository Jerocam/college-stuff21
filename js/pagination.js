$(document).ready(function () {

    function loadData(page){
        $.ajax({
            type: "POST",
            url: "databases/load-data.php",
            cache:false,
            data: {page_number:page},
            success: function (response) {
                $("#loadData").html(response);
            }
        });
    }
    
    loadData();

    $(document).on("click", ".pagination li a", function(e){
        e.preventDefault();
        var pageId = $(this).attr("id");
        loadData(pageId);
    });

});