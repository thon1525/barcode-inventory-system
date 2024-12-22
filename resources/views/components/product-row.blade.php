@props(['product', 'categories', 'suppliers'])

<tr>
    <th scope="row">{{ $product->id }}</th>
    <td>
        <img src="{{ $product->product_img ? url('upload/products/'.$product->product_img) : url('upload/noimage.jpg') }}" width="50" height="50" alt="Product Image">
    </td>
    <td>{{ $product->product_name }}</td>
    <td>{{ $product->product_price }}$</td>
    <td>
        <p class="{{ $product->product_qty > 5 && $product->product_qty <= 10 ? 'bg-warning text-dark' : ($product->product_qty <= 5 ? 'bg-danger text-white' : '') }}" style="padding: 5px; border-radius: 5px;">
            {{ $product->product_qty > 5 ? $product->product_qty : "Only $product->product_qty Left!" }}
        </p>
    </td>
    <td>{{ $categories->firstWhere('catid', $product->category_id)?->category_name ?? 'N/A' }}</td>
    <td>{!! DNS1D::getBarcodeHTML("$product->product_code", 'C128') !!} <span class="text-secondary">{{ $product->product_code }}</span></td>
    <td>{{ $suppliers->firstWhere('id', $product->supplier_id)?->supplier_name ?? 'N/A' }}</td>
    <td>
        <div class="d-flex justify-content-around">
            <form action="{{ route('product.view_product', $product->id) }}" method="get">@csrf
                <button class="btn btn-primary" type="submit">Edit</button>
            </form>
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#ModalDelete{{ $product->id }}">Delete</button>

            <form action="{{ route('product.destroy', $product->id) }}" method="POST">
                @method('delete')
                @csrf
                <div class="modal fade" id="ModalDelete{{ $product->id }}" tabindex="-1" aria-labelledby="ModalDeleteLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="ModalDeleteLabel">Delete product</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">Are you sure you want to delete <b>{{ $product->product_name }}</b>?</div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-danger">Confirm</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </td>
</tr>
