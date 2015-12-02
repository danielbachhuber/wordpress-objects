<?php

namespace WordPress_Objects;

/**
 * Base class to represent a WordPress Post
 */
class Post {

	protected $post;

	protected static $post_type = 'post';

	public function __construct( $post ) {

		if ( is_numeric( $post ) ) {
			$post = get_post( $post );
		}

		$this->post = $post;
	}

	/**
	 * Get the ID for the post
	 *
	 * @return int
	 */
	public function get_id() {
		return (int) $this->get_field( 'ID' );
	}

	/**
	 * Get the title for the post
	 *
	 * @return string
	 */
	public function get_title() {
		return $this->get_field( 'post_title' );
	}

	/**
	 * Print the title for the post
	 */
	public function the_title() {
		echo apply_filters( 'the_title', $this->get_title() );
	}

	/**
	 * Set the title of the post
	 *
	 * @param string
	 */
	public function set_title( $title ) {
		$this->set_field( 'post_title', $title );
	}

	/**
	 * Get the slug for the post
	 *
	 * @return string
	 */
	public function get_slug() {
		return $this->get_field( 'post_name' );
	}

	/**
	 * Set the slug of the post
	 *
	 * @param string
	 */
	public function set_slug( $slug ) {
		$this->set_field( 'post_name', $slug );
	}

	/**
	 * Get the status for the post
	 *
	 * @return string
	 */
	public function get_status() {
		return $this->get_field( 'post_status' );
	}

	/**
	 * Set the slug of the post
	 *
	 * @param string
	 */
	public function set_status( $status ) {
		$this->set_field( 'post_status', $status );
	}

	/**
	 * Get the excerpt for the post
	 *
	 * @return string
	 */
	public function get_excerpt() {
		return $this->get_field( 'post_excerpt' );
	}

	/**
	 * Print the excerpt for the post
	 */
	public function the_excerpt() {
		echo apply_filters( 'the_excerpt', $this->get_excerpt() );
	}

	/**
	 * Set the excerpt for the post
	 *
	 * @param string $excerpt
	 */
	public function set_excerpt( $excerpt ) {
		$this->set_field( 'post_excerpt', $excerpt );
	}

	/**
	 * Get the content for the post
	 *
	 * @return string
	 */
	public function get_content() {
		return $this->get_field( 'post_content' );
	}

	/**
	 * Print the content for the post
	 */
	public function the_content() {
		echo apply_filters( 'the_content', $this->get_content() );
	}

	/**
	 * Set the content for the post
	 *
	 * @param string $content
	 */
	public function set_content( $content ) {
		$this->set_field( 'post_content', $content );
	}

	/**
	 * Get the author for the post
	 *
	 * @return User
	 */
	public function get_author() {
		return new User( $this->get_field( 'post_author' ) );
	}

	/**
	 * Set the author for this post
	 *
	 * @param mixed
	 */
	public function set_author( $author ) {

		if ( is_numeric( $author ) ) {
			$author = new User( $author );
		}

		$this->set_field( 'post_author', $author->get_id() );
	}

	/**
	 * Get the permalink for the post
	 *
	 * @return string
	 */
	public function get_permalink() {
		return get_permalink( $this->get_id() );
	}

	/**
	 * Print the permalink for the post
	 */
	public function the_permalink() {
		echo apply_filters( 'the_permalink', $this->get_permalink() );
	}

	/**
	 * Get the post date for the post
	 *
	 * @return string
	 */
	public function get_date() {
		return $this->get_field( 'post_date' );
	}

	/**
	 * Set the post date for the post
	 *
	 * @param string
	 */
	public function set_date( $post_date ) {
		$this->set_field( 'post_date', date( 'Y-m-d H:i:s', strtotime( $post_date ) ) );
	}

	/**
	 * Get the post date gmt for the post
	 *
	 * @return string
	 */
	public function get_date_gmt() {
		return $this->get_field( 'post_date_gmt' );
	}

	/**
	 * Set the post date gmt for the post
	 *
	 * @param string
	 */
	public function set_date_gmt( $post_date_gmt ) {
		$this->set_field( 'post_date_gmt', date( 'Y-m-d H:i:s', strtotime( $post_date_gmt ) ) );
	}

	/**
	 * Get the post modified date for the post
	 *
	 * @return string
	 */
	public function get_modified() {
		return $this->get_field( 'post_modified' );
	}

	/**
	 * Set the post modified for the post
	 *
	 * @param string
	 */
	public function set_modified( $post_modified ) {
		$this->set_field( 'post_modified', date( 'Y-m-d H:i:s', strtotime( $post_modified ) ) );
	}

	/**
	 * Get the post modified date for the post
	 *
	 * @return string
	 */
	public function get_modified_gmt() {
		return $this->get_field( 'post_modified_gmt' );
	}

	/**
	 * Set the post modified gmt for the post
	 *
	 * @param string
	 */
	public function set_modified_gmt( $post_modified_gmt ) {
		$this->set_field( 'post_modified_gmt', date( 'Y-m-d H:i:s', strtotime( $post_modified_gmt ) ) );
	}

