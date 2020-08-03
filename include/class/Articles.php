<?php

/**
 * Retrieve posts infoRMQation from database 
 * Calculate median, arithmetic and geometric average 
 *
 * @author Alessandro Giaquinto
 */

define('ALL', -1);

final class Articles {
    private $posts = array();          // Published Posts
    private $current_length_posts = 0; // Number of displayed post
    private $physical_length_posts = 0;// Number of all published posts
    private $draft_post = 0;           // Number of drafted posts
    
    private $authors = array();        // Authors of the posts
    private $length_autors = 0;        // Number of authors
    private $author_posts = array();   // Number of post from a specific author 
    
    private $days = array();           // Distance, in days, of a post from the previous
    private $length_days = 0;          // Number of distance days
    private $delta_day = 0;            // The max distance, in days, of a post from the previous
    private $sum_days = 0;             // Sum of all days;
    private $arith_avg = 0.0;          // Arithmetic average of all days
    private $geom_avg = 1.0;           // Geometric average of all days
    
    private $categories = array();     // Categories
    private $categories_lentgh = 0.0;  // Num of categories
    private $category_avg = array();   // Weight of the categories 
    
    public $cat_max_id = array();
    private $cat_max_value = 0;
    
    
    private $arithmetic = array();     // The arithmetic weight evaluated step by step
    private $geometric = array();      // The geometric weight evaluated step by step
    private $median_array = array();   // The median array
    private $median_value = 0.0;       // The median value
    
    private $Q;
    
    public function __construct() {
        global $wpdb;
        $this->Q = $wpdb;
        $this->init();
    }
    
    protected function init(){
        $t = wp_count_posts();
        $this->physical_length_posts = (int)$t->publish ;
        $this->current_length_posts = RMQ_get_articles_lentgh($this->Q);
        $this->posts = get_posts( array('posts_per_page' => (int)$this->physical_length_posts, 'offset' => 0) );
        $this->draft_post = (int)$t->draft;
        $this->authors = RMQ_get_authors($this->Q);
        $this->length_autors = count($this->authors);
        
        foreach ($this->authors as $author) {
            $t = count_user_posts( $author->post_author, 'post', true);
            array_push($this->author_posts, ['displayed_name' => $author->display_name, 'counted' => $t, 'weight' => ($t/$this->physical_length_posts)*100 ]);
        }
                
        foreach ($this->posts as $post) {
            if ($this->length_days < $this->physical_length_posts -1 ){
                $this->length_days = $this->length_days+1;
            }
            $t = (int)$this->dateDifference( $post->post_date, ($this->posts[$this->length_days])->post_date );
            if ( $t == 0){
                $t = 1;
            }
            $this->sum_days = $this->sum_days + $t;
            $this->geom_avg = $this->geom_avg * $t;
            array_push( $this->days, $t );
            array_push( $this->arithmetic, $this->sum_days/$this->current_length_posts );
            array_push( $this->geometric, $this->geom_avg**(1/$this->current_length_posts) );
        }
        
        $this->arith_avg = $this->sum_days/$this->physical_length_posts;
        $this->geom_avg = $this->geom_avg**( 1/$this->physical_length_posts );
        $this->delta_day = RMQ_get_articles_delta_day($this->Q);
        
        $this->median_array = merge_sort($this->days);

        if( ($this->physical_length_posts)%2 ){
            $this->median_value = $this->median_array[($this->physical_length_posts)/2];
        } else {
            $this->median_value = ( $this->median_array[($this->physical_length_posts)/2] + $this->median_array[( ( $this->physical_length_posts)/2 ) + 1 ] )/2;
        }
        
        $this->categories = get_categories();
        $this->categories_lentgh = count($this->categories);
        
        foreach ($this->categories as $cat){
            array_push($this->category_avg, ['name' => $cat->name, 'counted' => $cat->category_count, 'weight' => ( ($cat->category_count/$this->physical_length_posts)*100 ) ]);
            if ( $cat->category_count > $this->cat_max_value){
                $this->cat_max_value = $cat->category_count;
            }
        }
        
    }
    
    public function getPosts(int $index=-1){
        if ( $index < 0 ){
            return array_slice($this->posts, 0, $this->current_length_posts);
        } else {
            return $this->posts[$index];
        }
    }
    
    public function getPostsTitle(int $index=-1){
        if ( $index < 0 ){
            return false;
        } else {
            return $this->posts[$index]->post_title;
        }
    }
    
