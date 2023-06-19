$(function(){
    $(document).on('click','#delete',function(e){
        e.preventDefault();
        var form = $(this).attr("data-form");
        Swal.fire({
            title: 'Are you sure?',
            text: "Delete This Data?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $("." + form).submit();
            }
        }) 
    });
});