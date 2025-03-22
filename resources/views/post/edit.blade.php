<x-layouts.app :title="__('New Post')">
    <div class="container mx-auto">
        <h1 class="text-2xl mb-5 font-bold">Update Your Post</h1>
        <form action="" method="post" enctype="multipart/form-data">
            @csrf
            @method("PUT")
            <input type="text" name="title" id="title" placeholder="Enter Your Title Here..." class="border border-zinc-500 rounded p-1 mb-2 w-full" value="{{ old('title', $post->title) }}" autofocus>
            @error('title')
                <p class="text-sm text-red-400 mb-2">{{ $message }}</p>
            @enderror
            <textarea name="content" id="content" cols="30" rows="5" placeholder="Details About Your Topics" class="border border-zinc-500 rounded p-1 mb-2 w-full">{{ old('content', $post->content) }}</textarea>
            @error('content')
                <p class="text-sm text-red-400 mb-2">{{ $message }}</p>
            @enderror
            <input type="file" name="photo" id="photo" class="border border-zinc-500 rounded p-1 mb-2 w-full">
            <img src="{{ asset('storage/'.$post->photo) }}" alt="" class="h-20 mb-2">
            @error('photo')
                <p class="text-sm text-red-400 mb-2">{{ $message }}</p>
            @enderror
            <input type="submit" value="Update" class="border border-zinc-500 rounded p-1 mb-2 w-full">
        </form>
    </div>
</x-layouts-app>