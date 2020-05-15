<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ajaxsearch_model extends CI_Model
{
    function fetch_data($query)
    {
        $this->db->select("*")->from("item")->join('category', 'category.category_id = item.item_category');
        if ($query != '') {
            $this->db->like('item_name', $query);
            $this->db->or_like('item_short_desc', $query);
            $this->db->or_like('item_long_desc', $query);
            $this->db->or_like('category_name', $query);
        }
        $this->db->order_by('item_id', 'ASC');
        return $this->db->get();
    }
}
