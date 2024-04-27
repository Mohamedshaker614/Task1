<tr id="{{ $product->id }}">
    <th scope="row">{{ $product->id }}</th>
    <td>{{ $product->name }}</td>
    <td>{{ $product->category->name }}</td>
    <td>{{ $product->price }}</td>
    <td>{{ $product->brand }}</td>
    <td>
        <img src="{{ $product->image_url }}" width ="100px" height="100px">
    </td>
    <td>{{ $product->details }}</td>
    <td>
        <div class="row">
            <div class="col-sm-6">
                <button class="btn btn-primary btn-block edit" data-route="{{url('dashboard/products/'.$product->id.'/edit')}}" data-toggle="modal" data-target="#edit">Edit <i class="ri-edit-fill"></i> </button>
            </div>
            <div class="col-sm-6">
                <button class="btn btn-danger btn-block delete" data-route="{{url('dashboard/products/'.$product->id)}}">Delete <i class="ri-delete-fill"></i> </button>
            </div>
        </div>
    </td>
</tr>
