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
        <?php

            if ($allAdvs != null){ ?>
                <div class="col-8 mt-4">
                    <input type="hidden" name="lat" value="<?= $allAdvs->lat?>" id="lat">
                    <input type="hidden" name="lng" value="<?= $allAdvs->lng?>" id="lng">
                    <div class="card">
                        <div class="card-header">
                            <div class="pull-left ml-1 bg-secondary rounded px-1 text-light"> <?= $allAdvs->first_name.' '.$allAdvs->last_name?>  <i class="fa fa-user"></i></div>
                            <div class="pull-left ml-1 bg-secondary rounded px-1 text-light"> <?= $allAdvs->phone?> <i class="fa fa-phone"></i></div>
                            <div class="pull-left ml-1 bg-secondary rounded px-1 text-light">  <?= $allAdvs->email ?> <i class="fa fa-envelope"></i></div>
                            <div class="pull-left ml-1 bg-secondary rounded px-1 text-light">  <?= date('Y-m-d', $allAdvs->created_at) ?> <i class="fa fa-calendar"></i></div>
                            <div class="pull-left ml-1 bg-secondary rounded px-1 text-light">  <?= date('h:m:s', $allAdvs->created_at) ?> <i class="fa fa-clock-o"></i></div>

                            <b class="card-title">تفاصيل الإعلان</b>
                        </div>
                        <div class="card-body">

                            <table class="table table-striped table-hover table-borderless table-responsive-sm">
                                <thead>
                                <tr>
                                    <th class="text-left">عنوان الإعلان</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><?= $allAdvs->title ?></td>
                                </tr>
                                </tbody>
                                <!-- End -->
                                <thead>
                                <tr>
                                    <th class="text-left">موقع الإعلان</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><?= $allAdvs->location ?></td>
                                </tr>
                                </tbody>
                                <!-- End -->
                                <thead>
                                <tr>
                                    <th class="text-left">المساحة بالمتر</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><?= $allAdvs->size  . ' متر'?></td>
                                </tr>
                                </tbody>
                                <!-- End -->
                                <thead>
                                <tr>
                                    <th class="text-left">عدد الغرف</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><?= $allAdvs->room . ' غرفة'?></td>
                                </tr>
                                </tbody>
                                <!-- End -->
                                <thead>
                                <tr>
                                    <th class="text-left">عدد الحمامات</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><i class="fa fa-toilet"></i> <?= $allAdvs->bath . ' حمام' ?></td>
                                </tr>
                                </tbody>
                                <!-- End -->
                                <thead>
                                <tr>
                                    <th class="text-left">تفاصيل الإعلان</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td style="word-break: break-all"><?= $allAdvs->description ?></td>
                                </tr>
                                </tbody>
                                <!-- End -->
                                <!-- End -->
                                <thead>
                                <tr>
                                    <th class="text-left">الموقع الجغرافي</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><div id="map"></div></td>
                                </tr>
                                </tbody>
                                <!-- End -->
                            </table>
                            <div class="border rounded mb-3">
                                <!-- Slider image -->
                                <ul class="pgwSlider">
                                    <?php

                                    $images = json_decode($allAdvs->img);

                                    foreach ($images as $image) { ?>
                                        <li>
                                            <img src="<?= $this->route->baseUrl() . IMAGES_PATH . 'adv' . DS . $allAdvs->user_id . DS . $image?>" >
                                        </li>
                                    <?php } ?>
                                </ul>
                                <!-- Slider image -->
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="<?= $this->route->baseUrl() . 'Advertise/edit'?>" class="btn btn-primary btn-sm"> تعديل الإعلان <i class="fa fa-edit"></i></a>
                            <a data-adv-id="<?= $allAdvs->adv_id ?>" href="<?= $this->route->baseUrl() . 'Advertise/delete'?>" class="btn btn-danger pull-left btn-sm delete_adv_link"> حذف الإعلان <i class="fa fa-trash"></i> </a>
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

                        var lat = document.getElementById('lat').value,
                            lng = document.getElementById('lng').value;

                        var myLatlng = new google.maps.LatLng(lat,lng);

                        marker = new google.maps.Marker({
                            map: map,
                            draggable: true,
                            animation: google.maps.Animation.DROP,
                            position: myLatlng
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


            <?php } else { ?>

               <div class="col-lg-8  mt-4 text-center font-weight-bold text-danger">لا توجد إعلانات خاصة بك ، لم تقم بإضافة أعلانات بعد</div>

            <?php } ?>
    </div>
</div>
