<?php
class CarModel extends CI_Model{

  public function save_manufacture($data)
  {
    $res = $this->db->insert('manufacture', $data);
    return $res;
  }
  public function save_car_model($data)
  {
    $res = $this->db->insert('car_model', $data);
    return $res;
    
  }

  public function toCheckDuplicateName($name)
  {
    $sql = "SELECT ID FROM manufacture WHERE  M_NAME = '".$name."'"; 
     $res= $this->db->query($sql);
     if(!empty($res->result()))
     {
        return 1;
     }
     else
     {
       return 0;
     }
  }
  public function getManufactData()
  {
     $sql = "SELECT ID, M_NAME FROM manufacture"; 
     $res= $this->db->query($sql);
     $i = 0;
     foreach ($res->result_array() as $row)
     {
         $data[$i]['ID'] = $row['ID'];
         $data[$i]['NAME'] = $row['M_NAME'];
         $i++;
     }

     return $data;
  }
  public function getManuFactNameByID($id)
  {
    $sql = "SELECT M_NAME FROM manufacture WHERE ID = '".$id."'"; 

    $name = "";
     $res= $this->db->query($sql);
     foreach ($res->result_array() as $row)
     {
        $name = $row['M_NAME'];
     }
     return $name;
  }
  public function updateCarEntry($del_id,$data)
  {
      $this->db->where('ID', $del_id);
      $result = $this->db->update('car_model', $data);

      return $result;
  }
  public function toGetCarData()
  {
     $result =array();
     $sql = "SELECT ID,MODEL_NAME,MANUFACTURE_ID,COLOR,MODEL_REG,NOTE,YEAR FROM car_model WHERE FLAG= '1'"; 
     $res= $this->db->query($sql);
     $output = $res->result_array();
     $i = 0;
     if(empty($output))
     {
        $result = 0;
     }
     else
     {
     foreach ($output as $row)
     {
         $result[$i]['ID'] = $row['ID'];
         $result[$i]['NAME'] = $row['MODEL_NAME'];
         $result[$i]['MANUFACT_NAME']= $this->getManuFactNameByID($row['MANUFACTURE_ID']);
         $result[$i]['COLOR'] = $row['COLOR'];
         $result[$i]['MODEL_REG'] = $row['MODEL_REG'];
         $result[$i]['NOTE'] = $row['NOTE'];
         $result[$i]['YEAR'] = $row['YEAR'];
         $i++;
     }
   }
     
     return $result;


  }
}