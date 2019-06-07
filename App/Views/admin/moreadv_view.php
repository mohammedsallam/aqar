<?php
$allCities = \Models\LocationsModel::getAll();
$allUsers = \Models\UsersModel::getAll();


?>


<?php

if (empty($adv) == false){ ?>
    <div class="panel panel-default adv_panel">
        <div class="panel-heading clearfix">
            <span class="pull-left"> <i class="fa fa-user"></i> <?= $adv->first_name.' '.$adv->last_name?> </span>
            <span class="pull-left"> <i class="fa fa-phone"></i> <?= $adv->phone?> </span>
            <span class="pull-left"> <i class="fa fa-envelope"></i> <?= $adv->email ?> </span>
            <span class="pull-left"> <i class="fa fa-calendar"></i> <?= date('Y-m-d', $adv->created_at) ?> </span>
            <span class="pull-left"> <i class="fa fa-clock-o"></i> <?= date('h:m:s', $adv->created_at) ?> </span>
            <b class="panel-title pull-right">
                تفاصيل الإعلان
            </b>
        </div>
        <div class="panel-body text-right">
            <input type="hidden" name="lat" value="<?=$adv->lat?>" id="lat">
            <input type="hidden" name="lng" value="<?=$adv->lng?>" id="lng">

            <table class="table table-hover table-bordered table-striped ">

                <thead>
                <tr>
                    <th class="text-right">عنوان الإعلان</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><?= $adv->title ?></td>
                </tr>
                </tbody>
                <!-- End -->
                <thead>
                <tr>
                    <th class="text-right">موقع الإعلان</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><?= $adv->location ?></td>
                </tr>
                </tbody>
                <!-- End -->
                <thead>
                <tr>
                    <th class="text-right">المساحة بالمتر</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><?= $adv->size ?></td>
                </tr>
                </tbody>
                <!-- End -->
                <thead>
                <tr>
                    <th class="text-right">عدد الغرف</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><?= $adv->room ?></td>
                </tr>
                </tbody>
                <!-- End -->
                <thead>
                <tr>
                    <th class="text-right">عدد الحمامات</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><?= $adv->bath ?></td>
                </tr>
                </tbody>
                <!-- End -->
                <thead>
                <tr>
                    <th class="text-right">تفاصيل الإعلان</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td style="word-break: break-all"><?= $adv->description ?></td>
                </tr>
                </tbody>
                <!-- End -->
                <!-- End -->
                <thead>
                <tr>
                    <th class="text-right">الموقع الجغرافي</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><div id="map"></div></td>
                </tr>
                </tbody>
                <!-- End -->
            </table>
            <!-- Slider image -->
            <ul class="pgwSlider">
                <?php

                $images = json_decode($adv->img);

                foreach ($images as $image) { ?>
                    <li>
                        <img src="<?= $this->route->baseUrl() . IMAGES_PATH . 'adv' . DS . $adv->user_id . DS .$image?>" >
                    </li>
                <?php } ?>
            </ul>
            <!-- Slider image -->

            <script>
                // The following example creates a marker in Stockholm, Sweden using a DROP
                // animation. Clicking on the marker will toggle the animation between a BOUNCE
                // animation and no animation.

                var marker,
                    lngVal = document.getElementById('lng').value,
                    latVal = document.getElementById('lat').value;

                function initMap() {
                    var map = new google.maps.Map(document.getElementById('map'), {
                        zoom: 10,
                        center: {lat: 21.382, lng: 39.863},
                        // center: new google.maps.LatLng(59.325, 18.070),
                    });

                    var myLatlng = new google.maps.LatLng(latVal,lngVal);

                    marker = new google.maps.Marker({
                        map: map,
                        draggable: true,
                        animation: google.maps.Animation.DROP,
                        position: myLatlng
                        // position: {lat: 21.382, lng: 39.863}
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
        </div>
    </div>
<?php } else { ?>

    <div class="col-lg-12 alert alert-danger text-center">هذا الإعلان غير موجود</div>

<?php } ?>

