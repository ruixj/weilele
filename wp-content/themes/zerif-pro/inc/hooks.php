<?php

/**************** 404 page *********************/

/**
 * Title of 404 pages
 *
 * HTML context: within `header.entry-header`
 */
function zerif_404_title_trigger() {
	do_action( 'zerif_404_title' );
}

/**
 * Content of 404 pages
 *
 * HTML context: within `div.entry-content`
 */
function zerif_404_content_trigger() {
	do_action( 'zerif_404_content' );
}

/*************** Sidebar *************************/

/**
 * Before sidebar
 *
 * HTML context: before `div#secondary`
 */
function zerif_before_sidebar_trigger() {
	do_action( 'zerif_before_sidebar' );
}

/**
 * After sidebar
 *
 * HTML context: after `div#secondary`
 */
function zerif_after_sidebar_trigger() {
	do_action( 'zerif_after_sidebar' );
}

/**
 * Top of sidebar
 *
 * HTML context: within `div#secondary`
 */
function zerif_top_sidebar_trigger() {
	do_action( 'zerif_top_sidebar' );
}

/**
 * Bottom of sidebar
 *
 * HTML context: within `div#secondary`
 */
function zerif_bottom_sidebar_trigger() {
	do_action( 'zerif_bottom_sidebar' );
}

/******************** Footer *********************/

/**
 * Before footer
 *
 * HTML context: before `footer`
 */
function zerif_before_footer_trigger() {
	do_action( 'zerif_before_footer' );
}

/**
 * After footer
 *
 * HTML context: after `footer`
 */
function zerif_after_footer_trigger() {
	do_action( 'zerif_after_footer' );
}

/**
 * Top of footer
 *
 * HTML context: within `footer div.container`
 */
function zerif_top_footer_trigger() {
	do_action( 'zerif_top_footer' );
}

/**
 * Bottom of footer
 *
 * HTML context: within `footer div.container`
 */
function zerif_bottom_footer_trigger() {
	do_action( 'zerif_bottom_footer' );
}

/***************** Search page ******************/

/**
 * Before search
 *
 * HTML context: within `main` at the beginning
 */
function zerif_before_search_trigger() {
	do_action( 'zerif_before_search' );
}

/**
 * After search
 *
 * HTML context: after `main` at the end
 */
function zerif_after_search_trigger() {
	do_action( 'zerif_after_search' );
}

/********************* Body ********************/
/**
 * Top of body
 *
 * HTML context: within `body`
 */
function zerif_top_body_trigger() {
	do_action( 'zerif_top_body' );
}

/**
 * Bottom of body
 *
 * HTML context: within `body`
 */
function zerif_bottom_body_trigger() {
	do_action( 'zerif_bottom_body' );
}

/******************* Head ******************/
/**
 * Top of head
 *
 * HTML context: within `head`
 */
function zerif_top_head_trigger() {
	do_action( 'zerif_top_head' );
}

/**
 * Bottom of head
 *
 * HTML context: within `head`
 */
function zerif_bottom_head_trigger() {
	do_action( 'zerif_bottom_head' );
}

/***************** Page ********************/

/**
 * Top of page content
 *
 * HTML context: within `content-left-wrap` at the beginning
 */
function zerif_top_page_content_trigger() {
	do_action( 'zerif_top_page_content' );
}

/**
 * Bottom of page content
 *
 * HTML context: within `content-left-wrap` at the end
 */
function zerif_bottom_page_content_trigger() {
	do_action( 'zerif_bottom_page_content' );
}

/**
 * Before page content
 *
 * HTML context: before `content-left-wrap`
 */
function zerif_before_page_content_trigger() {
	do_action( 'zerif_before_page_content' );
}

/**
 * After page content
 *
 * HTML context: after `content-left-wrap`
 */
function zerif_after_page_content_trigger() {
	do_action( 'zerif_after_page_content' );
}

/**
 * Page header
 *
 * HTML context: within `.entry-header`
 */
function zerif_page_header_trigger() {
	do_action( 'zerif_page_header' );
}

/************ Our Focus section ********************/

/**
 * Before Our focus section
 *
 * HTML context: before `.focus`
 */
function zerif_before_our_focus_trigger() {
	do_action( 'zerif_before_our_focus' );
}

/**
 * After Our focus section
 *
 * HTML context: after `.focus`
 */
function zerif_after_our_focus_trigger() {
	do_action( 'zerif_after_our_focus' );
}

/************ About us section ********************/

/**
 * Before About us section
 *
 * HTML context: before `.about-us`
 */
function zerif_before_about_us_trigger() {
	do_action( 'zerif_before_about_us' );
}

/**
 * After About us section
 *
 * HTML context: after `.about-us`
 */
function zerif_after_about_us_trigger() {
	do_action( 'zerif_after_about_us' );
}

/************ Latest news section *****************/

/**
 * Before Latest news section
 *
 * HTML context: before `.latest-news`
 */
function zerif_before_latest_news_trigger() {
	do_action( 'zerif_before_latest_news' );
}

/**
 * After Latest news section
 *
 * HTML context: after `.latest-news`
 */
function zerif_after_latest_news_trigger() {
	do_action( 'zerif_after_latest_news' );
}

