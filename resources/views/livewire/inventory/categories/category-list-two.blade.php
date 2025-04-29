<div>
    <div class="app-content"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            <div class="row">
                <div class="col-md-12 pt-4">
                    <div class="card mb-4">
                        <div class="card-header">
                            <div class="flex gap-4">
                                <h3 class="card-title">Category List</h3>
                                <div class="">
                                    <label for="hs-basic-usage" class="relative inline-block w-11 h-6 cursor-pointer">
                                        <input type="checkbox" id="hs-basic-usage" class="peer sr-only"
                                            wire:model.live='toggleSwitch'
                                            @if ($toggleSwitch == 1) checked @endif>
                                        <span
                                            class="absolute inset-0 bg-gray-200 rounded-full transition-colors duration-200 ease-in-out peer-checked:bg-blue-600 dark:bg-neutral-700 dark:peer-checked:bg-blue-500 peer-disabled:opacity-50 peer-disabled:pointer-events-none"></span>
                                        <span
                                            class="absolute top-1/2  -translate-y-[5px] size-5 bg-white rounded-full shadow-xs transition-transform duration-200 ease-in-out peer-checked:translate-x-[55%] dark:bg-neutral-400 dark:peer-checked:bg-white"></span>
                                    </label>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="button"
                                    class="btn btn-primary text-sm btn-sm radius-8 d-flex align-items-center gap-2"
                                    data-bs-toggle="modal" data-bs-target="#categoryModal"
                                    wire:click.prevent="resetFields">
                                    Add New Category
                                </button>
                            </div>
                        </div> <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered text-center">
                                <thead>
                                    <tr>

                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Date Variable</th>
                                        <th>Array Helper</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $item)
                                        <tr class="align-middle">
                                            <td>{{ $loop->index + 1 }} </td>
                                            <td>{{ $item->name }}</td>

                                            <td>{{ $item->description }}</td>
                                            <td class="">
                                                @if ($item->is_active == 1)
                                                    <span
                                                        class=" text-sm fw-semibold text-success-600 bg-green-500 px-2 py-0.5 rounded-lg text-white">Active</span>
                                                @else
                                                    <span
                                                        class=" text-sm fw-semibold text-danger-600 bg-red-500 px-2 py-0.5 rounded-lg text-white">In
                                                        Active</span>
                                                @endif
                                            </td>
                                            <td>{{ Carbon\Carbon::parse($date_variable)->format('d/m/y') }}</td>
                                            <td>{{ $a['products']['desk']['price'] }}</td>
                                            <td>
                                                <button type="button"
                                                    class="btn btn-warning text-sm btn-sm radius-8 gap-2"
                                                    data-bs-toggle="modal" data-bs-target="#categoryModal"
                                                    wire:click="edit({{ $item->id }})">Edit</button>
                                                <button type="button"
                                                    class="btn btn-danger text-sm btn-sm radius-8 gap-2"
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

    <div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        wire:ignore.self>
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Category</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-6">
                            <label for="name" class="col-form-label">Name <span
                                    class="text-red-500">*</span></label>
                            <input type="text" class="form-control" id="name" wire:model='name'
                                placeholder="Enter Category Name">
                            @error('name')
                                <span class="text-red-500 text-xs">{{ 'You must enter Category name' }}</span>
                            @enderror
                        </div>
                        {{-- <div class="col-6 mb-6">
                            <label for="name" class="col-form-label">Short Form <span class="text-red-500">*</span></label>
                            <input type="text" class="form-control" id="name" wire:model='short_form' placeholder="Enter Short Form">
                            @error('short_form')
                            <span class="text-red-500 text-xs">{{$message}}</span>
                            @enderror
                        </div> --}}
                        <div class="col-12 mb-6">
                            <label for="areaName" class="col-form-label">Description</label>
                            <textarea class="form-control resize-none" rows="3" id="description" wire:model="description"
                                placeholder="Enter the description.."></textarea>
                        </div>
                        <div class="col-12 mb-6">
                            <label for="areaName" class="col-form-label">Created Date</label>
                            <input type="date" class="form-control resize-none" rows="3" id="created_date"
                                wire:model="created_date"></input>
                        </div>
                        <div class="col-12 tw-mt-6">
                            <div class="form-switch switch-primary d-flex align-items-center gap-3">
                                <input class="form-check-input" type="checkbox" role="switch" id="switch1"
                                    wire:model="is_active">
                                <label class="form-check-label line-height-1 fw-medium text-secondary-light"
                                    for="switch1">Is Active ?</label>
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
