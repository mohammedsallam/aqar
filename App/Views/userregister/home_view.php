<div class="container">
    <div class="row">
        <div class="card col-sm-6 offset-3 mt-4">
            <div class="card-body">
                <!-- Alerts -->
                <div class="alert alert-success success_msg d-none text-center" role="alert"></div>
                <div class="alert alert-danger error_msg d-none text-center" role="alert"></div>
                <!-- End Alerts -->

                <h4 class="card-title text-center mb-5">تسجيل مستخدم جديد</h4>
                <form method="post" class="user_register_form" action="<?= $this->route->baseUrl() . 'UserRegister/check'?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="text" name="first_name" class="form-control" id="first_name"  placeholder="الإسم الأول">
                        <small class="text-danger d-none">الإسم الأول لا يقل عن 3 احرف</small>
                    </div>
                    <div class="form-group">
                        <input type="text" name="last_name" class="form-control" id="last_name"  placeholder="الإسم الأخير">
                        <small class="text-danger d-none">الإسم الأخير لا يقل عن 3 احرف</small>
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" id="email"  placeholder="البريد الإلكتروني">
                        <small class="text-danger d-none">صيغة بريد إلكتروني غير صالحة</small>
                    </div>
                    <div class="form-group">
                        <input type="tel" name="phone" class="form-control" id="phone"  placeholder="رقم الجوال">
                        <small class="text-danger d-none">رقم الجوال أرقام ولا يقل عن 10 أرقام ولا يزيد عن 14 رقم</small>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" id="password" placeholder="كلمة المرور">
                        <small class="text-danger d-none">كلمات المرور غير متطابقة</small>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password_conf" class="form-control" id="password_conf" placeholder="تأكيد كلمة المرور">
                    </div>
                    <div class="form-group">
                        <label for="user_img" class="btn btn-success btn-sm"> إضافة صورة <i class="fa fa-photo"></i></label>
                        <input type="file" name="user_img" class="form-control d-none user_img" id="user_img">
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm user_register_button">تسجيل</button>
                </form>
            </div>
            <div class="userImgContent d-none position-absolute"></div>
            <button class="del_img d-none position-absolute btn btn-danger btn-sm"><i class="fa fa-trash"></i> حذف الصورة </button>
        </div>
    </div>
</div>

<!--<div id="map"></div>-->
<!--<div id="current">sdfsdfdsf</div>-->
<!--<script>-->
<!--    // Note: This example requires that you consent to location sharing when-->
<!--    // prompted by your browser. If you see the error "The Geolocation service-->
<!--    // failed.", it means you probably did not give permission for the browser to-->
<!--    // locate you.-->
<!--    var map, infoWindow;-->
<!--    function initMap() {-->
<!--        map = new google.maps.Map(document.getElementById('map'), {-->
<!--            center: {lat: -34.397, lng: 150.644},-->
<!--            zoom: 6-->
<!--        });-->
<!--        infoWindow = new google.maps.InfoWindow;-->
<!---->
<!--        // Try HTML5 geolocation.-->
<!--        if (navigator.geolocation) {-->
<!--            navigator.geolocation.getCurrentPosition(function(position) {-->
<!--                var pos = {-->
<!--                    lat: position.coords.latitude,-->
<!--                    lng: position.coords.longitude-->
<!--                };-->
<!---->
<!--                infoWindow.setPosition(pos);-->
<!--                infoWindow.setContent('Location found.');-->
<!--                infoWindow.open(map);-->
<!--                map.setCenter(pos);-->
<!--            }, function() {-->
<!--                handleLocationError(true, infoWindow, map.getCenter());-->
<!--            });-->
<!--        } else {-->
<!--            // Browser doesn't support Geolocation-->
<!--            handleLocationError(false, infoWindow, map.getCenter());-->
<!--        }-->
<!---->
<!--    }-->
<!---->
<!--    function handleLocationError(browserHasGeolocation, infoWindow, pos) {-->
<!--        infoWindow.setPosition(pos);-->
<!--        infoWindow.setContent(browserHasGeolocation ?-->
<!--            'Error: The Geolocation service failed.' :-->
<!--            'Error: Your browser doesn\'t support geolocation.');-->
<!--        infoWindow.open(map);-->
<!--    }-->
<!---->
<!---->
<!--</script>-->
<!--<script async defer-->
<!--        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCe-Cm12jAANbN9CBDjFri0_V9YIDywCJQ&callback=initMap">-->
<!--</script>-->