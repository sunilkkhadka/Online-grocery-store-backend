@extends('admin.admin_master')
@section('admin')
    <div class="page-wrapper">
        <div class="page-content">

            <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
                {{-- <div class="col">
                    <div class="card radius-10 bg-gradient-deepblue">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <h5 class="mb-0 text-white">9526</h5>
                                <div class="ms-auto">
                                    <i class='bx bx-cart fs-3 text-white'></i>
                                </div>
                            </div>
                            <div class="progress my-3 bg-light-transparent" style="height:3px;">
                                <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="d-flex align-items-center text-white">
                                <p class="mb-0">Total Orders</p>
                                <p class="mb-0 ms-auto">+4.2%<span><i class='bx bx-up-arrow-alt'></i></span></p>
                            </div>
                        </div>
                    </div>
                </div> --}}
                {{-- <div class="col">
                    <div class="card radius-10 bg-gradient-orange">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <h5 class="mb-0 text-white">$8323</h5>
                                <div class="ms-auto">
                                    <i class='bx bx-dollar fs-3 text-white'></i>
                                </div>
                            </div>
                            <div class="progress my-3 bg-light-transparent" style="height:3px;">
                                <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="d-flex align-items-center text-white">
                                <p class="mb-0">Total Revenue</p>
                                <p class="mb-0 ms-auto">+1.2%<span><i class='bx bx-up-arrow-alt'></i></span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card radius-10 bg-gradient-ohhappiness">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <h5 class="mb-0 text-white">6200</h5>
                                <div class="ms-auto">
                                    <i class='bx bx-group fs-3 text-white'></i>
                                </div>
                            </div>
                            <div class="progress my-3 bg-light-transparent" style="height:3px;">
                                <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="d-flex align-items-center text-white">
                                <p class="mb-0">Visitors</p>
                                <p class="mb-0 ms-auto">+5.2%<span><i class='bx bx-up-arrow-alt'></i></span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card radius-10 bg-gradient-ibiza">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <h5 class="mb-0 text-white">5630</h5>
                                <div class="ms-auto">
                                    <i class='bx bx-envelope fs-3 text-white'></i>
                                </div>
                            </div>
                            <div class="progress my-3 bg-light-transparent" style="height:3px;">
                                <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="d-flex align-items-center text-white">
                                <p class="mb-0">Messages</p>
                                <p class="mb-0 ms-auto">+2.2%<span><i class='bx bx-up-arrow-alt'></i></span></p>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
            <!--end row-->





            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h5 class="mb-0">Orders Summary</h5>
                        </div>
                        <div class="font-22 ms-auto"><i class="bx bx-dots-horizontal-rounded"></i>
                        </div>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Product id</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Quantity</th>
                                    <th>Remark</th>
                                    <th>Price</th>
                                    <th>Special Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($i = 1)
                                @foreach ($product_datas as $item)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="recent-product-img">
                                                    <img src=" {{ $item->image }} " alt="">
                                                </div>

                                            </div>
                                        </td>


                                        <td>{{ $item->title }}</td>
                                        <td>{{ $item->description }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ $item->remark }}</td>
                                        <td>{{ $item->price }}</td>
                                        <td>{{ $item->special_price }}</td>
                                        <td>
                                            <a href="{{ route('product.edit', $item->id) }}" class="btn btn-info">Edit
                                            </a>
                                            <a href="{{ route('product.delete', $item->id) }}" class="btn btn-danger"
                                                id="delete">Delete </a>
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
@endsection
