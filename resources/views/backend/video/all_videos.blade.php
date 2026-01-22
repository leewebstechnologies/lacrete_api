@extends('admin.master')
@section('admin')

<div class="content">

    <!-- Start Content-->
    <div class="container-xxl">

        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">All Videos</h4>
            </div>

            <div class="text-end">
                <ol class="breadcrumb m-0 py-0">
                    <a href="{{ route('add.video') }}" class="btn btn-primary">Add Video</a>
                </ol>
            </div>
        </div>

        <!-- Datatables -->
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        <table id="datatable" class="table table-bordered dt-responsive table-responsive nowrap">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Video</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($videos as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>

                                        <td>
                                            <video width="200" height="120" controls>
                                                <source src="{{ asset('storage/' . $item->video) }}" type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>
                                        </td>

                                        <td>
                                            <a href="{{ route('edit.video', $item->id) }}" class="btn btn-success btn-sm">
                                                Edit
                                            </a>

                                            <a href="{{ route('delete.video', $item->id) }}"
                                               class="btn btn-danger btn-sm"
                                               id="delete">
                                                Delete
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

    </div> <!-- container -->

</div> <!-- content -->

@endsection
