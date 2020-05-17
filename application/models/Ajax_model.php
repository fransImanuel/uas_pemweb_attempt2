<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ajax_model extends CI_Model
{
    function fetch_data($search, $filter, $sort, $minimum, $maximum)
    {
        $this->db->select("*")->from("item")->join('category', 'category.category_id = item.item_category');


        if ($minimum != '') {
            $this->db->where('item_price >=', $minimum);
        }
        if ($maximum != '') {
            $this->db->where('item_price <=', $maximum);
        }
        if ($filter != '') {
            $this->db->where('category_name', $filter);
        }
        if ($search != '') {
            $this->db->like('item_name', $search);
        }


        $this->db->order_by('item_name', $sort);
        return $this->db->get();
    }
}
