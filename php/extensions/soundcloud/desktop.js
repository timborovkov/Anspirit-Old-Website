module.exports.processSpeech = function(speech, callback) {
  var toRet = {"done":false};
  callback(toRet);
}
module.exports.processActionFromSpeech = function(action, parameters, speech, emotion, callback) {
  var toRet = {"done":false};
  if(action.contains("media.music")){
    toRet.done = true;
    var style = "Avicii";
    if (parameters.artist != null) {
      style = parameters.artist;
    }else if(parameters.genre != null){
      style = parameters.genre + " music";
    }
    var song = null;
    global.qapi.loadScript("http://anspirit.org/php/extensions/soundcloud/scSearch.js", function() {
      scSearch(style, 50, function callback(tracks){
            //URI tracks[i].uri
            //title tracks[i].title
            var songId = Math.floor((Math.random() * 50) + 1) - 1;
            song = tracks[songId].uri;
            var embded = '<iframe width="100%" height="166" scrolling="no" frameborder="no" src="';
            var url = "https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/34019569&color=0066cc";
            embded = embded + updateURLParameter(url, 'url', song);
            embded = embded + '"></iframe>';
            newCard(embded);
      });
    });
    callback(toRet);
  }else{
    callback(toRet);
  }
}
module.exports.onStart = function(callback) {
  console.log("Hello from SoundCloud");
  callback();
}
function updateURLParameter(url, param, paramVal){
    var newAdditionalURL = "";
    var tempArray = url.split("?");
    var baseURL = tempArray[0];
    var additionalURL = tempArray[1];
    var temp = "";
    if (additionalURL) {
        tempArray = additionalURL.split("&");
        for (i=0; i<tempArray.length; i++){
            if(tempArray[i].split('=')[0] != param){
                newAdditionalURL += temp + tempArray[i];
                temp = "&";
            }
        }
    }

    var rows_txt = temp + "" + param + "=" + paramVal;
    return baseURL + "?" + newAdditionalURL + rows_txt;
}
