<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="/js/jquery-ui-1.12.1.custom/jquery-ui.min.css">
    <link rel="stylesheet" href="/app.css">

    <title>Movie App</title>
</head>
<body>
<button type="button" class="btn btn-success btn-primary btn-lg" id="watchlist" style="float: right">Watchlist</button>
<h1 class="main">Recommended Movies:</h1>
<div class="scrollmenu">
    <?php foreach ($params['recommendedMovies'] as $key => $data): ?>
        <a href="#<?=$data['id']?>" class="testing" data-row="<?=$data['id']?>">
            <div class="box">
            <span>
                <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" class="ipc-icon ipc-icon--star-inline"
                     viewBox="0 0 24 24" fill="currentColor"
                     role="presentation">
                    <path d="M12 20.1l5.82 3.682c1.066.675 2.37-.322 2.09-1.584l-1.543-6.926
                     5.146-4.667c.94-.85.435-2.465-.799-2.567l-6.773-.602L13.29.89a1.38 1.38
                     0 0 0-2.581 0l-2.65 6.53-6.774.602C.052 8.126-.453 9.74.486 10.59l5.147
                     4.666-1.542 6.926c-.28 1.262 1.023 2.26 2.09 1.585L12 20.099z">
                    </path>
                </svg>
                <?= $data['imdbRating']?>
            </span>
                <img src="<?= $data['posterurl']?>" class="mx-auto d-block col-lg-6 col-sm-6 col-8 img-fluid float-sm-left"/>
                <h5><?= $data['title']?></h5>
            </div>
            <button type="button" class="btn btn-primary">Add to Watchlist</button>
        </a>
    <?php endforeach; ?>
</div>

<h1 class="main">All Movies: </h1>
<div class="scrollmenu">
    <?php foreach ($params['allMovies'] as $key => $data): ?>
    <a href="#<?=$data['id']?>" class="testing" data-row="<?=$data['id']?>">
        <div class="box">
            <span>
                <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" class="ipc-icon ipc-icon--star-inline"
                     viewBox="0 0 24 24" fill="currentColor"
                     role="presentation">
                    <path d="M12 20.1l5.82 3.682c1.066.675 2.37-.322 2.09-1.584l-1.543-6.926
                     5.146-4.667c.94-.85.435-2.465-.799-2.567l-6.773-.602L13.29.89a1.38 1.38
                     0 0 0-2.581 0l-2.65 6.53-6.774.602C.052 8.126-.453 9.74.486 10.59l5.147
                     4.666-1.542 6.926c-.28 1.262 1.023 2.26 2.09 1.585L12 20.099z">
                    </path>
                </svg>
                <?= $data['imdbRating']?>
            </span>
            <img src="<?= $data['posterurl']?>" class="mx-auto d-block col-lg-6 col-sm-6 col-8 img-fluid float-sm-left"/>
            <h5><?= $data['title']?></h5>
            <button type="button" class="btn btn-primary">Add to Watchlist</button>
        </div>
    </a>
    <?php endforeach; ?>
</div>

<div class="modal fade" id="mainModal" tabindex="-1" aria-labelledby="mainModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="movie-title" id="mainModalLabel"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <img src="https://images-na.ssl-images-amazon.com/images/M/MV5BMTg1MTY2MjYzNV5BMl5BanBnXkFtZTgwMTc4NTMwNDI@._V1_SY500_CR0,0,337,500_AL_.jpg" class="mx-auto col-lg-6 col-sm-6 col-8 img-fluid float-sm-left" id="modal-img" >
                    </div>
                    <div class="col-md-8">
                        <h2>
                            <b class="movie-title"></b>
                            <i id="movie-year"></i>,
                            <span>Imb Rating:
                                <i id="imb-rating"></i>
                            </span>
                        </h2>
                        <hr>
                        <h2><b>Storyline: </b></h2>
                        <p id="storyline"></p>
                        <hr>
                        <h2>Cast:</h2>
                        <div id="cast"></div>
                        <hr>
                        <h2>Genres:</h2>
                        <p id="genres"></p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary add-to-watchlist">Add to Watchlist</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="checkModal" tabindex="-1" aria-labelledby="checkModal" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h1 id="checkModal">Add day for Watchlist</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="checkboxes">
                <input type="checkbox" id="monday" name="monday" value="1">
                <label for="monday"> Monday</label><br>
                <input type="checkbox" id="tuesday" name="tuesday" value="2">
                <label for="tuesday"> Tuesday</label><br>
                <input type="checkbox" id="wednesday" name="wednesday" value="3">
                <label for="wednesday"> Wednesday</label><br>
                <input type="checkbox" id="thursday" name="thursday" value="4">
                <label for="thursday"> Thursday</label><br>
                <input type="checkbox" id="friday" name="friday" value="5">
                <label for="friday"> Friday</label><br>
                <input type="checkbox" id="saturday" name="saturday" value="6">
                <label for="saturday"> Saturday</label><br>
                <input type="checkbox" id="sunday" name="sunday" value="7">
                <label for="sunday"> Sunday</label><br>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="adding-watchlist">Submit</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="movie-list" tabindex="-1" aria-labelledby="movie-list" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-sm-right">
        <div class="modal-content">
            <div class="modal-header">
                <h1 id="checkModal">Watchlist Movies</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" data-monday="[]">
                <h3>Monday: </h3><p id="monday"></p><hr>
                <h3>Tuesday: </h3><p id="tuesday"></p><hr>
                <h3>Wednesday: </h3><p id="wednesday"></p><hr>
                <h3>Thursday: </h3><p id="thursday"></p><hr>
                <h3>Friday: </h3><p id="friday"></p><hr>
                <h3>Saturday: </h3><p id="saturday"></p><hr>
                <h3>Sunday: </h3><p id="sunday"></p><hr>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
<script src="/js/jquery-ui-1.12.1.custom/external/jquery/jquery.js"></script>
<script src="/js/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script src="/js/app.js"></script>
</body>
</html>

