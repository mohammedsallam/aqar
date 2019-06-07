<?php


$limit = 2;

if (isset($_GET["page"])) {
    $pn  = abs($this->filter->int($_GET["page"]));
    if ($pn == 0){
        $pn = 1;
    }
}
else {
    $pn=1;
}

$start_from = ($pn-1) * $limit;


$sql = "SELECT advertises.*, users.*, adv_img.* FROM adv_img LEFT JOIN advertises ON advertises.id = adv_img.adv_id LEFT JOIN users ON users.id = advertises.user_id ORDER BY created_at DESC LIMIT $start_from,$limit";
$allAdv = \Models\AdvertiseModel::query($sql);

$sql = "SELECT * FROM advertises";
$count = \Models\AdvertiseModel::query($sql);
$count = count($count);
$page_count = ceil($count / $limit);

?>

<div class="container-fluid mt-5 ">
    <div class="row">
        <?php

        foreach ($allAdv as $adv) {

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
            }

            ?>
            <div class="card mb-5 col-lg-10 mx-auto clearfix">
                <div class="card-header">
                    <h5><?= $adv->title ?></h5>
                    <div class="pull-left ml-1 bg-secondary rounded px-1 text-light">  <?= $timeToShow ?> <i class="fa fa-clock-o"></i></div>

            </div>
                <a href="<?= $this->route->baseUrl() . 'advertise/show/' . $adv->id?>" class="text-decoration-none">
                    <div class="card-body position-relative">
                        <h5><?= $adv->title . '-' .$adv->location ?></h5>
                        <ul class="list-group">
                            <li class="list-unstyled"><img src="<?= $this->route->baseUrl() . IMAGES_PATH . 'ruler.png'?>"> <b class="text-muted"><?= $adv->size . ' متر' ?></b></li>
                            <li class="list-unstyled"><img src="<?= $this->route->baseUrl() . IMAGES_PATH . 'bath.png'?>"> <b class="text-muted"><?= $adv->bath ?></b></li>
                            <li class="list-unstyled"><img src="<?= $this->route->baseUrl() . IMAGES_PATH . 'bed.png'?>"> <b class="text-muted"><?= $adv->room ?></b></li>
                        </ul>
                        <div class="adv_img_show d-flex position-absolute">
                            <img src="<?= $this->route->baseUrl().IMAGES_PATH.'adv'.DS.$adv->user_id.DS.$images?>">
                        </div>
                    </div>
                </a>
            </div>
           <?php } ?>

            <div class="col-lg-10 m-auto text-center">
                <?php
                    $links = '';
                    if ($count > $limit){
                        for ($i=1; $i<=$page_count; $i++) {
                            if($i==$pn){

                                $links .= "<a class='active btn btn-success ml-1' href='".$this->route->baseUrl()."?page=".$i."'>".$i."</a>";
                            }
                            else {

                                $links .= "<a class='btn btn-primary btn-sm ml-1' href='".$this->route->baseUrl()."?page=".$i."'>".$i."</a>";
                            }
                        }
                        if ($pn > $page_count) { ?>
                            <div class="alert alert-info text-danger">لا توجد بيانات لعرضها</div>

                       <?php
                            echo $links;
                        } else {
                            echo $links;
                        }
                    } ?>
            </div>
    </div>
  </div>