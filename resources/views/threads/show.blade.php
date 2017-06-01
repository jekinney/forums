@extends('layouts.app')

@section('content')
    <main class="container">
        <div class="row">
            <div class="col-md-8">

                <section class="panel panel-default">
                    <header class="panel-heading">
                        <h1 class="panel-title">
                            {{ $thread->title }}
                        </h1>
                        By 
                        <a href="{{ route('profile', $thread->creator) }}">{{ $thread->creator->name }}</a> 
                        {{ $thread->created_at->diffForHumans() }}
                    </header>

                    <article class="panel-body">
                        {{ $thread->body }}
                    </article>
                </section>


                @foreach($replies as $reply)
                    <section class="panel panel-default">
                        
                        <header class="panel-heading">
                            <div class="level">

                                <h5 class="flex">
                                    <a href="{{ route('profile', $reply->owner) }}" >{{ $reply->owner->name }} </a> replied
                                    {{ $reply->created_at->diffForHumans() }}...
                                </h5>
                                
                                <form action="/replies/{{ $reply->id }}/favorites" method="post">
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-sm btn-link" {{ $reply->isFavorited()? 'disabled' : '' }}>
                                        {{ $reply->favorites_count }} {{ str_plural('Favorite', $reply->favorites_count) }}
                                    </button>
                                </form>

                            </div>
                        </header>

                        <article class="panel-body">
                            {{ $reply->body }}
                        </article>

                    </section>
                @endforeach

                {{ $replies->links() }}


                @if(auth()->check())
                    <section class="panel panel-default">
                        <form action="{{ $thread->path(). '/replies' }}" method="post" class="panel-body">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <textarea name="body" class="form-control" placeholder="Have something to add?" rows="5">{{ old('reply') }}</textarea>
                            </div>

                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-primary">Add Reply</button>
                            </div>

                        </form>
                    </section>
                @else
                    <p class="text-center">Please <a href="/login">Sign In</a> to participate in this discussion.</p>
                @endif
            
            </div>

            <aside class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <p>
                            This thread was published {{ $thread->created_at->diffForHumans() }} by 
                            <a href="{{ route('profile', $thread->creator) }}">{{ $thread->creator->name }}</a>,  and currently has {{ $thread->replies_count }}
                            {{ str_plural('comment', $thread->reply_count) }}.
                        </p>

                        @can('update', $thread)
                            <form action="{{ $thread->path() }}" method="post">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                
                                <div class="form-group text-right">
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </div>

                            </form>
                        @endcan
                        
                    </div>
                </div>
            </aside>
        </div>
    </main>
@endsection