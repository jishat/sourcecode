<!-- Sidebar Area -->
<div class="col-12 col-sm-9 col-md-6 col-lg-4">
    <div class="sidebar-area">

        <!-- Single Sidebar Widget -->
        <div class="single-widget-area search-widget">
            <form action="<?php echo esc_url(home_url('/')); ?>" method="get">
                <input type="search" name="s" placeholder="Search">
                <button type="submit">Search</button>
            </form>
        </div>

        <!-- Single Sidebar Widget -->
        <div class="single-widget-area cata-widget">
            <div class="widget-heading">
                <div class="line"></div>
                <h4>Categories</h4>
            </div>

            <ul>
                <?php 
                $var = array(
                    'orderby' => 'slug',
                    'parent' => 0,
                );
                $getCategories = get_categories($var);
                foreach($getCategories as $getCategory){
                    echo '<li><a href="'.get_category_link($getCategory->term_id).'">'.$getCategory->name.'</a></li>';
                    
                    // $getCategory->description;
                }
                ?>
                
            </ul>
        </div>

        

        <!-- Single Sidebar Widget -->
        <div class="single-widget-area cata-widget">
            <div class="widget-heading">
                <div class="line"></div>
                <h4>Archives</h4>
            </div>

            <ul>
                <?php 
                wp_get_archives(array('type' => 'monthly', 'limit' => 12, 'order' => 'ASC'));
                ?>
                
            </ul>
        </div>
        <?php dynamic_sidebar('unique-sidebar-id'); ?>
        <!-- Single Sidebar Widget -->
        <div class="single-widget-area tabs-widget">
            <div class="widget-heading">
                <div class="line"></div>
                <h4>Latest News</h4>
            </div>

            <div class="credit-tabs-content">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="tab--1" data-toggle="tab" href="#tab1" role="tab" aria-controls="tab1" aria-selected="false">Latest</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " id="tab--2" data-toggle="tab" href="#tab2" role="tab" aria-controls="tab2" aria-selected="false">Popular</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tab--3" data-toggle="tab" href="#tab3" role="tab" aria-controls="tab3" aria-selected="true">Comments</a>
                    </li>
                </ul>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab--1">
                        <div class="credit-tab-content">
                            <!-- Single News Area -->
                            <?php 
                            $argsLatest = array(
                                    'post_type' => 'post',
                                    'posts_per_page' => 10
                                );
                            $wpQuery = new WP_Query($argsLatest); 

                            while($wpQuery->have_posts()):
                                $wpQuery->the_post(); ?>
                                
                                <div class="single-news-area d-flex align-items-center">
                                    <div class="news-thumbnail">
                                        <?php the_post_thumbnail(); ?>
                                        <!-- <img src="img/bg-img/10.jpg" alt=""> -->
                                    </div>
                                    <div class="news-content">
                                        <span>July 18, 2018</span>
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        <div class="news-meta">
                                            <a href="#" class="post-author"><img src="img/core-img/pencil.png" alt=""> Jane Smith</a>
                                            <a href="#" class="post-date"><img src="img/core-img/calendar.png" alt=""> April 26</a>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            endwhile;
                            ?>

                            

                        </div>
                    </div>

                    <div class="tab-pane fade " id="tab2" role="tabpanel" aria-labelledby="tab--2">
                        <div class="credit-tab-content">
                            <!-- Single News Area -->
                            <div class="single-news-area d-flex align-items-center">
                                <div class="news-thumbnail">
                                    <img src="img/bg-img/10.jpg" alt="">
                                </div>
                                <div class="news-content">
                                    <span>July 18, 2018</span>
                                    <a href="#">How to get the best loan online</a>
                                    <div class="news-meta">
                                        <a href="#" class="post-author"><img src="img/core-img/pencil.png" alt=""> Jane Smith</a>
                                        <a href="#" class="post-date"><img src="img/core-img/calendar.png" alt=""> April 26</a>
                                    </div>
                                </div>
                            </div>

                            <!-- Single News Area -->
                            <div class="single-news-area d-flex align-items-center">
                                <div class="news-thumbnail">
                                    <img src="img/bg-img/11.jpg" alt="">
                                </div>
                                <div class="news-content">
                                    <span>July 18, 2018</span>
                                    <a href="#">A new way to finance your dream home</a>
                                    <div class="news-meta">
                                        <a href="#" class="post-author"><img src="img/core-img/pencil.png" alt=""> Jane Smith</a>
                                        <a href="#" class="post-date"><img src="img/core-img/calendar.png" alt=""> April 26</a>
                                    </div>
                                </div>
                            </div>

                            <!-- Single News Area -->
                            <div class="single-news-area d-flex align-items-center">
                                <div class="news-thumbnail">
                                    <img src="img/bg-img/12.jpg" alt="">
                                </div>
                                <div class="news-content">
                                    <span>July 18, 2018</span>
                                    <a href="#">10 tips to get the best loan for you</a>
                                    <div class="news-meta">
                                        <a href="#" class="post-author"><img src="img/core-img/pencil.png" alt=""> Jane Smith</a>
                                        <a href="#" class="post-date"><img src="img/core-img/calendar.png" alt=""> April 26</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab3" role="tabpanel" aria-labelledby="tab--3">
                        <div class="credit-tab-content">
                            <!-- Single News Area -->
                            <div class="single-news-area d-flex align-items-center">
                                <div class="news-thumbnail">
                                    <img src="img/bg-img/10.jpg" alt="">
                                </div>
                                <div class="news-content">
                                    <span>July 18, 2018</span>
                                    <a href="#">How to get the best loan online</a>
                                    <div class="news-meta">
                                        <a href="#" class="post-author"><img src="img/core-img/pencil.png" alt=""> Jane Smith</a>
                                        <a href="#" class="post-date"><img src="img/core-img/calendar.png" alt=""> April 26</a>
                                    </div>
                                </div>
                            </div>

                            <!-- Single News Area -->
                            <div class="single-news-area d-flex align-items-center">
                                <div class="news-thumbnail">
                                    <img src="img/bg-img/11.jpg" alt="">
                                </div>
                                <div class="news-content">
                                    <span>July 18, 2018</span>
                                    <a href="#">A new way to finance your dream home</a>
                                    <div class="news-meta">
                                        <a href="#" class="post-author"><img src="img/core-img/pencil.png" alt=""> Jane Smith</a>
                                        <a href="#" class="post-date"><img src="img/core-img/calendar.png" alt=""> April 26</a>
                                    </div>
                                </div>
                            </div>

                            <!-- Single News Area -->
                            <div class="single-news-area d-flex align-items-center">
                                <div class="news-thumbnail">
                                    <img src="img/bg-img/12.jpg" alt="">
                                </div>
                                <div class="news-content">
                                    <span>July 18, 2018</span>
                                    <a href="#">10 tips to get the best loan for you</a>
                                    <div class="news-meta">
                                        <a href="#" class="post-author"><img src="img/core-img/pencil.png" alt=""> Jane Smith</a>
                                        <a href="#" class="post-date"><img src="img/core-img/calendar.png" alt=""> April 26</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>