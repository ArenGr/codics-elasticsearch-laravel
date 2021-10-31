    <div class="container">
        <div class="card">
            <div class="card-header">
                Articles <small>({{ $users->count() }})</small>
            </div>
            <div class="card-body">
                @forelse ($users as $user)
                    <article class="mb-3">
                        <h2>{{ $user->name }}</h2>
                        <div class="m-0">{{ $user->surname }}</div>
                        <div class="badge badge-light">{{ $user->country}}</div>
                    </article>
                @empty
                    <p>No articles found</p>
                @endforelse
            </div>
        </div>
    </div>
