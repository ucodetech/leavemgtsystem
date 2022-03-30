<?php 
require_once '../../core/init.php';
$category = new Category();
$show = new Show();

if (isset($_POST['action']) && $_POST['action'] == 'addCategory'){
	$categories = $show->test_input($_POST['category']);

	if (empty($_POST['category'])) {
		echo $show->showMessage('danger','Category is required!', 'warning');
		return false;
	}

	if ($category->checkCategory($categories)) {
		echo $show->showMessage('danger', $categories .' Already Exists!', 'warning');
		return false;
		
	}

	$add = $category->insertCate(array(
	  	'category' => $categories
	  ));
	echo $show->showMessage('success', $categories .' Added!', 'check'); 

	
}

if (isset($_POST['action']) == 'fetch_Category') {
	$cats = $category->fetchCategory();
	echo $cats;
	
}

if (isset($_POST['del_id'])) {
  $id = $_POST['del_id'];
  $one  = 1;
  $data = $category->cateAction($one, $id);
}

if (isset($_POST['edit_id'])) {
  $id = $_POST['edit_id'];
  $data = $category->cateById($id);

  if ($data) {
  	echo '
  		<form class="mt-2" action="#" method="post" id="EditCategoryForm"  class="px-3">
                <input type="hidden" name="editId" id="editId" value="'.$data->id.'">
                <div class="form-group" >
                  <input type="text" name="category" id="Editcategory" class="form-control form-control-lg"  value="'.$data->category.'">

                </div>
                <div class="form-group">
                  <span id="cateError" class="text-danger"></span>
                </div>
                <div class="clearfix"> </div>
                <div class="form-group">
                  <input type="submit" name="EditCate" id="EditCateBtn" value="Edit Category" class="btn btn-info btn-block btn-lg">
                </div>
              </form>

  	';
  }
  
}


//edit category
if (isset($_POST['action']) && $_POST['action'] == 'update_cate') {
    $edit_id = $show->test_input($_POST['editId']);
    $categor = $show->test_input($_POST['category']);
    // $category = preg_replace('/[^a-z0-9]+/i', '-', trim(strtolower($category)));

    if (empty($_POST['category'])) {
        echo $category->showMessage('danger', 'Category is required!', 'warning');
        return false;
    }
      $category->cateUpdate($categor, $edit_id);

}

