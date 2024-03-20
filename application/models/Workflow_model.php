<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Workflow_model extends CI_Model
{
  private $table = "workflow";

  public function getAll()
  {
    $query = "SELECT * from $this->table as a ORDER BY a.activity_id ASC";
    return $this->db->query($query)->result();
  }

  function insert($data)
  {
    $this->db->insert($this->table, $data);
    return  $this->db->affected_rows();
  }

  public function update($id, $data)
  {
    $this->db->where('id', $id);
    $this->db->update($this->table, $data);
    return  $this->db->affected_rows();
  }

  public function delete($id)
  {
    $this->db->delete($this->table, array("id" => $id));
    return  $this->db->affected_rows();
  }
}
