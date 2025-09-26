<div class="offcanvas offcanvas-end" id="add-new-user">
    <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title" id="exampleModalLabel">Add New User</h5>
        <button
            type="button"
            class="btn-close text-reset"
            data-bs-dismiss="offcanvas"
            aria-label="Close"></button>
    </div>
    <div class="offcanvas-body flex-grow-1">
        <form class="add-new-record pt-0 row g-2" id="form-add-new-record" onsubmit="return false">
            <div class="col-sm-12">
                <label class="form-label" for="basicFullname">Password</label>
                <div class="input-group input-group-merge">
                    <span id="basicFullname2" class="input-group-text"><i class="bx bx-user"></i></span>
                    <input
                        type="text"
                        id="basicFullname"
                        class="form-control dt-full-name"
                        name="basicFullname"
                        placeholder="John Doe"
                        aria-label="John Doe"
                        aria-describedby="basicFullname2" />
                </div>
            </div>
            <div class="col-sm-12">
                <button type="submit" class="btn btn-primary data-submit me-sm-3 me-1">Logout</button>
                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">Cancel</button>
            </div>
        </form>
    </div>
</div>