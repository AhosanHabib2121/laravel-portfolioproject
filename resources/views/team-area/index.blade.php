{{-- extends here --}}
@extends('master-page.dashboard_main_page')

{{-- head title content here --}}
@section('dashboard_bar')
    Team Area
@endsection

{{-- main content here --}}
@section('content')
    <div class="container">
        {{-- team header area start here --}}
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    {{-- team header data add here --}}
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header bg-secondary">
                                <h4 class="text-white">Team Header Data</h4>
                            </div>
                            <div class="card-body">
                                @if (session('team_head_update_message'))
                                    <div class="alert alert-success">
                                        {{session('team_head_update_message')}}
                                    </div>
                                @endif
                                <form action="{{route('team.header',$team_header_all->id)}}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Header Title</label>
                                                <input type="text" name="header_title" value="{{$team_header_all->header_title}}" class="form-control @error('header_title') is-invalid @enderror" style="border-color:rgb(79, 74, 143)">
                                                @error('header_title')
                                                    <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Header Subtitle</label>
                                                <input type="text" name="header_subtitle" value="{{$team_header_all->header_subtitle}}" class="form-control @error('header_subtitle') is-invalid @enderror" style="border-color:rgb(79, 74, 143)">
                                                @error('header_subtitle')
                                                    <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-success btn-square" type="submit">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- team header area end here --}}

        {{-- team data add here --}}
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-secondary">
                        <h4 class="text-white">Team Data Add</h4>
                    </div>
                    <div class="card-body">
                        @if (session('photo_success_message'))
                            <div class="alert alert-success">
                                {{session('photo_success_message')}}
                            </div>
                        @endif
                        <form action="{{route('team.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" style="border-color:rgb(79, 74, 143)">
                                        @error('title')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Subtitle</label>
                                        <input type="text" name="subtitle" class="form-control @error('subtitle') is-invalid @enderror" style="border-color:rgb(79, 74, 143)">
                                        @error('subtitle')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Photo</label>
                                        <input type="file" name="photo" class="form-control @error('photo') is-invalid @enderror" style="border-color:rgb(79, 74, 143)" onchange="readURL(this);">
                                        @error('photo')
                                            <span class="text-danger">{{$message}}</span><br>
                                        @enderror
                                        <img class="hidden mt-2" id="team_photo_viewer" style="width: 100px;height:auto;" src="#" alt="your image" /><br>
                                        <small>size:700x892</small><br>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-success btn-square" type="submit">Add</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- team data list here --}}
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-secondary">
                        <h4 class="card-title text-white">Team Data list</h4>
                        {{--recycle info code start here --}}
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-trash fa-2x"></i></button>
                        <div class="modal fade" id="exampleModalCenter">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Deleted Team</h5>
                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body text-black table-responsive">
                                        <table id="deletedTeam_table" class="table table-bordered">
                                            <thead class="table-inverse">
                                                <tr>
                                                    <th>Serial NO.</th>
                                                    <th>Title</th>
                                                    <th>Subtitle</th>
                                                    <th>photo</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($team_delete_all as $team_delete )
                                                    <tr>
                                                        <td>{{$loop->index +1}}</td>
                                                        <td>{{$team_delete->title}}</td>
                                                        <td>{{$team_delete->subtitle}}</td>
                                                        <td>
                                                            <img src="{{$team_delete->photo}}" style="width:100px;height:150px" alt="not found">
                                                        </td>
                                                        <td>
                                                            <div class="btn-group mb-2">
                                                                <a href="{{route('team_restore',$team_delete->id)}}" type="button" class="btn btn-success btn-square btn-xs">Restore</a>
                                                                <a href="{{route('force_delete',$team_delete->id)}}" type="button" class="btn btn-danger btn-square btn-xs">Permanent Delete</a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr class="text-center text-danger">
                                                        <td colspan="50">No data to show</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--recycle info code end here --}}
                    </div>
                    <div class="card-body">
                        @if (session('delete_message'))
                            <div class="alert alert-danger">
                                {{session('delete_message')}}
                            </div>
                        @endif
                        <div class="table-responsive">
                            <table id="teamData_table" class="table table-responsive-md">
                                <thead>
                                    <tr>
                                        <th>Serial NO.</th>
                                        <th>Title</th>
                                        <th>Subtitle</th>
                                        <th>photo</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($team_all as $team)
                                        <tr>
                                            <td>{{$loop->index+1}}</td>
                                            <td>{{$team->title}}</td>
                                            <td>{{$team->subtitle}}</td>
                                            <td>
                                                <img src="{{$team->photo}}" style="width:100px;height:150px" alt="not found">
                                            </td>
                                            <td>
                                                <div class="d-flex">
                                                    <a href="{{route('team.edit',$team->id)}}" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
                                                    <form action="{{route('team.destroy',$team->id)}}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr class="text-center">
                                            <td colspan="50" class="text-danger">No data to show</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('use-js-code')
    <script>
        // datatable code start here
            $(document).ready( function () {
                $('#teamData_table').DataTable();
            });

            $(document).ready( function () {
                $('#deletedTeam_table').DataTable();
            });
        //  datatable code end here
        // image show js code use start here
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                $('#team_photo_viewer').attr('src', e.target.result).width(150).height(195);
                };
                $('#team_photo_viewer').removeClass('hidden');
                reader.readAsDataURL(input.files[0]);
            }
        }
        // image show js code use end here
    </script>
@endsection


