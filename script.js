'use strict';

const API_URL = 'https://www.omdbapi.com/?apikey=b2647f6f&t=';

const movieContainer = document.querySelector('.movie-container');
const errorContainer = document.querySelector('.error-container');

const title = document.querySelector('.title');
const plot = document.querySelector('.plot');
const genre = document.querySelector('.genre');
const releaseDate = document.querySelector('.release-date');
const runtime = document.querySelector('.runtime');
const imdbRating = document.querySelector('.imdb-rating');
const director = document.querySelector('.director');
const writer = document.querySelector('.writer');
const stars = document.querySelector('.stars');

const poster = document.querySelector('.poster-img');

const movieName = document.getElementById('movieName');

const searchBtn = document.querySelector('.search-btn');

let errorMessage = document.querySelector('.error-message');

movieContainer.classList.add('hidden');

// let userIsLoggedIn = false;

const setData = function (data) {
  title.textContent = data.Title;
  plot.textContent = data.Plot;
  genre.textContent = data.Genre;
  releaseDate.textContent = data.Released;
  runtime.textContent = data.Runtime;
  imdbRating.textContent = data.Ratings[0].Value.slice(0, 3);
  director.textContent = data.Director;
  writer.textContent = data.Writer;
  stars.textContent = data.Actors;

  poster.src = data.Poster;
};

const toggleClass = function () {
  movieContainer.classList.add('hidden');
  errorContainer.classList.remove('hidden');
};

const getMovieDetails = function (movie) {
  fetch(API_URL + movie)
    .then(response => response.json())
    .then(data => {
      if (data.Error === 'Movie not found!') {
        toggleClass();
        errorMessage.textContent = 'Movie not found!';
      } else {
        setData(data);
        movieContainer.classList.remove('hidden');
        errorContainer.classList.add('hidden');
      }
    });
};

const handleMovieSearch = function () {
  if (movieName.value.length === 0) {
    toggleClass();
    errorMessage.textContent = 'Please enter a movie name';
  } else {
    getMovieDetails(movieName.value);
    movieName.value = '';
  }
};

searchBtn.addEventListener('click', () => {
  handleMovieSearch();
});

movieName.addEventListener('keyup', function (e) {
  if (e.key === 'Enter') {
    handleMovieSearch();
  }
});
