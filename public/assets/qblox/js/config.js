var QBApp = {
  appId: 46915,
  authKey: 'S67XjEfhHJK42Xh',
  authSecret: 'ODuqE9jXSWuVgXm'
};

var config = {
  chatProtocol: {
    active: 2
  },
  debug: {
    mode: 1,
    file: null
  },
  stickerpipe: {
    elId: 'stickers_btn',

    apiKey: '847b82c49db21ecec88c510e377b452c',

    enableEmojiTab: false,
    enableHistoryTab: true,
    enableStoreTab: true,

    userId: null,

    priceB: '0.99 $',
    priceC: '1.99 $'
  }
};

var QBUser1 = {
        id: 17763700,
        name: 'Mochamad Panji Aryo Bimo',
        login: 'bimo13',
        pass: 'Bimo321+'
    };

QB.init(QBApp.appId, QBApp.authKey, QBApp.authSecret, config);
