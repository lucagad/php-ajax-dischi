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
  },

  methods: {
    getApi(){
      axios.get(this.baseURL)
      .then(response =>{
        this.albumArray = response.data.album;
        this.success = response.data.success;
        this.error_msg = response.data.error_msg;
        this.genreArray = response.data.genre;
        this.artistArray = response.data.artist;

        console.log(response.data.album);
        setTimeout(() => {this.isLoaded = true}, 2000);
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