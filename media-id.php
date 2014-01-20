<?php
/*
Plugin Name: Media ID
Plugin URI: http://horttcore.de
Description: Add a media id column on the media overview screen
Version: 1.2
Author: Ralf Hortt
Author URI: http://horttcore.de
License: GPL2
*/


/**
* Media ID
*/
class MEDIA_ID
{



	/**
	 * Constructor
	 *
	 * @access public
	 * @since v1.0
	 * @author Ralf Hortt
	 */
	public function __construct()
	{

		add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
		add_filter( 'manage_media_columns', array( $this, 'manage_media_columns' ) );
		add_action( 'manage_media_custom_column', array( $this, 'manage_media_custom_column' ), 10, 2 );
		add_action( 'plugins_loaded', array( $this, 'load_plugin_textdomain' ) );

	} // end __construct



	/**
	 * Add meta boxes
	 *
	 * @access public
	 * @since v1.0
	 * @author Ralf Hortt
	 */
	public function add_meta_boxes()
	{

		add_meta_box( 'media-id', __( 'ID', 'media-id' ), array( $this, 'meta_box_media_id' ), 'attachment', 'side' );

	} // end add_meta_boxes



	/**
	 * Load plugin textdomain
	 *
	 * @access public
	 * @since v1.0
	 * @author Ralf Hortt
	 */
	public function load_plugin_textdomain()
	{

		#load_plugin_textdomain( 'media-id', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

	} // end load_plugin_textdomain



	/**
	 * Add column
	 *
	 * @access public
	 * @param array $columns Columns
	 * @return array Columns
	 * @since v1.0
	 * @author Ralf Hortt
	 */
	public function manage_media_columns( array $columns )
	{

		$columns['media-id']  = __( 'ID', 'media-id' );
		return $columns;

	} // end manage_media_columns



	/**
	 * Populate custom columns
	 *
	 * @access public
	 * @param str $column Column
	 * @param int $post_id Post ID
	 * @since v1.0
	 * @author Ralf Hortt
	 */
	public function manage_media_custom_column( $column, $post_id )
	{

		global $post;

		switch( $column ) :

			case 'media-id' :
				echo apply_filters( 'column-media-id', $post_id );
			break;

		endswitch;

	} // end manage_media_custom_column



	/**
	 * Meta box media id
	 *
	 * @access public
	 * @param obj $post Post object
	 * @since v1.0
	 * @author Ralf Hortt
	 */
	public function meta_box_media_id( $post )
	{

		do_action( 'media-id-meta-box-before' );

		echo apply_filters( 'media-id-meta-box', sprintf( __( 'The media ID is: %d', 'media-id' ), apply_filters( 'meta-box-media-id', $post->ID, $post ) ), $post );

		do_action( 'media-id-meta-box-after' );

	} // end meta_box_media_id



}

new MEDIA_ID;
