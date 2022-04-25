<?php 
	get_header();
?>
			<?php 
				$curr_cat = ( isset( $_GET['comp_cat'] ) ) ? sanitize_text_field( $_GET['comp_cat'] ) : '';
				$curr_keyword = ( isset( $_GET['search_val'] ) ) ? sanitize_text_field( $_GET['search_val'] ) : '';
			
				if ( get_query_var('paged') ) { // !is_front_page()
						$paged = get_query_var('paged');
				} elseif ( get_query_var('page') ) { //is_front_page() only
						$paged = get_query_var('page');
				} else {
						$paged = 1;
				}

				//args for specific custom post type
				$args = array(  
					'post_type' => 'company',
					'post_status' => 'publish',
					'posts_per_page' => 9, 
					'orderby' => 'id', 
					'order' => 'ASC',
					'paged' => $paged
				);

				//add custom filter for custom field and taxonomy
				if($curr_cat){
					$args['tax_query'] = array(
						array(
							'taxonomy' => 'company_category',
							'field' => 'slug',
							'terms' => $curr_cat,
						)
					);
				}
				if($curr_keyword){
					$args['s'] = $curr_keyword;
					$args['s_meta_keys'] = array('desc','url');
				}
				$loop = new WP_Query( $args ); 
				$btn_filter = ($loop->have_posts() ? 'Filter' : 'Reset');
			?>
      <section class="container">
        <div class="content_title_section">
          <div class="main-content text-center">
            <h1><?php echo get_the_title();?></h1>
            <div class="desc"><?php echo get_the_content();?></div>
          </div>
					<div class="company-filter">
						<form class="form-inline" action="<?php echo get_site_url();?>">
							<div class="form-group mb-2">
								<label for="comp_cat" class="sr-only">Email</label>
								<?php cb_company_cat();?>
							</div>
							<div class="form-group mx-sm-3 mb-2">
								<label for="search_val" class="sr-only">Keywords</label>
								<?php _e(search_input("search_val"));?>
							</div>
							<?php 
							if($loop->have_posts()){ 
								echo '<button type="submit" class="btn btn-purple mb-2">'.esc_attr($btn_filter).'</button>';
							}else{
								echo '<a href="'.get_site_url().'" class="btn btn-purple mb-2">'.esc_attr($btn_filter).'</a>';
							} ?>
						</form>
					</div>
          <div class="job_list">
            <div class="row">
						<?php 
									if ($loop->have_posts()) {
									while ( $loop->have_posts() ) : $loop->the_post(); 
										include('_components/company_list_item.php');
									endwhile; ?>   
									<div class="d-flex justify-content-center mt-5">  
										<?php 
											$big = 999999;
											$total_pages = $loop->max_num_pages;
											if ($total_pages > 1){
												$current_page = max(1, get_query_var('page'));
												echo paginate_links(array(
														'base' => str_replace( $big, '%#%', get_pagenum_link( $big, false ) ),
														'format' => 'page/%#%',
														'current' => $current_page,
														'total' => $total_pages,
														'prev_text'    => '',
														'next_text'    => '',
												));
											}

										?>
									</div>
                	<?php wp_reset_query(); ?>

									<?php 
									} else {
										include('_components/nodata.php');
									}
									?>
								
								
            </div>
          </div>
        </div>
      </section>
    </main>
  
<?php get_footer();?>