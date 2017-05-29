@extends('layouts.app')

@section('content')
    <main class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">

                <section class="panel panel-default">
                    <header class="panel-heading">
                        <h1 class="panel-title">Threads</h1>
                    </header>

                    <div class="panel-body">

                        @foreach($threads as $thread)
                            <article>
                                <h4><a href="{{ $thread->path() }}">{{ $thread->title }}</a></h4>
                                <div class="body">{{ $thread->body }}</div>
                            </article>
                            <hr>
                        @endforeach

                    </div>
                </section>

            </div>
        </div>
    </main>
@endsection