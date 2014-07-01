<?php

namespace WordPress_Objects;

/**
 * Base User class
 */
class User {

	private $user;

	public function __construct( $user ) {

		if ( is_numeric( $user ) ) {
			$user = get_user_by( 'id', $user );
		}

		$this->user = $user;

	}

	/**
	 * Create a new user in the database
	 *
	 * @param string $user_login
	 * @return User|WP_Error
	 */
	public static function create( $user_login ) {

		$user_id = wp_insert_user( array( 'user_login' => $user_login, 'user_pass' => wp_generate_password() ) );
		if ( is_wp_error( $user_id ) ) {
			return $user_id;
		}

		return new User( $user_id );
	}

	/**
	 * Get the ID for the user
	 *
	 * @return int
	 */
	public function get_id() {
		return $this->get_field( 'ID' );
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
	 * Set the display name for the user
	 *
	 * @param string $display_name
	 */
	public function set_display_name( $display_name ) {
		$this->set_field( 'display_name', $display_name );
	}

	/**
	 * Get the first name for a user
	 *
	 * @return string
	 */
	public function get_first_name() {
		return $this->get_meta( 'first_name' );
	}

	/**
	 * Set the first name for the user
	 *
	 * @param string $first_name
	 */
	public function set_first_name( $first_name ) {
		$this->set_meta( 'first_name', $first_name );
	}

	/**
	 * Get the last name for a user
	 *
	 * @return string
	 */
	public function get_last_name() {
		return $this->get_meta( 'last_name' );
	}

	/**
	 * Set the last name for the user
	 *
	 * @param string $last_name
	 */
	public function set_last_name( $last_name ) {
		$this->set_meta( 'last_name', $last_name );
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
	 * Get the email address for the user
	 *
	 * @return string
	 */
	public function get_email() {
		return $this->get_field( 'user_email' );
	}

	/**
	 * Set the email address for the user
	 *
	 * @param string $email
	 */
	public function set_email( $email ) {
		$this->set_field( 'user_email', $email );
	}

	/**
	 * Get the avatar for the user
	 *
	 * @param int $size
	 * @return string
	 */
	public function get_avatar( $size ) {
		return get_avatar( $this->get_id(), $size );
	}

	/**
	 * Get the description for the user
	 *
	 * @return string
	 */
	public function get_description() {
		return $this->get_meta( 'description' );
	}

	/**
	 * Set the description for the user
	 *
	 * @param string
	 */
	public function set_description( $description ) {
		$this->set_meta( 'description', $description );
	}

	/**
	 * Get a user's field
	 *
	 * @param string $key
	 * @return mixed
	 */
	protected function get_field( $key ) {
		return $this->user->$key;
	}

	/**
	 * Set a field for a user
	 *
	 * @param string $key
	 * @param mixed $value
	 */
	protected function set_field( $key, $value ) {
		global $wpdb;

		$wpdb->update( $wpdb->users, array( $key => $value ), array( 'ID' => $this->get_id() ) );
		clean_user_cache( $this->get_id() );

		$this->user = get_user_by( 'id', $this->get_id() );
	}

	/**
	 * Get a meta value for a user
	 *
	 * @param string
	 * @return mixed
	 */
	protected function get_meta( $key ) {
		return get_user_meta( $this->get_id(), $key, true );
	}

	/**
	 * Set a meta value for a user
	 *
	 * @param string $key
	 * @param mixed $value
	 */
	protected function set_meta( $key, $value ) {
		update_user_meta( $this->get_id(), $key, $value );
	}

}
