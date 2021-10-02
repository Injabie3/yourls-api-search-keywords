<?php
    
    /*
     Plugin Name: Search for keywords
     Plugin URI: https://github.com/Injabie3/yourls-api-search-keywords 
     Forked from: https://github.com/bryzgaloff/yourls-api-lookup-keywords-by-url-substr
     Forked from: https://github.com/timcrockford/yourls-api-edit-url
     Description: Define a custom API action 'search_keywords'
     Version: 0.0.1
     Author: Injabie3
     Author URI: https://github.com/Injabie3
     */
    
    yourls_add_filter( 'api_action_search_keywords', 'api_action_search_keywords' );
    
    function api_action_search_keywords() {
        if ( ! isset( $_REQUEST['substr'] ) ) {
            return array(
                'statusCode' => 400,
                'status'     => 'fail',
                'simple'     => "Need a 'substr' parameter",
                'message'    => "error: missing param 'substr'",
            );
        }

        $url_substr = $_REQUEST['substr'];
        $sanitized_val = yourls_sanitize_url( $url_substr );

        global $ydb;
        $table = YOURLS_DB_TABLE_URL;
        $keywords = $ydb->fetchCol(
            "SELECT `keyword` FROM `$table` WHERE `keyword` LIKE :pattern",
            array('pattern' => '%' . $sanitized_val . '%'),
        );

        if ( !empty( $keywords ) ) {
            return array(
                'statusCode' => 200,
                'simple'     => 'Keywords for $sanitized_val are ' . $keywords,
                'message'    => 'success: found',
                'keywords'   => $keywords,
            );
        } else {
            return array(
                'statusCode' => 404,
                'status'     => 'fail',
                'simple'     => 'Error: could not find keywords for $sanitized_val',
                'message'    => 'error: not found',
                'keywords'   => array(),
            );
        }
    }
?>
