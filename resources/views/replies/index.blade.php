<reply :attributes="{{ $reply }}" inline-template v-cloak>
   <section id="reply-{{ $reply->id }}" class="panel panel-default">
                            
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
            <div v-if="editing">
                <textarea v-model="body" class="form-control"></textarea>
            </div>
            <div v-else v-html="body"></div>
        </article>
        
        @can('update', $reply)
            <footer class="panel-footer">
                <div v-if="editing" class="level">
                    <button type="button" @click="editing = false" class="btn btn-xs btn-default mr-1">Cancel</button>
                    <button class="btn btn-xs btn-primary" @click="update">Save</button>
                </div>
                <div v-else class="level">
                    <button type="button" @click="editing = true" class="btn btn-xs btn-info mr-1">Edit</button>
                    <form action="/replies/{{ $reply->id }}" method="post">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-xs btn-danger">Delete</button>
                    </form>
                </div>
            </footer>
        @endcan

    </section>
</reply>