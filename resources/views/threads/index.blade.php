@extends('layouts.app')

@section('content')
    <main class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                
                @forelse($threads as $thread)
                    <section class="panel panel-default">
                        <heading class="panel-heading level">
                            <h4 class="flex"><a href="{{ $thread->path() }}">{{ $thread->title }}</a></h4>
                            
                            <a href="{{ $thread->path() }}">
                                {{ $thread->replies_count }} {{ str_plural('reply', $thread->replies_count) }}
                            </a>
                        </heading>

                        <article class="panel-body">                        
                            {{ $thread->body }}
                        </article>

                    </section>
                @empty
                    <section class="panel panel-default">
                        <article class="panel-body text-center">
                            <p>No relevent results at this time.</p>
                        </article>
                    </section>
                @endforelse

            </div>
        </div>
    </main>
@endsection