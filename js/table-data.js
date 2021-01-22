
$(document).ready(function () {

    //load table data
    function loadData(page){
        $.ajax({
            type: "POST",
            url: "databases/table-data.php",
            cache:false,
            data: {page_number:page},
            success: function (response) {
                $("#loadTable").html(response);
            }
        });
    }
    loadData();
    $(document).on("click", ".pagination li a", function(e){
        e.preventDefault();
        let pageId = $(this).attr("id");
        loadData(pageId);
    });

    //delete data
    function delData(id){
        $.ajax({
            type: "POST",
            url: "databases/table-delete.php",
            data: {id:id},
            cache: false,
            success: function (response) {
                $("#loadTable").html(response);
            }
        });
    }
    $(document).on("click", ".buttonData .btn-danger", function(e){
        e.preventDefault();
        let btnId = $(this).attr('id');
        if (confirm('Are you sure to delete this data?')){
            delData(btnId);
        }
    });


});