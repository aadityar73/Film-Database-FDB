'use strict';

// API URL
const API_URL = 'https://www.omdbapi.com/?apikey=b2647f6f&t=';

// FUNCTION to select elements
const selectElement = ele => document.querySelector(ele);

// DOM Elements
const movieContainer = selectElement('.movie-container');
const errorContainer = selectElement('.error-container');

const title = selectElement('.title');
const plot = selectElement('.plot');
const genre = selectElement('.genre');
const releaseDate = selectElement('.release-date');
const runtime = selectElement('.runtime');
const imdbRating = selectElement('.imdb-rating');
const director = selectElement('.director');
const writer = selectElement('.writer');
const stars = selectElement('.stars');
const seasons = selectElement('.seasons');

const poster = selectElement('.poster-img');
const movieName = document.getElementById('movieName');
const searchBtn = selectElement('.search-btn');
const errorMessage = selectElement('.error-message');

// Initialize by hiding movie container
movieContainer.classList.add('hidden');

// Function to update movie data on the UI
const setData = function (data) {
  title.textContent = data.Title;
  plot.innerHTML = `Plot: <strong>${data.Plot}</strong>`;
  genre.innerHTML = `Genre: <strong>${data.Genre}</strong>`;
  releaseDate.innerHTML = `Release Date: <strong>${data.Released}</strong>`;
  runtime.innerHTML = `Runtime: <strong>${data.Runtime}</strong>`;

  // Checking for IMDb Rating
  imdbRating.innerHTML = data.Ratings[0]
    ? `IMDb Rating: <span class="star-bg">⭐</span> <strong>${data.Ratings[0].Value.slice(
        0,
        3
      )}</strong>`
    : 'IMDb Rating: <strong>N/A</strong>';

  director.innerHTML = `Director: <strong>${data.Director}</strong>`;
  writer.innerHTML = `Writers: <strong>${data.Writer}</strong>`;
  stars.innerHTML = `Stars: <strong>${data.Actors}</strong>`;

  // Checking for Seasons if available
  seasons.innerHTML = data.totalSeasons
    ? `Seasons: <strong>${data.totalSeasons}</strong>`
    : '';

  // Updating poster
  poster.src =
    data.Poster && data.Poster !== 'N/A' ? data.Poster : 'default-poster.jpg';
};

// Function to toggle visibility for error messages
const toggleErrorMessage = function (message) {
  errorMessage.textContent = message;
  movieContainer.classList.add('hidden');
  errorContainer.classList.remove('hidden');
};

// Function to fetch and display movie details
const getMovieDetails = function (movie) {
  fetch(API_URL + movie)
    .then(response => response.json())
    .then(data => {
      if (data.Error === 'Movie not found!') {
        toggleErrorMessage("Sorry, we couldn't find that movie or series.");
      } else {
        setData(data);
        movieContainer.classList.remove('hidden');
        errorContainer.classList.add('hidden');
      }
    });
};

// Handler for movie search
const handleMovieSearch = function () {
  const movie = movieName.value.trim();

  if (!movie) {
    toggleErrorMessage('Please enter the name of a movie or series.');
  } else {
    getMovieDetails(movie);
    movieName.value = '';
  }
};

// Event listeners for search button and enter key
searchBtn.addEventListener('click', handleMovieSearch);
movieName.addEventListener('keyup', function (e) {
  if (e.key === 'Enter') handleMovieSearch();
});
