@extends('layout.app')

@section('title') Welcome page @stop

@section('content')
    @include('partials.navbar')

    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-plus-circle"></i> New Post
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{route('post.new')}}">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input id="title" name="title" class="form-control  @if($errors->has('title'))is-invalid @endif">
                                @if($errors->has('title'))<span class="invalid-feedback">{{$errors->first('title')}}</span>@endif
                            </div>
                            <div class="form-group">
                                <label for="content">Post Content</label>
                                <textarea name="content" id="content" class="form-control @if($errors->has('content')) is-invalid @endif"></textarea>
                                @if($errors->has('content'))<span class="invalid-feedback">{{$errors->first('content')}}</span> @endif
                            </div>
                            <div class="form-group">
                                <button class="btn-outline-primary" type="submit">Save</button>
                            </div>
                            <!--<input type="hidden" name="_token" value="{{csrf_token()}}">-->
                            {{csrf_field()}}
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                @if(Session('info'))
                    <div class="alert alert-info">{{Session('info')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                <div class="card">
                    <div class="card-header"><i class="fas fa-database"></i> Available Post</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-borderless table-primary">
                                <tr>
                                    <td>Id</td>
                                    <td>Title</td>
                                    <td>Content</td>
                                    <td>Created Time</td>
                                    <td>Action</td>
                                </tr>
                                @foreach($posts as $p)
                                    <tr>
                                        <td>{{$p->id}}</td>
                                        <td>{{$p->title}}</td>
                                        <td>{{$p->content}}</td>
                                        <td>{{$p->created_at->diffForHumans()}}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                   <i class="fas fa-cogs"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item text-primary" href="{{route('post.edit',['id'=>$p->id])}}"><i class="fas fa-edit"></i>Edit</a>
                                                    <a data-toggle="modal" data-target="#d{{$p->id}}" class="dropdown-item text-danger" href="#"><i class="fas fa-trash"></i>Delete</a>
                                                </div>
                                            </div>
                                            <div id="d{{$p->id}}" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-sm">
                                                    <div class="modal-content">
                                                       <div class="modal-header">Confirmation</div>
                                                        <div class="modal-body  text-warning text-center">
                                                            <i class="fas fa-exclamation-circle fa-4x"></i><hr>
                                                            <span>Are you sure want to delete the id number <i>"{{$p->id}}" item</i></span>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="{{route('post.remove',['id'=>$p->id])}}" class="btn btn-outline-primary">Agree</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                            </table>
                            {{$posts->links()}}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    @stop