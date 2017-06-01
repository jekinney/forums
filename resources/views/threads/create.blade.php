@extends('layouts.app')

@section('content')
    <main class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">

                <section class="panel panel-default">

                    <header class="panel-heading">Create Thread</header>

                    <form action="/threads" method="post" class="panel-body">
                        {{ csrf_field() }}
                        
                        @if(count($errors))
                            <div class="alert alert-danger">
                                <ul class="list-unstyled">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="form-group {{ $errors->has('channel_id') ? ' has-error' : '' }}">
                            <label for="channel" class="control-label">Select a channel</label>
                            <select name="channel_id" id="channel" class="form-control">
                                <option value="">Select a Channel</option>
                                @foreach($channels as $channel)
                                    <option value="{{ $channel->id }}" {{ old('channel_id') == $channel->id? 'selected':'' }}>{{ $channel->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="control-label">Title</label>
                            <input type="text" name="title" id="title" value="{{ old('title') }}" class="form-control">
                        </div>

                        <div class="form-group {{ $errors->has('body') ? ' has-error' : '' }}">
                            <label for="body" class="control-label">Body</label>
                            <textarea name="body" class="form-control" rows="8">{{ old('body') }}</textarea>
                        </div>

                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-primary">Add Thread</button>
                        </div>

                    </form>

                </section>

            </div>
        </div>
    </main>
@endsection