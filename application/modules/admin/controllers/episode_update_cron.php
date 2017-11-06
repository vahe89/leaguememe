<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Episode_update_cron extends MX_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('anime_model', 'animod');
    }

    function index() {
        $current_date = date("Y-m-d H:i:s");
        $anime = $this->animod->getanime();

        foreach ($anime as $value) {
            echo '<br>';
            $anime_id = $value->anime_id;
            $episode = $value->episode;
            $manga = $value->manga;
            if ($current_date == $value->episode_time) {
                $dataArray = array(
                    'episode' => $episode + 1,
                );
                $this->animod->update_episode($anime_id, $dataArray);
                $animeArray = array(
                    'current_episode' => $episode + 1,
                );
                $this->animod->update_episode_detail($anime_id, $animeArray);
            }

            if ($current_date == $value->manga_time) {
                $dataArray = array(
                    'manga' => $manga + 1,
                );
                $this->animod->update_episode($anime_id, $dataArray);
                $animeArray = array(
                    'current_manga' => $manga + 1,
                );
                $this->animod->update_episode_detail($anime_id, $animeArray);
            }
        }
    }

}

?>