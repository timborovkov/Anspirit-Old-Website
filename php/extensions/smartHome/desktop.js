
	module.exports.processSpeech = function(speech, cb){
			var toRet = {"done":false};
	    cb(toRet);
	}
	module.exports.processActionFromSpeech = function(action, parameters, speech, emotion, cb){
			var toRet = {"done":false};
			 if(action != null){
				 if(action.contains('smarthome')){
					 if(window.NearestHub != null){
							 $.ajax({
								 type: 'get',
								 url: "http://api.anspirit.net:3000/hub/",
								 data: {task: {action: action, parameters: parameters}, secret: global.qapi.getUserSecret(), user: global.qapi.getUserId(), hubId: window.NearestHub.id},
								 success: function(data){
									 console.log("Data from hub: " + data);
									 toRet["done"] = true;
									 global.qSay("Done", function(){
										 	cb(toRet);
									 });
								 },
								 error: function(a, error) {
									 cb(toRet);
									 console.error(error);
								 }
							 });
						 }else {
							 console.log("No nearest hub found!");
						 }
				 }else{
						cb(toRet);
				 }
			 }else{
				 cb(toRet);
			 }
	}
	module.exports.onStart = function(callback){
	    //This will be executed during first loading
			console.log("Hello from SmartHome");
	    callback();
	}
