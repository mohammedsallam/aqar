<div class="container-fluid mt-5 ">
    <div class="row">
<?php

    if (empty($adv) == false) {
        $images = json_decode($adv->img);
        $images = $images[0];

        $time = floor((time() - $adv->created_at) / 60);


        if ($time < 60) {
            $timeToShow = "قبل $time دقيقة";
        } elseif($time >= 60) {
            $time = floor($time/60);
            $timeToShow = "قبل $time ساعة";
        } elseif ($time >= 24) {
            $time = floor($time/24);
            $timeToShow = "قبل $time يوم";
        } elseif ($time >= 30) {
            $time = floor($time/30);
            $timeToShow = "قبل $time شهر";
        } elseif ($time >= 12) {
            $time = floor($time/12);
            $timeToShow = "قبل $time سنة";
        } ?>

        <div class="card mb-5 col-lg-10 mx-auto clearfix">
            <input type="hidden" name="lat" value="<?=$adv->lat?>" id="lat">
            <input type="hidden" name="lng" value="<?=$adv->lng?>" id="lng">
            <div class="card-header">
                <h5><?= $adv->title ?></h5>
                <div class="pull-left ml-1 bg-secondary rounded px-1 text-light">  <?= $timeToShow ?> <i class="fa fa-clock-o"></i></div>
            </div>
            <div class="card-body position-relative">
                <h5><?= $adv->title . '-' .$adv->location ?></h5>
                <ul class="list-group">
                    <li class="list-unstyled"><img src="<?= $this->route->baseUrl() . IMAGES_PATH . 'ruler.png'?>"> <b class="text-muted"><?= $adv->size . ' متر' ?></b></li>
                    <li class="list-unstyled"><img src="<?= $this->route->baseUrl() . IMAGES_PATH . 'bath.png'?>"> <b class="text-muted"><?= $adv->bath ?></b></li>
                    <li class="list-unstyled"><img src="<?= $this->route->baseUrl() . IMAGES_PATH . 'bed.png'?>"> <b class="text-muted"><?= $adv->room ?></b></li>
                </ul>
                <div class="position-absolute user_info">
                    <?php

                    if ($adv->user_img == 'user.png') {
                        $image = 'user.png';
                        $border = 'border-0';
                    } else {
                        $image = 'users_profile'.DS.$adv->user_img;
                        $border = 'border';
                    }

                    ?>
                    <a href="" class="text-decoration-none" title="<?= $adv->first_name.' '.$adv->last_name?>">
                        <img class="rounded border p-2 adv_user_img" src="<?= $this->route->baseUrl().IMAGES_PATH.$image?>">
                        <span class="ml-2 font-weight-bold"><?= $adv->first_name.' '.$adv->last_name?></span>
                    </a>
                    <br><div class="btn btn-success btn-sm my-2 user_phone">إظهار رقم الجوال</div>
                    <span class="d-none"><?= $adv->phone ?></span>
                </div>
                <hr>
                <div class="description mt-3">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi cupiditate doloremque illo itaque labore laboriosam natus qui voluptatibus. Accusamus animi aperiam asperiores aspernatur aut autem consectetur consequuntur corporis deserunt dolores, eos facere id, impedit in inventore ipsam itaque laboriosam molestiae nisi odit omnis optio qui quibusdam quis quisquam reprehenderit veritatis? Ab accusantium ad assumenda autem beatae blanditiis corporis cupiditate deserunt dicta dolorem eligendi enim error esse eveniet expedita fugiat laudantium minima minus modi nihil, nobis nostrum odio odit officiis omnis optio praesentium quibusdam quidem quis, quisquam quo reprehenderit rerum vero. Assumenda aut error eveniet excepturi ipsum quidem recusandae, repellat repudiandae vel. Dolor doloremque molestias nisi reiciendis voluptas. At dicta earum illum laborum officiis provident. Ad autem blanditiis debitis enim itaque iure iusto laudantium magnam magni maxime minus natus nihil nisi numquam officiis placeat possimus quasi, recusandae repellat sequi soluta, ut velit veniam veritatis voluptas voluptatibus voluptatum. Blanditiis dolor esse inventore iure laboriosam libero modi non placeat porro quidem. Ab accusantium ad alias aliquid aperiam aut commodi, consectetur distinctio dolor dolorem doloremque ducimus eum eveniet explicabo harum in minima molestiae mollitia nobis nostrum quia recusandae reiciendis repellat rerum sequi sit soluta tempora temporibus ullam voluptatibus. Ad modi nulla sunt totam voluptatibus!
                </div>

                <ul class="pgwSlider">
                    <?php

                    $images = json_decode($adv->img);

                    foreach ($images as $image) { ?>
                        <li>
                            <img src="<?= $this->route->baseUrl() . IMAGES_PATH . 'adv' . DS . $adv->user_id . DS .$image?>" >
                        </li>
                    <?php } ?>
                </ul>
                <div class="clearfix"></div>
                <div class="mt-5" id="map"></div>
            </div>
        </div>

        <script>

            var marker,
                lngVal = document.getElementById('lng').value,
                latVal = document.getElementById('lat').value;
            function initMap() {
                var map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 17,
                    center: {lat: 21.382, lng: 39.863},
                    // center: new google.maps.LatLng(59.325, 18.070),
                });

                var myLatlng = new google.maps.LatLng(latVal,lngVal);

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
        <div class="alert alert-info col-lg-10 offset-1 text-center text-danger">هذا الإعلان غير موجود</div>
    <?php } ?>
    </div>
</div>

