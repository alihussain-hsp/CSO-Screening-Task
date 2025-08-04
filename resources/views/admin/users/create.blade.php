<div class="modal-body">
    <form id="createUserForm" class="ajax-form" method="POST" autocomplete="off" onkeydown="return event.key != 'Enter';">
        @csrf
        <div class="form-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control form-control-lg" id="name" name="name"
                            autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control form-control-lg" id="email" name="email"
                            autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>password</label>
                        <input type="password" class="form-control form-control-lg" id="password" name="password"
                            autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Confirm password</label>
                        <input type="password" class="form-control form-control-lg" id="password-confirmation"
                            name="password_confirmation" autocomplete="off">
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <button type="button" class="btn btn-primary" id="create-user">Create</button>
</div>
