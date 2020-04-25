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

    $('.btn-delete-selected').on('click', function(){
        var data = $('#blogForm').serializeJSON();
        $.ajax({
            url: $base_url + 'blog/delete_checked/',
            type: 'POST',
            data: data,
            success: function (res) {
                if (res) {
                    location.href = $base_url + 'blog';
                }
            }
        });
    });

    // add gallery button
    $('.add-gallery').on('click', function(){
        var inTr = '<tr>'+
        '<td style="width:300px;">'+
        '<img src="http://localhost/product/assets/img/bg/1.jpg" class="gallery-image" alt="" width="200">'+
        '<div>'+
        '<input type="file" name="uploadfile[]" class="upload-file">'+
        '</div>'+
        '<div>'+
        '<button class="btn btn-sm btn-outline-danger mt-1 btn-gallery-delete" type="button">Delete Image</button>'+
        '</div>'+
        '</td>'+
        '<td>'+
        '<label>Order</label>'+
        '<input type="text" name="ordering[]" value="" class="form-control">'+
        '</td>'+
        '<td>'+
        '<label>Title</label>'+
        '<input type="text" name="title_name[]" value="" class="form-control">'+
        '</td>'+
        '<td>'+
        '<label>Alt</label>'+
        '<input type="text" name="alt_name[]" value="" class="form-control">'+
        '</td>'+
        '</tr>';

        $('#tableGallery').append(inTr);
    });

    // change cover
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.cover-image').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $('input[name=cover_image]').on('change', function(e){
        readURL(this);
    });

    // change gallery
    function readURLGallery(input, imgElment) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                imgElment.attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $('.upload-file').on('change', function(){
        var imgElment = $(this).parent('div').prev('img');        
        readURLGallery(this, imgElment);
    });
    // gallery delete
    $('body').on('click', '.btn-gallery-delete', function(){
        $(this).closest('tr').remove();

        var dataHref = $(this).attr('data-href');
        if(dataHref != undefined) {
            $.ajax({
                url: dataHref,
                type: 'get',
                success: function(res) {

                }
            });
        }
    });

    // reset cover
    $('.btn-cover-reset').on('click', function(){
        $('input[name=cover_image]').val('');
        $('.cover-image').attr('src', 'http://localhost/product/assets/img/bg/1.jpg');

        var dataHref = $(this).attr('data-href');
        var dataImage = $(this).attr('data-image');
        if(dataImage == 1) {
            $.ajax({
                url: dataHref,
                type: 'get',
                success: function(res) {

                }
            });
        }
    });
});