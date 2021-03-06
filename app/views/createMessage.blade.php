<div class="modal fade" id="createMessage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <form>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Create Message</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="inputRecipient">To:</label>
          <input type="text" class="form-control" id="inputRecipient" placeholder="">
        </div>
        <div class="form-group">
          <label for="inputMessage">Message:</label>
          <textarea id="inputMessage" class="form-control" rows="3"></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary">Send Message</button>
      </form>
      </div>
    </div>
  </div>
</div>