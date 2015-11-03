<?php

namespace WordPress_Objects;

/**
 * Base class to represent a WordPress Attachment
 */
class Attachment extends Post {

	protected static $post_type = 'attachment';

	/**
	 * Get the URL to the attachment for a given size
	 *
	 * @param string $size
	 * @param array $args
	 * @return string|false
	 */
	 public function get_url( $size = 'full', $args = array() ) {
		$img_data = $this->get_src( $size, $args );
		if ( $img_data ) {
			return $img_data[0];
		} else {
			return false;
		}
	}

	/**
	 * Get the standard WP $src array, but potentially resized
	 *
	 * @param string $size
	 * @param array $args
	 * @return array|false
	 */
	private function get_src( $size, $args ) {
		$src = wp_get_attachment_image_src( $this->get_id(), $size );
		return $this->maybe_resize_image_src( $src, $args );
	}

	/**
	 * Get the HTML to represent this attachment
	 * Internalized version of wp_get_attachment_image() so we can use our ::get_src() method
	 *
	 * @return string
	 */
	public function get_html( $size = 'full', $args = array() ) {

		$image = $this->get_src( $size, $args );
		if ( ! $image ) {
			return '';
		}

		$html = '';
		list( $src, $width, $height ) = $image;
		// Supplied width and height should take priority
		if ( ! empty( $args['width'] ) ) {
			$width = (int) $args['width'];
		}
		if ( ! empty( $args['height'] ) ) {
			$height = (int) $args['height'];
		}

		$size_str = is_array( $size ) ? $size[0] . '-' . $size[1] : $size;

		$hwstring = image_hwstring( $width, $height );
		$default_attr = array(
			'src'	=> $src,
			'class'	=> "attachment-$size_str",
			'alt'	=> trim( strip_tags( $this->get_meta( '_wp_attachment_image_alt' ) ) ), // Use Alt field first
		);
		if ( empty($default_attr['alt']) )
			$default_attr['alt'] = trim( strip_tags( $this->get_caption() ) ); // If not, Use the Caption
		if ( empty($default_attr['alt']) )
			$default_attr['alt'] = trim( strip_tags( $this->get_title() ) ); // Finally, use the title

		$attr = wp_parse_args($args, $default_attr);

		$attr = apply_filters( 'wp_get_attachment_image_attributes', $attr, $this->post );
		$attr = array_map( 'esc_attr', $attr );
		$html = rtrim("<img $hwstring");
		foreach ( $attr as $name => $value ) {
			$html .= " $name=" . '"' . $value . '"';
		}
		$html .= ' />';

		return $html;
	}

	/**
	 * Get the caption for the attachment
	 *
	 * @return string
	 */
	public function get_caption() {
		return $this->get_field( 'post_excerpt' );
	}

	/**
	 * Get the credit for the attachment
	 *
	 * @return string
	 */
	public function get_credit() {
		$metadata = $this->get_metadata();
		if ( ! empty( $metadata['image_meta']['credit'] ) ) {
			return $metadata['image_meta']['credit'];
		} else {
			return '';
		}
	}

	/**
	 * Get attachment metadata
	 *
	 * @return array
	 */
	protected function get_metadata() {
		return wp_get_attachment_metadata( $this->get_id() );
	}


}
