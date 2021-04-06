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
    $(document).on('click', '#export-csv', function (){
        exportTableToCSV.apply(this, [$('#tab'), 'export.csv']);

    });

    $(document).on('click', '#adding-watchlist', function (){
        let movieTitle = $('b.movie-title').text()
        $('#checkboxes input:checked').each(function() {
            $('th#'+ $(this).attr('name')).append(movieTitle + ', ')
        });
        $('#checkModal').modal('hide');
        $('#mainModal').modal('hide');
        alert('Movie ' + movieTitle + ' is added to your watchlist');
    });

    function exportTableToCSV($table, filename) {

        var $rows = $table.find('tr:has(td),tr:has(th)'),

            // Temporary delimiter characters unlikely to be typed by keyboard
            // This is to avoid accidentally splitting the actual contents
            tmpColDelim = String.fromCharCode(11), // vertical tab character
            tmpRowDelim = String.fromCharCode(0), // null character

            // actual delimiter characters for CSV format
            colDelim = '","',
            rowDelim = '"\r\n"',

            // Grab text from table into CSV formatted string
            csv = '"' + $rows.map(function (i, row) {
                var $row = jQuery(row), $cols = $row.find('td,th');

                return $cols.map(function (j, col) {
                    var $col = jQuery(col), text = $col.text();

                    return text.replace(/"/g, '""'); // escape double quotes

                }).get().join(tmpColDelim);

            }).get().join(tmpRowDelim)
                .split(tmpRowDelim).join(rowDelim)
                .split(tmpColDelim).join(colDelim) + '"',

            // Data URI
            csvData = 'data:application/csv;charset=utf-8,' + encodeURIComponent(csv);
        if (window.navigator.msSaveBlob) { // IE 10+
            //alert('IE' + csv);
            window.navigator.msSaveOrOpenBlob(new Blob([csv], {type: "text/plain;charset=utf-8;"}), "csvname.csv")
        }
        else {
            jQuery(this).attr({ 'download': filename, 'href': csvData, 'target': '_blank' });
        }
    }

});