/**
 * Top of Latest news section
 *
 * HTML context: within `.latest-news`
 */
function zerif_top_latest_news_trigger() {
	do_action( 'zerif_top_latest_news' );
}

/**
 * Bottom of Latest news section
 *
 * HTML context: within `.latest-news`
 */
function zerif_bottom_latest_news_trigger() {
	do_action( 'zerif_bottom_latest_news' );
}

/************ Our team section *****************/

/**
 * Before Our team section
 *
 * HTML context: before `.our-team`
 */
function zerif_before_our_team_trigger() {
	do_action( 'zerif_before_our_team' );
}

/**
 * After Our team section
 *
 * HTML context: after `.our-team`
 */
function zerif_after_our_team_trigger() {
	do_action( 'zerif_after_our_team' );
}

/**
 * Top of Our team section
 *
 * HTML context: within `.our-team`
 */
function zerif_top_our_team_trigger() {
	do_action( 'zerif_top_our_team' );
}

/**
 * Bottom of Our team section
 *
 * HTML context: within `.our-team`
 */
function zerif_bottom_our_team_trigger() {
	do_action( 'zerif_bottom_our_team' );
}

/************ Testimonials section *****************/

/**
 * Before Testimonials section
 *
 * HTML context: before `.testimonial`
 */
function zerif_before_testimonials_trigger() {
	do_action( 'zerif_before_testimonials' );
}

/**
 * After Testimonials section
 *
 * HTML context: after `.testimonial`
 */
function zerif_after_testimonials_trigger() {
	do_action( 'zerif_after_testimonials' );
}

/**
 * Top of Testimonials section
 *
 * HTML context: within `.testimonial`
 */
function zerif_top_testimonials_trigger() {
	do_action( 'zerif_top_testimonials' );
}

/**
 * Bottom of Testimonials section
 *
 * HTML context: within `.testimonial`
 */
function zerif_bottom_testimonials_trigger() {
	do_action( 'zerif_bottom_testimonials' );
}

/************ Subscribe section *****************/

/**
 * Before Subscribe section
 *
 * HTML context: before `.newsletter`
 */
function zerif_before_subscribe_trigger() {
	do_action( 'zerif_before_subscribe' );
}

/**
 * After Subscribe section
 *
 * HTML context: after `.newsletter`
 */
function zerif_after_subscribe_trigger() {
	do_action( 'zerif_after_subscribe' );
}

/**
 * Top of Subscribe section
 *
 * HTML context: within `.newsletter`
 */
function zerif_top_subscribe_trigger() {
	do_action( 'zerif_top_subscribe' );
}

/**
 * Bottom of Subscribe section
 *
 * HTML context: within `.newsletter`
 */
function zerif_bottom_subscribe_trigger() {
	do_action( 'zerif_bottom_subscribe' );
}

/************ Packages section *****************/

/**
 * Before Packages section
 *
 * HTML context: before `.packages`
 */
function zerif_before_packages_trigger() {
	do_action( 'zerif_before_packages' );
}

/**
 * After Packages section
 *
 * HTML context: after `.packages`
 */
function zerif_after_packages_trigger() {
	do_action( 'zerif_after_packages' );
}

/**
 * Top of Packages section
 *
 * HTML context: within `.packages`
 */
function zerif_top_packages_trigger() {
	do_action( 'zerif_top_packages' );
}

/**
 * Bottom of Packages section
 *
 * HTML context: within `.packages`
 */
function zerif_bottom_packages_trigger() {
	do_action( 'zerif_bottom_packages' );
}

/************ Portfolio section *****************/

/**
 * Before Portfolio section
 *
 * HTML context: before `.works`
 */
function zerif_before_portfolio_trigger() {
	do_action( 'zerif_before_portfolio' );
}

/**
 * After Portfolio section
 *
 * HTML context: after `.works`
 */
function zerif_after_portfolio_trigger() {
	do_action( 'zerif_after_portfolio' );
}

/**
 * Top of Portfolio section
 *
 * HTML context: within `.works`
 */
function zerif_top_portfolio_trigger() {
	do_action( 'zerif_top_portfolio' );
}

/**
 * Bottom of Portfolio section
 *
 * HTML context: within `.works`
 */
function zerif_bottom_portfolio_trigger() {
	do_action( 'zerif_bottom_portfolio' );
}

/**
 * Single portfolio header
 *
 * HTML context: within `.entry-header`
 */
function zerif_portfolio_header_trigger() {
	do_action( 'zerif_portfolio_header' );
}
/************ Big title section *****************/

/**
 * Add content inside div.buttons
 *
 * HTML context: within `.buttons`
 */
function zerif_big_title_buttons_top_trigger() {
	do_action( 'zerif_big_title_buttons_top' );
}

/**
 * Add content inside div.buttons
 *
 * HTML context: within `.buttons`
 */
function zerif_big_title_buttons_bottom_trigger() {
	do_action( 'zerif_big_title_buttons_bottom' );
}
/************ General *****************/

/**
 * Add content after the header tag is closed
 *
 * HTML context: after `header` is closed
 */
function zerif_after_header_trigger() {
	do_action( 'zerif_after_header' );
}