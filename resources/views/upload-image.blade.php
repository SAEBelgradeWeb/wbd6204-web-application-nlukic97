@extends('layouts.app')

@section('content')
    <div class="container">
        <div> <!--You had 'viewModal' here.-->
            <div class="row d-flex justify-content-center">

                <div id="box" class="col-lg-6 col-md-8 col-10 bg-white pt-3">
                    <form action='/upload-image' method="POST" enctype="multipart/form-data"
                          id="box" class="col-lg-6 col-md-8 col-10 bg-white pt-3"
                    >
                        @csrf
                        <!-- image updating field -->
                        <div class="input-group mb-3">
                            <input type="file" name='avatar' id="avatar" class="form-control d-inline-block">
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary mb-3">Save</button>
                            <a href="/myAccount"><span class="btn btn-secondary mb-3">Cancel</span></a>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