	/**
	 * Get the parent id for the post
	 *
	 * @return string
	 */
	public function get_parent_id() {
		return (int) $this->get_field( 'post_parent' );
	}

	/**
	 * Set the parent id of the post
	 *
	 * @param int
	 */
	public function set_parent_id( $parent_id ) {
		$this->set_field( 'post_parent', $parent_id );
	}

	/**
	 * Get the type of post
	 *
	 * @return string
	 */
	public function get_type() {
		return $this->post->post_type;
	}

	/**
	 * Get the featured image ID for the post
	 *
	 * @return int|false
	 */
	public function get_featured_image_id() {
		return (int) $this->get_meta( '_thumbnail_id' );
	}

	/**
	 * Set the featured image for the post
	 *
	 * @param int $featured_image_id
	 */
	public function set_featured_image_id( $featured_image_id ) {
		$this->set_meta( '_thumbnail_id', (int) $featured_image_id );
	}

	/**
	 * Get the featured image url for the given featured image id
	 *
	 * @param string $size
	 * @return string|false
	 */
	 public function get_featured_image_url( $size = 'full' ) {

		$attachment_id = $this->get_featured_image_id();
		if ( ! $attachment_id ) {
			return false;
		}
		$src = wp_get_attachment_image_src( $attachment_id, $size );
		if ( ! $src ) {
			return false;
		}

		return $src[0];
	}

	/**
	 * Get the categories of the post
	 *
	 * @return array
	 */
	public function get_categories() {
		return $this->get_taxonomy_terms( 'category' );
	}

	/**
	 * Set the categories for the post
	 *
	 * @param
	 */
	public function set_categories( $categories ) {
		$this->set_taxonomy_terms( 'category', $categories );
	}

	/**
	 * Get the tags of the post
	 *
	 * @return array
	 */
	public function get_tags() {
		return $this->get_taxonomy_terms( 'post_tag' );
	}

	/**
	 * Set the tags for the post
	 *
	 * @param
	 */
	public function set_tags( $tags ) {
		$this->set_taxonomy_terms( 'post_tag', $tags );
	}

	/**
	 * Create a new instance
	 *
	 * @return Post|false
	 */
	public static function create( $args = array() ) {

		$defaults = array(
			'post_type'     => static::$post_type,
			'post_status'   => 'draft',
			'post_author'   => get_current_user_id(),
			);
		$args = array_merge( $defaults, $args );
		add_filter( 'wp_insert_post_empty_content', '__return_false' );
		$post_id = wp_insert_post( $args );
		remove_filter( 'wp_insert_post_empty_content', '__return_false' );
		if ( ! $post_id ) {
			return false;
		}

		$class = get_called_class();

		return new $class( $post_id );
	}

	/**
	 * Get a field from the post object
	 *
	 * @param string $key
	 * @return mixed
	 */
	protected function get_field( $key ) {
		return $this->post->$key;
	}

	/**
	 * Set a field for the post object
	 *
	 * @param string $key
	 * @param mixed $value
	 */
	protected function set_field( $key, $value ) {
		global $wpdb;

		$wpdb->update( $wpdb->posts, array( $key => $value ), array( 'ID' => $this->get_id() ) );
		clean_post_cache( $this->get_id() );
		$this->post = get_post( $this->get_id() );
	}

	/**
	 * Get a meta value for a post
	 *
	 * @param string
	 * @return mixed
	 */
	protected function get_meta( $key ) {
		return get_post_meta( $this->get_id(), $key, true );
	}

	/**
	 * Set a meta value for a post
	 *
	 * @param string $key
	 * @param mixed $value
	 */
	protected function set_meta( $key, $value ) {
		update_post_meta( $this->get_id(), $key, $value );
	}

	/**
	 * Get the taxonomy terms for a post
	 *
	 * @param string $taxonomy
	 * @return array
	 */
	protected function get_taxonomy_terms( $taxonomy ) {

		$terms = get_the_terms( $this->get_id(), $taxonomy );
		if ( $terms && ! is_wp_error( $terms ) ) {
			return $terms;
		} else {
			return array();
		}

	}

	/**
	 * Set taxonomy terms for a post
	 *
	 * @param string $taxonomy
	 * @param array $terms Array of term names or term objects
	 */
	protected function set_taxonomy_terms( $taxonomy, $terms ) {

		if ( ! is_array( $terms ) ) {
			return false;
		}

		// Maybe this was an array of objects
		$first_term = $terms[0];
		if ( is_object( $first_term ) ) {
			$terms = wp_list_pluck( $terms, 'name' );
		}

		// Terms need to exist in order to use wp_set_object_terms(), sadly
		foreach( $terms as $term ) {
			if ( ! get_term_by( 'name', $term, $taxonomy ) ) {
				wp_insert_term( $term, $taxonomy );
			}
		}

		wp_set_object_terms( $this->get_id(), array_map( 'sanitize_title', $terms ), $taxonomy );
	}

}
