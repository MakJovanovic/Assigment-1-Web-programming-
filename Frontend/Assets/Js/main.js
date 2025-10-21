     async function getWeather() {
        const city = document.getElementById('city').value;
        const weatherDataElem = document.getElementById('weather-data');
        const errorMessageElem = document.getElementById('error-message');

        weatherDataElem.textContent = '';
        errorMessageElem.textContent = '';

        const apiKey = '84d2d72583a6b1687c3a06570d6e57c3';

        try {
            const response = await fetch(`https://api.openweathermap.org/data/2.5/weather?q=${city}&appid=${apiKey}`);

            if (!response.ok) {
                throw new Error('City not found');
            }

            const data = await response.json();
            const weatherDescription = data.weather[0].description;
            const temperature = (data.main.temp - 273.15).toFixed(2);

            weatherDataElem.textContent = `Weather: ${weatherDescription}, Temperature: ${temperature}°C`;
        } catch (error) {
            errorMessageElem.textContent = `Error: ${error.message}`;
        }
    }

    document.getElementById('get-weather').addEventListener('click', getWeather);