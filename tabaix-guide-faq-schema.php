<?php
/**
 * Plugin Name:       Tabaix Guide FAQ Schema
 * Plugin URI:        https://tabaix.com
 * Description:       Adds FAQPage JSON-LD schema to the /tools/ guide pages, built from the FAQ questions and answers the guides already show on the page in their details/summary sections. Nothing is displayed or edited; deactivating the plugin removes the schema again.
 * Version:           1.0.0
 * Author:            Tabaix
 * License:           GPL-2.0-or-later
 * Text Domain:       tabaix-guide-faq-schema
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'wp_head', function () {
	if ( ! is_singular( 'page' ) ) {
		return;
	}
	$post = get_queried_object();
	if ( ! $post || empty( $post->post_content ) ) {
		return;
	}
	$link = get_permalink( $post );
	if ( ! $link || strpos( $link, '/tools/' ) === false ) {
		return;
	}
	$content = $post->post_content;

	// If a Yoast FAQ block ever appears on a guide, Yoast owns the schema.
	if ( strpos( $content, 'yoast-faq' ) !== false || strpos( $content, 'schema-faq' ) !== false ) {
		return;
	}

	if ( ! preg_match_all( '#<details[^>]*>\s*<summary[^>]*>(.*?)</summary>(.*?)</details>#is', $content, $m ) ) {
		return;
	}

	$entities = array();
	foreach ( $m[1] as $i => $q_html ) {
		$q = trim( html_entity_decode( wp_strip_all_tags( $q_html ), ENT_QUOTES, 'UTF-8' ) );
		$a = trim( html_entity_decode( wp_strip_all_tags( $m[2][ $i ] ), ENT_QUOTES, 'UTF-8' ) );
		$a = preg_replace( '/\s+/', ' ', $a );
		if ( $q === '' || strlen( $a ) < 20 ) {
			continue;
		}
		$entities[] = array(
			'@type'          => 'Question',
			'name'           => $q,
			'acceptedAnswer' => array(
				'@type' => 'Answer',
				'text'  => $a,
			),
		);
		if ( count( $entities ) >= 12 ) {
			break;
		}
	}

	if ( count( $entities ) < 2 ) {
		return;
	}

	$schema = array(
		'@context'   => 'https://schema.org',
		'@type'      => 'FAQPage',
		'mainEntity' => $entities,
	);
	echo '<script type="application/ld+json">' . wp_json_encode( $schema ) . '</script>' . "\n";
}, 20 );
