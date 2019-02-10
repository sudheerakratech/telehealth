const maxUsers = 1;
var partnerID;
var myName;
var partnerName;
var room_name = 'default';

//const base_url = 'https://lite.tokbird.com:9443' 
const base_url = 'https://video.akrahealth.com:443' ;

var QueryString = function () {
    var query_string = {};
    var query = window.location;
    query = query.toString();
    query = query.split('?');
    if (query[1]) {
        query = query[1];
        var vars = query.split("&");
        for (var i = 0; i < vars.length; i++) {
            var pair = vars[i].split("=");
            if (typeof query_string[pair[0]] === "undefined") {
                query_string[pair[0]] = decodeURIComponent(pair[1]);
            } else if (typeof query_string[pair[0]] === "string") {
                var arr = [query_string[pair[0]], decodeURIComponent(pair[1])];
                query_string[pair[0]] = arr;
            } else {
                query_string[pair[0]].push(decodeURIComponent(pair[1]));
            }
        }
        return query_string;
    } else {
        return false;
    }
}();


if (QueryString.room) {
    room_name = QueryString.room;
}
if (QueryString.uname) {
    myName = QueryString.uname;
}
if (QueryString.oname) {
    partnerName = QueryString.oname;
    document.getElementById('partnerName').innerText=partnerName;
}

var webrtc = new SimpleWebRTC({
    // the id/element dom element that will hold "our" video
    localVideoEl: 'self',
    // the id/element dom element that will hold remote videos
    remoteVideosEl: '',
    nick: myName,
    // immediately ask for camera access
    autoRequestMedia: true,
    debug: false,
    url: base_url
});

webrtc.testReadiness();
webrtc.on('readyToCall', function () {
     webrtc.joinRoom(room_name, (err, roomDesc) => {
        let len = Object.keys(roomDesc.clients).length;
        if (len > maxUsers) {
            webrtc.disconnect();
            alert('Room is busy right now. Please try again later.');
       }

    });
    
});

webrtc.on('videoAdded', function (video, peer) {
   
    var remotes = document.getElementById('subscriber');
   
    remotes.appendChild(video);
    $('#' + webrtc.getDomId(peer)).css({"width": "100%", "height": "100%"});
    partnerID=webrtc.getDomId(peer);
});
webrtc.on('videoRemoved', function (video, peer) {
   $("#subscriber").empty();
   partnerID=null;

});

function sendmessage() {

    let text = document.getElementById('message').value;
    if (text.replace(/\s/g, "").length === 0) { // Don't send just whitespace
        return;
    }
    if (partnerID == null) { // Don't send just whitespace
        return;
    } else {
        webrtc.sendDirectlyToAll('onReceiveSendToAll', 'onReceiveSendToAll', {
            data: text
        });
        
    }
    addToConversation("me", text);
    document.getElementById('message').value = "";
    
}

webrtc.on('channelMessage', function (peer, label, data) {
    console.log(peer, label, data);

    if (label == "onReceiveSendToAll") {
        addToConversation(peer.nick, data.payload.data);
     }
});



webrtc.on('createdPeer', function (peer) {
    //showNotifiction('New user joined');
    if (peer && peer.pc) {
        peer.pc.on('iceConnectionStateChange', function (event) {
            switch (peer.pc.iceConnectionState) {
                case 'checking':

                    break;
                case 'connected':
                case 'completed': // on caller side

                    break;
                case 'disconnected':

                    break;
                case 'failed':
                    showNotifiction(
                        "Unable to connect remote peer.Please check your firewall settings"
                    );
                    break;
                case 'closed':
                    //console.log('created peer--Connection closed.');
                    break;
            }
        });

    }

});

function addToConversation(who, content) {
    // Escape html special characters, then add linefeeds.
    content = content.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
    content = content.replace(/\n/g, '<br />');
    console.log(who);
    let _class = null;
    if (who == 'me') {
        _class = 'blue-color';
    } else {
        _class = 'red-color';
        who=partnerName;
    }
     document.getElementById('messages').innerHTML += '<div class="row"><div class="col-lg-2"><span class="blue-color"><strong>' + who + '</strong><br><small>2018-08-16 16:04:22</small></span></div><div class="col-md-10"><blockquote class="' + _class + '"><small>' + content + '</small></blockquote></div></div>';
}



