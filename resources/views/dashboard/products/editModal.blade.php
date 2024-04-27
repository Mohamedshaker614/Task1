<div class="modal" id="edit-{{$product->id}}">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo iq-card">
            <div class="modal-header">
                <h6 class="modal-title">Edit</h6><button
                    aria-label="Close" class="close" data-dismiss="modal"
                    type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                    <div class="card  box-shadow-0 iq-card">
                        <div class="card-header iq-card">
                            <h4 class="card-title mb-1">Edit Product</h4>
                        </div>
                        <div class="card-body pt-0">
                            <form class="updateProduct" data-id="{{$product->id}}" id="updateProduct-{{$product->id}}">
                                <ul id="error-{{$product->id}}" class="list-unstyled"></ul>

                                <div class="form-group" >
                                    <label for="name">Product Name</label>
                                    <input type="text" class="form-control"placeholder="Enter Name" name="name"
                                        id="name" value="{{ $product->name }}">
                                </div>
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="number" class="form-control" id="price"
                                        placeholder="Price" name="price" value="{{ $product->price }}">
                                </div>
                                <div class="form-group">
                                    <label for="Brand">Brand</label>
                                    <input type="text" class="form-control" id="Brand"
                                        placeholder="Brand" name="brand" value="{{ $product->brand }}">
                                </div>
                                <div class="form-group">
                                    <label for="image">Upload Image</label>
                                    <input type="file" class="form-control" id="image" aria-describedby="emailHelp"
                                        placeholder="Upload File" name="image"
                                        data-default-file="{{ asset($product->image) }}">
                                </div>
                                <div class="form-group">
                                    <label for="Details">Details</label>
                                    <input type="text" class="form-control" id="Details"
                                        placeholder="Details" name="details" value="{{ $product->details }}">
                                </div>
                                <div class="form-group col-lg-6">
                                    <p class="mg-b-10">Single Select</p>
                                    <select class="form-control" name="category_id">
                                        <option value="{{ $product->category_id }}">{{ $product->category->name }}
                                        </option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-0 mt-3 justify-content-end">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <input type="submit" class="btn btn-primary" value="Save changes" name="submit">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
