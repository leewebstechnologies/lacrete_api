@extends('admin.master')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<div class="content">

    <!-- Start Content-->
    <div class="container-xxl">

        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Edit Video</h4>
            </div>
        </div>

        <!-- Form -->
        <div class="row">
            <div class="col-xl-12">
                <div class="card">

                    <div class="card-header">
                        <h5 class="card-title mb-0">Update Video</h5>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('update.video') }}"
                              method="post"
                              class="row g-3"
                              enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="id" value="{{ $video->id }}">

                            <div class="col-md-6">
                                <label class="form-label">Change Video (Optional)</label>
                                <input type="file"
                                       name="video"
                                       class="form-control"
                                       id="video"
                                       accept="video/*">
                            </div>

                            <div class="col-md-6">
                                <video id="showVideo"
                                       controls
                                       style="width: 100%; max-height: 250px;">
                                    <source src="{{ asset('storage/' . $video->video) }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>

                            <div class="col-12">
                                <button class="btn btn-primary" type="submit">
                                    Update Video
                                </button>
                            </div>

                        </form>
                    </div> <!-- end card-body -->

                </div>
            </div>
        </div>

    </div> <!-- container -->

</div> <!-- content -->

<script>
    $(document).ready(function () {
        $('#video').change(function (e) {
            let file = e.target.files[0];
            if (file) {
                let url = URL.createObjectURL(file);
                $('#showVideo').attr('src', url);
            }
        });
    });
</script>

@endsection
