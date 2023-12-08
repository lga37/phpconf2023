<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    Seus pedidos :


                    @foreach(auth()->user()->checkouts as $checkout)
                    {{ $checkout->id }}
                    @php echo "<pre>"; print_r(json_decode($checkout->products,true)); echo "</pre>"; @endphp
                    {{ $checkout->created_at->diffForHumans() }}
                    <hr>
                    @endforeach


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
