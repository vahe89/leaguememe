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

$route['list_discussion'] = "admin/discussion/list_discussion";

$route['add_articles'] = "admin/articles/add_article";
$route['list_articles'] = "admin/articles/article_list";
$route['edit_articles/(:any)'] = "admin/articles/edit_article/$1";

$route['add_patch_notes'] = "admin/patch_note/add_patch_notes";
$route['list_patch_notes'] = "admin/patch_note/list_patch_notes";
$route['edit_patch_notes/(:any)'] = "admin/patch_note/edit_patch_notes/$1";

$route['list_rules_template'] = "admin/rules_template/all_rules_template";
$route['rules_template'] = "admin/rules_template/rules_templates";
$route['add_rules_template'] = "admin/rules_template/add_category";
$route['edit_rules_template/(:any)'] = "admin/rules_template/edit_rules_template/$1";

$route['manage_tab'] = "admin/leaguelist/manage_tab";

$route['list_author'] = "admin/leaguelist/list_author";
$route['add_author'] = "admin/leaguelist/add_author";
$route['edit_author/(:any)'] = "admin/leaguelist/edit_author/$1";
$route['addsection'] = "admin/leaguelist/addsection";
$route['list_section'] = "admin/leaguelist/list_section";
$route['list_section_in/(:any)'] = "admin/leaguelist/list_section_in/$1";
$route['edit_section/(:any)'] = "admin/leaguelist/edit_section/$1";
// end admin route
// 
// 
// start public route
$route['remove_space'] = "public/home/remove_space";

$route['home'] = "public/home";
$route['bookmark'] = "public/home";
$route['popular'] = "public/home";

$route['new'] = "public/home";
$route['new/all'] = "public/home";
$route['new/art'] = "public/home";
$route['new/video'] = "public/home";
$route['new/random'] = "public/home";
$route['new/gifs'] = "public/home";

$route['popular/all'] = "public/home";
$route['popular/art'] = "public/home";
$route['popular/video'] = "public/home";
$route['popular/random'] = "public/home";
$route['popular/gifs'] = "public/home";

$route['bookmark/all'] = "public/home";
$route['bookmark/art'] = "public/home";
$route['bookmark/video'] = "public/home";
$route['bookmark/random'] = "public/home";
$route['bookmark/gifs'] = "public/home";

$route['new/all/(:any)'] = "public/home/index/$1";
$route['new/art/(:any)'] = "public/home/index/$1";
$route['new/video/(:any)'] = "public/home/index/$1";
$route['new/random/(:any)'] = "public/home/index/$1";
$route['new/gifs/(:any)'] = "public/home/index/$1";

$route['popular/all/(:any)'] = "public/home/index/$1";
$route['popular/art/(:any)'] = "public/home/index/$1";
$route['popular/video/(:any)'] = "public/home/index/$1";
$route['popular/random/(:any)'] = "public/home/index/$1";
$route['popular/gifs/(:any)'] = "public/home/index/$1";

$route['bookmark/all/(:any)'] = "public/home/index/$1";
$route['bookmark/art/(:any)'] = "public/home/index/$1";
$route['bookmark/video/(:any)'] = "public/home/index/$1";
$route['bookmark/gifs/(:any)'] = "public/home/index/$1";

$route['home/(:any)'] = "public/home/index/$1";

$route['season-old'] = "public/leaguelist/season_index";

$route['gamechat'] = "public/gamechat/index";
$route['gamechat/popular'] = "public/gamechat/index";
$route['gamechat/new'] = "public/gamechat/index";
$route['gamechat/bookmark'] = "public/gamechat/index";

$route['news-list'] = "public/news/index";
$route['news-list/news'] = "public/news/index";
$route['news-list/bookmark'] = "public/news/index";

$route['news'] = "public/news/news_home";
$route['news-detail/(:any)'] = "public/news/news_detail/$1";

$route['discussion'] = "public/discussion/index";
$route['discussion/fav'] = "public/discussion/fav";
$route['discussion-single/(:any)'] = "public/discussion/discussion_single/$1";

$route['poll'] = "public/poll/index";
$route['public/poll/poll-listing'] = "public/poll/poll_listing";

$route['poll-vote/(:any)'] = "public/poll/poll_question/$1";
$route['result-voting/(:any)'] = "public/poll/result_voting/$1";

$route['event'] = "public/event/mainevent";
$route['event/event-info/(:any)'] = "public/event/detail/$1";

$route['patch-note'] = "public/patch_note/index";
$route['patch-note/new'] = "public/patch_note/index";
$route['patch-note/bookmark'] = "public/patch_note/index";
$route['patch-note-detail/(:any)'] = "public/patch_note/detail/$1";

$route['league_victory'] = "public/leaguelist/league_victory";
$route['league_defeat'] = "public/leaguelist/league_defeat";
$route['user/login'] = "public/user/login";
$route['user/logout'] = "public/user/logout";
$route['user/change_pswd'] = "public/user/change_pswd";
$route['user_profile'] = "public/user/user_profile";
$route['notification'] = "public/user/notification";
$route['leaguememe_profile/(:any)'] = "public/user/leaguememe_profile/$1";
$route['leaguememe-profile/(:any)'] = "public/user/leaguememe_profile/$1";
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


$route['review-list/(:any)'] = "public/user/user_review_list/$1";
$route['user/Acccount_activation/(:any)'] = "public/user/Acccount_activation/$1";

$route['anime-album'] = "public/animelist/anime_album";
//$route['anime-list-album/(:any)/(:any)'] = "public/animelist/anime_album_episode_list/$1/$1";
$route['anime-list-album/(:any)'] = "public/animelist/anime_album_episode_list/$1";

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
