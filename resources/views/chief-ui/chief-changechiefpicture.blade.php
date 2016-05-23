@extends('layout-chief')

@section('content')

 <!-- Load Javascript Libraries (AngularJS, JQuery, Bootstrap) -->
    <script src="{{ asset('bower_components/angular/angular.min.js') }}"></script>

    <!-- AngularJS Application Scripts -->
    <script src="{{ asset('app/app.js') }}"></script>

    <!-- AngularJS Application Scripts -->


    <!-- Angular Utils Pagination -->
    <script src="{{ asset('bower_components/angularUtils-pagination/dirPagination.js') }}"></script>

    <br>
    <div ng-app="unitScorecardApp">
       <form action="{{url('change_picture')}}" method="post" enctype="multipart/form-data">
            <div class="wrap">
                <div class="row">           
                    <div class="col-lg-12">
                        <div class="panel panel-warning measures-custom-panel">
                            <div class="panel-heading measures-custom-heading">
                                <i class="fa fa-circle-o-notch fa-5x"></i> <h2><b>{{ $chief_user->chief->ChiefAbbreviation }} Change Chief Picture</b></h2>   <i ng-show="loading" class="fa fa-spinner fa-spin"></i>
                            </div>
                            <div class="panel-body">
                                 <label> Current Chief Picture:</label>
                                  @if (Session::has('upload-error'))
                                   <div class="alert alert-danger"><span class="fa fa-warning fa-fw"></span> {{ Session::get('upload-error') }}</div>
                                    @endif
                                    @if (Session::has('upload-success'))
                                   <div class="alert alert-success"><span class="fa fa-file-picture-o fa-fw"></span> {{ Session::get('upload-success') }}</div>
                                    @endif
                                 <img class="img-responsive dashboard-custom-pictureabb" 
                                src="{{ asset('uploads/chiefpictures/cropped/'.''.$chief_user->chief->PicturePath.'') }}">
                                <hr>

                                    <label style="color:orange">*Choose a file: (max 1mb)</label>
                                    <input type="file" name="picturepath" >

                                    <input type="hidden" name="chiefid" value="{{$chief_user->chief->ChiefID}}">
                              

                                   

                                <br><br><button type="submit" class="btn btn-success btn-sm ">Save Changes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>    
    </div>

@endsection