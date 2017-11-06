<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class News_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function get_all_articals() {
        $this->db->select('*');
        $this->db->from('article');
        //$this->db->join('article_comment', 'article.article_id = article_comment.article_id','left');
       // $this->db->join('article_tag', 'article.article_id= article_tag.article_id','left');
        $this->db->order_by("article.created_date", "desc");
        $query = $this->db->get();
        
        return $query->result_array();
        
    }
     function get_articles_top_treading() {
        $this->db->select('*');
        $this->db->from('article');
        //$this->db->join('article_comment', 'article.article_id = article_comment.article_id','left');
       // $this->db->join('article_tag', 'article.article_id= article_tag.article_id','left');
        $this->db->order_by("article.article_views", "desc");
        $query = $this->db->get();
        
        return $query->result_array();
        
    }
    function get_article_comments($article_id){
        $this->db->select('*');
        $this->db->from('article_comment');
        $this->where('article_id',$article_id);
        $this->db->order_by("created_date", "desc");
        $query = $this->db->get();
        return $query->result_array();
    }
    
  }