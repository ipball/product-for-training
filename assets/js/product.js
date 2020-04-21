$(function () {
    $('.btn-delete').on('click', function () {
        var blogId = $(this).attr('data-id');

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: $base_url + 'blog/delete/' + blogId,
                    type: 'GET',
                    success: function (res) {
                        if (res) {
                            location.href = $base_url + 'blog';
                        }
                    }
                });
            }
        });
    });
});