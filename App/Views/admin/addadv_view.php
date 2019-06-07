<?php
$allCities = \Models\LocationsModel::getAll();
$allUsers = \Models\UsersModel::getAll();

?>

<div class="panel panel-default col-lg-12">
    <div class="panel-title text-center">
        <b>إضافة إعلان</b>
    </div>
    <div class="panel-body">
        <!-- Alerts -->
        <div class="alert alert-success success_msg hidden text-center" role="alert"></div>
        <div class="alert alert-danger error_msg hidden text-center" role="alert"></div>
        <!-- End Alerts -->

        <form method="post" class="add_adv_form" id="add_adv_form" action="<?= $this->route->baseUrl() . 'Advertise/add'?>" enctype="multipart/form-data">
            <input type="hidden" name="lat" value="" id="lat">
            <input type="hidden" name="lng" value="" id="lng">
            <div class="form-group clearfix">
                <label for="title" class="pull-right">العنوان</label>
                <input type="text" name="title" class="form-control text-right" id="title"  placeholder="عنوان الإعلان">
                <small class="text-danger hidden pull-right">عنوان الإعلان لا يقل عن 3 احرف</small>
            </div>
            <div class="form-group clearfix">
                <label for="location" class="pull-right">الموقع</label>
                <select name="location" id="location" class="location form-control">
                    <option value="0"></option>
                    <?php
                    if (empty($allCities) == false){
                        foreach ($allCities as $allCity) { ?>
                            <option value="<?= $allCity->city?>"><?= $allCity->city?></option>
                        <?php } } ?>


                </select>
                <small class="text-danger hidden pull-right location_alert">رجاءاً اختيار الموقع</small>
            </div>
            <div class="form-group clearfix">
                <label for="size" class="pull-right">المساحة</label>
                <input type="text" name="size" class="form-control text-right" id="size" placeholder="المساحة بالمتر">
                <small class="text-danger hidden pull-right">المساحة أرقام فقط</small>
            </div>
            <div class="form-group clearfix">
                <label for="room" class="pull-right">عدد الغرف</label>
                <input type="text" name="room" class="form-control text-right" id="room" placeholder="عدد الغرف">
                <small class="text-danger hidden pull-right">عدد الغرف أرقام فقط</small>
            </div>
            <div class="form-group clearfix">
                <label for="bath" class="pull-right">عدد الحمامات</label>
                <input type="text" name="bath" class="form-control text-right" id="bath" placeholder="عدد الحمامات">
                <small class="text-danger hidden pull-right"> عدد الحمامات أرقام فقط</small>
            </div>

            <div class="form-group clearfix">
                <label for="user_id" class="pull-right">اسم المستخدم</label>
                <select name="user_id" id="user_id" class="user_id form-control">
                    <option value="0"></option>
                    <?php
                    if (empty($allUsers) == false){
                        foreach ($allUsers as $allUser) { ?>
                            <option value="<?= $allUser->id?>"><?= $allUser->first_name . ' ' , $allUser->last_name?></option>
                        <?php } } ?>
                </select>
                <small class="text-danger hidden pull-right location_alert">رجاءاً اختيار الموقع</small>
            </div>
            <div class="form-group">
                <label for="title" class="pull-right">وصف الإعلان</label>
                <textarea name="description" class="form-control text-right" id="description" cols="30" rows="10" placeholder="وصف الإعلان"></textarea>
                <small class="text-danger hidden pull-right">رجاء قم بكتابة الوصف</small>
            </div>

            <!--  Map  -->
            <div id="map"></div>
            <div id="current">موقعك الحالي بخطي الطول والعرض</div>
            <hr>
            <!--  Map  -->


            <div class="form-group">
                <label for="img" class="btn btn-success pull-right"><i class="fa fa-image"></i> إضافة صور</label>
                <input type="file" multiple name="files[]" class="form-control hidden text-right img" id="img">
                <b class="btn btn-danger delete_img">حذف الصور</b>
            </div>

            <div class="form-group">
                <div class="hidden img_container"></div>
                <div class="text-danger img_allow text-center"><strong>عدد الصور المسموح بها 5 صور فقط *</strong></div>
            </div>
            <button type="submit" class="btn btn-primary btn-sm add_adv_button pull-right">إضافة إعلان</button>
        </form>
        <div class="imgContent"></div>

    </div>
</div>
<script>
    // The following example creates a marker in Stockholm, Sweden using a DROP
    // animation. Clicking on the marker will toggle the animation between a BOUNCE
    // animation and no animation.

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
            document.getElementById('current').innerHTML = '<p><b>تم تحريك العلامة:</b> Current Lat: ' + evt.latLng.lat().toFixed(3) + ' Current Lng: ' + evt.latLng.lng().toFixed(3) + '</p>';
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

        // marker.addListener('click', toggleBounce);

    }



    // function toggleBounce() {
    //
    //
    //
    //     if (marker.getAnimation() !== null) {
    //         marker.setAnimation(null);
    //     } else {
    //         marker.setAnimation(google.maps.Animation.BOUNCE);
    //     }
    // }


</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCe-Cm12jAANbN9CBDjFri0_V9YIDywCJQ&callback=initMap">

    // var marker;
    //
    // function initMap() {
    //     var map = new google.maps.Map(document.getElementById('map'), {
    //         zoom: 13,
    //         center: {lat: 59.325, lng: 18.070}
    //     });
    //
    //     marker = new google.maps.Marker({
    //         map: map,
    //         draggable: true,
    //         animation: google.maps.Animation.DROP,
    //         position: {lat: 59.327, lng: 18.067}
    //     });
    //     marker.addListener('click', toggleBounce);
    // }
    //
    // function toggleBounce() {
    //
    //
    //
    //     if (marker.getAnimation() !== null) {
    //         marker.setAnimation(null);
    //     } else {
    //         marker.setAnimation(google.maps.Animation.BOUNCE);
    //     }
    // }
</script>
