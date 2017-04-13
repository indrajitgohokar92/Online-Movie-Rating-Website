function addMovieRating(movie_id, username, movieRating) {
    $.ajax({
        url: '../db/addRatings.php',
        type: 'POST',
        data: {
            movie_id: movie_id,
            username: username,
            movieRating: movieRating
        }
    });
}

function addToWatchList(movie_id, username, shouldAddToWatchlist){
    $.ajax({
        url: '../db/addToWatchList.php',
        type: 'POST',
        data: {
            movie_id: movie_id,
            username:username,
            shouldAddToWatchlist:shouldAddToWatchlist
        }
    });
}
