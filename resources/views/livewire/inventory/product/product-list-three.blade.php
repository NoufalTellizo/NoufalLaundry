<div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 pt-4">
                    <div class="card mb-4">
                        <div class="card-header">
                            <div class="flex items-center gap-4">
                                <h3 class="card-title font-semibold text-2xl">{{ $title }}</h3>
                                <button type="button" class="btn btn-danger text-sm btn-sm radius-8 gap-2"
                                    wire:click.prevent="showUnits()">JSON Show Unit</button>
                                {{-- <div class="flex items-center">
                                    <label for="hs-basic-usage" class="relative inline-block w-11 h-6 cursor-pointer">
                                        <input type="checkbox" id="hs-basic-usage" class="peer sr-only"
                                            wire:model.live='toggleSwitch'
                                            @if ($toggleSwitch == 1) checked @endif>
                                        <span
                                            class="absolute inset-0 bg-gray-200 rounded-full transition-colors duration-200 ease-in-out peer-checked:bg-blue-600 dark:bg-neutral-700 dark:peer-checked:bg-blue-500 peer-disabled:opacity-50 peer-disabled:pointer-events-none"></span>
                                        <span
                                            class="absolute top-1/2 -translate-y-[5px] translate-x-[1px] size-5 bg-white rounded-full shadow-xs transition-transform duration-200 ease-in-out peer-checked:translate-x-[55%] dark:bg-neutral-400 dark:peer-checked:bg-white"></span>
                                    </label>
                                </div> --}}
                                <div class="max-w-sm space-y-3">
                                    <input type="text"
                                        class="py-2 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm disabled:pointer-events-none focus:outline-none border bg-neutral-100 focus:ring-1 focus:ring-neutral-400 transition ease-in-out"
                                        placeholder="Search here..." wire:model.live='search'>
                                </div>
                                <div class="flex items-center">
                                    <select name="" id=""
                                        class="py-2 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:outline-none border bg-neutral-100 focus:ring-1 focus:ring-neutral-400 transition ease-in-out"
                                        wire:model.live='toggleCategory'>
                                        <option value="all">Select Category</option>
                                        @foreach ($this->categories as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="">Opening Balance</label>
                                    <div class="flex items-center gap-2">
                                        <input type="date"
                                            class="py-2 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm disabled:pointer-events-none focus:outline-none border bg-neutral-100 focus:ring-1 focus:ring-neutral-400 transition ease-in-out"
                                            placeholder="from :" wire:model.live='from_date'>
                                        <input type="date"
                                            class="py-2 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm disabled:pointer-events-none focus:outline-none border bg-neutral-100 focus:ring-1 focus:ring-neutral-400 transition ease-in-out"
                                            placeholder="to :" wire:model.live='to_date'>
                                    </div>
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="">Upto Date</label>
                                    <input type="date" wire:model.live = 'dateFilter'
                                        class="py-2 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm disabled:pointer-events-none focus:outline-none border bg-neutral-100 focus:ring-1 focus:ring-neutral-400 transition ease-in-out">
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="">No:of Items</label>
                                    <input type="number" wire:model.live = 'number_of_items'
                                        class="py-2 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm disabled:pointer-events-none focus:outline-none border bg-neutral-100 focus:ring-1 focus:ring-neutral-400 transition ease-in-out">
                                </div>
                            </div>
                            <div class="flex justify-content-end gap-2">
                                @if ($selectedProducts != null)
                                    <button type="button" class="btn btn-warning text-sm btn-sm radius-8 gap-2"
                                        data-bs-toggle="modal" data-bs-target="#productNameEditModal">Edit All</button>
                                    <button type="button" class="btn btn-danger text-sm btn-sm radius-8 gap-2"
                                        wire:click.prevent="deleteSelectedProducts()">Delete All</button>
                                @endif
                                <button type="button"
                                    class="btn btn-primary text-sm btn-sm radius-8 d-flex align-items-center gap-2"
                                    data-bs-toggle="modal" data-bs-target="#productModal"
                                    wire:click.prevent="resetFields">
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
                                        <th>Opening Balance</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($filtered_products as $item)
                                        <tr class="align-middle">
                                            <td class="">
                                                <div class="flex">
                                                    <input type="checkbox"
                                                        class="inline-flex items-center justify-center shrink-0 mt-0.5 border-gray-200 rounded-sm text-blue-600 focus:ring-blue-500 checked:border-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800"
                                                        id="hs-default-checkbox" wire:model.live='selectedProducts'
                                                        value="{{ $item->id }}">
                                                </div>
                                            </td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->category?->name }}</td>
                                            <td>{{ $item->sku }}</td>
                                            <td>{{ $item->purchase_price }}</td>
                                            <td>{{ $item->opening_balance }}</td>
                                            <td>{{ $item->description }}</td>
                                            {{-- <td class="">
                                                @if ($item->is_active == 1)
                                                    <span
                                                        class=" text-sm fw-semibold text-success-600 bg-green-500 px-2 py-0.5 rounded-lg text-white">Active</span>
                                                @else
                                                    <span
                                                        class=" text-sm fw-semibold text-danger-600 bg-red-500 px-2 py-0.5 rounded-lg text-white">In
                                                        Active</span>
                                                @endif
                                            </td> --}}
                                            <td>
                                                <label class="relative inline-flex items-center cursor-pointer">
                                                    <input type="checkbox" value="" class="sr-only peer"
                                                        wire:click='changeStatus({{ $item->id }})'
                                                        @if ($item->is_active == 1) checked @endif>
                                                    <div
                                                        class="w-9 h-5 bg-gray-200 hover:bg-gray-300 peer-focus:outline-0 peer-focus:ring-transparent rounded-full peer transition-all ease-in-out duration-500 peer-checked:after:translate-x-[50%] peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-indigo-600 hover:peer-checked:bg-indigo-700">
                                                    </div>
                                                </label>
                                            </td>
                                            <td>{{ $item->created_at->format('Y-m-d') }}</td>
                                            <td>
                                                <button type="button"
                                                    class="btn btn-warning text-sm btn-sm radius-8 gap-2"
                                                    data-bs-toggle="modal" data-bs-target="#productModal"
                                                    wire:click="edit({{ $item->id }})">Edit</button>

                                                <button type="button"
                                                    class="btn btn-danger text-sm btn-sm radius-8 gap-2"
                                                    wire:click.prevent="delete({{ $item->id }})">Delete</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="productModal" tabindex="-1" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">
                        @if ($products)
                            Edit Unit
                        @else
                            Add Unit
                        @endif
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6 mb-6">
                            <label for="name" class="col-form-label">Name <span
                                    class="text-red-500">*</span></label>
                            <input type="text" class="form-control" id="name" wire:model='name'
                                placeholder="Enter Product Name">
                            @error('name')
                                <span class="text-red-500 text-xs">{{ 'You must enter Product Name' }}</span>
                            @enderror
                        </div>
                        <div class="col-6 mb-6">
                            <label for="category_id" class="col-form-label">Category <span
                                    class="text-red-500">*</span></label>
                            <select name="" id="" class="form-control" wire:model='category_id'>
                                <option value="">Choose Category</option>
                                @foreach ($categories as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-6 mb-6">
                            <label for="sku" class="col-form-label">SKU <span
                                    class="text-red-500">*</span></label>
                            <input type="text" class="form-control" wire:model='sku' placeholder="Enter SKU">
                            @error('sku')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-6 mb-6">
                            <label for="purchase_price" class="col-form-label">Purchase Price <span
                                    class="text-red-500">*</span></label>
                            <input type="text" class="form-control" wire:model='purchase_price'
                                placeholder="Enter Purchase Price">
                            @error('purchase_price')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-6 mb-6">
                            <label for="opening_balance" class="col-form-label">Opening Balance </label>
                            <input type="text" class="form-control" wire:model='opening_balance'
                                placeholder="Enter Opening Balance">
                            @error('opening_balance')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12 mb-6">
                            <label for="description" class="col-form-label">Description</label>
                            <textarea class="form-control resize-none" rows="3" wire:model="description"
                                placeholder="Enter the description.."></textarea>
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
    <div class="modal fade" id="productNameEditModal" tabindex="-1" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">
                        @if ($products)
                            Edit Unit
                        @else
                            Add Unit
                        @endif
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-6">
                            <label for="name" class="col-form-label">Name <span
                                    class="text-red-500">*</span></label>
                            <input type="text" class="form-control" id="name" wire:model='all_name'
                                placeholder="Enter Product Name">
                            @error('all_name')
                                <span class="text-red-500 text-xs">{{ 'You must enter the Name' }}</span>
                            @enderror
                        </div>
                        {{-- <div class="col-6 mb-6">
                            <label for="category_id" class="col-form-label">Category <span
                                    class="text-red-500">*</span></label>
                            <select name="" id="" class="form-control" wire:model='category_id'>
                                <option value="">Choose Category</option>
                                @foreach ($categories as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-6 mb-6">
                            <label for="sku" class="col-form-label">SKU <span
                                    class="text-red-500">*</span></label>
                            <input type="text" class="form-control" wire:model='sku' placeholder="Enter SKU">
                            @error('sku')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-6 mb-6">
                            <label for="purchase_price" class="col-form-label">Purchase Price <span
                                    class="text-red-500">*</span></label>
                            <input type="text" class="form-control" wire:model='purchase_price'
                                placeholder="Enter Purchase Price">
                            @error('purchase_price')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-6 mb-6">
                            <label for="opening_balance" class="col-form-label">Opening Balance </label>
                            <input type="text" class="form-control" wire:model='opening_balance'
                                placeholder="Enter Opening Balance">
                            @error('opening_balance')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12 mb-6">
                            <label for="description" class="col-form-label">Description</label>
                            <textarea class="form-control resize-none" rows="3" wire:model="description"
                                placeholder="Enter the description.."></textarea>
                        </div> --}}
                        <div class="col-12 tw-mt-6">
                            <div class="form-switch switch-primary d-flex align-items-center gap-3">
                                <input class="form-check-input" type="checkbox" role="switch" id="switch1"
                                    wire:model="all_is_active">
                                <label class="form-check-label line-height-1 fw-medium text-secondary-light"
                                    for="switch1">Is Active ?</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" wire:click.prevent="updateAllName">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>
