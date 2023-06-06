<? include "header.php"; ?>

<section id="home" class="d-flex align-items-center">
    <div class="container" data-aos="zoom-out" data-aos-delay="100">
        <h1 style="font-weight: normal;font-size: 40px;"><?= $language["index_welcome"]; ?> <span style="font-family: Lucida Calligraphy Italic;font-size: 58px;line-height: 60px;">PerformVE</span></h1>
        <h2><?= $language["index_welcom2"]; ?></h2>
        <div class="d-flex">
            <a href="#about" class="btn-get-started scrollto"><?= $language["index_start"]; ?></a>
            <a href="https://www.youtube.com/watch?v=HTbhp1lU62s" class="glightbox btn-watch-video"><i class="bi bi-play-circle"></i><span><?= $language["index_video"]; ?></span></a>
        </div>
    </div>
</section>

<main id="main">
    <section id="about" class="about section-bg">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <h3><?= $language["index_about2"]; ?><?= $language["index_about3"]; ?></h3>
            </div>
            <div class="row" style="padding-top: 20px; padding-bottom: 80px;">
                <div class="col-lg-6 aos-init aos-animate" data-aos="fade-right" data-aos-delay="100">
                    <div class="vidbg-container">
                        <video autoplay muted loop style="opacity: 1; width: 98%; border-radius: 16px;" id="aboutVideo">
                            <source src="img/intro.mp4" type="video/mp4">
                            <source src="#" type="video/webm">
                        </video>
                        <div class="vidbg-overlay"></div>
                    </div>
                </div>
                <div class="col-lg-6 content aos-init aos-animate about-right" data-aos="fade-up" data-aos-delay="100">
                    <p class="section-subtitle" style="margin-top: 0px; width: 75%;">
                        <?= $language["index_about4"]; ?>
                    </p>
                    <ul class="section-subtitle">
                        <li><i class="bx bx-body"></i><?= $language["index_about4_1"]; ?></li>
                        <li><i class="bx bx-dollar-circle"></i><?= $language["index_about4_2"]; ?></li>
                        <li><i class="bx bx-store-alt"></i><?= $language["index_about4_3"]; ?></li>
                    </ul>
                    <p style="margin-top: 0px; width: 75%;">
                        <?= $language["index_about5"]; ?>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section id="services" class="services" style="padding:0px">
        <video autoplay muted loop id="serviceVideo">
            <source src="img/intro2.mp4" type="video/mp4">
        </video>
        <div class="section-overlay"></div>

        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <br><br>
                <h3 style="color:white;"><?= $language["index_service2"];?><?= $language["index_service3"];?></h3>
            </div>

            <div id="splide">
                <div class="splide__track" id="splide-track">
                    <ul class="splide__list">
                        <li class="splide__slide">
                            <div class="icon-box">
                                <div class="icon"><i class="bx bx-user-pin"></i></div>
                                <h4><?= $language["index_pm"]; ?></h4>
                                <ul class="section-subtitle">
                                    <li><?= $language["index_pm2"]; ?></li>
                                    <li><?= $language["index_pm3"]; ?></li>
                                    <li><?= $language["index_pm4"]; ?></li>
                                </ul>
                            </div>
                        </li>

                        <li class="splide__slide">
                            <div class="icon-box">
                                <div class="icon"><i class="bx bx-pie-chart-alt-2"></i></div>
                                <h4><?= $language["index_hcm"]; ?></h4>
                                <ul class="section-subtitle">
                                    <li><?= $language["index_hcm2"]; ?></li>
                                    <ul class="checkmark-ul">
                                        <li><?= $language["index_hcm2_1"]; ?></li>
                                        <li><?= $language["index_hcm2_2"]; ?></li>
                                        <li><?= $language["index_hcm2_3"]; ?></li>
                                        <li><?= $language["index_hcm2_4"]; ?></li>
                                    </ul>
                                    <li><?= $language["index_hcm3"]; ?></li>
                                </ul>
                            </div>
                        </li>

                        <li class="splide__slide">
                            <div class="icon-box">
                                <div class="icon"><i class="bx bx-plus-circle"></i></div>
                                <h4><?= $language["index_pg"]; ?></h4>
                                <ul class="section-subtitle">
                                    <li><?= $language["index_pg2"]; ?></li>
                                    <li><?= $language["index_pg3"]; ?></li>
                                    <li><?= $language["index_pg4"]; ?></li>
                                </ul>
                            </div>
                        </li>

                        <li class="splide__slide">
                            <div class="icon-box">
                                <div class="icon"><i class="bx bx-dollar-circle"></i></div>
                                <h4><?= $language["index_hcce"]; ?></h4>
                                <p class="section-subtitle">
                                    <?= $language["index_hcce2"]; ?></p>
                                <ul class="section-subtitle">
                                    <li><?= $language["index_hcce2_1"]; ?></li>
                                    <li><?= $language["index_hcce2_2"]; ?></li>
                                    <li><?= $language["index_hcce2_3"]; ?></li>
                                    <li><?= $language["index_hcce2_4"]; ?></li>
                                </ul>
                            </div>
                        </li>

                        <li class="splide__slide">
                            <div class="icon-box">
                                <div class="icon"><i class="bx bx-bar-chart-square"></i></div>
                                <h4><?= $language["index_bp"]; ?></h4>
                                <p class="section-subtitle">
                                    <?= $language["index_bp2"]; ?></p>
                                <ul class="section-subtitle">
                                    <li><?= $language["index_bp2_1"]; ?></li>
                                    <li><?= $language["index_bp2_2"]; ?></li>
                                    <li><?= $language["index_bp2_3"]; ?></li>
                                </ul>
                            </div>
                        </li>

                        <li class="splide__slide">
                            <div class="icon-box">
                                <div class="icon"><i class="bx bx-current-location"></i></div>
                                <h4><?= $language["index_twr"]; ?></h4>
                                <ul class="section-subtitle">
                                    <li><?= $language["index_twr2"]; ?></li>
                                    <li><?= $language["index_twr3"]; ?></li>
                                    <li><?= $language["index_twr4"]; ?></li>
                                </ul>
                            </div>
                        </li>

                        <li class="splide__slide">
                            <div class="icon-box">
                                <div class="icon"><i class="bx bx-happy"></i></div>
                                <h4><?= $language["index_vein"]; ?></h4>
                                <ul class="section-subtitle">
                                    <li><?= $language["index_vein2"]; ?></li>
                                    <li><?= $language["index_vein3"]; ?></li>
                                    <li><?= $language["index_vein4"]; ?></li>
                                    <li><?= $language["index_vein5"]; ?></li>
                                </ul>
                            </div>
                        </li>

                        <li class="splide__slide">
                            <div class="icon-box">
                                <div class="icon"><i class="bx bx-body"></i></div>
                                <h4><?= $language["index_onbord"]; ?></h4>
                                <ul class="section-subtitle">
                                    <li><?= $language["index_onbord2"]; ?></li>
                                    <li><?= $language["index_onbord3"]; ?></li>
                                    <li><?= $language["index_onbord4"]; ?></li>
                                    <li><?= $language["index_onbord5"]; ?></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section id="security" class="security">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h3><?= $language["index_security2"];?><?= $language["index_security3"]; ?></h3>

                <div class="row aos-init aos-animate security-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="col-12 col-lg-6" style="padding: 0px;">
                        <img src="img/i_security.jpg" class="img-fluid" alt="" style="border-radius: 10px; width:100%; height:100%">
                    </div>
                    <div class="col-12 col-lg-6 content">
                        <ul class="section-subtitle">
                            <li><?=$language["index_security4"];?></li>
                            <li><i class="bx bx-data"></i><?= $language["index_security5"]; ?></li>
                            <li><i class="bx bx-check-shield"></i><?= $language["index_security6"]; ?></li>
                            <li><i class="bx bx-lock"></i><?= $language["index_security7"]; ?></li>
                            <li><i class="bx bx-code-block"></i><?= $language["index_security8"]; ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="team" class="team section-bg">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h3><?= $language["index_team2"]; ?><?= $language["index_team3"]; ?></h3>

                <div class="row aos-init aos-animate team-card" data-aos="fade-up" data-aos-delay="100">

                    <div class="col-12 col-lg-6 content">
                        <p>
                            <?= $language["index_team4"]; ?>
                        </p>
                    </div>
                    <div class="col-12 col-lg-6" style="padding: 0px;">
                        <img src="img/i_team.png" class="img-fluid" alt="" style="width:100%;height: 359px;border-radius: 10px;">
                    </div>
                </div>

                <!-- <div class="row" style="padding-top: 40px; padding-bottom: 40px;">
                    <p style="margin-top: 0px; width: 75%;">
                        <?= $language["index_team4"]; ?>
                    </p>
                </div> -->
            </div>
        </div>
        </div>
    </section>

    <section id="customized" class="customized">
        <div class="section-title" style="position: relative;">
            <h3 style="color:white;"><?=$language["index_customized2"].$language["index_customized3"];?></h3>
        </div>
        <div class="container aos-init aos-animate" data-aos="zoom-in">
            <div class="customized-slider swiper-container swiper-container-initialized swiper-container-horizontal swiper-container-pointer-events aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
                <div class="swiper-wrapper" id="swiper-wrapper-8af102100ba5198ca1" aria-live="off" style="transform: translate3d(-9072px, 0px, 0px); transition-duration: 0ms;">

                    <div class="swiper-slide" data-swiper-slide-index="0" role="group" aria-label="1 / 5">
                        <div class="customized-item">
                            <img src="img/i_property.jpg" class="customized-img" alt="">
                            <h3><?= $language["index_customized4"]; ?></h3>
                            <h4><?= $language["index_customized_title"]; ?></h4>
                        </div>
                    </div>

                    <div class="swiper-slide swiper-slide-prev" data-swiper-slide-index="1" role="group" aria-label="2 / 5">
                        <div class="customized-item">
                            <img src="img/i_clinics.jpg" class="customized-img" alt="">
                            <h3><?= $language["index_customized5"]; ?></h3>
                            <h4><?= $language["index_customized_title"]; ?></h4>
                        </div>
                    </div>

                    <div class="swiper-slide swiper-slide-active" data-swiper-slide-index="2" role="group" aria-label="3 / 5">
                        <div class="customized-item">
                            <img src="img/i_financial.jpeg" class="customized-img" alt="">
                            <h3><?= $language["index_customized6"]; ?></h3>
                            <h4><?= $language["index_customized_title"]; ?></h4>
                        </div>
                    </div>

                    <div class="swiper-slide swiper-slide-next" data-swiper-slide-index="3" role="group" aria-label="4 / 5">
                        <div class="customized-item">
                            <img src="img/i_logistics.jpg" class="customized-img" alt="">
                            <h3><?= $language["index_customized7"]; ?></h3>
                            <h4><?= $language["index_customized_title"]; ?></h4>
                        </div>
                    </div>

                    <div class="swiper-slide" data-swiper-slide-index="4" role="group" aria-label="5 / 5">
                        <div class="customized-item">
                            <img src="img/i_education.jpg" class="customized-img" alt="">
                            <h3><?= $language["index_customized8"]; ?></h3>
                            <h4><?= $language["index_customized_title"]; ?></h4>
                        </div>
                    </div>

                </div>
                <div class="swiper-pagination swiper-pagination-clickable swiper-pagination-bullets"><span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label=""></span><span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label=""></span><span class="swiper-pagination-bullet swiper-pagination-bullet-active" tabindex="0" role="button" aria-label=""></span><span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label=""></span><span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label=""></span></div>
                <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
            </div>

        </div>
    </section>

    <section id="contact" class="contact section-bg">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h3><?= $language["index_contact2"]; ?></h3>
            </div>

            <div class="row" data-aos="fade-up" data-aos-delay="100">
                <div class="col-lg-6">
                    <div class="info-box mb-4">
                        <i class="bx bx-map"></i>
                        <h3><?= $language["index_address"]; ?></h3>
                        <p style="text-align: center;"><?= $language["index_address2"]; ?></p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="info-box mb-4">
                        <i class="bx bx-envelope"></i>
                        <h3><?= $language["index_email"]; ?></h3>
                        <p><a href="mailto:support@performve.com">support@performve.com</a><br><br></p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="info-box  mb-4">
                        <i class="bx bx-phone-call"></i>
                        <h3><?= $language["index_call"]; ?></h3>
                        <p><a href="tel:+85293082800">+852 9308 2800</a><br><br></p>
                    </div>
                </div>
            </div>

            <div class="row" data-aos="fade-up" data-aos-delay="100">

                <div class="col-lg-6 ">
                    <?php
                    $langStr = "en";
                    if (isset($_COOKIE['lang']) && $_COOKIE['lang'] == "tc") {
                        $langStr = "zh-TW";
                    } else if (isset($_COOKIE['lang']) && $_COOKIE['lang'] == "sc") {
                        $langStr = "zh-CN";
                    }
                    ?>
                    <iframe class="mb-4 mb-lg-0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d922.0216779896616!2d114.21184662922403!3d22.425761899078676!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3404089782a709eb%3A0x92ca670fb2b15b44!2z56eR5a245ZyS56eR5oqA5aSn6YGT6KW_NeiZn-S8gealreW7o-WgtA!5e0!3m2!1s<?=$langStr;?>!2sEnterprise%20Place%20(5W),%20Hong%20Kong+(PerformVE%20Limited)!4v1622013751169!5m2!1s<?=$langStr;?>!2shk" width="100%" height="384px" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>

                <div class="col-lg-6">
                    <form action="contact" method="post" role="form" class="php-email-form">
                        <span>Fill in the form below and we’ll be in touch shortly!<br><br></span>
                        <div class="row">
                            <div class="col form-group">
                                <input type="text" name="name" class="form-control" id="name" placeholder="<?= $language["index_message_name"]; ?>" autocomplete="off" oninput="setCustomValidity('')" oninvalid="setCustomValidity('<?= $language['general_fill_in_field']; ?>')" required>
                            </div>
                            <div class="col form-group">
                                <input type="email" class="form-control" name="email" id="email" placeholder="<?= $language["index_message_email"]; ?>" autocomplete="off" oninput="setCustomValidity('')" oninvalid="setCustomValidity('<?= $language['general_must_email']; ?>')" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="subject" id="subject" placeholder="<?= $language["index_message_subject"]; ?>" autocomplete="off" oninput="setCustomValidity('')" oninvalid="setCustomValidity('<?= $language['general_fill_in_field']; ?>')" required>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="message" rows="5" placeholder="<?= $language["index_message_message"]; ?>" autocomplete="off" oninput="setCustomValidity('')" oninvalid="setCustomValidity('<?= $language['general_fill_in_field']; ?>')" required></textarea>
                        </div>
                        <div class="my-3">
                            <div class="loading"><?= $language["index_loading"]; ?></div>
                            <div class="error-message"></div>
                            <div class="sent-message"><?= $language["contact_success"]; ?></div>
                        </div>
                        <div class="text-center"><button type="submit"><?= $language["index_send_message"]; ?></button>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </section>

</main>

<? include "footer.php"; ?>
