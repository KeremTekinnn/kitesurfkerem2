<x-app-layout>
    <div class="relative bg-gradient-to-r from-purple-600 to-blue-600 h-screen text-white overflow-hidden">
        <div class="absolute inset-0">
          <img src="{{ asset('img/banner.jpg') }}" class="object-cover object-center w-full h-full">
        </img>
          <div class="absolute inset-0 bg-black opacity-50"></div>
        </div>

        <div class="relative z-10 flex flex-col justify-center items-center h-full text-center">
          <h1 class="text-5xl font-bold leading-tight mb-4">Welcome {{ Auth::user()->name }}</h1>
          <p class="text-lg text-gray-300 mb-8">Buy cheap nigros.</p>
          <a href="{{ route('reservations') }}" class="bg-orange-500 text-gray-900 py-2 px-6 rounded-full text-lg font-semibold transition duration-300 ease-in-out transform hover:scale-105 hover:shadow-lg">Get Started</a>
        </div>
    </div>

    <div id="weatherButton" class="fixed bottom-5 left-5 z-50">
        <div id="weatherPopup" class="hidden bg-white border border-[#F07D19] text-[#F07D19] rounded shadow-lg p-4 mt-2 mb-4 -bottom-full transition-all duration-300 ease-in-out">
            <div id="weatherContent"></div>
        </div>
        <button class="bg-[#F07D19] hover:bg-[#a34d02] transition-all ease-in-out duration-1500 text-white font-bold py-2 px-4 rounded-full" id="weatherButton">Check the Weather</button>
    </div>
</x-app-layout>
