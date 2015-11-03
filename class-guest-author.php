<?php

namespace WordPress_Objects;

class Guest_Author extends Author {

	public function __construct( $guest_author ) {
		$this->guest_author = $guest_author;
	}

	/**
	 * Get the type
	 * @return string
	 */
	public function get_type() {
		return 'guest-author';
	}


	/**
	 * Get the ID for the user
	 *
	 * @return int
	 */
	public function get_id() {
		return (int) $this->get_field( 'ID' );
	}

	/**
	 * Get the display name for a user
	 *
	 * @return string
	 */
	public function get_display_name() {
		return $this->get_field( 'display_name' );
	}

	/**
	 * Get the first name for a user
	 *
	 * @return string
	 */
	public function get_first_name() {
		return $this->guest_author->first_name;
	}

	/**
	 * Get the last name for a user
	 *
	 * @return string
	 */
	public function get_last_name() {
		return $this->guest_author->last_name;
	}

	/**
	 * Get the user login value for the user
	 *
	 * @return string
	 */
	public function get_user_login() {
		return $this->get_field( 'user_login' );
	}

	/**
	 * Get the user nicename value for the user
	 *
	 * @return string
	 */
	public function get_user_nicename() {
		return $this->get_field( 'user_nicename' );
	}

	/**
	 * Get the email address for the user
	 *
	 * @return string
	 */
	public function get_email() {
		return $this->get_field( 'user_email' );
	}

	/**
	 * Get the user's permalink
	 *
	 * @return string
	 */
	public function get_permalink() {
		return get_author_posts_url( $this->get_id(), $this->get_field( 'user_nicename') );
	}

	/**
	 * Get the Author's feed link
	 *
	 * @return string
	 */
	public function get_feed_link() {
		$url = get_author_posts_url( $this->get_id(), $this->get_field( 'user_nicename') );
		return trailingslashit( $url ) . 'feed/';
	}

	/**
	 * Get the avatar for the user
	 *
	 * @param array|int $size
	 * @return string
	 */
	public function get_avatar( $size ) {

		$thumbnail_id = $this->get_meta( '_thumbnail_id' );
		if ( $thumbnail_id && $attachment = Attachment::get_by_post_id( $thumbnail_id ) ) {
			if ( ! is_array( $size ) ) {
				$size = array( $size, $size );
			}
			$args = array(
				'class'       => 'avatar photo avatar-' . (int) $size[0],
				'width'       => $size[0],
				'height'      => $size[1],
			);
			$args['max']         = $args['width'] * 2;
			$args['breakpoints'] = array( $args['width'], $args['max'] );
			$args['sizes']       = implode( ', ', array(
				'(min-device-resolution: 1.6) ' . $args['max'] . 'px',
				$args['width'] . 'px',
			) );
			
			return $attachment->get_html( 'full', $args ) ;
		}
	}

	/**
	 * Get the description for the user
	 *
	 * @return string
	 */
	public function get_description() {
		return $this->guest_author->description;
	}

	/**
	 * Get a user's field
	 *
	 * @param string $key
	 * @return mixed
	 */
	protected function get_field( $key ) {
		return $this->guest_author->$key;
	}

	/**
	 * Get a meta value for a guest author post
	 *
	 * @param string
	 * @return mixed
	 */
	protected function get_meta( $key ) {
		return get_post_meta( $this->get_id(), $key, true );
	}

	/**
	 * Set a meta value for a guest author post
	 *
	 * @param string $key
	 * @param mixed $value
	 */
	protected function set_meta( $key, $value ) {
		update_post_meta( $this->get_id(), $key, $value );
	}

}
