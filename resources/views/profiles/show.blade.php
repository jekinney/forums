@extends('layouts.app')

@section('content')
    <main class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <header class="page-header">
                    <h1>{{ $profileUser->name }} <small>Since {{ $profileUser->created_at->diffForHumans() }}</small></h1>
                </header>

                @forelse($activities as $date => $activity)
                    <h3 class="page-header">{{ $date }}</h3>
                    @foreach($activity as $record)
                        @if(view()->exists("profiles.activities.{$record->type}"))
                            @include("profiles.activities.{$record->type}", ['activity' => $record]) 
                        @endif
                    @endforeach
                @empty
                    <div class="panel panel-default">
                        <article class="panel-body">
                            <p class="text-center">No Activity for this user.</p>
                        </article>
                    </div>
                @endforelse
                
                <footer class="text-center"> 
                </footer>

            </div>
        </div>
    </main>
@endsection