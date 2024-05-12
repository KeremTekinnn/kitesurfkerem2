<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles

    </head>
    <body class="font-michroma antialiased min-h-screen bg-no-repeat bg-fixed bg-cover bg-center relative" style="background-image: url({{ asset('img/itemsbg3.jpg') }});">                <div class="min-h-screen">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @livewireScripts
        @livewire('wire-elements-modal')
        <div id="weatherButton" class="fixed bottom-5 left-5 z-50">
            <div id="weatherPopup" class="hidden bg-white border border-[#F07D19] text-[#F07D19] rounded shadow-lg p-4 mt-2 mb-4 -bottom-full transition-all duration-300 ease-in-out">
                <div id="weatherContent"></div>
            </div>
            <button class="bg-[#F07D19] hover:bg-[#a34d02] transition-all ease-in-out duration-1500 text-white font-bold py-2 px-4 rounded-full" id="weatherButton">Check the Weather</button>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const weatherButton = document.getElementById('weatherButton');
                const weatherPopup = document.getElementById('weatherPopup');
                const weatherContent = document.getElementById('weatherContent');

                weatherButton.addEventListener('click', function() {
                    // Show weather popup
                    weatherPopup.classList.toggle('hidden');

                    // Fetch weather data for multiple cities
                    const apiKey = 'abea1fcf027706b796887236d9c57efe';
                    const cities = ['Zandvoort', 'Muiderberg', 'Wijk aan Zee', 'IJmuiden', 'Scheveningen', 'Hoek van Holland']; // Add more cities as needed

                    Promise.all(cities.map(city => {
                        const apiUrl = `https://api.openweathermap.org/data/2.5/weather?q=${city}&appid=${apiKey}&units=metric`;
                        return fetch(apiUrl)
                            .then(response => response.json())
                            .then(data => {
                                const temperature = data.main.temp;
                                const windSpeed = data.wind.speed;
                                const cityName = data.name;
                                const country = data.sys.country;

                                // Return weather information for the city
                                return {
                                    cityName: `${cityName}, ${country}`,
                                    temperature: `${temperature}°C`,
                                    windSpeed: `${windSpeed} m/s`
                                };
                            })
                            .catch(error => {
                                console.error(`Error fetching weather data for ${city}:`, error);
                                // Return placeholder data for the city in case of error
                                return {
                                    cityName: city,
                                    temperature: 'N/A',
                                    windSpeed: 'N/A'
                                };
                            });
                    }))
                    .then(weatherData => {
                        // Update weather content
                        weatherContent.innerHTML = weatherData.map(data => `
                            <div class="mb-4">
                                <h3>${data.cityName}</h3>
                                <p>Temperatuur: ${data.temperature}</p>
                                <p>Windsnelheid: ${data.windSpeed}</p>
                            </div>
                        `).join('');
                    });
                });
            });
        </script>
    </body>
</html>
