$(document).ready(function() {

    $('.overlay').height($(document).height() + 1000);

    $('.loading, .overlay').fadeOut();

    // set copy right year
    $('.main-footer span').html(new Date().getFullYear());

    // Fire Data table
    $('#user_table').DataTable();
    // $('#user_table').DataTable({
    //     'paging'      : true,
    //     'lengthChange': true,
    //     'searching'   : true,
    //     'ordering'    : true,
    //     'info'        : true,
    //     'autoWidth'   : true
    // });

    $('.location, .user_id').select2();

    // pgwSlider
    $('.pgwSlider').pgwSlider({
        displayControls: true,
        maxHeight: 500,
        verticalCentering: true,
        autoSlide: false
    });


    /**
     * Admin block
     */


    $(document).on('click', '.admin_edit_profile .update_button', function (e) {
        e.preventDefault();

        // $('.admin_edit_profile form.update_form input').each(function () {
        //
        //     if ($(this).val().length === 0) {
        //         $(this).css({
        //             borderBottom: "1px solid #ff8282"
        //         }).next().removeClass('hidden')
        //     }
        //
        //     $(this).focus(function () {
        //         $(this).css({
        //             borderBottom: "1px solid #ced4da"
        //         }).next().addClass('hidden')
        //
        //     })
        //
        // });

        var f_name = $('#first_name'),
            l_name = $('#last_name'),
            email = $('#email'),
            password = $('#password'),
            confPassword = $('#password_conf');

        // if (f_name.val().length < 2 ){
        //     f_name.next().removeClass('hidden');
        //     return false
        // }
        //
        // if (l_name.val().length < 2 ){
        //     l_name.next().removeClass('hidden');
        //     return false
        // }
        //
        // var pattern = "^[a-z0-9._-]+@[a-z]+.[a-z]{2}$";
        //
        // if (!email.val().match(pattern)) {
        //     email.next().removeClass('hidden');
        //     return false
        // }


        // if (password.val() !== '' && confPassword.val() !== ''){
        //     if (password.val() !== confPassword.val()){
        //         password.next().removeClass('hidden');
        //         return false
        //     }
        //
        //     if (password.val().length < 8 || confPassword.val().length < 8){
        //         password.next().removeClass('hidden').html('كلمات المرور لا تقل عن 8 أحرف');
        //         return false
        //     }
        // }
        //
        // if (password.val() !== confPassword.val()){
        //     password.next().removeClass('hidden');
        //     return false
        //
        // } else {
        //     password.next().addClass('hidden');
        // }


        var form = $('.admin_edit_profile form.update_form'),
            formData = form.serialize(),
            url = form.attr('action');

        $.ajax({

            url: url,
            type: 'post',
            dataType: 'json',
            data: formData,

            beforeSend: function(){

                $('.loading, .overlay').fadeIn();
            },

            success: function (data) {

                if (data.status === 'error'){

                    $('.error_msg').removeClass('hidden').html(data.msg);
                    $('.success_msg').addClass('hidden');

                } else {

                    $('.success_msg').removeClass('hidden').html(data.msg);
                    $('.error_msg').addClass('hidden');

                    var buffer = setInterval(function () {
                        window.location.reload();
                        clearInterval(buffer)
                    }, 600);
                }

                $('.loading, .overlay').fadeOut();

            }

        })

    });


    /**
     * Users block
     */

    // Get user information in user model
    $(document).on('click', '.edit_user_link', function () {

        $.ajax({

            url: $(this).data('url'),
            type:'post',
            dataType: 'html',
            data:{
                id: $(this).data('user-id')
            },

            success: function (data) {
                $('.edit_user_modal .modal-body').html(data)
            }
        })

    })


    // Update user profile
    $(document).on('click', '.update_button', function (e) {
        e.preventDefault();

        $('.edit_user_modal form.update_form input').each(function () {

            if ($(this).val().length === 0) {
                $(this).css({
                    borderBottom: "1px solid #ff8282"
                }).next().removeClass('hidden')
            }

            $(this).focus(function () {
                $(this).css({
                    borderBottom: "1px solid #ced4da"
                }).next().addClass('hidden')

            })

        });

        var f_name = $('#first_name'),
            l_name = $('#last_name'),
            email = $('#email'),
            phone = $('#phone'),
            password = $('#password'),
            confPassword = $('#password_conf');


        if (f_name.val().length < 2 ){
            f_name.next().removeClass('d-none');
            return false
        }

        if (l_name.val().length < 2 ){
            l_name.next().removeClass('d-none');
            return false
        }

        var pattern = "^[a-z0-9._-]+@[a-z]+.[a-z]{3}$";

        if (!email.val().match(pattern)) {
            email.next().removeClass('d-none');
            return false
        }


        var pattern = "^[0-9]{10}$";

        if (!phone.val().match(pattern)) {
            phone.next().removeClass('d-none');
            return false
        }

        if (password.val() !== '' && confPassword.val() !== ''){
            if (password.val() !== confPassword.val()){
                password.next().removeClass('d-none');
                return false
            }

            if (password.val().length < 8 || confPassword.val().length < 8){
                password.next().removeClass('d-none').html('كلمات المرور لا تقل عن 8 أحرف');
                return false
            }
        }

        if (password.val() !== confPassword.val()){
            password.next().removeClass('d-none');
            return false

        } else {
            password.next().addClass('d-none');
        }


        var form = $('.edit_user_modal form.update_form'),
            formData = new FormData(form[0]),
            url = form.attr('action');

        $.ajax({

            url: url,
            type: 'post',
            dataType: 'json',
            contentType: false,
            processData: false,
            data: formData,

            beforeSend: function(){

                $('.loading, .overlay').fadeIn();
            },

            success: function (data) {

                if (data.status === 'error'){

                    $('.error_msg').removeClass('hidden').html(data.msg);
                    $('.success_msg').addClass('hidden');



                } else {

                    $('.success_msg').removeClass('hidden').html(data.msg);
                    $('.error_msg').addClass('hidden');


                }


                $('.loading, .overlay').fadeOut();

                var buffer = setInterval(function () {
                    window.location.reload();
                    clearInterval(buffer)
                }, 1000);

            }

        })
    });

    // Show image on change
    $(document).on('change', '.user_img', function () {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('.userImgContentForm').removeClass('hidden').html('<img class="edit_profile_img" src="'+e.target.result+'">');

        };

        reader.readAsDataURL(this.files[0]);

        $('.del_img_profile').removeClass('hidden');
    });

    // Delete image
    $(document).on('click', '.del_img_profile', function () {
        $('.user_img').val('');
        $('.userImgContentForm').addClass('hidden').html('')
    })

    //Delete user
    $(document).on('click', 'a.delete_user_link' ,function (e) {

        e.preventDefault();

        var deleteConfirm = confirm('هل تريد بالتأكيد حذف المستخدم');

            var userId = $(this).data('user-id');
                parentClass = $(".tr_"+userId);

        if (deleteConfirm){

            $.ajax({
                url: $(this).attr('href'),
                type: 'post',
                dataType: 'json',
                crossDomain: true,
                data: {
                    id: userId
                }
            }).done(function (data) {
                if (data.status === 'success'){
                    $('.box .delete_msg').removeClass('hidden');
                    $('.box .delete_msg strong').text(data.msg);
                    parentClass.remove();
                } else {

                    $('.box .delete_msg').removeClass('hidden');
                    $('.box .delete_msg strong').html(data.msg);
                }
            })

        }

    });

    // Add user
    $('.user_register_button').click(function (e) {
        e.preventDefault();

        $('form.user_register_form input').each(function () {

            if ($(this).val().length === 0) {
                $(this).css({
                    borderBottom: "1px solid #ff8282"
                }).next().removeClass('hidden')
            }

            $(this).focus(function () {
                $(this).css({
                    borderBottom: "1px solid #ced4da"
                }).next().addClass('hidden')

            })

        });

        var f_name = $('#first_name'),
            l_name = $('#last_name'),
            email = $('#email'),
            phone = $('#phone'),
            password = $('#password'),
            confPassword = $('#password_conf');

        if (f_name.val().length < 3 ){
            f_name.next().removeClass('hidden');
            return false
        }

        if (l_name.val().length < 3 ){
            l_name.next().removeClass('hidden');
            return false
        }

        var pattern = "^[a-z0-9._-]+@[a-z]+.[a-z]{2}$";

        if (!email.val().match(pattern)) {
            email.next().removeClass('hidden');
            return false
        }


        var pattern = "^[0-9]{10}$";

        if (!phone.val().match(pattern)) {
            phone.next().removeClass('hidden');
            return false
        }

        if (password.val() !== confPassword.val() || password.val() === '' || confPassword.val() === ''){
            password.next().removeClass('hidden');

            return false

        } else {
            password.next().addClass('hidden');
        }


        var form = $('form.user_register_form'),
            formData = form.serialize(),
            url = form.attr('action');

        $.ajax({

            url: url,
            type: 'post',
            dataType: 'json',
            data: formData,

            beforeSend: function(){

                $('.loading, .overlay').fadeIn();
            },

            success: function (data) {

                if (data.status === 'error'){

                    $('.error_msg').removeClass('hidden').html(data.msg);
                    $('.success_msg').addClass('hidden');

                } else {

                    $('.success_msg').removeClass('hidden').html(data.msg);
                    $('.error_msg').addClass('hidden');
                }

                $('form.user_register_form input').each(function () {
                    $(this).val('');
                });

                $('.loading, .overlay').fadeOut();
            }

        })

    });


    /**
     *  ِAdvertises block
     */

    //Delete adv
    $(document).on('click', 'a.delete_adv_link', function (e) {
        e.preventDefault();

        var deleteConfirm = confirm('هل تريد بالتأكيد حذف الإعلان');

        var advId = $(this).data('adv-id');
        parentClass = $(".tr_"+advId);

        if (deleteConfirm){

            $.ajax({
                url: $(this).attr('href'),
                type: 'post',
                dataType: 'json',
                crossDomain: true,
                data: {
                    id: advId
                }
            }).done(function (data) {
                if (data.status === 'success'){
                    $('.box .delete_msg').removeClass('hidden');
                    $('.box .delete_msg strong').text(data.msg);

                    parentClass.remove();
                } else {

                    $('.box .delete_msg').removeClass('hidden');
                    $('.box .delete_msg strong').html(data.msg);

                }
            })

        }
    });

    // Add adv
    $('.add_adv_button').click(function (e) {
        e.preventDefault();

        $("html, body").animate({ scrollTop: 0 });

        $('form.add_adv_form input, textarea, select').each(function () {

            if ($(this).val().length === 0) {
                $(this).css({
                    borderBottom: "1px solid #ff8282"
                }).next().removeClass('hidden')
            }

            $(this).focus(function () {
                $(this).css({
                    borderBottom: "1px solid #ced4da"
                }).next().addClass('hidden')

            })

        });

        var title = $('#title'),
            location = $('#location'),
            user = $('#user_id'),
            desc = $('#description'),
            size = $('#size'),
            bath = $('#bath'),
            room = $('#room'),
            lat = $('#lat'),
            lng = $('#lng'),
            img = $('#img');


        if (title.val().length < 2 ){
            title.next().removeClass('hidden');
            return false
        }

        if (location.val() === '0' ){
            $('.location_alert').removeClass('hidden');
            return false
        }

        if (user.val() === '0' ){
            $('.location_alert').removeClass('hidden');
            return false
        }


        if (desc.val().length < 2 ){
            desc.next().removeClass('hidden');
            return false
        }

        var pattern = "^[0-9]+$";

        if (size.val().length === 0){
            size.next().removeClass('d-none');
            return false

        }


        if (!size.val().match(pattern)){
            size.next().removeClass('d-none');
            return false
        }

        if (room.val().length === 0){
            room.next().removeClass('d-none');
            return false
        }


        if (!room.val().match(pattern)){
            room.next().removeClass('d-none');
            return false
        }

        if (bath.val().length === 0){
            bath.next().removeClass('d-none');
            return false
        }


        if (!bath.val().match(pattern)){
            bath.next().removeClass('d-none');
            return false
        }


        if (img.val() === '' ){
            $('.img_allow').html('فضلاً قم باختيار صورة على الأقل').addClass('img_alert');
            return false
        }

        if (lat.val() === ''){
            $('#current').html('فضلاً قم بتحديد موقعك على الخريطة').addClass('map_alert');
            return false
        }


        var form = $('form#add_adv_form'),
            formData = new FormData(form[0]),
            url = form.attr('action');

        $.ajax({

            url: url,
            type: 'post',
            dataType: 'json',
            contentType: false,
            processData: false,
            data: formData,

            beforeSend: function(){

                $('.loading, .overlay').fadeIn();
            },

            success: function (data) {

                if (data.status === 'error'){

                    $('.error_msg').removeClass('hidden').html(data.msg);
                    $('.success_msg').addClass('hidden');

                } else {

                    $('.success_msg').removeClass('hidden').html(data.msg);
                    $('.error_msg').addClass('hidden');

                    $('.img_container input').remove();
                    $('.imgContent img').remove();
                    $('.img').val('');

                    $('form.add_adv_form input, textarea').each(function () {
                        $(this).val('');
                    });
                }

                $('.loading, .overlay').fadeOut();



            }

        })

    });

    $('.img').change(function () {


        for (var i = 0; i < this.files.length; i++){

            var rand = Math.floor(Math.random() * 1000000000000000) + '_' + Math.floor(Math.random() * 1000000000000000);

            if (this.files.length > 5) {
                $('.img_allow').html('تم الوصول لحد غير مسموح به من الصور رجاء اختيار 5 صور فقط').addClass('alert alert-danger');

            } else if ($('.img_container').children().length > 4){
                $('.img_allow').html('تم الوصول لحد غير مسموح به من الصور رجاء اختيار 5 صور فقط').addClass('alert alert-danger');
            } else {
                $('.img_allow').html('عدد الصور المسموح بها 5 صور فقط *').removeClass('alert alert-danger');


                var reader = new FileReader();

                reader.onload = function(e) {

                    $('.imgContent').removeClass('hidden').append('<img class="adv_img" src="'+e.target.result+'">');

                };

                reader.readAsDataURL(this.files[i]);

                $('.img_container').append('<input type="text" class="hidden" name="images[]" value="'+this.files[i].name+'" >')

            }

        }

    });

    // Delete image by double click it
    $(document).on('click', '.delete_img', function (e) {
        $('.img_container input').remove();
        $('.imgContent img').remove();
        $('.img').val('');

        return false

    });

    /**
     * City block
     */

    // Get city information in model
    $(document).on('click', 'a.edit_city_link', function (e) {

        e.preventDefault();
        $.ajax({

            url: $(this).data('url'),
            type:'post',
            dataType: 'html',
            data:{
                id: $(this).data('city-id')
            },

            success: function (data) {
                $('.edit_city_modal .modal-body').html(data)
            }
        })

    });

    // Edit city
    $(document).on('click', '.edit_city_modal .update_button', function (e) {
        e.preventDefault();

        var city = $('#city');

        if (city.val().length === 0 ){
            city.next().removeClass('hidden');
            return false
        }

        var form = $('.edit_city_modal form.update_form'),
            formData = form.serialize(),
            url = form.attr('action');

        $.ajax({

            url: url,
            type: 'post',
            dataType: 'json',
            data: formData,

            beforeSend: function(){

                $('.loading, .overlay').fadeIn();
            },

            success: function (data) {

                if (data.status === 'error'){

                    $('.error_msg').removeClass('hidden').html(data.msg);
                    $('.success_msg').addClass('hidden');

                } else {

                    $('.success_msg').removeClass('hidden').html(data.msg);
                    $('.error_msg').addClass('hidden');

                    var buffer = setInterval(function () {
                        window.location.reload();
                        clearInterval(buffer)
                    }, 600);
                }

                $('.loading, .overlay').fadeOut();

            }

        })

    });

    //Delete city
    $(document).on('click', 'a.delete_city_link' ,function (e) {

        e.preventDefault();

        var deleteConfirm = confirm('هل تريد بالتأكيد حذف المدينة');

        var cityId = $(this).data('city-id'),
            parentClass = $(".tr_"+cityId);

        if (deleteConfirm){

            $.ajax({
                url: $(this).data('url'),
                type: 'post',
                dataType: 'json',
                crossDomain: true,
                data: {
                    id: cityId
                }
            }).done(function (data) {
                if (data.status === 'success'){
                    $('.box .delete_msg').removeClass('hidden');
                    $('.box .delete_msg strong').text(data.msg);
                    parentClass.remove();
                } else {

                    $('.box .delete_msg').removeClass('hidden');
                    $('.box .delete_msg strong').html(data.msg);
                }
            })

        }

    });

    // Add user
    $('.add_city_button').click(function (e) {
        e.preventDefault();

        var city = $('#city');

        if (city.val().length === 0 ){
            city.next().removeClass('hidden');
            return false
        }


        var form = $('form.add_city_form'),
            formData = form.serialize(),
            url = form.attr('action');

        $.ajax({

            url: url,
            type: 'post',
            dataType: 'json',
            data: formData,

            beforeSend: function(){

                $('.loading, .overlay').fadeIn();
            },

            success: function (data) {

                if (data.status === 'error'){

                    $('.error_msg').removeClass('hidden').html(data.msg);
                    $('.success_msg').addClass('hidden');

                } else {

                    $('.success_msg').removeClass('hidden').html(data.msg);
                    $('.error_msg').addClass('hidden');
                }

                city.val('');

                $('.loading, .overlay').fadeOut();
            }

        })

    });

    /**
     * Delete old users profile image
     */

    //Delete old image one by one
    $(document).on('click', 'a.delete_old_img_link', function (e) {
        e.preventDefault();

        var deleteConfirm = confirm('هل تريد بالتأكيد حذف الصورة؟');

        var entry = $(this).data('entry'),
            parent = $('.tr_'+entry);

        if (deleteConfirm){

            $.ajax({
                url: $(this).data('url'),
                type: 'post',
                dataType: 'json',
                crossDomain: true,
                data: {
                    entry: entry+'.'+$(this).data('ext')
                }
            }).done(function (data) {
                if (data.status === 'success'){
                    $('.delete_msg').removeClass('hidden');
                    $('.delete_msg strong').text(data.msg);
                    parent.remove();
                } else {

                    $('.delete_msg').removeClass('hidden');
                    $('.delete_msg strong').html(data.msg);

                }
            })

        }
    });
    
    if ($('tr.odd td').hasClass('dataTables_empty')) {
        $('button.del_old_img_button').remove();
    }

    //Delete old image all
    $(document).on('click', 'button.del_old_img_button', function (e) {
        e.preventDefault();
        
        var deleteConfirm = confirm('هل تريد بالتأكيد حذف كل الصور؟');

        if (deleteConfirm){

            $.ajax({
                url: $(this).data('url'),
                type: 'post',
                dataType: 'json',
                crossDomain: true,
                data: {
                    delAll: 'delAll'
                }
            }).done(function (data) {
                if (data.status === 'success'){
                    $('.delete_msg').removeClass('hidden');
                    $('.delete_msg strong').text(data.msg);

                    $('#user_table tr.odd, tr.even').remove();
                    // window.location.reload();
                    $('button.del_old_img_button').remove();

                } else {

                    $('.delete_msg').removeClass('hidden');
                    $('.delete_msg strong').html(data.msg);

                }
            })

        }
    });

});