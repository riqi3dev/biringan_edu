<?php
get_header();

while (have_posts()) {
    the_post(); ?>
    <!-- up until here, this will close the php and load the html code -->

    <div class="page-banner">
        <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/ocean.jpg') ?>)"></div>
        <div class="page-banner__content container container--narrow">
            <h1 class="page-banner__title"><?php the_title(); ?></h1>
            <div class="page-banner__intro">
                <p>Learn how the school of your dreams got started.</p>
            </div>
        </div>
    </div>

    <div class="container container--narrow page-section">
        <?php
        
        $parentId = wp_get_post_parent_id(get_the_ID());

        if ($parentId) { ?>
            <div class="metabox metabox--position-up metabox--with-home-link">
                <p>
                    <a class="metabox__blog-home-link" href="<?php echo get_permalink($parentId); ?>"><i class="fa fa-home" aria-hidden="true"></i> Back to <?php echo get_the_title($parentId); ?></a> <span class="metabox__main"><?php the_title(); ?></span>
                </p>
            </div>
        <?php } ?>

        <?php 
        // handles pages that is not a parent nor child page
        $permaLink = get_pages(array('child_of' => get_the_ID()));
        if ($parentId || $permaLink) { ?>

        <!-- if ($parentId) { ?> -->

        <div class="page-links">
            <h2 class="page-links__title"><a href="<?php echo get_permalink($parentId); ?>"><?php echo get_the_title($parentId); ?></a></h2>
            <ul class="min-list">
                <?php
                
                if ($parentId) {
                    $childId = $parentId;
                } else {
                    $childId = get_the_ID();
                }

                wp_list_pages(array(
                    'title_li' => null,
                    'child_of' => $childId,
                    'sort_column' => 'menu_order'
                )); ?>
            </ul>
        </div>

        <?php } ?>

        <div class="generic-content">
            <?php the_content(); ?>
        </div>
    </div>

    <!-- re-opening php here to load footer section in a page -->
<?php }
get_footer();
?>