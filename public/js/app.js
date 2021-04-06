$('document').ready(function(){
    $(document).on("click", ".testing", function () {
        let movieId = $(this).attr('data-row');
        $('#mainModal').modal('toggle');
        $.post("/data",
            {
                movieId: movieId,
            },
            function(data, status){
                if(status == 'success') {
                    let res = JSON.parse(data)
                    $('#modal-img').attr('src', res.posterurl);
                    $('.movie-title').text(res.title);
                    $('#movie-year').text('(' + res.year + ')');
                    $('#imb-rating').text(res.imdbRating);
                    $('#storyline').text(res.storyline);
                    $('#genres').text(res.genres.join());
                    let html = ''
                    res.actors.forEach(element => html += '<li>' + element + '</li>')
                    $('#cast').html(html);
                }
            });
    })
    $(document).on('click', '.add-to-watchlist', function (){
        $('#checkModal').modal('toggle');
    });
    $(document).on('click', '#watchlist', function (){
        $('#movie-list').modal('toggle');

    });

    $(document).on('click', '#adding-watchlist', function (){
        let movieTitle = $('b.movie-title').text()
        $('#checkboxes input:checked').each(function() {
            $('p#'+ $(this).attr('name')).append(movieTitle + ', ')
        });
        $('#checkModal').modal('hide');
        $('#mainModal').modal('hide');
        alert('Movie ' + movieTitle + ' is added to your watchlist');

    });
});
