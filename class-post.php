<?php

namespace WordPress_Objects;

/**
 * Base class to represent a WordPress Post
 */
class Post {

	private $post;

	private static $post_type = 'post';

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
		return $this->get_field( 'ID' );
	}

	/**
	 * Get the title for the post
	 *
	 * @return string
	 */
	public function get_title() {
		return apply_filters( 'the_title', $this->get_field( 'post_title' ) );
	}

	/**
	 * Get the excerpt for the post
	 *
	 * @return string
	 */
	public function get_excerpt() {
		return apply_filters( 'the_excerpt', $this->get_field( 'post_excerpt' ) );
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
		return apply_filters( 'the_content', $this->get_field( 'post_content' ) );
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
	* Get the permalink for the post
	*
	* @return string
	*/
	public function get_permalink() {
		return apply_filters( 'the_permalink', get_permalink( $this->get_id() ) );
	}

	/**
	 * Create a new instance
	 *
	 * @return Post|false
	 */
	public static function create( $args = array() ) {

		$defaults = array(
			'post_type'     => self::$post_type,
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


}
