$(document).ready(function () {

    var bodyPadding = $('.navbar').innerHeight();


    $('.overlay').height($(document).height()+$(document).height());

    $('.loading, .overlay').fadeOut();

    $('body').css({
        paddingBottom: bodyPadding,
        paddingTop: bodyPadding
    });

    $('.location, .user_id').select2();

    $('.pgwSlider').pgwSlider({
        displayControls: true,
        maxHeight: 500,
        verticalCentering: true,
        autoSlide: false
    });

    // set copy right year

    $('.footer .copyright span').html(new Date().getFullYear());

    // Admin register
    $('.admin_register_button').click(function (e) {
        e.preventDefault();

        $('form.admin_register_form input').each(function () {

            if ($(this).val().length === 0) {
                $(this).css({
                    borderBottom: "1px solid #ff8282"
                }).next().removeClass('d-none')
            }

            $(this).focus(function () {
                $(this).css({
                    borderBottom: "1px solid #ced4da"
                }).next().addClass('d-none')

            })

        });

        var f_name = $('#first_name'),
            l_name = $('#last_name'),
            email = $('#email'),
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

        var pattern = "^[a-z0-9._-]+@[a-z]+.[a-z]{2}$";

        if (!email.val().match(pattern)) {
            email.next().removeClass('d-none');
            return false
        }


        var pattern = "^[0-9]{10}$";

        if (!phone.val().match(pattern)) {
            phone.next().removeClass('d-none');
            return false
        }

        if (password.val() !== confPassword.val() || password.val() === '' || confPassword.val() === ''){
            password.next().removeClass('d-none');

            return false

        } else {
            password.next().addClass('d-none');
        }


        var form = $('form.admin_register_form'),
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

                    $('.error_msg').removeClass('d-none').html(data.msg);
                    $('.success_msg').addClass('d-none');

                } else {

                    $('.success_msg').removeClass('d-none').html(data.msg);
                    $('.error_msg').addClass('d-none');

                    $('form.admin_register_form input').each(function () {
                        $(this).val('');
                    })
                }


                $('.loading, .overlay').fadeOut();
            }

        })

    });

    // User register
    $('.user_register_button').click(function (e) {
        e.preventDefault();

        $('form.user_register_form input').each(function () {

            if ($(this).val().length === 0) {
                $(this).css({
                    borderBottom: "1px solid #ff8282"
                }).next().removeClass('d-none')
            }

            $(this).focus(function () {
                $(this).css({
                    borderBottom: "1px solid #ced4da"
                }).next().addClass('d-none')

            })

        });

        var f_name = $('#first_name'),
            l_name = $('#last_name'),
            email = $('#email'),
            phone = $('#phone'),
            password = $('#password'),
            confPassword = $('#password_conf');

        if (f_name.val().length < 3 ){
            f_name.next().removeClass('d-none');
            return false
        }

        if (l_name.val().length < 3 ){
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

        if (password.val() !== confPassword.val() || password.val() === '' || confPassword.val() === ''){
            password.next().removeClass('d-none');

            return false

        } else {
            password.next().addClass('d-none');
        }


        var form = $('form.user_register_form'),
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

                    $('.error_msg').removeClass('d-none').html(data.msg);
                    $('.success_msg').addClass('d-none');

                } else {

                    $('.success_msg').removeClass('d-none').html(data.msg);
                    $('.error_msg').addClass('d-none');

                    $('form.user_register_form input').each(function () {
                        $('form.user_register_form input').val('');
                    });

                    $('.loading, .overlay').fadeOut();
                }


            }

        })

    });

    // Show image on change
    $(document).on('change', '.user_img', function () {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('.userImgContent').removeClass('d-none').html('<img class="adv_img" src="'+e.target.result+'">').removeClass('d-none');
            $('.userImgContentForm').removeClass('d-none').html('<img class="edit_profile_img" src="'+e.target.result+'">').removeClass('d-none');

        };

        reader.readAsDataURL(this.files[0]);

        $('.del_img_profile').removeClass('d-none');
    });


    // Delete image
    $('.del_img').click(function () {
        $('.user_img').val('');
        $('.userImgContent').addClass('d-none').html('')
    });

    $(document).on('click', '.del_img_profile', function () {
        $('.user_img').val('');
        $('.userImgContentForm').addClass('d-none').html('')
    });


    // Show user phone
    $('.user_phone').click(function () {
        $(this).html($(this).next().html())
    });


    // Admin and User login
    $('.login_button').click(function (e) {
      e.preventDefault();


        $('form.login_form input').each(function () {
            if ($(this).val() === '') {
                $(this).css({
                    borderBottom: "2px solid #ff8282"
                }).next().removeClass('d-none')
            }

            $(this).focus(function () {
                $(this).css({
                    borderBottom: "1px solid #ced4da"
                }).next().addClass('d-none')
            })

        });

        var email = $('#email'),
            password = $('#password');


        if (email.val().length === 0){
            email.next().removeClass('d-none');
            return false
        }

        var pattern = "^[a-z0-9._-]+@[a-z]+.[a-z]{3}$";


        if (!email.val().match(pattern)) {
            email.next().removeClass('d-none');
            return false
        }

        if (password.val().length === 0 ){
            password.next().removeClass('d-none');
            return false
        }


        var form = $('form.login_form'),
            formData = form.serialize(),
            url = form.attr('action');

        $.ajax({

            url: url,
            type: 'post',
            dataType: 'json',
            data: formData,

            success: function (data) {

                if (data.status === 'error'){

                    $('.error_msg').removeClass('d-none').html(data.msg);
                    $('.success_msg').addClass('d-none');

                } else {
                    $('.success_msg').removeClass('d-none').html(data.msg);
                    $('.error_msg').addClass('d-none');

                    $('form.login_form input').each(function () {
                        $(this).val('');
                    });

                    var buffer = setInterval(function () {
                        window.location.reload();
                        clearInterval(buffer)
                    }, 600);
                }


            }

        })

    });

    // Update profile
    $(document).on('click', '.update_button', function (e) {
        e.preventDefault();

        $('form.update_form input').each(function () {

            if ($(this).val().length === 0) {
                $(this).css({
                    borderBottom: "1px solid #ff8282"
                }).next().removeClass('d-none')
            }

            $(this).focus(function () {
                $(this).css({
                    borderBottom: "1px solid #ced4da"
                }).next().addClass('d-none')

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


        var form = $('form.update_form'),
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

                    $('.error_msg').removeClass('d-none').html(data.msg);
                    $('.success_msg').addClass('d-none');

                } else {

                    $('.success_msg').removeClass('d-none').html(data.msg);
                    $('.error_msg').addClass('d-none');
                }


                $('.loading, .overlay').fadeOut();

                var buffer = setInterval(function () {
                    window.location.reload();
                    clearInterval(buffer)
                }, 1000);
            }

        })
    });

    // Get user profile
    $('a.user_modal_grape').click(function () {

        $.ajax({

            url: $(this).data('url'),
            type: 'post',
            dataType: 'html',
            data: {
                id: $(this).data('user-id')
            },

            success: function (data) {
                $('.user_modal .modal-body').html(data)
            }

        })

    });

    /**
     * Advertise block
     */

    // Add adv
    $('.add_adv_button').click(function (e) {
        e.preventDefault();
        $("html, body").animate({ scrollTop: 0 });
        $('form.add_adv_form input, textarea, select, option').each(function () {

            if ($(this).val().length === 0) {
                $(this).css({
                    borderBottom: "1px solid #ff8282"
                }).next().removeClass('d-none');
            }

            $(this).focus(function () {
                $(this).css({
                    borderBottom: "1px solid #ced4da"
                }).next().addClass('d-none')

            });

        });

        var title = $('#title'),
            location = $('#location'),
            desc = $('#description'),
            size = $('#size'),
            bath = $('#bath'),
            room = $('#room'),
            lat = $('#lat'),
            img = $('#img');


        if (title.val().length < 2 ){
            title.next().removeClass('d-none');
            return false
        }


        if (location.val() === '0' ){
            $('.location_alert').removeClass('d-none');
            return false
        } else {
            $('.location_alert').addClass('d-none');
        }


        if (desc.val().length < 2 ){
            desc.next().removeClass('d-none');
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

        if (lat.val() === ''){
            $('#current').html('فضلاً قم بتحديد موقعك على الخريطة').addClass('alert alert-danger');
            return false
        }
        if (img.val() === '' ){
            $('.img_allow').html('فضلاً قم باختيار صورة على الأقل').addClass('alert alert-danger');
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

                    $('.error_msg').removeClass('d-none').html(data.msg);
                    $('.success_msg').addClass('d-none');

                } else {

                    $('.success_msg').removeClass('d-none').html(data.msg);
                    $('.error_msg').addClass('d-none');

                    $('.img_container input').remove();
                    $('.imgContent img').remove();
                    $('.img').val('');

                    $('form.add_adv_form input:not(input[type=hidden]), textarea, option').each(function () {
                        $(this).val('');
                    });

                    var buffer = setInterval(function () {
                        window.location.reload();
                        clearInterval(buffer);
                    },1500)

                }

                $('.loading, .overlay').fadeOut();

                $("html, body").animate({ scrollTop: 0 });
            }

        })

    });

    //Delete adv
    $(document).on('click', 'a.delete_adv_link', function (e) {
        e.preventDefault();
        var deleteConfirm = confirm('هل تريد بالتأكيد حذف الإعلان');
        var advId = $(this).data('adv-id');
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
                    $('.success_msg').removeClass('d-none').text(data.msg);
                    $('.error_msg').addClass('d-none');
                    var buffer = setInterval(function () {
                        window.location.reload();
                        clearInterval(buffer);
                    },1000)


                } else {

                    $('.error_msg').removeClass('d-none').text(data.msg);
                    $('.success_msg').addClass('d-none');

                }

                $("html, body").animate({ scrollTop: 0 });
            });

        }
    });

    $('.img').change(function () {


        for (var i = 0; i < this.files.length; i++){

            if (this.files.length > 5) {
                $('.img_allow').html('تم الوصول لحد غير مسموح به من الصور رجاء اختيار 5 صور فقط').addClass('alert alert-danger');
                $('.img_container input').remove();
                $('.imgContent img').remove();
                $('.img').val('');

            } else if ($('.img_container').children().length > 4){
                $('.img_allow').html('تم الوصول لحد غير مسموح به من الصور رجاء اختيار 5 صور فقط').addClass('alert alert-danger');
                $('.img_container input').remove();
                $('.imgContent img').remove();
                $('.img').val('');
            } else {
                $('.img_allow').html('عدد الصور المسموح بها 5 صور فقط *').toggleClass('alert alert-danger alert alert-info');


                var reader = new FileReader();

                reader.onload = function(e) {

                    $('.imgContent').append('<img class="adv_img" src="'+e.target.result+'">').removeClass('d-none');

                };

                reader.readAsDataURL(this.files[i]);

                $('.img_container').append('<input type="hidden" name="images[]" value="'+this.files[i].name+'" >')

            }

        }

    });

    // Delete image by double click it
    $(document).on('click', '.delete_img', function () {
        $('.img_container input').remove();
        $('.imgContent img').remove();
        $('.img').val('');
        $('.imgContent').addClass('d-none');
        return false

    });

    $('.search_button').click(function () {
        if ($('#search').val() === ''){
            $('.search_msg').removeClass('d-none');
            return false
        }
    });

    $('#search').focus(function () {
        $('.search_msg').addClass('d-none');
    });

});