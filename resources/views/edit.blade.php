@extends('layout.app')

@section('title') Welcome page @stop

@section('content')
    @include('partials.navbar')
    <div class="container">
        <div class="row">
            <div class="col-sm-4 offset-4">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-edit"></i> Edit Post
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{route('post.update')}}">
                            <input type="hidden" name="id" value="{{$post->id}}">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input value="{{$post->title}}" id="title" name="title" class="form-control  @if($errors->has('title'))is-invalid @endif">
                                @if($errors->has('title'))<span class="invalid-feedback">{{$errors->first('title')}}</span>@endif
                            </div>
                            <div class="form-group">
                                <label for="content">Post Content</label>
                                <textarea name="content" id="content" class="form-control @if($errors->has('content')) is-invalid @endif">{{$post->content}}</textarea>
                                @if($errors->has('content'))<span class="invalid-feedback">{{$errors->first('content')}}</span> @endif
                            </div>
                            <div class="form-group">
                                <a href="{{route('welcome')}}" class="btn btn-outline-secondary">Cancel</a>
                                <button class=" btn btn-outline-primary" type="submit">Save</button>
                            </div>
                        <!--<input type="hidden" name="_token" value="{{csrf_token()}}">-->
                            {{csrf_field()}}
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop