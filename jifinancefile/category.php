<?php get_header(); ?>

    <!-- ##### Breadcrumb Area Start ##### -->
    <section class="breadcrumb-area bg-img bg-overlay jarallax" style="background-image: url(img/bg-img/13.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcrumb-content">
                        <h2>News</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">News</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Breadcrumb Area End ##### -->

    <!-- ##### News Area Start ##### -->
    <section class="news-area section-padding-100">
        <div class="container">
            <div class="row">
                <!-- Single News Area -->
                <div class="col-12 col-lg-8">
                    <?php 
                    if( have_posts()){
                        while(have_posts()){ the_post(); ?>
                            <!-- Single Blog Area -->
                            <div class="single-blog-area mb-70">
                                <div class="blog-thumbnail">
                                    <?php the_post_thumbnail('postimage', array('class' => 'any_class_name')); ?>
                                    <!-- <a href="#"><img src="img/bg-img/22.jpg" alt=""></a> -->
                                </div>
                                <div class="blog-content">
                                    <span><?php the_time('d M, Y'); ?></span>
                                    <a href="<?php the_permalink(); ?>" class="post-title"><?php the_title(); ?></a>
                                    <div class="blog-meta">
                                        <a href="#" class="post-author"><img src="img/core-img/pencil.png" alt=""> <?php the_author(); ?></a>
                                        <a href="#" class="post-date"><img src="img/core-img/calendar.png" alt=""> <?php comments_popup_link( 'No Comments >>', '1 Comment', '% Comments' ) ?></a>
                                    </div>
                                    <p><?php the_excerpt(); ?></p>
                                </div>
                            </div>
                    <?php
                        }
                    }else{
                        echo esc_html_e('Sorry! has not any post');
                    }
                    ?>

                    

                    <?php the_posts_pagination(); ?>

                    <!-- Pagination -->
                    <!-- <nav aria-label="Page navigation">
                        <ul class="pagination">
                            <li class="page-item active"><a class="page-link" href="#">01</a></li>
                            <li class="page-item"><a class="page-link" href="#">02</a></li>
                            <li class="page-item"><a class="page-link" href="#">03</a></li>
                        </ul>
                    </nav> -->
                </div>

                <?php get_sidebar(); ?>
            </div>
        </div>
    </section>
    <!-- ##### News Area End ##### -->

    <!-- ##### Newsletter Area Start ###### -->
    <section class="newsletter-area section-padding-100 bg-img jarallax" style="background-image: url(img/bg-img/6.jpg);">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-10 col-lg-8">
                    <div class="nl-content text-center">
                        <h2>Subscribe to our newsletter</h2>
                        <form action="#" method="post">
                            <input type="email" name="nl-email" id="nlemail" placeholder="Your e-mail">
                            <button type="submit">Subscribe</button>
                        </form>
                        <p>Curabitur elit turpis, maximus quis ullamcorper sed, maximus eu neque. Cras ultrices erat nec auctor blandit.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Newsletter Area End ###### -->

<?php get_footer(); ?>