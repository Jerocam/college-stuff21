(function () {
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    let forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.prototype.slice.call(forms)
      .forEach(function (form) {
        form.addEventListener('submit', function (event) {
          if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
            form.classList.add('was-validated');
          } else {
            // Field values
            event.preventDefault();
            let fname = $("#fname").val();
            let lname = $("#lname").val();
            let email = $("#email").val();
            let phone = $("#phone").val();
            let prodname = $("#prodName").val();
            let prodprice = $("#prodPrice").val();
            let proddesc = $("#prodDesc").val();
            let prodcateg = $("#prodCateg").val();
            let prodimg = $("#prodImg")[0].files[0];
            
            let newData = new FormData();
                newData.append('fname', fname);
                newData.append('lname', lname);
                newData.append('email', email);
                newData.append('phone', phone);
                newData.append('prodName', prodname);
                newData.append('prodPrice', prodprice);
                newData.append('prodDesc', proddesc);
                newData.append('prodCateg', prodcateg);
                newData.append('prodImg', prodimg);
            $.ajax({
                url: "databases/insert-data.php",
                type: "POST",
                data: newData,
                contentType: false,
                processData: false,
                cache: false,
                success: function (data) {
                    $('#formProduct')[0].reset();
                    $('#successData').append('<div class="alert text-center alert-success" role="alert"><strong>Inserted successfully new data! Thank you</strong></div>');
                    $('form').removeClass('was-validated');
                    fadingAlert();
                }
            });
        }
        })
    })

    function fadingAlert(){
    setTimeout(function(){
        $('.alert').fadeOut(2000); 
    }, 2000);
    }

    $('#stylebtn2 .btn-warning').click(function (e) { 
        e.preventDefault();
        $('#formProduct')[0].reset();
        $('form').removeClass('was-validated');
    });

})();
