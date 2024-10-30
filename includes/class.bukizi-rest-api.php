<?php
namespace BukiziRegistration;

if ( ! defined( 'ABSPATH' ) ) exit;

class Bukizi_RestApi {

    protected static $instance = null;
    
	private function __construct() {
		$this->plugin_slug = 'bukizi-register';
    }
    
    public function bukizi_do_hooks() {
        add_action( 'rest_api_init', array( $this, 'bukizi_register_routes' ) );
    }

	public static function bukizi_get_instance() {

		if ( null == self::$instance ) {
			self::$instance = new self;
			self::$instance->bukizi_do_hooks();
		}

		return self::$instance;
	}

    public function bukizi_register_routes() {
        $user_id = get_current_user_id();
        $version = '1';
        $namespace = $this->plugin_slug . '/v' . $version;
        $endpoint = '/admin/';

        register_rest_route( $namespace, $endpoint, array(
            array(
                'methods'               => \WP_REST_Server::READABLE,
                'callback'              => array( $this, 'bukizi_get_api_key' ),
                'permission_callback'   => array( $this, 'bukizi_admin_permissions_check' ),
            ),
        ) );

        register_rest_route( $namespace, $endpoint, array(
            array(
                'methods'               => \WP_REST_Server::CREATABLE,
                'callback'              => array( $this, 'bukizi_update_api_key' ),
                'permission_callback'   => array( $this, 'bukizi_admin_permissions_check' ),
                'args'                  => array(
                    'api_key' => array(
                        'required' => true,
                        'type' => 'string',
                        'description' => 'The user\'s api_key address',
                        'format' => 'string'
                    ),
                ),
            ),
        ) );

        register_rest_route( $namespace, $endpoint, array(
            array(
                'methods'               => \WP_REST_Server::EDITABLE,
                'callback'              => array( $this, 'bukizi_update_api_key' ),
                'permission_callback'   => array( $this, 'bukizi_admin_permissions_check' ),
                'args'                  => array(
                    'api_key' => array(
                        'required' => true,
                        'type' => 'string',
                        'description' => 'The user\'s api_key address',
                        'format' => 'string'
                    ),
                ),
            ),
        ) );

        register_rest_route( $namespace, $endpoint, array(
            array(
                'methods'               => \WP_REST_Server::DELETABLE,
                'callback'              => array( $this, 'bukizi_delete_api_key' ),
                'permission_callback'   => array( $this, 'bukizi_admin_permissions_check' ),
                'args'                  => array(),
            ),
        ) );

    }

    public function bukizi_get_api_key( $request ) {
        $api_key = get_option( 'bkz_api_key' );

        if ( ! $api_key ) {
            return new \WP_REST_Response( array(
                'success' => true,
                'value' => ''
            ), 200 );
        }

        return new \WP_REST_Response( array(
            'success' => true,
            'value' => $api_key
        ), 200 );
    }

    public function bukizi_update_api_key( $request ) {
        $updated = update_option( 'bkz_api_key', $request->get_param( 'api_key' ) );

        return new \WP_REST_Response( array(
            'success'   => $updated,
            'value'     => $request->get_param( 'api_key' )
        ), 200 );
    }

    public function bukizi_delete_api_key( $request ) {
        $deleted = delete_option( 'bkz_api_key' );

        return new \WP_REST_Response( array(
            'success'   => $deleted,
            'value'     => ''
        ), 200 );
    }
    
    public function bukizi_admin_permissions_check( $request ) {
        return current_user_can( 'manage_options' );
    }
}
