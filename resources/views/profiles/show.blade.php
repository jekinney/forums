@extends('layouts.app')

@section('content')
    <main class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <header class="page-header">
                    <h1>{{ $profileUser->name }} <small>Since {{ $profileUser->created_at->diffForHumans() }}</small></h1>
                </header>

                @foreach($activities as $date => $activity)
                    <h3 class="page-header">{{ $date }}</h3>
                    @foreach($activity as $record)
                       @include("profiles.activities.{$record->type}", ['activity' => $record]) 
                    @endforeach
                @endforeach
                
                <footer class="text-center"> 
                </footer>

            </div>
        </div>
    </main>
@endsection