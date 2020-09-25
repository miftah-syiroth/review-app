@extends('layouts.app')

@section('title', $post->slug)

@section('content')
    <div class="container">
        <h1>{{$post->title}}</h1>
        <div class="text-secondary">
            <a href="/categories/{{$post->category->slug}}">{{$post->category->name}}</a> 
            &middot; {{$post->created_at->format('d F, Y')}}
            &middot;
            @foreach ($post->tags as $tag)
                <a href="/tags/{{$tag->slug}}">{{$tag->name}}</a>
            @endforeach
        </div>
        <hr>
        <img src="{{asset('storage/' . $post->thumbnail)}}" alt="" class="img-fluid">
        <hr>
        <p>{{$post->body}}</p>
        <div class="text-secondary">
            Was written by {{ $post->user->name }}
        </div>
        <div>

            @can('delete', $post)

                <!-- Button trigger modal -->
            <button type="button" class="btn btn-link btn-sm text-danger" data-toggle="modal" data-target="#exampleModal">
                delete
            </button>
            
        
  
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Anda yakin menghapus?</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div>
                                <div>{{$post->title}}</div>
                                <div class="text-secondary">
                                    <small> published {{$post->created_at->format('d M, Y')}}</small>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <form action="/posts/{{$post->slug}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">iya</button>
                                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">tidak</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            @endcan
            
        </div>
    </div>
@endsection