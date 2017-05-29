@extends('layouts.app')

@section('content')
    <main class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">

                <section class="panel panel-default">
                    <header class="panel-heading">
                        <h1 class="panel-title">
                            {{ $thread->title }}
                        </h1>
                        By 
                        <a href="">{{ $thread->creator->name }}</a> 
                        {{ $thread->created_at->diffForHumans() }}
                    </header>

                    <article class="panel-body">
                        {{ $thread->body }}
                    </article>
                </section>

            </div>
        </div>

         <div class="row">
            <div class="col-md-8 col-md-offset-2">

                @foreach($thread->replies as $reply)
                    <section class="panel panel-default">
                        
                        <header class="panel-heading">
                            <a href="#">{{ $reply->owner->name }}</a> replied
                            {{ $reply->created_at->diffForHumans() }}...
                        </header>

                        <article class="panel-body">
                            {{ $reply->body }}
                        </article>

                    </section>
                @endforeach

            </div>
        </div>

        @if(auth()->check())
             <div class="row">
                <div class="col-md-8 col-md-offset-2">
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
                </div>
            </div>
        @else
            <p class="text-center">Please <a href="/login">Sign In</a> to participate in this discussion.</p>
        @endif

    </main>
@endsection