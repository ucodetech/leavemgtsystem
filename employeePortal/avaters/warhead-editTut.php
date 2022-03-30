<?php
require_once '../core/init.php';
if (!isWarHeadGranted()) {
  Session::flash('access-denied', 'Access Denied!');
  Redirect::to('warhead-access');

}
require APPROOT .'/includes/Panelhead.php';

$warhead = new Post();

?>

<div class="content-wrapper">

    <div class="content-header">
      <div class="container-fluid">
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="card my-2 border-success">
              <div class="card-header bg-warning text-white">
                <h4 class="m-0"><i class="fas fa-edit fa-lg"></i></i>Edit Tutorial</h4>
              </div>
              <div class="card-body">
                  <?php

                  //fetch categories
                  $result = $warhead->fetchCateParent(0);

                  $slug_url = '';

                  $tut_title = ((isset($_POST['tut_title']) && $_POST['tut_title'] != '')?Show::test_input($_POST['tut_title']) : '');

                  $tut_description = ((isset($_POST['tut_description']) && $_POST['tut_description'] != '')? Show::test_input($_POST['tut_description']): '');

                  $tags = ((isset($_POST['tags']) && $_POST['tags'] != '')?Show::test_input($_POST['tags']) : '');

                  $html = ((isset($_POST['html']) && $_POST['html'] != '')?$_POST['html'] : '');

                  $html_description = ((isset($_POST['html_description']) && $_POST['html_description'] != '')?Show::test_input($_POST['html_description']) : '');

                  $css = ((isset($_POST['css']) && $_POST['css'] != '')?Show::test_input($_POST['css']) : '');

                  $css_description = ((isset($_POST['css_description']) && $_POST['css_description'] != '')?Show::test_input($_POST['css_description']) : '');

                  $jquery = ((isset($_POST['jquery']) && $_POST['jquery'] != '')?Show::test_input($_POST['jquery']) : '');

                  $jquery_description = ((isset($_POST['jquery_description']) && $_POST['jquery_description'] != '')?Show::test_input($_POST['jquery_description']) : '');

                  $category = ((isset($_POS['category']) && $_POST['category'] != '')?Show::test_input($_POST['category']): '');

                  $youtube_link = ((isset($_POST['youtube_link']) && $_POST['youtube_link'] != '')?Show::test_input($_POST['youtube_link']) : '');

                    if (isset($_GET['edit'])) {
                      $editID = (int)$_GET['edit'];

                      //pass data to  varibles
                        //fetch by id

                  $results = $warhead->tutById($editID, 0);


                  $tut_title = ((isset($_POST['tut_title']) && $_POST['tut_title'] != '')?Show::test_input($_POST['tut_title']) : $results->tut_title);

                  $tut_description = ((isset($_POST['tut_description']) && $_POST['tut_description'] != '')? Show::test_input($_POST['tut_description']): $results->tut_description);


                  $html = ((isset($_POST['html']) && $_POST['html'] != '')?Show::test_input($_POST['html']) : $results->html);

                  $html_description = ((isset($_POST['html_description']) && $_POST['html_description'] != '')?Show::test_input($_POST['html_description']) : $results->html_description);

                  $css = ((isset($_POST['css']) && $_POST['css'] != '')?Show::test_input($_POST['css']) : $results->css);

                  $css_description = ((isset($_POST['css_description']) && $_POST['css_description'] != '')?Show::test_input($_POST['css_description']) : $results->css_description);

                  $jquery = ((isset($_POST['jquery']) && $_POST['jquery'] != '')?Show::test_input($_POST['jquery']) : $results->jquery);

                  $jquery_description = ((isset($_POST['jquery_description']) && $_POST['jquery_description'] != '')?Show::test_input($_POST['jquery_description']) : $results->jquery_description);


                  $youtube_link = ((isset($_POST['youtube_link']) && $_POST['youtube_link'] != '')?Show::test_input($_POST['youtube_link']) : $results->youtube_link);

                  // $category = ((isset($_POS['parent']) && $_POST['parent'] != '')?Show::test_input($_POST['parent']): $results->categories);

                  $parentCat = $warhead->cateById($results->categories, 0);

                  $category = ((isset($_POST['category']) && $_POST['category'] != '')?Show::test_input($_POST['category']) : $parentCat->category);



              $php_tut = ((isset($_POST['php_tut']) && $_POST['php_tut'] != '')?$_POST['php_tut']: $results->php_tut);

              $php_description = ((isset($_POST['php_description']) && $_POST['php_description'] != '')?$_POST['php_description']: $results->php_description);

              $sql_tut = ((isset($_POST['sql_tut']) && $_POST['sql_tut'] != '')?$_POST['sql_tut']: $results->sql_tut);

              $sql_description = ((isset($_POST['sql_description']) && $_POST['sql_description'] != '')?$_POST['sql_description']: $results->sql_description);

           $tags = ((isset($_POST['tags']) && $_POST['tags'] != '')?$_POST['tags']:$results->tags);






                  $slug_url = preg_replace('/[^a-z0-9]+/i', '-', trim(strtolower($tut_title )));

                  //  $sql = "SELECT * FROM tutorials WHERE slug_url LIKE '%$slug_url%' ";
                  //   $stmt = Show::_pdo->prepare($sql);
                  //   $stmt->execute();
                  //   $checkSlug = $stmt->fetchAll(PDO::FETCH_OBJ);

                  // if ($checkSlug) {
                  //     foreach ($checkSlug as $slug) {
                  //       $data[] = $slug->slug_url;
                  //     }
                  //     if (in_array($slug_url, $data)) {
                  //       $count = 0;
                  //       while(in_array(($slug_url . '-' . ++$count), $data));
                  //       $slug_url = $slug_url . '-' . $count;
                  //     }
                  // }


                    if (isset($_GET['edit'])) {

                       $update =  $warhead->updateTut($tut_title, $tut_description,  $tags,  $html, $html_description,  $css ,  $css_description, $jquery, $jquery_description,$category, $slug_url, $youtube_link,  $php_tut, $php_description,$sql_tut, $sql_description, $editID);
                       }
                    if ($update) {
                      echo Show::showMessage('success', 'Tutorial updated successfully-> <a href="warhead-tutorials" class="px-3 m-0">Back</a>', 'check');


                       }else{

                        echo Show::showMessage('danger', 'something wrong', 'warning');
                        return false;
                    }
 }
                   ?>

                     <form class="px-3" action="#" method="post" id="edit-tutorial-form">

                  <div class="row">
                    <input type="hidden" name="id" id="editTutid">
                    <div class="form-group col-md-6">
                      <input type="text" name="tut_title" id="etut_title" placeholder="Title" class="form-control form-control-lg" value="<?= $tut_title; ?>">
                    </div>

                    <div class="form-group col-md-6">
                      <label for="youtube_link">Youtube Link</label>
                      <input type="text" name="youtube_link" id="youtube_link" placeholder="Youtube like" class="form-control form-control-lg" value="<?= $youtube_link; ?>">
                    </div>
                     <div class="form-group col-md-6">
                      <label for="tags">Tags</label>
                      <input type="text" name="tags" id="tags" placeholder="Tags" class="form-control form-control-lg" value="<?=  $tags; ?>">
                    </div>

                    <div class="form-group col-md-6">
                      <label for="category">Category</label>
                      <select class="form-control form-control-lg" name="category" id="category">
                        <option value=""<?=(($category == '')? ' selected' : '');?>>
                         Select Category
                        </option>

                        <?php foreach ($result as $p) : ?>
                          <option value="<?= $p->id;?>" <?=(($category == $p->category)? ' selected' : '');?>>
                                <?= $p->category; ?>
                          </option>


                         <?php endforeach; ?>


                      </select>

                    </div>


                    <div class="form-group col-md-6">
                      <label for="tut_description">Tut Description</label>
                      <textarea  name="tut_description" id="tut_description" placeholder="Description" class="form-control form-control-lg" rows="8">
                        <?= $tut_description; ?>
                       </textarea>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="html">Html</label>
                      <textarea  name="html" id="html" placeholder="Html Code" class="form-control form-control-lg" rows="8" >
                        <?= $html; ?>
                      </textarea>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="html_description">Html Description</label>
                      <textarea  name="html_description" id="html_description" placeholder="Description" class="form-control form-control-lg" rows="8" ><?= $html_description; ?></textarea>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="jquery">Jquery</label>
                      <textarea  name="jquery" id="jquery" placeholder="jquery Code" class="form-control form-control-lg" rows="8"><?= $jquery; ?></textarea>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="jquery_description">Jquery Description</label>
                      <textarea  name="jquery_description" id="jquery_description" placeholder="Description" class="form-control form-control-lg" rows="8"><?= $jquery_description; ?></textarea>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="css">Css</label>
                      <textarea  name="css" id="ecss" placeholder="css Code" class="form-control form-control-lg" rows="8"><?= $css; ?></textarea>
                    </div>
                    <div class="form-group col-md-6">
                    <label for="css_description">Css Description</label>
                      <textarea  name="css_description" id="css_description" placeholder="Description" class="form-control form-control-lg" rows="8"> <?= $css_description; ?></textarea>
                    </div>

                    <div class="clearfix">  </div>
                    <div class="form-group col-md-12">
                      <input type="submit" name="EdituploadTut" id="EdituploadTutBtn" value="Edit Tutorial" class="btn btn-info btn-lg btn-block px-2">
                    </div>
                  </div>
                  </form>

              </div>
            </div>
          </div>
        </div>
        </div>
      </div><!-- /.container-fluid -->
      <!-- /.content -->
    </div>




<?php   require APPROOT .'/includes/Panelfooter.php';?>
<script>
  $(document).ready(function(){
    get_child_options('<?=$category;?>');
  })
</script>
<script type="text/javascript" src="childCate.js"></script>
