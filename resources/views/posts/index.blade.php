@extends('layouts.app')

@section('content')
    <div class="container">
        
        <div class="d-flex justify-content-between">
            <div>
                @if (isset($category))
                    <h4>Category: <a href="/categories/{{$category->slug}}">{{$category->name}}</a></h4>
                @elseif(isset($tag))
                    <h4>Tag: <a href="/tags/{{$tag->slug}}">{{$tag->name}}</a></h4>
                @else
                    <h4>All posts</h4>
                @endif

                
                <hr>
            </div>
            <div>
                @auth
                <a href="{{url('/posts/create')}}" class="btn btn-primary btn-sm" role="button">Add Post</a>
                @endauth
            </div>
        </div>
        <div class="row">
        @forelse ($posts as $post)
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header">
                        {{$post->title}}
                    </div>
                    <img src="{{ asset('storage/' . $post->thumbnail) }}" class="card-img-top" alt="">
                    <div class="card-body">
                        <div>
                            {{Str::limit($post->body, 100)}}
                        </div>
                    <a href="{{url('/posts/'. $post->slug)}}">Read more</a>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        Pusblished on {{$post->created_at->format('D F, Y')}}
                        
                        @can('update', $post)
                        <a href="{{url('/posts/'. $post->slug .'/edit')}}" class="btn btn-sm btn-primary">Edit</a>
                        @endcan
                        
                        
                        
                    </div>
                </div>
            </div>
        @empty
            <div class="col-md-6">
                <div class="alert-info alert">
                    Tidak ada artikel
                </div>
            </div>
        @endforelse
            
        </div>
        <div class="d-flex justify-content-center">
            <div>
                {{$posts->links()}}
            </div>
        </div>
        
    </div>
@endsection