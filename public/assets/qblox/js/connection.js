//"use strict";

var currentUser;

$(document).ready(function() {
  currentUser = QBLoginEdtrx;
  connectToChat(QBLoginEdtrx);
});

function connectToChat(user) {
  $('#loginForm button').hide();
  $('#loginForm .progress').show();

  // Create session and connect to chat
  //
  QB.createSession({login: user.login, password: user.pass}, function(err, res) {
    if (res) {
      // save session token
      token = res.token;

      user.id = res.user_id;
      mergeUsers([{user: user}]);

      QB.chat.connect({userId: user.id, password: user.pass}, function(err, roster) {
        if (err) {
          console.log(err);
        } else {
          console.log(roster);

          // setup scroll stickerpipe module
          //
          setupStickerPipe();

          // load chat dialogs
          //
          retrieveChatDialogs();

          // setup message listeners
          //
          setupAllListeners();

          // setup scroll events handler
          //
          setupMsgScrollHandler();
        }
      });
    }
  });
}

function setupAllListeners() {
  QB.chat.onDisconnectedListener    = onDisconnectedListener;
  QB.chat.onReconnectListener       = onReconnectListener;
  QB.chat.onMessageListener         = onMessage;
  QB.chat.onSystemMessageListener   = onSystemMessageListener;
  QB.chat.onDeliveredStatusListener = onDeliveredStatusListener;
  QB.chat.onReadStatusListener      = onReadStatusListener;
  setupIsTypingHandler();
}

// reconnection listeners
function onDisconnectedListener(){
  console.log("onDisconnectedListener");
}

function onReconnectListener(){
  console.log("onReconnectListener");
}


// niceScroll() - ON
$(document).ready(
    function() {
        $("html").niceScroll({cursorcolor:"#53C7D1", cursorwidth:"5", zindex:"99999"});
        $(".nice-scroll").niceScroll({cursorcolor:"#53C7D1", cursorwidth:"5", zindex:"99999"});
    }
);
