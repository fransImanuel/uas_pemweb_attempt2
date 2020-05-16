<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ajax_model extends CI_Model
{
    function fetch_data($search, $filter, $sort)
    {
        $this->db->select("*")->from("item")->join('category', 'category.category_id = item.item_category');




        if ($search != '') {
            $this->db->like('item_name', $search);
            $this->db->or_like('item_short_desc', $search);
            $this->db->or_like('item_long_desc', $search);
        }

        if ($filter != '') {
            $this->db->where('category_name', $filter);
        }

        $this->db->order_by('item_name', $sort);
        return $this->db->get();
    }
}
