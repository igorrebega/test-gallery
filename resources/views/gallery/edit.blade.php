@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit gallery {{$model['title']}}</div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('gallery.update',['id'=>$id]) }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="title" class="col-md-4 control-label">Title</label>

                                <div class="col-md-6">
                                    <input id="title" name="title" type="text" class="form-control" title="title"
                                           value="{{ old('title') ?: $model['title']  }}" required
                                           autofocus>

                                    @if ($errors->has('title'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Update
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">Upload photos</div>

                    <div class="panel-body">
                        <form class="form-horizontal"
                              method="POST"
                              action="{{ route('photo.upload') }}"
                              enctype="multipart/form-data">
                            {{ csrf_field() }}


                            <input type="hidden" name="id" value="{{$id}}">
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="filename" class="col-md-4 control-label">Photos</label>

                                <div class="col-md-6">
                                    <input id="filename" type="file" name="filename[]"
                                           class="form-control"
                                           multiple
                                           accept="image/png, image/jpeg">

                                    @if ($errors->has('filename.*'))
                                        <span class="help-block">
                                        <strong>Photos must be in .png or .jpg format with max size 2048kb</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-success">
                                        Upload
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                @if(!empty($photos))
                    <div class="panel panel-default">
                        <div class="panel-heading">Manage photos</div>

                        <div class="panel-body">

                            <table class="table">
                                <thead>
                                <tr>
                                    <td>Thumbnail</td>
                                    <td>Title</td>
                                    <td></td>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($photos as $photoId => $photo)
                                    <tr>
                                        <td>
                                            <a href="{{'/images/'.$id.'/'.$photo['name']}}">
                                                <img width="50" height="50"
                                                     src="{{'/images/'.$id.'/'.$photo['name']}}">
                                            </a>
                                        </td>
                                        <td>
                                            @if($photo['isPrimary'])
                                                <button class="btn btn-info" disabled>
                                                    Is cover
                                                </button>
                                            @else
                                                <a href="{{route('photo.makeCover',['galleryId' => $id, 'id' => $photoId])}}"
                                                   class="btn btn-success">
                                                    Make cover
                                                </a>
                                            @endif

                                            <a href="{{route('photo.delete',['galleryId' => $id, 'id' => $photoId])}}"
                                               class="btn btn-danger">
                                                Delete
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
