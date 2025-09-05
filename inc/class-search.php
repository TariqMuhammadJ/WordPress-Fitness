<?php if(!class_exists('MainSearch')){
    class MainSearch{
        public function __construct(){
            add_filter('posts_clauses', [$this, 'only_include_search'], 10, 2);
            add_filter('pre_get_posts', [$this, 'include_posts'], 1);
            add_filter('posts_search', [$this, 'search_format'], 9,  2);
            add_filter('posts_request', function($sql){
                error_log("FINAL SEARCH SQL: " . $sql);
                return $sql;
            });

        }

       public function search_format($search, $wp_query){
        global $wpdb;

        if (!is_search()) {
            return $search;
        }

        $term = $wp_query->get('s');
        if (empty($term)) {
            return $search; // don’t break if no keyword
        }

        $like = '%' . $wpdb->esc_like($term) . '%';

        // Extend the default WHERE with tag/category matching
        $extra = $wpdb->prepare("
            OR {$wpdb->posts}.ID IN (
                SELECT tr.object_id
                FROM {$wpdb->term_relationships} tr
                INNER JOIN {$wpdb->term_taxonomy} tt ON tr.term_taxonomy_id = tt.term_taxonomy_id
                INNER JOIN {$wpdb->terms} t ON tt.term_id = t.term_id
                WHERE (tt.taxonomy = 'post_tag' OR tt.taxonomy = 'category')
                AND t.name LIKE %s
            )
        ", $like);

        // Append our extra condition
        if (!empty($search)) {
            $search = str_replace('))', ") $extra )", $search); 
        }

        return $search;
    }
         public function include_posts($query){
            if($query->is_search() && $query->is_main_query()){
                $query->set('post_type', 'post');
            }
            return $query;
        }

        
      
        public function only_include_search($clauses, $query){
            global $wpdb;

            if (!$query->is_main_query() || !$query->is_search()) {
                return $clauses;
            }

            $search_term = $query->get('s');
            if (empty($search_term)) {
                return $clauses;
            }

            $like = '%' . $wpdb->esc_like($search_term) . '%';

            $clauses['orderby'] = "
                (
                    (SELECT COUNT(*) FROM {$wpdb->term_relationships} tr
                    INNER JOIN {$wpdb->term_taxonomy} tt ON tr.term_taxonomy_id = tt.term_taxonomy_id
                    INNER JOIN {$wpdb->terms} t ON tt.term_id = t.term_id
                    WHERE tr.object_id = {$wpdb->posts}.ID
                    AND tt.taxonomy = 'post_tag'
                    AND t.name LIKE '{$like}')
                +
                    (SELECT COUNT(*) FROM {$wpdb->term_relationships} tr
                    INNER JOIN {$wpdb->term_taxonomy} tt ON tr.term_taxonomy_id = tt.term_taxonomy_id
                    INNER JOIN {$wpdb->terms} t ON tt.term_id = t.term_id
                    WHERE tr.object_id = {$wpdb->posts}.ID
                    AND tt.taxonomy = 'category'
                    AND t.name LIKE '{$like}')
                +
                    CASE WHEN {$wpdb->posts}.post_title LIKE '{$like}' THEN 1 ELSE 0 END
                +
                    CASE WHEN {$wpdb->posts}.post_content LIKE '{$like}' THEN 1 ELSE 0 END
                ) DESC,
                {$wpdb->posts}.post_date DESC
            ";

            error_log("Custom ORDER BY applied: " . $clauses['orderby']);

            return $clauses;
        }


    }

    new MainSearch();

    
}