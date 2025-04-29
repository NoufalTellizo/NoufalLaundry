<div>
    <div class="app-content"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            <div class="row">
                <div class="col-md-12 pt-4">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Product List</h3>

                            <div class="d-flex justify-content-end">
                                <button type="button"
                                    class="btn btn-primary text-sm btn-sm radius-8 d-flex align-items-center gap-2"
                                    data-bs-toggle="modal" data-bs-target="#productModal" wire:click.prevent="resetFields">
                                    Add New Product
                                </button>
                            </div>
                        </div> <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>SKU</th>
                                        <th>Purchase Price</th>
                                        <th>Opening Stock</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $item)
                                        <tr class="align-middle">
                                            <td>{{ $loop->index + 1 }} </td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->category?->name }}</td>
                                            <td>{{ $item->sku }}</td>
                                            <td>{{ $item->purchase_price }}</td>
                                            <td>{{ $item->opening_stock }}</td>
                                            <td>{{ $item->description }}</td>
                                            <td class="">
                                                @if ($item->is_active == 1)
                                                    <span
                                                        class=" text-sm fw-semibold text-success-600 bg-green-500 px-2 py-0.5 rounded-lg text-white">Active</span>
                                                @else
                                                    <span
                                                        class=" text-sm fw-semibold text-danger-600 bg-red-500 px-2 py-0.5 rounded-lg text-white">In Active</span>
                                                @endif
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-warning text-sm btn-sm radius-8 gap-2" data-bs-toggle="modal"
                                                    data-bs-target="#productModal"
                                                    wire:click="edit({{ $item->id }})">Edit</button>
                                                <button type="button" class="btn btn-danger text-sm btn-sm radius-8 gap-2"
                                                    wire:click.prevent="delete({{ $item->id }})">Delete</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div> <!-- /.card-body -->
                    </div> <!-- /.card -->
                </div> <!-- /.col -->
            </div> <!--end::Row-->
        </div> <!--end::Container-->
    </div>

    <div class="modal fade" id="productModal" tabindex="-1"  aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" >@if($product) Edit Product @else Add Product @endif</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6 mb-6">
                            <label for="name" class="col-form-label">Name <span class="text-red-500">*</span></label>
                            <input type="text" class="form-control"  wire:model='name' placeholder="Enter Category Name">
                            @error('name')
                            <span class="text-red-500 text-xs">{{$message}}</span>
                            @enderror
                        </div>
                        {{-- <div class="col-6 mb-6">
                            <label for="name" class="col-form-label">Unit <span class="text-red-500">*</span></label>
                            <select name="" id=""  wire:model='unit_id' class="form-control">
                                <option value="">Choose Unit</option>
                                @foreach ($units as $item)
                                    <option value="{{ $item->id }}">{{ $item->name}}</option>
                                @endforeach
                            </select>
                            @error('name')
                            <span class="text-red-500 text-xs">{{$message}}</span>
                            @enderror
                        </div> --}}
                        <div class="col-6 mb-6">
                            <label for="name" class="col-form-label">Category <span class="text-red-500">*</span></label>
                            <select name="" id="" wire:model='category_id'  class="form-control">
                                <option value="">Choose Category</option>
                                @foreach ($categories as $item)
                                    <option value="{{ $item->id }}">{{ $item->name}}</option>
                                @endforeach
                            </select>
                            @error('name')
                            <span class="text-red-500 text-xs">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-6 mb-6">
                            <label for="name" class="col-form-label">SKU <span class="text-red-500">*</span></label>
                            <input type="text" class="form-control" wire:model='sku' placeholder="Enter SKU">
                            @error('sku')
                            <span class="text-red-500 text-xs">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-6 mb-6">
                            <label for="name" class="col-form-label">Purchase Price <span class="text-red-500">*</span></label>
                            <input type="text" class="form-control" wire:model='purchase_price' placeholder="Enter Purchase Price">
                            @error('purchase_price')
                            <span class="text-red-500 text-xs">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-6 mb-6">
                            <label for="name" class="col-form-label">Opening Stock</label>
                            <input type="text" class="form-control"  wire:model='opening_stock' placeholder="Enter Opening Stock">
                            @error('opening_stock')
                            <span class="text-red-500 text-xs">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-12 mb-6">
                            <label for="areaName" class="col-form-label">Description</label>
                            <textarea class="form-control resize-none" rows="3" id="description" wire:model="description" placeholder="Enter the description.."></textarea>
                        </div>
                        <div class="col-12 tw-mt-6">
                            <div class="form-switch switch-primary d-flex align-items-center gap-3">
                                <input class="form-check-input" type="checkbox" role="switch" id="switch1" wire:model="is_active">
                                <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="switch1">Is Active ?</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" wire:click.prevent="save">Save</button>
                </div>
            </div>
        </div>
    </div>

</div>
