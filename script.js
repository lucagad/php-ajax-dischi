const app = new Vue({
  el: '#app',

  data:{
    baseURL:'http://localhost:8888/php-ajax-dischi/api.php',
    albumArray:[],
    isLoaded : false,

    genreArray:[],
    artistArray:[],
    filterKeyGenre:'',
    filterKeyArtist:'',


    error_msg: '',
    success : true,
  },
  mounted() {
    this.getApi();
    setTimeout(() => {this.isLoaded = true}, 2000);
  },

  methods: {
    getApi(){
      axios.get(this.baseURL)
      .then(response =>{
        this.albumArray = response.data.album;
        this.success = response.data.success;
        this.error_msg = response.data.error_msg;
        console.log(response.data.album);
        setTimeout(() => {this.isLoaded = true}, 1000);
        this.createSelectOption();
      })
    },

    // Funzione che salva il valore del parametro ricevuto dal componente figlio in una variabile del componente stesso
    filterAlbumGenre(value) {
      this.filterForGenre = value;
      console.log("VUE.APP -----> Select Genre Value:", value);
  },

  // Funzione che salva il valore del parametro ricevuto dal componente figlio in una variabile del componente stesso
  filterAlbumArtist(value) {
      this.filterForArtist = value;
      console.log("VUE.APP -----> Select Artist Value:", value);
  },

  // HEADER

  // SELECT

  createSelectOption(){
    console.log('START createSelectOption');

    // Ciclo l'array della risposta API ed push gli elementi non presenti nell'array del genere musicale
    this.albumArray.forEach(element => {
      if(!this.genreArray.includes(element.genre)){
        console.log(element.genre);
        this.genreArray.push(element.genre);
      }
    });

    // Ciclo l'array della risposta API ed push gli elementi non presenti nell'array degli artisti
    this.albumArray.forEach(element => {
      if(!this.artistArray.includes(element.author)){
        console.log(element.author);
        this.artistArray.push(element.author);
      }
    });
  },

  onChangeSelectGenre (value) {
    // Funzione che al cambio di valore della select dei generi invia l'evento ed il valore della select stessa al componente genitore
    this.filterKeyGenre = event.target.value;
    console.log("CHILDREN Genre ---> CHANGED", event.target.value);
  },

  onChangeSelectArtist (value){
    // Funzione che al cambio di valore della select degli artisti invia l'evento ed il valore della select stessa al componente genitore
    this.filterKeyArtist = event.target.value;
    console.log("CHILDREN Artist ---> CHANGED", event.target.value);
  }


  },
  computed:{
    filteredAlbum(){

      let arrayFiltered = [];
      if (this.filterKeyGenre == "all" && this.filterKeyArtist == "all"){
        arrayFiltered = this.albumArray;

      } else if (this.filterKeyGenre == "all" && this.filterKeyArtist != "all"){
        arrayFiltered = this.albumArray.filter( album => {
          return album.author.includes(this.filterKeyArtist);
        })

      } else if (this.filterKeyArtist == "all" && this.filterKeyGenre != "all"){
        arrayFiltered = this.albumArray.filter( album => {
          return album.genre.includes(this.filterKeyGenre);
        })

      } else if (this.filterKeyArtist != "all" && this.filterKeyGenre != "all"){
        arrayFiltered = this.albumArray.filter( album => {
          return (album.genre.includes(this.filterKeyGenre) && album.author.includes(this.filterKeyArtist));
        })
      }

      return arrayFiltered;

    }
  }
})