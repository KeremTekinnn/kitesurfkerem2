document.addEventListener('DOMContentLoaded', function() {
    const weatherButton = document.getElementById('weatherButton');
    const weatherPopup = document.getElementById('weatherPopup');
    const closeButton = document.getElementById('closeButton');
    const weatherContent = document.getElementById('weatherContent');

    weatherButton.addEventListener('click', function() {
        // Show weather popup
        weatherPopup.classList.toggle('hidden');

        // Fetch weather data for multiple cities
        const apiKey = "abea1fcf027706b796887236d9c57efe";
        const cities = ['Zandvoort', 'Muiderberg', 'Wijk aan Zee', 'IJmuiden', 'Scheveningen', 'Hoek van Holland'];

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

    closeButton.addEventListener('click', function() {
        // Hide weather popup
        weatherPopup.classList.add('hidden');
    });
});
