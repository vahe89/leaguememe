<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | -------------------------------------------------------------------------
  | URI ROUTING
  | -------------------------------------------------------------------------
  | This file lets you re-map URI requests to specific controller functions.
  |
  | Typically there is a one-to-one relationship between a URL string
  | and its corresponding controller class/method. The segments in a
  | URL normally follow this pattern:
  |
  |	example.com/class/method/id/
  |
  | In some instances, however, you may want to remap this relationship
  | so that a different class/function is called than the one
  | corresponding to the URL.
  |
  | Please see the user guide for complete details:
  |
  |	http://codeigniter.com/user_guide/general/routing.html
  |
  | -------------------------------------------------------------------------
  | RESERVED ROUTES
  | -------------------------------------------------------------------------
  |
  | There area two reserved routes:
  |
  |	$route['default_controller'] = 'welcome';
  |
  | This route indicates which controller class should be loaded if the
  | URI contains no data. In the above example, the "welcome" class
  | would be loaded.
  |
  |	$route['404_override'] = 'errors/page_missing';
  |
  | This route will tell the Router what URI segments to use if those provided
  | in the URL cannot be matched to a valid route.
  |
 */
// for admin
$route['admin'] = "admin/login";
$route['logout'] = "admin/admin/logout";
$route['edit_profile'] = "admin/admin/edit_profile";
$route['login/check_login'] = "admin/login/check_login";

$route['dashboard'] = "admin/login/dashboard";
 
$route['users'] = "admin/users/user_list";

$route['ban_users'] = "admin/users/ban_users";
$route['user_list'] = "admin/users/user_list";

$route['add_category'] = "admin/category/add_category";
$route['list_category'] = "admin/category/list_category";
$route['edit_category/(:num)'] = "admin/category/edit_category/$1";

$route['add_admin'] = "admin/admin/add_admin";
$route['admin_list'] = "admin/admin/admin_list";
$route['edit_admin/(:any)'] = "admin/admin/edit_admin/$1";

$route['add_league'] = "admin/leaguelist/add_league";
$route['list_league'] = "admin/leaguelist/list_league";
$route['list_league/(:any)'] = "admin/leaguelist/top_navigation/$1";
$route['edit_league/(:any)'] = "admin/leaguelist/edit_league/$1";
//$route['edit_league/(:any)/(:any)'] = "admin/leaguelist/edit_league/$1/$2";

$route['add_event'] = "admin/event/add_event";
$route['list_event'] = "admin/event/list_event";
$route['edit_event/(:any)'] = "admin/event/edit_event/$1";
$route['select_winner/(:any)'] = "admin/event/select_winner/$1";

$route['sidebar_list'] = "admin/leaguelist/view_sidebar";

$route['list_anime_report'] = "admin/leaguelist/anime_report";

$route['all_anime_report'] = "admin/leaguelist/all_anime_report";
$route['anime-category'] = "admin/animecategory/anime_category";
$route['edit-animedetail/(:any)'] = "admin/animecategory/edit_anime_detail/$1";
 
$route['list_discussion'] = "admin/discussion/list_discussion";
// end admin route
// 
// 
// start public route
$route['home/(:any)'] = "public/home/index/$1";
$route['league_victory'] = "public/leaguelist/league_victory";
$route['league_defeat'] = "public/leaguelist/league_defeat";
$route['user/login'] = "public/user/login";
$route['user/logout'] = "public/user/logout";
$route['user/change_pswd'] = "public/user/change_pswd";
$route['user_profile'] = "public/user/user_profile";
$route['notification'] = "public/user/notification";
$route['animemoment_profile/(:any)'] = "public/user/animemoment_profile/$1";
$route['animemoment-profile/(:any)'] = "public/user/animemoment_profile/$1";
$route['show-all-post/(:any)'] = "public/user/show_all_post/$1";
$route['user/update_pswd'] = "public/user/update_pswd";

$route['tag'] = "public/leaguelist/league_image_tag";
$route['user/reset_password/(:any)'] = "public/user/reset_password/$1";
$route['user/update_password'] = "public/user/update_password";
$route['user/reg'] = "public/user/reg";
$route['user/forgot_password'] = "public/user/forgot_password";
$route['loginfacebook'] = "public/loginfacebook";
$route['logingoogle'] = "public/logingoogle";
$route['tag/(:any)'] = "public/leaguelist/league_image_tag/$1";
$route['discussion-single/(:any)'] = "public/animelist/discussion_single/$1";
$route['poll-vote/(:any)'] = "public/poll/poll_question/$1";
$route['result-voting/(:any)'] = "public/poll/result_voting/$1";
$route['review-list/(:any)'] = "public/user/user_review_list/$1";
$route['poll-listing'] = "public/poll/poll_listing";
$route['user/Acccount_activation/(:any)'] = "public/user/Acccount_activation/$1";

$route['anime-album'] = "public/animelist/anime_album";
//$route['anime-list-album/(:any)/(:any)'] = "public/animelist/anime_album_episode_list/$1/$1";
$route['anime-list-album/(:any)'] = "public/animelist/anime_album_episode_list/$1";
 $route['news'] = "public/news/news_home";
//$route[''] = "public/leaguelist/single_image_list/$1
$route['event/event-info/(:any)'] = "public/event/detail/$1";
session_start();
require_once( BASEPATH . 'database/DB' . EXT );
$db = & DB();
$query = $db->get('le_leagueimages');
$result = $query->result();
foreach ($result as $rows) {
    //$paths=$rows->leagueimage_id.'/'.rawurlencode($rows->leagueimage_name);
    $paths = $rows->leagueimage_id;
    $route[$paths] = "public/leaguelist/single_image_list/" . $rows->leagueimage_id;
    //$paths_sub=$rows->leagueimage_id.'/'.rawurlencode($rows->leagueimage_name).'/(:any)';
    //$route[$paths_sub]  = "home/single_image/".$rows->leagueimage_id;
    // follwoing active
    //$paths_sub = $rows->leagueimage_id . '/(:any)';
    //$route[$paths_sub] = "home/single_image/" . $rows->leagueimage_id;
}

$route['default_controller'] = "public/home";
$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */
