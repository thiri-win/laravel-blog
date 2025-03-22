<x-layouts.app :title="__('Post Detail')">
    <div class="container mx-auto">
        <div class="shadow p-5">
            <h1 class="text-2xl font-bold">{{ $post->title }}</h1>
            <p class="text-gray-500 text-sm">{{ $post->created_at->format('Y-m-d') }}</p>
            <p class="text-gray-700 my-3">{{ $post->content }}</p>
            <img src="{{ asset('storage/' . $post->photo) }}" alt="{{ $post->title }}"
                class="w-full h-100 object-cover rounded-xl mb-3">
            <a href="{{ route('posts.edit', ['post' => $post]) }}"
                class="border px-5 py-1 border-zinc-500 rounded-xl inline-block font-bold">Edit</a>
            <form action="{{ route('posts.destroy', ['post' => $post]) }}" method="post" class="inline-block">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="border px-5 py-1 border-zinc-500 rounded-xl inline-block font-bold">Delete</button>
            </form>
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
            <!-- Comments Section -->
            <div class="mt-8">
                <h3 class="text-lg font-semibold">Comments</h3>

                <!-- Comment Form -->
                <form action="{{ route('comments.store', $post) }}" method="POST" class="mt-4">
                    @csrf
                    <textarea name="content" rows="3" class="w-full border rounded-lg p-2" placeholder="Add a comment..."></textarea>
                    @error('content')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                    <button type="submit" class="mt-2 bg-blue-500 text-white px-4 py-2 rounded">
                        Comment
                    </button>
                </form>

                <!-- Comments List -->
                <div class="mt-6 space-y-4">
                    @foreach ($post->comments()->latest()->get() as $comment)
                        <div class="bg-gray-50 text-black p-4 rounded">
                            <div class="flex justify-between">
                                <p class="font-semibold">{{ $comment->user->name }}</p>
                                <p class="text-gray-500  text-sm">{{ $comment->created_at->diffForHumans() }}</p>
                            </div>
                            <p class="mt-2">{{ $comment->content }}</p>

                            @if ($comment->user_id === auth()->id())
                                <form action="{{ route('comments.destroy', [$post, $comment]) }}" method="POST"
                                    class="mt-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 text-sm">Delete</button>
                                </form>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    </x-layouts-app>
