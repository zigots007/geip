<?php 
function geip_load_assets() {
	wp_enqueue_style( 'geip-style', get_stylesheet_uri(), array(), null);
	wp_enqueue_style( 'geip-style-custom', get_template_directory_uri().'/assets/css/custom.css', array(), null);
	wp_enqueue_style( 'geip-style-responsive', get_template_directory_uri().'/assets/css/responsive.css', array(), null);
	wp_enqueue_style( 'geip-font-custom', "http://fonts.cdnfonts.com/css/futura-pt", array(), null);
}
add_action( 'wp_enqueue_scripts', 'geip_load_assets' );


function cb_company_cat(){
	$curr_cat = ( isset( $_GET['comp_cat'] ) ) ? sanitize_text_field( $_GET['comp_cat'] ) : '';
	$terms = get_terms( array(
		'taxonomy' => 'company_category',
		'hide_empty' => false,
	) );
	$renderOutput = "<select class=\"form-control\" id=\"comp_cat\" name=\"comp_cat\">";
		$renderOutput .= "<option value='' ".($curr_cat == "" ? 'selected' : '').">All Category</option>";
	foreach($terms as $t) {
		$renderOutput .= "<option value=".$t->slug." ".($curr_cat == $t->slug ? 'selected' : '').">".$t->name."</option>";
	}
	$renderOutput .= "<select>";
	echo $renderOutput;
}


function search_input($name){
	$curr_keyword = ( isset( $_GET['search_val'] ) ) ? sanitize_text_field( $_GET['search_val'] ) : '';
	echo '<input class="form-control" id="search_val" placeholder="Search here" name="'.esc_attr( $name ).'" value="'.$curr_keyword.'"/>';
}
function custom_part(){
	return file_get_contents(locate_template("_components/company_list_item.php"));
}

add_action('pre_get_posts', 'my_search_query'); 
//combine search by title and custom field 
function my_search_query($query) {
    if ($query->is_search() and $query->query_vars and $query->query_vars['s'] and $query->query_vars['s_meta_keys']) { // if we are searching using the 's' argument and added a 's_meta_keys' argument
        global $wpdb;
        $search = $query->query_vars['s']; // get the search string
        $ids = array(); // initiate array of martching post ids per searched keyword
        foreach (explode(' ',$search) as $term) { // explode keywords and look for matching results for each
            $term = trim($term); // remove unnecessary spaces
            if (!empty($term)) { // check the the keyword is not empty
                $query_posts = $wpdb->prepare("SELECT * FROM {$wpdb->posts} WHERE post_status='publish' AND ((post_title LIKE '%%%s%%') OR (post_content LIKE '%%%s%%'))", $term, $term); // search in title and content like the normal function does
                $ids_posts = [];
                $results = $wpdb->get_results($query_posts);
                if ($wpdb->last_error)
                    die($wpdb->last_error);
                foreach ($results as $result)
                    $ids_posts[] = $result->ID; // gather matching post ids
                $query_meta = [];
                foreach($query->query_vars['s_meta_keys'] as $meta_key) // now construct a search query the search in each desired meta key
                    $query_meta[] = $wpdb->prepare("meta_key='%s' AND meta_value LIKE '%%%s%%'", $meta_key, $term);
                $query_metas = $wpdb->prepare("SELECT * FROM {$wpdb->postmeta} WHERE ((".implode(') OR (',$query_meta)."))");
                $ids_metas = [];
                $results = $wpdb->get_results($query_metas);
                if ($wpdb->last_error)
                    die($wpdb->last_error);
                foreach ($results as $result)
                    $ids_metas[] = $result->post_id; // gather matching post ids
                $merged = array_merge($ids_posts,$ids_metas); // merge the title, content and meta ids resulting from both queries
                $unique = array_unique($merged); // remove duplicates
                if (!$unique)
                    $unique = array(0); // if no result, add a "0" id otherwise all posts wil lbe returned
                $ids[] = $unique; // add array of matching ids into the main array
            }
        }
        if (count($ids)>1)
            $intersected = call_user_func_array('array_intersect',$ids); // if several keywords keep only ids that are found in all keywords' matching arrays
        else
            $intersected = $ids[0]; // otherwise keep the single matching ids array
        $unique = array_unique($intersected); // remove duplicates
        if (!$unique)
            $unique = array(0); // if no result, add a "0" id otherwise all posts wil lbe returned
        unset($query->query_vars['s']); // unset normal search query
        $query->set('post__in',$unique); // add a filter by post id instead
    }
}


function custom_title( $title ) {
    add_theme_support( 'title-tag' );
}
add_action( 'after_setup_theme', 'custom_title' );
