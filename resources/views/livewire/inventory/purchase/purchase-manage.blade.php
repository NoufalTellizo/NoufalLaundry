<div class="w-full p-2 h-[calc(100vh-4rem)] overflow-hidden">
    <div class="card">
        <div class="flex flex-col justify-between">
            <div class="">
                <div class="card-body flex flex-col">
                    <div class="flex items-center justify-between">
                        <div class="flex gap-2 relative">
                            <div class="flex flex-col">
                                <input type="text"
                                    class="p-2 rounded-lg border border-gray-400 focus:outline-none focus:ring focus:ring-gray-100 placeholder:text-sm placeholder:text-black/70"
                                    placeholder="{{ $selected_supplier ? $selected_supplier->name : 'Select A Supplier...' }}"
                                    wire:model.live='search_suppliers'>
                                @if (!empty($search_suppliers && count($filtered_suppliers) > 0))
                                    <div class="absolute top-[100%] left-0 w-full z-20 bg-white rounded-lg">
                                        @foreach ($filtered_suppliers as $item)
                                            <li class="hover:cursor-pointer gap-1 dropdown-item px-3 py-1 rounded bg-neutral-50 hover:bg-neutral-200"
                                                wire:click='select_supplier({{ $item->id }})'>
                                                {{ $item->name }}</li>
                                        @endforeach
                                    </div>
                                @elseif(!empty($search_suppliers))
                                    <div class="px-3 py-1 w-full rounded-lg bg-neutral-200">
                                        No Results Found
                                    </div>
                                @endif
                            </div>
                            <div class="">
                                <button class="border bg-neutral-100 hover:bg-neutral-300 p-2 rounded-lg text-blue-500"
                                    data-bs-toggle="modal" data-bs-target="#supplierModal"
                                    wire:click.prevent='resetSupplierInputFields'>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-6" viewBox="0 0 24 24">
                                        <g fill="none">
                                            <path
                                                d="m12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.018-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z" />
                                            <path fill="currentColor"
                                                d="M16 14a5 5 0 0 1 5 5v1a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-1a5 5 0 0 1 5-5zm4-6a1 1 0 0 1 1 1v1h1a1 1 0 1 1 0 2h-1v1a1 1 0 1 1-2 0v-1h-1a1 1 0 1 1 0-2h1V9a1 1 0 0 1 1-1m-8-6a5 5 0 1 1 0 10a5 5 0 0 1 0-10" />
                                        </g>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <button class="border bg-neutral-100 hover:bg-neutral-300 px-2 py-1 rounded-lg text-sm">
                                Clear All
                            </button>
                            <button
                                class="border bg-blue-600 hover:bg-blue-800 text-white px-2 py-1 rounded-lg focus:ring focus:ring-gray-100 text-sm">
                                Save
                            </button>
                        </div>
                    </div>
                    <div class="flex items-center justify-between mt-2">
                        <div class="flex items-center gap-2">
                            <input type="text"
                                class="p-2 rounded-lg border border-gray-400 focus:outline-none focus:ring focus:ring-gray-100 placeholder:text-sm placeholder:text-black/70"
                                placeholder="#Invoice Number">
                            <input type="date"
                                class="p-2 rounded-lg border border-gray-400 focus:outline-none text-neutral-400 ">
                        </div>
                        <div class="flex items-center gap-2">
                            <button class="border bg-neutral-100 hover:bg-neutral-300 px-2 py-1 rounded-lg text-sm">
                                3
                            </button>
                            <button class="border bg-neutral-100 hover:bg-neutral-300 px-2 py-1 rounded-lg text-sm">
                                2025-10-14
                            </button>
                        </div>
                    </div>
                    <div class="mt-2 relative">
                        <input type="text"
                            class="p-2 rounded-lg border max-h-60 border-gray-400 focus:outline-none w-full focus:ring focus:ring-gray-100 placeholder:text-sm placeholder:text-black/70"
                            placeholder="{{ $selected_product ? $selected_product->name : 'Select A Product...' }}"
                            wire:model.live='search_products'>
                        @if (!empty($search_products && count($filtered_products) > 0))
                            <div class="absolute top-[100%] left-0 w-full z-20 bg-white rounded-lg">
                                @foreach ($filtered_products as $item)
                                    <li class="hover:cursor-pointer gap-1 dropdown-item px-3 py-1 rounded bg-neutral-50 hover:bg-neutral-200"
                                        wire:click='select_product({{ $item->id }})'>
                                        {{ $item->name }}</li>
                                @endforeach
                            </div>
                        @elseif(!empty($search_products))
                            <div class="px-3 py-1 w-full rounded-lg bg-neutral-200">
                                No Results Found
                            </div>
                        @endif
                    </div>
                </div>
                <div class="card-body p-2">
                    <div class="table-responsive scroll-sm py-1.5 px-3 overflow-y-auto h-[calc(100vh-33rem)]">
                        <table class="table bordered-table sm-table mb-0 ">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col" class="">Name</th>
                                    <th scope="col" class="">OTY</th>
                                    <th scope="col" class="">Rate</th>
                                    <th scope="col" class="text-center">Discount</th>
                                    <th scope="col" class="text-center">Tax</th>
                                    <th scope="col" class="text-center">Total</th>
                                    <th scope="col" class="text-center"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cart as $index => $item)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $item['product']['name'] }}</td>
                                        <td>
                                            <input type="number" wire:model.live ='cart.{{ $index }}.quantity' wire:input='calculateTotal()'
                                                class="py-1 px-2 text-center rounded-lg border border-gray-400 focus:outline-none w-full focus:ring focus:ring-gray-100">
                                        </td>
                                        <td>
                                            <input type="number" wire:model.live ='cart.{{ $index }}.rate' wire:input='calculateTotal()'
                                                class="py-1 px-2 text-center rounded-lg border border-gray-400 focus:outline-none w-full focus:ring focus:ring-gray-100">
                                        </td>
                                        <td>
                                            <input type="number" wire:model.live ='cart.{{ $index }}.discount' wire:input='calculateTotal()'
                                                class="py-1 px-2 text-center rounded-lg border border-gray-400 focus:outline-none w-full focus:ring focus:ring-gray-100">
                                        </td>
                                        <td class="text-center">
                                            Tax%
                                        </td>
                                        <td class="text-center">
                                            <span class="font-semibold">{{ $item['total'] }}</span>
                                        </td>
                                        <td class="text-center">
                                            <div class="d-flex align-items-center gap-10 justify-content-center">
                                                <button
                                                    class="border bg-red-100 hover:bg-red-300 p-2 rounded-full text-red-700">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4"
                                                        viewBox="0 0 24 24">
                                                        <path fill="currentColor"
                                                            d="M7.616 20q-.672 0-1.144-.472T6 18.385V6H5V5h4v-.77h6V5h4v1h-1v12.385q0 .69-.462 1.153T16.384 20zM17 6H7v12.385q0 .269.173.442t.443.173h8.769q.23 0 .423-.192t.192-.424zM9.808 17h1V8h-1zm3.384 0h1V8h-1zM7 6v13z" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class=" flex justify-between">
                <div class="p-2 flex flex-col gap-2">
                    <div class="flex items-center gap-2">
                        <div class="flex flex-col gap-1">
                            <label for="" class="text-sm font-semibold">Paid Amount <span
                                    class="text-sm text-red-500">*</span></label>
                            <input type="text"
                                class="w-full p-2 rounded-lg border border-gray-400 focus:outline-none focus:ring focus:ring-gray-100 placeholder:text-sm placeholder:text-black/70"
                                placeholder="#Invoice Number">
                        </div>
                        <div class="flex flex-col gap-1">
                            <label for="" class="text-sm font-semibold">Payment Method <span
                                    class="text-sm text-red-500">*</span></label>
                            <select name="" id=""
                                class="w-full p-2 rounded-lg border border-gray-400 focus:outline-none focus:ring focus:ring-gray-100">
                                <option value="">Choose Payment Method</option>
                                <option value="1">Cash</option>
                                <option value="2">Card</option>
                                <option value="3">UPI</option>
                                <option value="4">Cheque</option>
                                <option value="5">Bank Transfer</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="flex flex-col gap-1">
                            <label for="" class="text-sm font-semibold">Note/Remark</label>
                            <textarea type="text"
                                class="w-full px-3 py-2 rounded-lg border border-gray-400 focus:outline-none focus:ring focus:ring-gray-100 placeholder:text-sm resize-none placeholder:text-black/70"
                                placeholder="Enter Note/Remark"></textarea>
                        </div>
                        <div class="flex flex-col gap-1">
                            <label for="" class="text-sm font-semibold">Payment Remark</label>
                            <textarea type="text"
                                class="w-full px-3 py-2 rounded-lg border border-gray-400 focus:outline-none focus:ring focus:ring-gray-100 placeholder:text-sm resize-none placeholder:text-black/70"
                                placeholder="Enter Payment Remark"></textarea>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col gap-1 px-5">
                    <div class="flex justify-between gap-52">
                        <span>Sub Total</span>
                        <span>{{ $cart_data['sub_total'] ?? 0}}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Discount</span>
                        <span>{{ $cart_data['discount'] ?? 0}}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Taxable Amount</span>
                        <span>{{ $cart_data['taxable-amount'] ?? 0}}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Tax Amount</span>
                        <span>{{ $cart_data['tax_amount'] ?? 0}}</span>
                    </div>
                    <div class="flex justify-between mt-2">
                        <span class="text-xl font-semibold">Gross Total</span>
                        <span class="text-xl font-bold">{{ $cart_data['total'] ?? 0}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="supplierModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Supplier</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6 mb-6">
                            <label for="name" class="col-form-label">Name <span
                                    class="text-red-500">*</span></label>
                            <input type="text" class="form-control" id="name" wire:model='name'
                                placeholder="Enter Category Name">
                            @error('name')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-6 mb-6">
                            <label for="name" class="col-form-label">Phone <span
                                    class="text-red-500">*</span></label>
                            <input type="number" class="form-control" id="name" wire:model='phone'
                                placeholder="Enter Phone Number">
                            @error('phone')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-6 mb-6">
                            <label for="name" class="col-form-label">Tax Number</label>
                            <input type="text" class="form-control" id="name" wire:model='tax_number'
                                placeholder="Enter Tax Number">
                            @error('tax_number')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-6 mb-6">
                            <label for="name" class="col-form-label">Opening Balance</label>
                            <input type="number" class="form-control" id="name" wire:model='opening_balance'
                                placeholder="Enter Opening Balance">
                            @error('opening_balance')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-6 mb-6">
                            <label for="name" class="col-form-label">Email</label>
                            <input type="email" class="form-control" id="name" wire:model='email'
                                placeholder="Enter Email">
                            @error('email')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12 mb-6">
                            <label for="areaName" class="col-form-label">Address</label>
                            <textarea class="form-control resize-none" rows="3" id="description" wire:model="address"
                                placeholder="Enter the address.."></textarea>
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
