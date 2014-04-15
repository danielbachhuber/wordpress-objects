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
	 * Get the user login value for the user
	 *
	 * @return string
	 */
	public function get_user_login() {
		return $this->get_field( 'user_login' );
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
	 * Get a user's field
	 *
	 * @param string $key
	 * @return mixed
	 */
	protected function get_field( $key ) {
		return $this->user->$key;
	}

}
