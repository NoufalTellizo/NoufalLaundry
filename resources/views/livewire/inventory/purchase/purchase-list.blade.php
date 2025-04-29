<div>
    <div class="app-content"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            <div class="row">
                <div class="col-md-12 pt-4">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Purchase List</h3>

                            <div class="d-flex justify-content-end">
                                <a href="{{ route('inventory.purchase.manage') }}"
                                    class="btn btn-primary text-sm btn-sm radius-8 d-flex align-items-center gap-2">
                                    Add New Purchase
                                </a>
                            </div>
                        </div> <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th class="text-start">Purchase Info</th>
                                        <th>Supplier</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($purchases as $item)
                                        <tr class="align-middle">
                                            <td class="">
                                                <div class="flex flex-col text-start">
                                                    <span class="">Purchase No: <span class="font-semibold">{{ $item->purchase_number}}</span></span>
                                                    <span>Purchase Date: <span class="font-semibold">{{ \Carbon\Carbon::parse($item->purchase_date)->format('Y-m-d')}}</span></span>
                                                </div>
                                            </td>
                                            <td>{{ $item->supplier_name }}</td> 
                                            <td>{{ $item->total }}</td> 
                                            <td class="">
                                                @if ($item->status == 1)
                                                    <span
                                                        class=" text-sm fw-semibold text-success-600 bg-green-500 px-2 py-0.5 rounded-lg text-white">Completed</span>
                                                @else
                                                    <span
                                                        class=" text-sm fw-semibold text-danger-600 bg-red-500 px-2 py-0.5 rounded-lg text-white">Pending</span>
                                                @endif
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-warning text-sm btn-sm radius-8 gap-2" data-bs-toggle="modal"
                                                    data-bs-target="#productModal"
                                                    wire:click="edit({{ $item->id }})">Edit</button>
                                                <button type="button"  class="btn btn-danger text-sm btn-sm radius-8 gap-2"
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
</div>
