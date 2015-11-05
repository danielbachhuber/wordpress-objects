<?php

namespace WordPress_Objects;

abstract class Author {

	/**
	 * Get the ID for the Author
	 *
	 * @return int
	 */
	abstract public function get_id();

	/**
	 * Get the display name for an Author
	 *
	 * @return string
	 */
	abstract public function get_display_name();

	/**
	 * Get the first name for a Author
	 *
	 * @return string
	 */
	abstract public function get_first_name();

	/**
	 * Get the last name for a Author
	 *
	 * @return string
	 */
	abstract public function get_last_name();

	/**
	 * Get the user login value for the Author
	 *
	 * @return string
	 */
	abstract public function get_user_login();

	/**
	 * Get the user nicename value for the Author
	 */
	abstract public function get_user_nicename();

	/**
	 * Get the email address for the Author
	 *
	 * @return string
	 */
	abstract public function get_email();

	/**
	 * Get the Author's permalink
	 *
	 * @return string
	 */
	abstract public function get_permalink();

	/**
	 * Get the Author's feed link
	 *
	 * @return string
	 */
	abstract public function get_feed_link();

	/**
	 * Get the avatar for the Author
	 *
	 * @param array|int $size
	 * @return string
	 */
	abstract public function get_avatar( $size );

	/**
	 * Get the description for the Author
	 *
	 * @return string
	 */
	abstract public function get_description();

}
