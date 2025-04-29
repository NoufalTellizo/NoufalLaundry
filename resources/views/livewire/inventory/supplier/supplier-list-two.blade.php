<div>
    <div class="app-content"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            <div class="row">
                <div class="col-md-12 pt-4">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Supplier List</h3>

                            <div class="d-flex justify-content-end">
                                <button type="button"
                                    class="btn btn-primary text-sm btn-sm radius-8 d-flex align-items-center gap-2"
                                    data-bs-toggle="modal" data-bs-target="#supplierModal" wire:click.prevent="resetFields">
                                    Add New Supplier
                                </button>
                            </div>
                        </div> <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Tax Number</th>
                                        <th>Opening Balance</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($suppliers as $item)
                                        <tr class="align-middle">
                                            <td>{{ $loop->index + 1 }} </td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->phone }}</td>
                                            <td>{{ $item->tax_number }}</td>
                                            <td>{{ $item->opening_balance }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->address }}</td>
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
                                                    data-bs-target="#supplierModal"
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

    <div class="modal fade" id="supplierModal" tabindex="-1" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">@if($supplier) Edit Supplier @else Add Supplier @endif</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-6">
                            <label for="name" class="col-form-label">Name <span class="text-red-500">*</span></label>
                            <input type="text" class="form-control" wire:model='name' placeholder="Enter Category Name">
                            @error('name')
                            <span class="text-red-500 text-xs">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-6 mb-6">
                            <label for="name" class="col-form-label">Phone Number <span class="text-red-500">*</span></label>
                            <input type="number" class="form-control" wire:model='phone' placeholder="Enter Short Form">
                            @error('phone')
                            <span class="text-red-500 text-xs">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-6 mb-6">
                            <label for="name" class="col-form-label">Tax Number </label>
                            <input type="text" class="form-control" wire:model='tax_number' placeholder="Enter Tax Number">
                        </div>
                        <div class="col-6 mb-6">
                            <label for="name" class="col-form-label">Opening Balance </label>
                            <input type="number" class="form-control" wire:model='opening_balance' placeholder="Enter Opening Balance">
                            @error('opening_balance')
                            <span class="text-red-500 text-xs">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-6 mb-6">
                            <label for="name" class="col-form-label">Email </label>
                            <input type="text" class="form-control" wire:model='email' placeholder="Enter Email">
                        </div>
                        <div class="col-12 mb-6">
                            <label for="areaName" class="col-form-label">Address</label>
                            <textarea class="form-control resize-none" rows="3" wire:model="address" placeholder="Enter the address.."></textarea>
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
