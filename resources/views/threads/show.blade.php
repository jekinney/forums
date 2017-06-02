@extends('layouts.app')

@section('content')
    <thread-view :count="{{ $thread->replies_count }}" inline-template>
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
                    

                    <replies @removed="repliesCount--"></replies>
                
                </div>

                <aside class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <p>
                                This thread was published {{ $thread->created_at->diffForHumans() }} by 
                                <a href="{{ route('profile', $thread->creator) }}">{{ $thread->creator->name }}</a>,  and currently has <span v-text="repliesCount"></span>.
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
    </thread-view>
@endsection