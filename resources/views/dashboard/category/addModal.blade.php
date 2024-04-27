<div class="modal" id="add">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo iq-card">
            <div class="modal-header">
                <h6 class="modal-title">Create</h6><button aria-label="Close" class="close" data-dismiss="modal"
                    type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                    <div class="card  box-shadow-0 iq-card">
                        <div class="card-header iq-card">
                            <h4 class="card-title mb-1">New Category</h4>
                        </div>
                        <div class="card-body pt-0">
                            <form id="addCategory" >
                                <ul id="error" class="list-unstyled"></ul>

                                <div class="form-group">
                                    <label for="inputName">Category Name</label>
                                    <input type="text" class="form-control" id="inputName" placeholder="Enter Name"
                                        name="name">
                                </div>
                                <div class="form-group">
                                    <label for="inputdetails">Category Details</label>
                                    <input type="text" class="form-control" id="inputdetails" placeholder="Enter Details"
                                        name="details">
                                </div>
                                <div class="form-group mb-0 mt-3 justify-content-end">
                                    <div>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                        <button type="reset" class="btn btn-secondary">Cancel</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
