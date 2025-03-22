<x-layouts.app :title="__('All Posts')">
    <div class="container mx-auto">
        @foreach ($posts as $post)
            <a href="{{ route('posts.show', ['post' => $post]) }}">
                <div class="shadow p-3 mb-5">
                    <h2>{{ $post->user->name }}</h2>
                    <p class="text-xs mb-3">{{ $post->created_at->diffForHumans() }}</p>
                    <h1>{{ $post->title }}</h1>
                    <p>{{ $post->content }}</p>
                    <div class="flex items-center mt-4">
                        @if ($post->isLikedBy(auth()->user()))
                            <form action="{{ route('posts.unlike', $post) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500">
                                    Unlike
                                </button>
                            </form>
                        @else
                            <form action="{{ route('posts.like', $post) }}" method="POST">
                                @csrf
                                <button type="submit" class="text-gray-500">
                                    Like
                                </button>
                            </form>
                        @endif
                        <span class="ml-2">{{ $post->likes()->count() }} likes</span>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
    </x-layouts-app>
