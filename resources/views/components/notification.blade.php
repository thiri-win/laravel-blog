@if (session('success'))
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
        class="bg-green-500 text-white p-3 rounded-lg absolute top-20 left-1/2 -translate-x-1/2 z-30">
        {{ session('success') }}
    </div>
@endif
@if (session('warning'))
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
        class="bg-amber-500 text-white p-3 rounded-lg absolute top-20 left-1/2 -translate-x-1/2 z-30">
        {{ session('warning') }}
    </div>
@endif
@if (session('deleted'))
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
        class="bg-red-500 text-white p-3 rounded-lg absolute top-20 left-1/2 -translate-x-1/2 z-30">
        {{ session('deleted') }}
    </div>
@endif