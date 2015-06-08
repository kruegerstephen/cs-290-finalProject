$( document ).ready(function() {


var userNameAvail = true;
var currentList = [];
var movieNameList = [];
var movieList = [];
var imgCombine;
function listObject(listName, id_1,id_2,id_3,id_4,id_5){
    this.listName = listName;
    this.id_1 = id_1;
    this.id_2 = id_2;
    this.id_3 = id_3;
    this.id_4 = id_4;
    this.id_5 = id_5;
}
function movieObject(id, name, releaseDate,summary,img) {
  this.id = id;
  this.name = name;
  this.releaseDate = releaseDate;
  this.summary = summary;
  this.img = img;
}
var movieResults;
var saveThisList;

 var  base_url = 'http://api.themoviedb.org/3/',
        mode = 'search/movie?query=',
        input,
        movieName,
        key = '&api_key=470fd2ec8853e25d2f8d86f685d2270e',
        img_url = 'https://image.tmdb.org/t/p/w150/';


$("table").on('click', '.addToList',function() {
   var movieID = $(this).val();
   var inList = false;
   
   if($.inArray(movieID,currentList)>-1){
       $(".already").empty();	
       $(".curList").append("<h4 class = 'already'>Movie already in List<h4>");
       inList = true;
   }else{
       currentList[currentList.length] = movieID;
       inList = false;
   }


if(inList==false){
 for(var x = 0; x<movieResults.results.length;x++){
     var movCheck = movieResults.results[x].id.toString();
     if(movCheck === movieID){
         imgCombine = img_url+movieResults.results[x].poster_path;
         var movie = new movieObject(movieID,movieResults.results[x].original_title,movieResults.results[x].release_date,movieResults.results[x].overview,imgCombine);
         break;
     }
 }
   
  
 if(movie!=null && movieList.length<5){ 
  movieList[movieList.length] = movie;
  $(".curList").empty();
  for(var i = 0; i<movieList.length; i++){
   $(".curList").append("<tr class = 'listResult_" + movieList[i].id+"'>" + movieList[i].name +"</tr>");
                       $(".listResult_" + movieList[i].id).append("<td><img class = 'imgListUrl' src ="+movieList[i].img+"></img><td>")
                       $(".listResult_" + movieList[i].id).append("<td class = 'descriptionList_"+movieList[i].id+"'><h3 class = 'listName' value ="+movieList[i].name+">"
                       +movieList[i].name+"</h3><h4 class = 'releaseListDate'>Release Date: "
                       +movieList[i].releaseDate+"</h4><p id = 'movieListSummary'>" +  movieList[i].summary+"</p><td>");
                       $(".descriptionList_" + movieList[i].id).append("<button class = 'removeFromList' value = "+movieList[i].id+">Remove From List</button>");
  }
 }else{
    $(".curList").append("You cannot add more than 5 movies to your list");
 }
}
});
 

$("table").on('click', '.removeFromList',function() {
  var removeTerm = $(this).val(),
    index = -1;

for(var x = 0; x < currentList.length; x++) {
    if (currentList[x] === removeTerm) {
	currentList.splice(x,1);	
	}
}


for(var i = 0; i < movieList.length; i++) {
    if (movieList[i].id === removeTerm) {
        index = i;o
	movieList.splice(index,1);
	$(".curList").empty();
  	for(var i = 0; i<movieList.length; i++){
   		$(".curList").append("<tr class = 'listResult_" + movieList[i].id+"'>" + movieList[i].name +"</tr>");
                       $(".listResult_" + movieList[i].id).append("<td><img class = 'imgListUrl' src ="+movieList[i].img+"></img><td>")
                       $(".listResult_" + movieList[i].id).append("<td class = 'descriptionList_"+movieList[i].id+"'><h3 class = 'listName' value ="+movieList[i].name+">"
                       +movieList[i].name+"</h3><h4 class = 'releaseListDate'>Release Date: "
                       +movieList[i].releaseDate+"</h4><p id = 'movieListSummary'>" +  movieList[i].summary+"</p><td>");
                       $(".descriptionList_" + movieList[i].id).append("<button class = 'removeFromList' value = "+movieList[i].id+">Remove From List</button>");
  		}

        break;
    }
}

});
 
$('.saveList').click(function(){
    var listName = $(".listSavedName").val();
    var boolSaveList;
    /*$.ajax({
            url:"checkListTable.php",
            type:'POST',
            data: 'listName='+listName,
            error: function (status) {
                alert(status);
            },
            succes: function (data){
             if(data != ""){
                 boolSaveList = false;
                $(".saveList").prop("disabled",true);
             }else{
                 boolSaveList = true;
                $(".saveList").prop("disabled",false);
             }
            }
            
        });*/
        
    if(movieList.length==5 /* && boolSaveList == true*/){
        var listName = $(".listSavedName").val();
        
         saveThisList = new listObject(listName, movieList[0].id,movieList[1].id,movieList[2].id,movieList[3].id,movieList[4].id); 
         saveLists(saveThisList);
    }
    
    
});   
  

function saveLists(saveThisList){
    var i = 0;
    $.ajax({
        url: "addList.php",
        type: 'POST',
        data: 'listName='+saveThisList.listName+'&id_1='+saveThisList.id_1+'&id_2='+saveThisList.id_2+'&id_3='+saveThisList.id_3+'&id_4='+saveThisList.id_4+'&id_5='+saveThisList.id_5,
        succes: function(data){
        }
    });
    location.reload()
};
   
   
   

$('#user').keyup(function(){
    var username = $('#user').val();
    if(username.length>2){
       $.ajax({
          url: "validation.php",
          type: 'POST',
          data: 'username=' + username,
          success: function(result){
                     if(result == ""){
                        $("#availability").html("No Results");
                        userNameAvail = true;
                     }
                     else{
                        $("#availability").html("Not available")
                        userNameAvail = false;
                     }
                   }
          });
    }
});


$('#addUserSubmit').click(function(){
        var username = $('#user').val();
        var password = $('#password').val();
    if(userNameAvail!=false){    
      $.ajax({
          url: "addUser.php",
          type: 'POST',
          data: 'user=' + username +'&password=' + password,
          success: function(result){
                     if(result == "true"){
                        $("#signedIn").html("User Added, sign in below");
                     }
                     else{
                        $("#signedIn").html("Not available")
                     }
                   }
          });
    }
    
});



$('#loginUser').click(function(){
        var username = $('#user').val();
        var password = $('#password').val();
      $.ajax({
          url: "loginResult.php",
          type: 'POST',
          data: 'username=' + username +'&password=' + password,
          success: function(result){
                     if(result == "true"){
                        $("body").html("User signed in");
                     }
                     else{
                        $("body").html("Not available")
                     }
                   }
          });
});




$("#searchForFilm").click(function() {
        var input = $('#filmSearch').val(),
            movieName = encodeURI(input);
            $('.movieDiv').empty();
        $.ajax({
            type: 'GET',
            url: base_url + mode + input + key,
            async: false,
            contentType: 'application/json',
            dataType: 'jsonp',
            success: function(data) {
                movieResults = data;
		if(movieResults.total_results!=0){ 
		  $(".movieDiv").empty();
               for(var i = 0; i<data.results.length; i++){
                   if(data.results[i].poster_path != null){
                       $(".movieDiv").append("<tr class = 'movieSearchResult_" + data.results[i].id+"'>" + data.results[i].original_title+"</tr>");
                       $(".movieSearchResult_" + data.results[i].id).append("<td><img class = 'imgurl_"+data.results[i].id+"' value ='"+img_url+data.results[i].poster_path+"'src = "+img_url+data.results[i].poster_path+"></img><td>");
                       $(".movieSearchResult_" + data.results[i].id).append("<td class = 'description_"+data.results[i].id+"'><h3 class = 'name_"+data.results[i].id+"' value ="+data.results[i].original_title+">"+data.results[i].original_title+"</h3><h4 class = 'releaseDate' value = '"+data.results[i].release_date+">Release Date: "+data.results[i].release_date+"</h4><p id = 'movieSummary'>" + data.results[i].overview+"</p><td>");
                       $(".description_" + data.results[i].id).append("<button class = 'addToList' value = "+data.results[i].id+">Add To List</button>");
                   }
               }
	      }else{
		$(".movieDiv").empty();

		$(".movieDiv").append("<h3>No Results, try again.</h3>")		

	      }
            },
            error: function(e) {
                alert("failed");
            }
        });
});

// set your delay here, 2 seconds as an example...
var my_delay = 2000;


// function that processes your ajax calls...
function callAjax(i) {
    var  mode = 'movie/';
    var  key = '&?api_key=470fd2ec8853e25d2f8d86f685d2270e';
    $.ajax({
        type: 'GET',
        url: base_url + mode + i +key,
        async: false,
        contentType: 'application/json',
        dataType: 'jsonp',
        success: function(data) {
              if(data.poster_path != null){
                       $(".userList").append("<tr class = 'userSearchResult_" + data.id+"'>" + data.original_title+"</tr>");
                       $(".userSearchResult_" + data.id).append("<td><img class = 'img_"+data.id+"' value ='"+img_url+data.poster_path+"'src = "+img_url+data.poster_path+"></img><td>");
                       $(".userSearchResult_" + data.id).append("<td class = 'user_movie_description_"+data.id+"'><h3 class = 'name_"+data.id+"' value ="+data.original_title+">"+data.original_title+"</h3><h4 class = 'releaseDate' value = '"+data.release_date+"'>Release Date: "+data.release_date+"</h4><p id = 'movieSummary'>" + data.overview+"</p><td>");
                   }
         }
  });
}

$(".movieList_Gen").click(function(){
    var input = $(this).text();
    $(".clear_list").show();
    $.ajax({
          url: "myLists.php",
          type: 'POST',
          data: 'movieList_name=' + input,
          success: function(result){
                    var i = JSON.parse(result);
                   $(".userList").empty();
                         for(var z = 0; z<5; z++){
                             setTimeout(callAjax(i[z]), 10000);
                    }
                }
          });
    
    
});

$(".clear_list").click(function() {
   $(".userList").empty();
   $(this).hide();
});
    
$('#logout').click(function() {
    $.ajax({
          url: "logout.php",
          success: function(result){
          
              
          }
          });
});
    
    

});