    public function getPostsDate(int $index=-1){
        if ( $index < 0 ){
            return false;
        } else {
            return $this->posts[$index]->post_date;
        }
    }
    
    public function getPostsID(int $index=-1){
        if ( $index < 0 ){
            return false;
        } else {
            return $this->posts[$index]->ID;
        }
    }
    
    public function getPostsGuid(int $index=-1){
        if ( $index < 0 ){
            return false;
        } else {
            return $this->posts[$index]->guid;
        }
    }
    
    public function getPostsAuthor(int $index=-1){
        if ( $index < 0 ){
            return false;
        } else {
            return $this->posts[$index]->post_author;
        }
    }
    
    public function getLastestPost(){
        return $this->posts[0];
    }
    
    public function getDaysLastestPost(){
        return $this->dateDifference( ($this->posts[0])->post_date, 'now');
    }
    
    public function getLastestPostTitle(){
        return $this->posts[0]->post_title;
    }
    
    public function getLastestPostGuid(){
        return $this->posts[0]->post_guid;
    }
    
    public function getLastestPostDate(){
        return $this->posts[0]->post_date;
    }
    
    public function getLastestPostID(){
        return $this->posts[0]->ID;
    }
    
    public function getLastestPostAuthor(){
        return $this->posts[0]->post_author;
    }
    
    public function getCurrentLengthPosts(){
        return $this->current_length_posts;
    }
    
    public function getMaxLengthPosts(){
        return $this->physical_length_posts;
    }
    
    public function getNumOfPublishedPosts(){
        return $this->physical_length_posts;
    }
    
    public function getNumOfDraftPosts(){
        return $this->draft_post;
    }
    
    public function getDays(int $index=-1){
        if ($index < 0){
            return $this->days;
        } else {
            return $this->days[$index];
        }
    }
    
    public function getDeltaDay(){
        return $this->delta_day;
    }
    
    public function getAuthors() {
        return $this->authors;
    }
    
    public function getNumOfAuthors() {
        return $this->length_autors;
    }
    
    public function getAuthorPosts(int $index=-1){
        if ($index < 0){
            return $this->author_posts;
        } else {
            return $this->author_posts[$index];
        }
    }
    
    public function getCategories(int $index=-1) {
        if ($index < 0){
            return $this->categories;
        } else {
            return $this->categories[$index];
        }   
    }
    
    public function getNumOfCategories(){
        return $this->categories_lentgh;
    }
    
    public function getCategoriesAvg(int $index=-1) {
        if ($index < 0){
            return $this->category_avg;
        } else {
            return $this->category_avg[$index];
        }   
    }
    
    
    public function getSumDays(){
        return $this->sum_days;
    }
    
    public function getArithmeticAverage() {
        return $this->arith_avg;
    }
    
    public function getGeometricAverage(){
        return $this->geom_avg;
    }
    
    public function getArithmetic($all_value = false){
        if ( $all_value ){
            return $this->arithmetic;
        } else  {
            return $this->arithmetic[$this->current_length_posts];
        }
    }

    public function getGeometric($all_value = false){
        if ( $all_value ){
            return $this->geometric;
        } else  {
            return $this->geometric[$this->current_length_posts];
        }
    }
    
    public function getMedian() {
        return $this->median_value;
    }
    
    public function getMedianArray(){
        return $this->median_array;
    }
    
    public function getWorstDay(){
        return $this->median_array[$this->physical_length_posts - 1];
    }
    
    public function getBestDay(){
        return $this->median_array[0];
    }

    public function setLengthPosts($new_value){
        if ( $new_value > $this->physical_length_posts || $new_value < 10){
            return false;
        } else {
            $this->current_length_posts = $new_value;
            RMQ_update_articles_lentgh($this->Q, $new_value);
        }
    }
    
    public function setDeltaDays($new_value){
        if ( $new_value < 1){
            return false;
        } else {
            $this->delta_day = $new_value;
            RMQ_update_articles_lentgh($this->Q, $new_value);
        }
    }
    
    public function dateDifference($date_1, $date_2, $differenceFoRMQat = '%a' ){
        $interval = date_diff( date_create($date_1), date_create($date_2) );
        return $interval->format($differenceFoRMQat);
    }
    
    public function searchAuthorById($id){
        foreach ($this->authors as $author) {
            if ($author->post_author == $id){
                return $author->display_name;
            }
        }
    }
}

