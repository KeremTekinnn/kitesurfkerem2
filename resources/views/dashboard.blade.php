<x-app-layout>
    <div class="relative h-screen text-white overflow-hidden">
        <div class="absolute inset-0">
            <img src="{{ asset('img/banner.jpg') }}" class="object-cover object-center w-full h-full">
            </img>
            <div class="absolute inset-0 bg-black opacity-50"></div>
        </div>

        <div class="relative z-10 flex flex-col justify-center items-center h-full text-center">
            <h1 class="text-5xl font-bold leading-tight mb-4">Welcome {{ Auth::user()->name }}</h1>
            {{-- <p class="text-lg text-gray-300 mb-8">Buy cheap nigros.</p> --}}
            <a href="{{ route('reservations') }}"
                class="bg-orange-500 text-gray-900 py-2 px-6 rounded-full text-lg font-semibold transition duration-300 ease-in-out transform hover:scale-105 hover:shadow-lg">Get
                Started</a>
        </div>
    </div>


    {{-- Items --}}
    <div class="p-16 relative z-20">
        <!-- Heading -->
        <h1 class="uppercase tracking-wide text-lg font-bold mb-8 text-white text-center">LESSEN PAKKETTEN</h1>
        <!-- Centered Container for Products -->
        <div class="mx-auto w-full max-w-screen-lg">
            <!-- Center the product containers horizontally and limit to medium screen size -->
            <!-- Product 1 -->
            @foreach ($products as $product)
                <div class="flex flex-col md:flex-row items-center bg-orange-200 rounded-lg mb-4 space-x-6">
                    <!-- Product Image -->
                    <img src="{{ $product->img_url }}" alt="Product Image"
                        class="h-60 w-full md:w-auto rounded object-cover object-center md:mb-0">
                    <div class="flex flex-col justify-center items-center md:w-1/3">
                        <!-- Product Text -->
                        <p class="text-lg font-bold">{{ $product->name }}</p>
                        <p class="text-sm">{{ $product->duration }} uur</p>
                        <p class="text-sm">{{ $product->description }}</p>
                    </div>
                    <!-- Additional Info -->
                    <div
                        class="md:border-l border-gray-400 md:pl-4 flex flex-col justify-center h-auto md:h-60 md:w-1/3">
                        <div class="m-4 flex flex-col justify-center items-center">
                            <p class="text-sm font-semibold">${{ $product->price }}</p>
                            <p class="text-xs">per persoon inclusief materialen</p>
                            <a href="{{ route('reservation.create') }}"
                                class="bg-[#F07D19] hover:bg-gray-800 hover:text-white transition-all ease-in-out duration-1500 font-bold py-1 px-2 mt-2 rounded w-full text-center">
                                Reserve
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- How to Kitesurf --}}
    <div class="container mx-auto px-6 py-16 relative z-30">
        <h2 class="text-4xl font-bold text-center text-white mb-8">How to Kitesurf?</h2>
        <div class="md:grid md:grid-cols-3 gap-4 mt-16">
            <div class="bg-orange-200 rounded-lg shadow-md p-6 flex flex-col items-center justify-center mb-4">
                <img src="{{ asset('img/kitesurf_step1.png') }}" alt="Kitesurf"
                    class="rounded-md mb-4 h-48 w-48 object-cover">
                <h3 class="text-2xl text-gray-800 font-bold mb-2">Step 1: Prepare Equipment</h3>
                <p class="text-md text-gray-600">Prepare the necessary equipment for kitesurfing. This includes a kite,
                    board, bar, and harness.</p>
            </div>
            <div class="bg-orange-200 rounded-lg shadow-md p-6 flex flex-col items-center justify-center mb-4">
                <img src="{{ asset('img/kitesurf_step2.png') }}" alt="Kitesurf"
                    class="rounded-md mb-4 h-48 w-48 object-cover">
                <h3 class="text-2xl text-gray-800 font-bold mb-2">Step 2: Control the Kite</h3>
                <p class="text-md text-gray-600">Learn to control the kite. This is the most important part of
                    kitesurfing and requires some practice.</p>
            </div>
            <div class="bg-orange-200 rounded-lg shadow-md p-6 flex flex-col items-center justify-center">
                <img src="{{ asset('img/kitesurf_step3.png') }}" alt="Kitesurf"
                    class="rounded-md mb-4 h-48 w-48 object-cover">
                <h3 class="text-2xl text-gray-800 font-bold mb-2">Step 3: Enter the Water and Surf</h3>
                <p class="text-md text-gray-600">The final step is to enter the water and surf. This step tests your
                    kite control skills and is the most fun part of kitesurfing.</p>
            </div>
        </div>
        <div class="flex justify-center mt-16">
            <iframe width="800" height="450" src="https://www.youtube.com/embed/JoA9WMhOBBQ?si=M5EEahn9hTzxVzsN"
                title="YouTube video player" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
        </div>
    </div>

    {{-- How to Make --}}
    <div class="container mx-auto px-6 py-16 relative z-30">
        <h2 class="text-4xl font-bold text-center text-white mb-8">How to make Reservation?</h2>
        <div class="flex flex-wrap mt-16">
            <div class="w-full md:w-1/3 px-2 mb-4">
                <div class="bg-orange-200 rounded-lg shadow-md p-6 flex flex-col items-center justify-center h-64">
                    <img src="{{ asset('img/step1.png') }}" alt="Kitesurf"
                        class="rounded-md mb-4 h-48 w-48 object-cover">
                    <h3 class="text-2xl text-gray-800 font-bold mb-2">Kies je pakket</h3>
                </div>
            </div>
            <div class="w-full md:w-1/3 px-2 mb-4">
                <div class="bg-orange-200 rounded-lg shadow-md p-6 flex flex-col items-center justify-center h-64">
                    <img src="{{ asset('img/step2.png') }}" alt="Kitesurf"
                        class="rounded-md mb-4 h-48 w-48 object-cover">
                    <h3 class="text-2xl text-gray-800 font-bold mb-2">Maak je reservering</h3>
                </div>
            </div>
            <div class="w-full md:w-1/3 px-2 mb-4">
                <div class="bg-orange-200 rounded-lg shadow-md p-6 flex flex-col items-center justify-center h-64">
                    <img src="{{ asset('img/step3.png') }}" alt="Kitesurf"
                        class="rounded-md mb-4 h-48 w-48 object-cover">
                    <h3 class="text-2xl text-gray-800 font-bold mb-2">Begin met kitesurfen</h3>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
