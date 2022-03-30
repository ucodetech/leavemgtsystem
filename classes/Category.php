<?php

 /**
  * category
  */
 class Category
 {

 	private  $_db;


  function __construct()
  {
    $this->_db = Database::getInstance();

  }

 


public function insertCate($field = array()){
    $this->_db->insert('categories', $field);
  
}




// Move cate to Trash
public function cateAction($val, $id){
  $this->_db->update('categories', 'id', $id, array(
    'deleted' => $val
  ));
  return true;

}


public function cateById($id){
  $sql = "SELECT * FROM categories WHERE  id = '$id' AND deleted = 0";
  $this->_db->query($sql);
 if ($this->_db->count()) {
   return $this->_db->first();
     }else{
        return false;
   }
}


public function cateUpdate($category, $Id){

  $this->_db->update('categories', 'id', $Id, array(
    'category' => $category
  ));
  return true;

}

public function checkCategory($category)
{
   $check = $this->_db->get('categories', array('category' ,'=', $category));
   if ($check->count()) {
     return true;
   }else{
    return false;
   }

}


public function fetchCategory()
{

  $data = $this->_db->get('categories', array('deleted','=', 0));
  if ($data->count()) {
      $cate = $data->results();

      $output = '';

      $output .='
          <table class="table table-stripped table-boreded" id="showCate">
          <thead>
            <th>#</th>
            <th>Category</th>
            <th>Edit</th>
            <th>Delete</th>
          </thead>
            <tbody>
      ';

        foreach ($cate as $c) {
          $output .='
                 
                      <tr>
                      <td>'.$c->id.'</td>
                      <td>'.$c->category.'</td>
                      <td>
                        
                        <a href="#" class="btn btn-success btn-sm editIcon" id="'.$c->id.'"   data-target="#editCategory" data-toggle="modal"><i class="fa fa-edit"></i>&nbsp;Edit</a>
                      </td>
                      <td>
                        <a href="#" class="btn btn-danger btn-sm trashIcon" id="'.$c->id.'"><i class="fa fa-trash"></i>&nbsp;Delete</a>
                      </td>
                    </tr>  
            ';
        }

      $output .= ' </tbody>
                  </table>';

    return $output;
  }
  
  
               
}



public function getCategory()
{

  $data = $this->_db->get('categories', array('deleted','=', 0));
  if ($data->count()) {
      return  $data->results();
  }else{
    return false;
  }
}



}//end of class
