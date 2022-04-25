<div class="col-sm-12 col-md-12 col-lg-4">
    <div class="job my-4">
        <div class="job-item">
            <div class="photo-job">
            <?php $company_image = get_field( 'company_image' ); ?>
                <?php if ( $company_image ) { ?>
                     <span class="helper"></span>
                    <img src="<?php echo esc_url($company_image['url']); ?>" alt="<?php echo $company_image['alt']; ?>"  class="main-icon"/>
                <?php } ?>
            </div>
        </div>
        <div class="detail-job text-center">
                <h3 class="m-0"><a href="<?php echo get_field( 'url' ); ?>" target="_blank" >
                        <?php echo get_the_title(); ?>
                </a></h3>
                <span><?php echo get_field( 'url' ); ?></span>
                <p class="job-desc"><?php echo get_field( 'desc' ); ?></p>
        </div>
    </div>
</div>