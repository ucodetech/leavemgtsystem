	  <!-- Add Note Modal -->
      <div class="modal fade" id="addQuizModal">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" >
          <div class="modal-content">
            <div class="modal-header bg-success">
              <h4 class="modal-title text-light"> <i class="fas fa-edit fa-lg"></i> Edit project</h4>
              <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
              <form class="mt-2px-3" action="#" method="post" id="addQuizform">

                <div class="form-group">
                  <input type="text" name="quizQuestion" id="quizQuestion" class="form-control form-control-lg" placeholder="Question">

                </div>
               
                <div class="clearfix"> </div>
                <div class="form-group">
                  <input type="submit" name="EditCateBtn" id="EditCateBtn" value="Edit Category" class="btn btn-info btn-block btn-lg"><br>
                  <span id="ErrorMsg"></span>
                </div>
              </form>
            </div>
          </div>
        </div>

      </div>