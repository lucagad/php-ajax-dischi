<?php 
  include_once __DIR__.'/assets/data/db.php';

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