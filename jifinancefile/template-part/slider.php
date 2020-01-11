    <div class="hero-area">
        <div class="hero-slideshow owl-carousel">
            
            <?php 
                global $post;

                $jifinanceSlide = array(
                                    'posts_per_page' => -1, //-1 means unlimited slider show.
                                    'post_type' => 'slider-item',
                                    'page' => $paged,
                                    'order' => 'DESC'
                                );
                $allInfo = get_posts($jifinanceSlide);

                foreach ($allInfo as $post) : setup_postdata($post);
                    $sliderImg = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'slider-item');
            ?>

            <!-- Single Slide -->
            <div class="single-slide bg-img">
                <!-- Background Image-->
                <div class="slide-bg-img bg-img bg-overlay" style="background-image: url(<?= $sliderImg[0];?>);"></div>
                <!-- Welcome Text -->
                <div class="container h-100">
                    <div class="row h-100 align-items-center justify-content-center">
                        <div class="col-12 col-lg-9">
                            <div class="welcome-text text-center">
                                <h6 data-animation="fadeInUp" data-delay="100ms"><?php echo get_post_meta($post->ID, 'hello', true); ?></h6>
                                <h2 data-animation="fadeInUp" data-delay="300ms"><?= the_title();?></h2>
                                <p data-animation="fadeInUp" data-delay="500ms"><?= the_content();?>.</p>
                                <a href="<?= the_permalink();?>" class="btn credit-btn mt-50" data-animation="fadeInUp" data-delay="700ms">Discover</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Slide Duration Indicator -->
                <div class="slide-du-indicator"></div>
            </div>
            
            <?php endforeach; ?>

        </div>
    </div>