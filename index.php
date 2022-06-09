<?php 

$album = [
  [
      "poster" => "https://www.onstageweb.com/wp-content/uploads/2018/09/bon-jovi-new-jersey.jpg",
      "title" => "New Jersey",
      "author" => "Bon Jovi",
      "genre"=> "Rock",
      "year"=> "1988"
  ],
  [
      "poster"=> "https://img.discogs.com/vknPDdrqRbT92pNRX0W4I5N91jg=/fit-in/300x300/filters:strip_icc():format(jpeg):mode_rgb():quality(40)/discogs-images/R-1246953-1448927086-6590.jpeg.jpg",
      "title"=> "Live at Wembley 86",
      "author"=> "Queen",
      "genre"=> "Pop",
      "year"=> "1992"
  ],
  [
      "poster"=> "https://images-na.ssl-images-amazon.com/images/I/41JD3CW65HL.jpg",
      "title"=> "Ten's Summoner's Tales",
      "author"=> "Sting",
      "genre"=> "Pop",
      "year"=> "1993"
  ],
  [
      "poster"=> "https://cdn2.jazztimes.com/2018/05/SteveGadd-800x723.jpg",
      "title"=> "Steve Gadd Band",
      "author"=> "Steve Gadd Band",
      "genre"=> "Jazz",
      "year"=> "2018"
  ],
  [
      "poster"=> "https://images-na.ssl-images-amazon.com/images/I/810nSIQOLiL._SY355_.jpg",
      "title"=> "Brave new World",
      "author"=> "Iron Maiden",
      "genre"=> "Metal",
      "year"=> "2000"
  ],
  [
      "poster"=> "https://upload.wikimedia.org/wikipedia/en/9/97/Eric_Clapton_OMCOMR.jpg",
      "title"=> "One more car, one more raider",
      "author"=> "Eric Clapton",
      "genre"=> "Rock",
      "year"=> "2002"
  ],
  [
      "poster"=> "https://images-na.ssl-images-amazon.com/images/I/51rggtPgmRL.jpg",
      "title"=> "Made in Japan",
      "author"=> "Deep Purple",
      "genre"=> "Rock",
      "year"=> "1972"
  ],
  [
      "poster"=> "https://images-na.ssl-images-amazon.com/images/I/81r3FVfNG3L._SY355_.jpg",
      "title"=> "And Justice for All",
      "author"=> "Metallica",
      "genre"=> "Metal",
      "year"=> "1988"
  ],
  [
      "poster"=> "https://img.discogs.com/KOBsqQwKiNKH-q927oHMyVdDzSo=/fit-in/596x596/filters:strip_icc():format(jpeg):mode_rgb():quality(90)/discogs-images/R-6406665-1418464475-6120.jpeg.jpg",
      "title"=> "Hard Wired",
      "author"=> "Dave Weckl",
      "genre"=> "Jazz",
      "year"=> "1994"
  ],
  [
      "poster"=> "https://m.media-amazon.com/images/I/71K9CbNZPsL._SS500_.jpg",
      "title"=> "Bad",
      "author"=> "Michael Jacjson",
      "genre"=> "Pop",
      "year"=> "1987"
  ]
  ];


  $genreArray = createSelectOptionGenre($album);
  $artistArray = createSelectOptionArtist($album);

  $isLoaded = true;

  // var_dump($genreArray);

  function createSelectOptionGenre($album){

  $genreArray = [];
        // Ciclo l'array della risposta API ed push gli elementi non presenti nell'array del genere musicale
        foreach ($album as $item => $singleAlbum) {

          if(!in_array($singleAlbum['genre'], $genreArray)){
            // console.log(element.genre);
            $genreArray[] = $singleAlbum['genre'];
          }
        }

    return $genreArray;

  }

  function createSelectOptionArtist($album){

    $artistArray = [];
          // Ciclo l'array della risposta API ed push gli elementi non presenti nell'array del genere musicale
          foreach ($album as $item => $singleAlbum) {
  
            if(!in_array($singleAlbum['author'], $artistArray )){
              // console.log(element.genre);
              $artistArray[] = $singleAlbum['author'];
            }
  
          }
          
      return $artistArray;
    }




?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <link rel="preconnect" href="https://fonts.googleapis.com"> 
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> 
  <link href="https://fonts.googleapis.com/css2?family=Encode+Sans+Condensed:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="./assets/style/style.css">

  <title>Document</title>
</head>
<body>

  <div id="app">

    <nav class="navbar navbar-expand-lg navbar_personal">
      <div class="container-fluid">
        <a class="navbar-brand logo" href="#">
          <img src="./assets/img/logo.png" alt="Logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fa-solid fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse navbar_select_container" id="navbarNav">
          
        <div>
          <!-- Al cambio del valore della select chiamo la relativa funzione che passa parametri al componente genitore -->
          <select 
          @change="onChangeSelectGenre"
          name="music-genre" id="genre">
            <option value="all" selected>Seleziona un genere</option>
            <?php  foreach ($genreArray as $item => $genre): ?>
            <option value="element"><?php echo $genre; ?></option>
            <?php endforeach; ?>

          </select>

          <!-- Al cambio del valore della select chiamo la relativa funzione che passa parametri al componente genitore -->
          <select 
            @change="onChangeSelectArtist"
            name="music-artist" id="artist">
              <option value="all" selected>Seleziona un'artista</option>
              <?php  foreach ($artistArray as $item => $artist): ?>
                <option value="element"><?php echo $artist; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
      </div>
    </nav>

    <main class="main_wrapper">
      
      <?php if($isLoaded): ?>
        <div v-if="isLoaded" class="album_container container">

          <?php  foreach ($album as $item => $singlealbum): ?>
          <div class="album_card"> 
          
              <div class="card_container">
                <img src="<?php echo $singlealbum['poster']; ?>" alt="<?php echo $singlealbum['title']; ?>">
                <h5> <?php echo $singlealbum['title']; ?></h5>
                <span><?php echo $singlealbum['author']; ?></span>
                <span><?php echo $singlealbum['year']; ?></span>
              </div>

          </div>
          <?php endforeach; ?>
      
        </div>
        <?php else: ?>

        <div class="container" v-else>
          <div class="loader_container">
            <div class="loader">
              <img src="./assets/img/logo.png" alt="Logo" />
            </div>
            <div class="title">LOADING YOUR FAVORITE MUSIC ...</div> 
          </div>
        </div>
        <?php endif; ?>
    </main>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>

</body>
</html>