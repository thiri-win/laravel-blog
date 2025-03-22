<x-layouts.app :title="__('New Post')">
    <div class="container mx-auto">
        <h1 class="text-2xl mb-5 font-bold">What's Your Topic Today?</h1>
        <form action="{{ route('posts.create') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="text" name="title" id="title" placeholder="Enter Your Title Here..." class="border border-zinc-500 rounded p-1 mb-2 w-full" value="{{ old('title') }}" autofocus>
            @error('title')
                <p class="text-sm text-red-400 mb-2">{{ $message }}</p>
            @enderror
            <textarea name="content" id="content" cols="30" rows="5" placeholder="Details About Your Topics" class="border border-zinc-500 rounded p-1 mb-2 w-full">{{ old('content') }}</textarea>
            @error('content')
                <p class="text-sm text-red-400 mb-2">{{ $message }}</p>
            @enderror
            <input type="file" name="photo" id="photo" class="border border-zinc-500 rounded p-1 mb-2 w-full">
            @error('photo')
                <p class="text-sm text-red-400 mb-2">{{ $message }}</p>
            @enderror
            <input type="submit" value="Submit" class="border border-zinc-500 rounded p-1 mb-2 w-full">
        </form>
    </div>
</x-layouts-app>