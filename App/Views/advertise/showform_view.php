<?php
$allCities = \Models\LocationsModel::getAll();
$id = $this->session->has('id') ? $this->session->get('id') : $this->cookie->get('id');

?>

<div class="container-fluid">
    <div class="row">
        <div class="col-3 mt-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">التحكم في الإعلانات</h4>
                    <p class="card-text"><a href="<?= $this->route->baseUrl() . 'Advertise'?>">إعلاناتي</a></p>
                    <p class="card-text"><a href="<?= $this->route->baseUrl() . 'Advertise/showForm'?>">إضافة إعلان</a></p>
                    <p class="card-text"><a href="<?= $this->route->baseUrl() . 'Advertise/edit'?>">تعديل الإعلان</a></p>
                </div>
            </div>
        </div>
        <div class="card col-lg-8 mt-4">
            <!-- Alerts -->
            <div class="alert alert-success success_msg d-none text-center" role="alert"></div>
            <div class="alert alert-danger error_msg d-none text-center" role="alert"></div>
            <!-- End Alerts -->
            <div class="card-header">
                <h4 class="card-title text-center">إضافة إعلان</h4>
                <p class="col-lg-12 text-danger text-center font-weight-bold ">في حالة إضافة أعلان جديد سوف يتم حذف الإعلان السابق واستبداله بالإعلان الجديد</p>
            </div>
            <div class="card-body">
                <form method="post" class="add_adv_form" id="add_adv_form" action="<?= $this->route->baseUrl() . 'advertise/add'?>" enctype="multipart/form-data">
                    <input type="hidden" name="user_id" value="<?= $id ?>" id="user_id">
                    <input type="hidden" name="adv_id" value="<?= $allAdvs->adv_id ?>" id="adv_id">
                    <input type="hidden" name="lat" value="" id="lat">
                    <input type="hidden" name="lng" value="" id="lng">
                    <div class="form-group">
                        <label for="title">عنوان الإعلان</label>
                        <input type="text" name="title" class="form-control text-left" id="title"  placeholder="عنوان الإعلان" value="">
                        <small class="text-danger d-none">عنوان الإعلان لا يقل عن 3 احرف</small>
                    </div>
                    <div class="form-group">
                        <label for="location">الموقع</label>
                        <select name="location" id="location" class="location form-control">
                            <option value="0"></option>
                            <?php
                            if (empty($allCities) == false){
                                foreach ($allCities as $allCity) { ?>
                                    <option value="<?= $allCity->city?>"><?= $allCity->city?></option>
                                <?php } } ?>


                        </select>
                        <small class="text-danger location_alert d-none">رجاءاً اختيار الموقع</small>
                    </div>
                    <div class="form-group">
                        <label for="size">المساحة</label>
                        <input type="text" name="size" class="form-control text-left" id="size" placeholder="المساحة بالمتر">
                        <small class="text-danger d-none">المساحة أرقام فقط</small>
                    </div>
                    <div class="form-group">
                        <label for="room">عدد الغرف</label>
                        <input type="text" name="room" class="form-control text-left" id="room" placeholder="عدد الغرف">
                        <small class="text-danger d-none">عدد الغرف أرقام فقط</small>
                    </div>
                    <div class="form-group">
                        <label for="bath">عدد الحمامات</label>
                        <input type="text" name="bath" class="form-control text-left" id="bath" placeholder="عدد الحمامات">
                        <small class="text-danger d-none"> عدد الحمامات أرقام فقط</small>
                    </div>
                    <div class="form-group">
                        <label for="description">وصف الإعلان</label>
                        <textarea name="description" class="form-control text-left" id="description" cols="30" rows="10" placeholder="وصف الإعلان"></textarea>
                        <small class="text-danger d-none">رجاء كتابة الوصف ولا يقل عن 3 كلمات</small>
                    </div>

                    <!--  Map  -->
                    <div id="map"></div>
                    <br>
                    <b id="current">موقعك الحالي بخطي الطول والعرض</b>
                    <hr>
                    <!--  Map  -->

                    <div class="form-group">
                        <label for="img" class="btn btn-success "><i class="fa fa-image"></i> إضافة صور</label>
                        <input type="file" multiple name="files[]" class="form-control d-none text-left img" id="img">
                        <b class="btn btn-danger delete_img pull-left">حذف الصور</b>
                        <div class="text-danger img_allow text-center">عدد الصور المسموح بها 5 صور فقط *</div>
                    </div>

                    <div class="img_container d-none"></div>

                    <div class="imgContent d-none col-lg-12 mb-3"></div>

                    <button type="submit" class="btn btn-primary btn-sm add_adv_button pull-right">إضافة إعلان</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script>

    var marker;
    function initMap() {
         var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 10,
            center: {lat: 21.382, lng: 39.863},
            // center: new google.maps.LatLng(59.325, 18.070),
        });

        marker = new google.maps.Marker({
            map: map,
            draggable: true,
            animation: google.maps.Animation.DROP,
            position: {lat: 21.382, lng: 39.863}
        });


        google.maps.event.addListener(marker, 'dragend', function (evt) {
            document.getElementById('current').innerHTML = '<p><b>تم تحريك العلامة:</b> Current Lat: ' + evt.latLng.lat().toFixed(3) + ' | Current Lng: ' + evt.latLng.lng().toFixed(3) + '</p>';
            document.getElementById('current').removeAttribute('class');
            document.getElementById('lat').value = evt.latLng.lat().toFixed(3);
            document.getElementById('lng').value = evt.latLng.lng().toFixed(3);

            //  var infowindow = new google.maps.InfoWindow({
            //     content: '<p>Marker Location:' + marker.getPosition() + '</p>'
            // });
            //
            // infowindow.open(map, marker);

        });


        map.setCenter(marker.position);
        marker.setMap(map);
    }


</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCe-Cm12jAANbN9CBDjFri0_V9YIDywCJQ&callback=initMap"></script>