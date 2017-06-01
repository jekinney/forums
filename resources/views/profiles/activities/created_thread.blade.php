<section class="panel panel-default">
    <header class="panel-heading level">
        <h1 class="panel-title">{{ $profileUser->name }} created a thread: 
        	<a href="{{ $activity->subject->path() }}">{{ $activity->subject->title }}</a></h1>
    </header>

    <article class="panel-body">
		{{ $activity->subject->body }}
    </article>
</section>