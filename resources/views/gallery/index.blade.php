@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Galleries</div>

                    <div class="panel-body">
                        <p>
                            <a href="/gallery/create" class="btn btn-success">Create gallery</a>
                        </p>
                        @if(empty($galleries))
                            <p class="alert alert-info">There is no galleries create, please make one</p>
                        @else
                            <table class="table">
                                <thead>
                                <tr>
                                    <td>Cover</td>
                                    <td>Title</td>
                                    <td></td>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($galleries as $id => $gallery)
                                    <tr>
                                        <td>
                                            @if($gallery['cover'])
                                                <img src="/images/{{$id}}/{{$gallery['cover']}}" height="50"
                                                     width="50">
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{route('gallery.edit',['id'=>$id])}}">{{$gallery['title']}}</a>
                                        </td>
                                        <td>
                                            <a href="{{route('gallery.delete',['id' => $id])}}" class="btn btn-danger">
                                                Delete
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
