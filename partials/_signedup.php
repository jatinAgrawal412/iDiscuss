<div class="modal fade" id="signedupModal" tabindex="-1" aria-labelledby="signedupModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="signedupModalLabel">SignedUp for an iDiscuss</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="partials/_handleSignup.php" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Choose an Profile Pic</label>
            <input type="file" class="form-control" id="image" name="image" aria-describedby="emailHelp" required >
          </div>
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" class="form-control" id="signupEmail" name="signupEmail" aria-describedby="emailHelp" required>
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
          </div>
          <div class="mb-3">
            <label for="text" class="form-label">User Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" id="signupPassword" name="signupPassword" required>
          </div>
          <div class="mb-3">
            <label for="text" class="form-label">Confirm Password</label>
            <input type="text" class="form-control" id="signupcPassword" name="signupcPassword" required>
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Your roll</label>
            <input type="text" class="form-control" id="rol" name="rol" >
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">SignedUp</button>
        </div>
      </form>
    </div>
  </div>
</div>