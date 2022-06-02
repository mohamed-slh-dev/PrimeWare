/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/app.js":
/*!*****************************!*\
  !*** ./resources/js/app.js ***!
  \*****************************/
/***/ ((__unused_webpack_module, __unused_webpack_exports, __webpack_require__) => {

__webpack_require__(/*! ./bootstrap */ "./resources/js/bootstrap.js");

var app = new Vue({
  el: '#app',
  data: {
    messages: [],
    newMessage: ''
  },
  created: function created() {
    var _this = this;

    this.fetchMessages();
    Echo["private"]('chat').listen('MessageSentEvent', function (e) {
      _this.messages.push({
        message: e.message.message,
        user: e.user
      });
    });
  },
  methods: {
    fetchMessages: function fetchMessages() {
      var _this2 = this;

      axios.get('/messages').then(function (response) {
        _this2.messages = response.data;
      });
    },
    addMessage: function addMessage(message) {
      var _this3 = this;

      axios.post('/messages', {
        message: message
      }).then(function (response) {
        _this3.messages.push({
          message: response.data.message.message,
          user: response.data.user
        });
      });
    },
    sendMessage: function sendMessage() {
      this.addMessage(this.newMessage);
      this.newMessage = '';
    }
  }
});

/***/ }),

/***/ "./resources/js/bootstrap.js":
/*!***********************************!*\
  !*** ./resources/js/bootstrap.js ***!
  \***********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var laravel_echo__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! laravel-echo */ "./node_modules/laravel-echo/dist/echo.js");
/* harmony import */ var larasocket_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! larasocket-js */ "./node_modules/larasocket-js/dist/index.js");
// window._ = require('lodash');

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */
// window.axios = require('axios');
// window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */
// import Echo from 'laravel-echo';
// window.Pusher = require('pusher-js');
// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     forceTLS: true
// });


window.Echo = new laravel_echo__WEBPACK_IMPORTED_MODULE_0__.default({
  broadcaster: larasocket_js__WEBPACK_IMPORTED_MODULE_1__.default,
  token: "1664|yWgfYt10XnkRs7Jghvx0qzdQ2Rt899tTc1h4u4PJ"
});

/***/ }),

/***/ "./node_modules/larasocket-js/dist/channel/channel.js":
/*!************************************************************!*\
  !*** ./node_modules/larasocket-js/dist/channel/channel.js ***!
  \************************************************************/
/***/ ((__unused_webpack_module, exports) => {

"use strict";

Object.defineProperty(exports, "__esModule", ({ value: true }));
exports.Channel = void 0;
/**
 * This class represents a basic channel.
 */
var Channel = /** @class */ (function () {
    function Channel() {
    }
    /**
     * Listen for a whisper event on the channel instance.
     */
    Channel.prototype.listenForWhisper = function (event, callback) {
        return this.listen('.client-' + event, callback);
    };
    /**
     * Listen for an event on the channel instance.
     */
    Channel.prototype.notification = function (callback) {
        return this.listen('.Illuminate\\Notifications\\Events\\BroadcastNotificationCreated', callback);
    };
    /**
     * Stop listening for a whispser event on the channel instance.
     */
    Channel.prototype.stopListeningForWhisper = function (event) {
        return this.stopListening('.client-' + event);
    };
    return Channel;
}());
exports.Channel = Channel;


/***/ }),

/***/ "./node_modules/larasocket-js/dist/channel/index.js":
/*!**********************************************************!*\
  !*** ./node_modules/larasocket-js/dist/channel/index.js ***!
  \**********************************************************/
/***/ (function(__unused_webpack_module, exports, __webpack_require__) {

"use strict";

var __createBinding = (this && this.__createBinding) || (Object.create ? (function(o, m, k, k2) {
    if (k2 === undefined) k2 = k;
    Object.defineProperty(o, k2, { enumerable: true, get: function() { return m[k]; } });
}) : (function(o, m, k, k2) {
    if (k2 === undefined) k2 = k;
    o[k2] = m[k];
}));
var __exportStar = (this && this.__exportStar) || function(m, exports) {
    for (var p in m) if (p !== "default" && !exports.hasOwnProperty(p)) __createBinding(exports, m, p);
};
Object.defineProperty(exports, "__esModule", ({ value: true }));
__exportStar(__webpack_require__(/*! ./channel */ "./node_modules/larasocket-js/dist/channel/channel.js"), exports);
__exportStar(__webpack_require__(/*! ./larasocket-channel */ "./node_modules/larasocket-js/dist/channel/larasocket-channel.js"), exports);
__exportStar(__webpack_require__(/*! ./larasocket-private-channel */ "./node_modules/larasocket-js/dist/channel/larasocket-private-channel.js"), exports);
__exportStar(__webpack_require__(/*! ./larasocket-presence-channel */ "./node_modules/larasocket-js/dist/channel/larasocket-presence-channel.js"), exports);


/***/ }),

/***/ "./node_modules/larasocket-js/dist/channel/larasocket-channel.js":
/*!***********************************************************************!*\
  !*** ./node_modules/larasocket-js/dist/channel/larasocket-channel.js ***!
  \***********************************************************************/
/***/ (function(__unused_webpack_module, exports, __webpack_require__) {

"use strict";

var __extends = (this && this.__extends) || (function () {
    var extendStatics = function (d, b) {
        extendStatics = Object.setPrototypeOf ||
            ({ __proto__: [] } instanceof Array && function (d, b) { d.__proto__ = b; }) ||
            function (d, b) { for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p]; };
        return extendStatics(d, b);
    };
    return function (d, b) {
        extendStatics(d, b);
        function __() { this.constructor = d; }
        d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
    };
})();
Object.defineProperty(exports, "__esModule", ({ value: true }));
exports.LarasocketChannel = void 0;
/**
 * This class represents a Socket.io channel.
 */
var channel_1 = __webpack_require__(/*! ./channel */ "./node_modules/larasocket-js/dist/channel/channel.js");
var util_1 = __webpack_require__(/*! ../util */ "./node_modules/larasocket-js/dist/util/index.js");
var LarasocketChannel = /** @class */ (function (_super) {
    __extends(LarasocketChannel, _super);
    /**
     * Create a new class instance.
     */
    function LarasocketChannel(socket, name, options) {
        var _this = _super.call(this) || this;
        /**
         * The event callbacks applied to the channel.
         */
        _this.events = {};
        _this.eventFormatter = new util_1.EventFormatter(options.namespace);
        _this.name = name;
        _this.socket = socket;
        _this.options = options;
        _this.subscribe();
        return _this;
    }
    /**
     * Subscribe to a Socket.io channel.
     */
    LarasocketChannel.prototype.subscribe = function () {
        this.socket.subscribe(this);
    };
    /**
     * Unsubscribe from channel and ubind event callbacks.
     */
    LarasocketChannel.prototype.unsubscribe = function () {
        this.unbind();
        this.socket.unsubscribe(this);
    };
    /**
     * Listen for an event on the channel instance.
     */
    LarasocketChannel.prototype.listen = function (event, callback) {
        this.on(event, callback);
        return this;
    };
    /**
     * Stop listening for an event on the channel instance.
     */
    LarasocketChannel.prototype.stopListening = function (event) {
        var name = this.eventFormatter.format(event);
        this.socket.removeListener(name);
        delete this.events[name];
        return this;
    };
    /**
     * Bind the channel's socket to an event and store the callback.
     */
    LarasocketChannel.prototype.on = function (event, callback) {
        this.socket.on(event, callback);
        this.bind(event, callback);
    };
    /**
     * Bind the channel's socket to an event and store the callback.
     */
    LarasocketChannel.prototype.bind = function (event, callback) {
        this.events[event] = this.events[event] || [];
        this.events[event].push(callback);
    };
    /**
     * Unbind the channel's socket from all stored event callbacks.
     */
    LarasocketChannel.prototype.unbind = function () {
        var _this = this;
        Object.keys(this.events).forEach(function (event) {
            _this.socket.removeListener(event);
            delete _this.events[event];
        });
    };
    return LarasocketChannel;
}(channel_1.Channel));
exports.LarasocketChannel = LarasocketChannel;


/***/ }),

/***/ "./node_modules/larasocket-js/dist/channel/larasocket-presence-channel.js":
/*!********************************************************************************!*\
  !*** ./node_modules/larasocket-js/dist/channel/larasocket-presence-channel.js ***!
  \********************************************************************************/
/***/ (function(__unused_webpack_module, exports, __webpack_require__) {

"use strict";

var __extends = (this && this.__extends) || (function () {
    var extendStatics = function (d, b) {
        extendStatics = Object.setPrototypeOf ||
            ({ __proto__: [] } instanceof Array && function (d, b) { d.__proto__ = b; }) ||
            function (d, b) { for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p]; };
        return extendStatics(d, b);
    };
    return function (d, b) {
        extendStatics(d, b);
        function __() { this.constructor = d; }
        d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
    };
})();
Object.defineProperty(exports, "__esModule", ({ value: true }));
exports.LarasocketPresenceChannel = void 0;
var larasocket_private_channel_1 = __webpack_require__(/*! ./larasocket-private-channel */ "./node_modules/larasocket-js/dist/channel/larasocket-private-channel.js");
/**
 * This class represents a Socket.io presence channel.
 */
var LarasocketPresenceChannel = /** @class */ (function (_super) {
    __extends(LarasocketPresenceChannel, _super);
    function LarasocketPresenceChannel() {
        return _super !== null && _super.apply(this, arguments) || this;
    }
    /**
     * Register a callback to be called anytime the member list changes.
     */
    LarasocketPresenceChannel.prototype.here = function (callback) {
        this.on('.presence:subscribed', callback);
        return this;
    };
    /**
     * Listen for someone joining the channel.
     */
    LarasocketPresenceChannel.prototype.joining = function (callback) {
        this.on('.presence:joining', callback);
        return this;
    };
    /**
     * Listen for someone leaving the channel.
     */
    LarasocketPresenceChannel.prototype.leaving = function (callback) {
        this.on('.presence:leaving', callback);
        return this;
    };
    return LarasocketPresenceChannel;
}(larasocket_private_channel_1.LarasocketPrivateChannel));
exports.LarasocketPresenceChannel = LarasocketPresenceChannel;


/***/ }),

/***/ "./node_modules/larasocket-js/dist/channel/larasocket-private-channel.js":
/*!*******************************************************************************!*\
  !*** ./node_modules/larasocket-js/dist/channel/larasocket-private-channel.js ***!
  \*******************************************************************************/
/***/ (function(__unused_webpack_module, exports, __webpack_require__) {

"use strict";

var __extends = (this && this.__extends) || (function () {
    var extendStatics = function (d, b) {
        extendStatics = Object.setPrototypeOf ||
            ({ __proto__: [] } instanceof Array && function (d, b) { d.__proto__ = b; }) ||
            function (d, b) { for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p]; };
        return extendStatics(d, b);
    };
    return function (d, b) {
        extendStatics(d, b);
        function __() { this.constructor = d; }
        d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
    };
})();
Object.defineProperty(exports, "__esModule", ({ value: true }));
exports.LarasocketPrivateChannel = void 0;
var larasocket_channel_1 = __webpack_require__(/*! ./larasocket-channel */ "./node_modules/larasocket-js/dist/channel/larasocket-channel.js");
var outgoing_message_1 = __webpack_require__(/*! ../util/outgoing-message */ "./node_modules/larasocket-js/dist/util/outgoing-message.js");
/**
 * This class represents a Socket.io presence channel.
 */
var LarasocketPrivateChannel = /** @class */ (function (_super) {
    __extends(LarasocketPrivateChannel, _super);
    function LarasocketPrivateChannel() {
        return _super !== null && _super.apply(this, arguments) || this;
    }
    /**
     * Trigger client event on the channel.
     */
    LarasocketPrivateChannel.prototype.whisper = function (eventName, data) {
        var message = this.socket.getSocketMessage(outgoing_message_1.OutgoingMessageType.WHISPER);
        message.channel = this;
        message.event = "client-" + eventName;
        message.payload = data;
        this.socket.send(message);
        return this;
    };
    return LarasocketPrivateChannel;
}(larasocket_channel_1.LarasocketChannel));
exports.LarasocketPrivateChannel = LarasocketPrivateChannel;


/***/ }),

/***/ "./node_modules/larasocket-js/dist/connector/connector.js":
/*!****************************************************************!*\
  !*** ./node_modules/larasocket-js/dist/connector/connector.js ***!
  \****************************************************************/
/***/ ((__unused_webpack_module, exports) => {

"use strict";

Object.defineProperty(exports, "__esModule", ({ value: true }));
exports.Connector = void 0;
var Connector = /** @class */ (function () {
    /**
     * Create a new class instance.
     */
    function Connector(options) {
        /**
         * Default connector options.
         */
        this._defaultOptions = {
            auth: {
                headers: {},
            },
            authEndpoint: '/broadcasting/auth',
            broadcaster: 'pusher',
            csrfToken: null,
            host: null,
            key: null,
            namespace: 'App.Events',
        };
        this.setOptions(options);
        this.connect();
    }
    /**
     * Merge the custom options with the defaults.
     */
    Connector.prototype.setOptions = function (options) {
        this.options = Object.assign(this._defaultOptions, options);
        if (this.csrfToken()) {
            this.options.auth.headers['X-CSRF-TOKEN'] = this.csrfToken();
        }
        return options;
    };
    /**
     * Extract the CSRF token from the page.
     */
    Connector.prototype.csrfToken = function () {
        var selector;
        // @ts-ignore
        if (typeof window !== 'undefined' && window.Laravel && window.Laravel.csrfToken) {
            // @ts-ignore
            return window.Laravel.csrfToken;
        }
        else if (this.options.csrfToken) {
            return this.options.csrfToken;
        }
        else if (typeof document !== 'undefined' && typeof document.querySelector === 'function') {
            selector = document.querySelector('meta[name="csrf-token"]');
            if (selector) {
                return selector.getAttribute('content');
            }
        }
        return null;
    };
    return Connector;
}());
exports.Connector = Connector;


/***/ }),

/***/ "./node_modules/larasocket-js/dist/connector/index.js":
/*!************************************************************!*\
  !*** ./node_modules/larasocket-js/dist/connector/index.js ***!
  \************************************************************/
/***/ (function(__unused_webpack_module, exports, __webpack_require__) {

"use strict";

var __createBinding = (this && this.__createBinding) || (Object.create ? (function(o, m, k, k2) {
    if (k2 === undefined) k2 = k;
    Object.defineProperty(o, k2, { enumerable: true, get: function() { return m[k]; } });
}) : (function(o, m, k, k2) {
    if (k2 === undefined) k2 = k;
    o[k2] = m[k];
}));
var __exportStar = (this && this.__exportStar) || function(m, exports) {
    for (var p in m) if (p !== "default" && !exports.hasOwnProperty(p)) __createBinding(exports, m, p);
};
Object.defineProperty(exports, "__esModule", ({ value: true }));
__exportStar(__webpack_require__(/*! ./connector */ "./node_modules/larasocket-js/dist/connector/connector.js"), exports);
__exportStar(__webpack_require__(/*! ./larasocket-connector */ "./node_modules/larasocket-js/dist/connector/larasocket-connector.js"), exports);


/***/ }),

/***/ "./node_modules/larasocket-js/dist/connector/larasocket-connector.js":
/*!***************************************************************************!*\
  !*** ./node_modules/larasocket-js/dist/connector/larasocket-connector.js ***!
  \***************************************************************************/
/***/ (function(__unused_webpack_module, exports, __webpack_require__) {

"use strict";

var __extends = (this && this.__extends) || (function () {
    var extendStatics = function (d, b) {
        extendStatics = Object.setPrototypeOf ||
            ({ __proto__: [] } instanceof Array && function (d, b) { d.__proto__ = b; }) ||
            function (d, b) { for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p]; };
        return extendStatics(d, b);
    };
    return function (d, b) {
        extendStatics(d, b);
        function __() { this.constructor = d; }
        d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
    };
})();
Object.defineProperty(exports, "__esModule", ({ value: true }));
exports.LarasocketConnector = void 0;
var channel_1 = __webpack_require__(/*! ../channel */ "./node_modules/larasocket-js/dist/channel/index.js");
var connector_1 = __webpack_require__(/*! ./connector */ "./node_modules/larasocket-js/dist/connector/connector.js");
var util_1 = __webpack_require__(/*! ../util */ "./node_modules/larasocket-js/dist/util/index.js");
/**
 * This class creates a connector to a Socket.io server.
 */
var LarasocketConnector = /** @class */ (function (_super) {
    __extends(LarasocketConnector, _super);
    function LarasocketConnector() {
        var _this = _super !== null && _super.apply(this, arguments) || this;
        /**
         * All of the subscribed channel names.
         */
        _this.channels = {};
        return _this;
    }
    /**
     * Create a fresh Socket.io connection.
     */
    LarasocketConnector.prototype.connect = function () {
        this.websocket = new util_1.LarasocketManager(this.options);
    };
    /**
     * Listen for an event on a channel instance.
     */
    LarasocketConnector.prototype.listen = function (name, event, callback) {
        return this.channel(name).listen(event, callback);
    };
    /**
     * Get a channel instance by name.
     */
    LarasocketConnector.prototype.channel = function (name) {
        if (!this.channels[name]) {
            this.channels[name] = new channel_1.LarasocketChannel(this.websocket, name, this.options);
        }
        return this.channels[name];
    };
    /**
     * Get a private channel instance by name.
     */
    LarasocketConnector.prototype.privateChannel = function (name) {
        if (!this.channels['private-' + name]) {
            this.channels['private-' + name] = new channel_1.LarasocketPrivateChannel(this.websocket, 'private-' + name, this.options);
        }
        return this.channels['private-' + name];
    };
    /**
     * Get a presence channel instance by name.
     */
    LarasocketConnector.prototype.presenceChannel = function (name) {
        if (!this.channels['presence-' + name]) {
            this.channels['presence-' + name] = new channel_1.LarasocketPresenceChannel(this.websocket, 'presence-' + name, this.options);
        }
        return this.channels['presence-' + name];
    };
    /**
     * Leave the given channel, as well as its private and presence variants.
     */
    LarasocketConnector.prototype.leave = function (name) {
        var _this = this;
        var channels = [name, 'private-' + name, 'presence-' + name];
        channels.forEach(function (_name) {
            _this.leaveChannel(_name);
        });
    };
    /**
     * Leave the given channel.
     */
    LarasocketConnector.prototype.leaveChannel = function (name) {
        if (this.channels[name]) {
            this.channels[name].unsubscribe();
            delete this.channels[name];
        }
    };
    /**
     * Get the socket ID for the connection.
     */
    LarasocketConnector.prototype.socketId = function () {
        return this.websocket.socketId();
    };
    /**
     * Disconnect Socketio connection.
     */
    LarasocketConnector.prototype.disconnect = function () {
        this.websocket.disconnect();
    };
    return LarasocketConnector;
}(connector_1.Connector));
exports.LarasocketConnector = LarasocketConnector;


/***/ }),

/***/ "./node_modules/larasocket-js/dist/index.js":
/*!**************************************************!*\
  !*** ./node_modules/larasocket-js/dist/index.js ***!
  \**************************************************/
/***/ ((__unused_webpack_module, exports, __webpack_require__) => {

"use strict";

Object.defineProperty(exports, "__esModule", ({ value: true }));
var connector_1 = __webpack_require__(/*! ./connector */ "./node_modules/larasocket-js/dist/connector/index.js");
exports.default = connector_1.LarasocketConnector;


/***/ }),

/***/ "./node_modules/larasocket-js/dist/util/event-formatter.js":
/*!*****************************************************************!*\
  !*** ./node_modules/larasocket-js/dist/util/event-formatter.js ***!
  \*****************************************************************/
/***/ ((__unused_webpack_module, exports) => {

"use strict";

Object.defineProperty(exports, "__esModule", ({ value: true }));
exports.EventFormatter = void 0;
/**
 * Event name formatter
 */
var EventFormatter = /** @class */ (function () {
    /**
     * Create a new class instance.
     */
    function EventFormatter(namespace) {
        this.namespace = namespace;
    }
    /**
     * Format the given event name.
     */
    EventFormatter.prototype.format = function (event) {
        if (event.charAt(0) === '.' || event.charAt(0) === '\\') {
            return event.substr(1);
        }
        else if (this.namespace) {
            event = this.namespace + '.' + event;
        }
        return event.replace(/\./g, '\\');
    };
    /**
     * Set the event namespace.
     */
    EventFormatter.prototype.setNamespace = function (value) {
        this.namespace = value;
    };
    return EventFormatter;
}());
exports.EventFormatter = EventFormatter;


/***/ }),

/***/ "./node_modules/larasocket-js/dist/util/incoming-message.js":
/*!******************************************************************!*\
  !*** ./node_modules/larasocket-js/dist/util/incoming-message.js ***!
  \******************************************************************/
/***/ (function(__unused_webpack_module, exports, __webpack_require__) {

"use strict";

var __extends = (this && this.__extends) || (function () {
    var extendStatics = function (d, b) {
        extendStatics = Object.setPrototypeOf ||
            ({ __proto__: [] } instanceof Array && function (d, b) { d.__proto__ = b; }) ||
            function (d, b) { for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p]; };
        return extendStatics(d, b);
    };
    return function (d, b) {
        extendStatics(d, b);
        function __() { this.constructor = d; }
        d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
    };
})();
Object.defineProperty(exports, "__esModule", ({ value: true }));
exports.IncomingMessage = exports.IncomingMessageType = void 0;
var message_1 = __webpack_require__(/*! ./message */ "./node_modules/larasocket-js/dist/util/message.js");
var IncomingMessageType;
(function (IncomingMessageType) {
    IncomingMessageType["LINKED"] = "linked";
})(IncomingMessageType = exports.IncomingMessageType || (exports.IncomingMessageType = {}));
/**
 * SocketMessage
 */
var IncomingMessage = /** @class */ (function (_super) {
    __extends(IncomingMessage, _super);
    /**
     * Create a new class instance.
     */
    function IncomingMessage(rawJson) {
        var _this = _super.call(this) || this;
        _this.action = rawJson.action;
        _this.event = rawJson.event;
        _this.payload = rawJson.payload;
        _this.connectionId = rawJson.connection_id;
        return _this;
    }
    return IncomingMessage;
}(message_1.Message));
exports.IncomingMessage = IncomingMessage;


/***/ }),

/***/ "./node_modules/larasocket-js/dist/util/index.js":
/*!*******************************************************!*\
  !*** ./node_modules/larasocket-js/dist/util/index.js ***!
  \*******************************************************/
/***/ (function(__unused_webpack_module, exports, __webpack_require__) {

"use strict";

var __createBinding = (this && this.__createBinding) || (Object.create ? (function(o, m, k, k2) {
    if (k2 === undefined) k2 = k;
    Object.defineProperty(o, k2, { enumerable: true, get: function() { return m[k]; } });
}) : (function(o, m, k, k2) {
    if (k2 === undefined) k2 = k;
    o[k2] = m[k];
}));
var __exportStar = (this && this.__exportStar) || function(m, exports) {
    for (var p in m) if (p !== "default" && !exports.hasOwnProperty(p)) __createBinding(exports, m, p);
};
Object.defineProperty(exports, "__esModule", ({ value: true }));
__exportStar(__webpack_require__(/*! ./event-formatter */ "./node_modules/larasocket-js/dist/util/event-formatter.js"), exports);
__exportStar(__webpack_require__(/*! ./larasocket-manager */ "./node_modules/larasocket-js/dist/util/larasocket-manager.js"), exports);


/***/ }),

/***/ "./node_modules/larasocket-js/dist/util/larasocket-manager.js":
/*!********************************************************************!*\
  !*** ./node_modules/larasocket-js/dist/util/larasocket-manager.js ***!
  \********************************************************************/
/***/ ((__unused_webpack_module, exports, __webpack_require__) => {

"use strict";

Object.defineProperty(exports, "__esModule", ({ value: true }));
exports.LarasocketManager = void 0;
var channel_1 = __webpack_require__(/*! ../channel */ "./node_modules/larasocket-js/dist/channel/index.js");
var event_formatter_1 = __webpack_require__(/*! ./event-formatter */ "./node_modules/larasocket-js/dist/util/event-formatter.js");
var outgoing_message_1 = __webpack_require__(/*! ./outgoing-message */ "./node_modules/larasocket-js/dist/util/outgoing-message.js");
var larasocket_websocket_1 = __webpack_require__(/*! ./larasocket-websocket */ "./node_modules/larasocket-js/dist/util/larasocket-websocket.js");
/**
 * Event name formatter
 */
var LarasocketManager = /** @class */ (function () {
    /**
     * Create a new class instance.
     */
    function LarasocketManager(options) {
        var _this = this;
        /**
         *
         */
        this.subscribedChannels = {};
        this.options = options;
        this.listeners = {};
        this.eventFormatter = new event_formatter_1.EventFormatter(options.namespace);
        this.websocketInstance = new larasocket_websocket_1.LarasocketWebsocket(options, function (d) { return _this.route(d); }, function () { return _this.reconnect(); });
    }
    /**
     *
     */
    LarasocketManager.prototype.disconnect = function () {
        this.websocketInstance.close();
    };
    /**
     * Triggers subscription to each previously subscribed channel.
     */
    LarasocketManager.prototype.reconnect = function () {
        for (var _i = 0, _a = Object.values(this.subscribedChannels); _i < _a.length; _i++) {
            var channel = _a[_i];
            this.subscribe(channel);
        }
    };
    /**
     * Subscribe to a given channel.
     *
     * @param channel
     */
    LarasocketManager.prototype.subscribe = function (channel) {
        var _this = this;
        this.authenticate(channel).then(function (response) {
            _this.subscribedChannels[channel.name] = channel; // track so we can reconnect if needed.
            var subscribeMessage = _this.getSocketMessage(outgoing_message_1.OutgoingMessageType.SUBSCRIBE);
            subscribeMessage.payload = response;
            subscribeMessage.channel = channel;
            _this.send(subscribeMessage);
        });
    };
    /**
     * Unsubscribe to a given channel.
     *
     * @param channel
     */
    LarasocketManager.prototype.unsubscribe = function (channel) {
        delete this.subscribedChannels[channel.name]; // track so we can reconnect if needed.
        var unsubscribeMessage = this.getSocketMessage(outgoing_message_1.OutgoingMessageType.UNSUBSCRIBE);
        unsubscribeMessage.channel = channel;
        this.send(unsubscribeMessage);
    };
    /**
     * Tie an event listener to an action.
     *
     * @param name
     * @param listener
     */
    LarasocketManager.prototype.on = function (name, listener) {
        var formattedEventName = this.eventFormatter.format(name);
        this.listeners[formattedEventName] = listener;
    };
    /**
     * Tie an event listener to an action.
     *
     * @param name
     */
    LarasocketManager.prototype.removeListener = function (name) {
        var formattedEventName = this.eventFormatter.format(name);
        delete this.listeners[formattedEventName];
    };
    /**
     *
     * @param type
     */
    LarasocketManager.prototype.getSocketMessage = function (type) {
        return new outgoing_message_1.OutgoingMessage(this.options.token, type);
    };
    /**
     *
     * @param message
     */
    LarasocketManager.prototype.send = function (message) {
        this.websocketInstance.send(message);
    };
    /**
     *
     */
    LarasocketManager.prototype.socketId = function () {
        return this.websocketInstance.connectionId;
    };
    /**
     * Routes an incoming massage for processing.
     *
     * @param message
     */
    LarasocketManager.prototype.route = function (message) {
        if (message.event) {
            var formattedEventName = this.eventFormatter.format(message.event);
            if (this.listeners[formattedEventName]) {
                try {
                    var payloadForListeners = message.payload;
                    if (typeof payloadForListeners === 'string') {
                        payloadForListeners = JSON.parse(payloadForListeners);
                    }
                    // convert payload into an object
                    this.listeners[formattedEventName](payloadForListeners);
                }
                catch (e) {
                    throw new Error('Failed to parse incoming message');
                }
            }
        }
    };
    /**
     * Authenticate a channel subscription.
     *
     * @param channel
     */
    LarasocketManager.prototype.authenticate = function (channel) {
        if (channel instanceof channel_1.LarasocketPresenceChannel || channel instanceof channel_1.LarasocketPrivateChannel) {
            return this.websocketInstance.getAuthNetworkPromise(channel);
        }
        return Promise.resolve(); // dummy Promise. No auth for public channels.
    };
    return LarasocketManager;
}());
exports.LarasocketManager = LarasocketManager;


/***/ }),

/***/ "./node_modules/larasocket-js/dist/util/larasocket-websocket.js":
/*!**********************************************************************!*\
  !*** ./node_modules/larasocket-js/dist/util/larasocket-websocket.js ***!
  \**********************************************************************/
/***/ ((__unused_webpack_module, exports, __webpack_require__) => {

"use strict";

Object.defineProperty(exports, "__esModule", ({ value: true }));
exports.LarasocketWebsocket = void 0;
var incoming_message_1 = __webpack_require__(/*! ./incoming-message */ "./node_modules/larasocket-js/dist/util/incoming-message.js");
var link_message_1 = __webpack_require__(/*! ./link-message */ "./node_modules/larasocket-js/dist/util/link-message.js");
/**
 * Event name formatter
 */
var LarasocketWebsocket = /** @class */ (function () {
    /**
     * Create a new class instance.
     */
    function LarasocketWebsocket(options, onMessageListener, onReconnectListener) {
        /**
         *
         */
        this.timeout = 500;
        this.options = options;
        this.csrf = options.auth.headers['X-CSRF-TOKEN'];
        this.uuid = this.uuidv4();
        this.onMessageListener = onMessageListener;
        this.reconnectListener = onReconnectListener;
        this.websocketUrl = options.wsHost || 'ws.larasocket.com';
        this.token = encodeURIComponent(this.options.token);
    }
    /**
     *
     */
    LarasocketWebsocket.prototype.close = function () {
        if (this.websocketInstance) {
            this.websocketInstance.close();
        }
    };
    /**
     * Send string data over the websocket connection.
     *
     * @param message
     */
    LarasocketWebsocket.prototype.send = function (message) {
        var _this = this;
        this.getWebsocketInstance().then(function (socket) {
            message.connectionId = _this.connectionId; // sometimes, we dont have connectionId information until this callback.
            socket.send(JSON.stringify(message.toNetworkJson()));
        });
    };
    /**
     *
     * @param channel
     */
    LarasocketWebsocket.prototype.getAuthNetworkPromise = function (channel) {
        var _this = this;
        return this.getWebsocketInstance().then(function (socket) {
            if (_this.options.authorizer) {
                var authorizer_1 = _this.options.authorizer(channel, _this.options);
                return new Promise(function (resolve, reject) {
                    authorizer_1.authorize(_this.connectionId, function (error, data) {
                        if (error) {
                            return reject(data);
                        }
                        return resolve(data);
                    });
                });
            }
            var networkAgent;
            if (typeof Vue === 'function' && Vue.http) {
                networkAgent = Vue.http;
            }
            if (typeof axios === 'function') {
                networkAgent = axios;
            }
            if (typeof jQuery === 'function') {
                networkAgent = jQuery;
            }
            if (networkAgent) {
                return networkAgent
                    .post(_this.options.authEndpoint, {
                    socket_id: _this.connectionId,
                    channel_name: channel.name,
                    _token: _this.csrf,
                })
                    .then(function (response) {
                    return response.data;
                });
            }
            else {
                return fetch(_this.options.authEndpoint, {
                    method: 'POST',
                    headers: {
                        Accept: 'application/json',
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        socket_id: _this.connectionId,
                        channel_name: channel.name,
                        _token: _this.csrf,
                    }),
                }).then(function (response) {
                    return response.json();
                });
            }
            throw new Error('Need either Vue.http, axios, jQuery, or fetch.');
        });
    };
    /**
     * Return a promise that will resolve the websocket instance.
     */
    LarasocketWebsocket.prototype.getWebsocketInstance = function () {
        if (this.websocketInstance) {
            return Promise.resolve(this.websocketInstance);
        }
        return this.connect();
    };
    /**
     * The connection is ready.
     */
    LarasocketWebsocket.prototype.websocketInstanceReady = function (socket) {
        this.websocketInstance = socket;
        this.websocketInitializationPromise = undefined;
    };
    /**
     * Reset and connect to the websocket.
     */
    LarasocketWebsocket.prototype.reconnect = function () {
        var _this = this;
        this.websocketInitializationPromise = undefined;
        this.websocketInstance = undefined;
        return this.connect().then(function (websocket) {
            _this.reconnectListener(_this);
            return websocket;
        });
    };
    /**
     * Initialize an websocket connection.
     */
    LarasocketWebsocket.prototype.connect = function () {
        var _this = this;
        if (this.websocketInitializationPromise) {
            return this.websocketInitializationPromise;
        }
        this.websocketInitializationPromise = new Promise(function (resolve, reject) {
            var socket = new WebSocket("wss://" + _this.websocketUrl + "?token=" + _this.token + "&uuid=" + _this.uuid);
            // Connection opened
            socket.onopen = function (e) { return _this.onOpen(socket, e); };
            socket.onclose = function (e) { return _this.onClose(e); };
            socket.onerror = function (e) { return _this.onError(e); };
            // Listen for messages
            socket.onmessage = function (event) {
                _this.onMessage(socket, resolve, reject, event);
            };
        });
        return this.websocketInitializationPromise;
    };
    /**
     * Websocket on open event.
     *
     * @param socket
     * @param event
     */
    LarasocketWebsocket.prototype.onOpen = function (socket, event) {
        if (this.options.debug) {
            // tslint:disable-next-line
            console.log("[LARASOCKET DEBUG]: onopen -> ", event);
        }
        // Warning: can't use this.send. we are still in the initialization process.
        socket.send(JSON.stringify(new link_message_1.LinkMessage(this.token, this.uuid).toNetworkJson()));
    };
    /**
     * Websocket on close event. Larasocket will attempt to reconnect.
     *
     * @param event
     */
    LarasocketWebsocket.prototype.onClose = function (event) {
        var _this = this;
        var timeout = this.getTimeout();
        if (this.options.debug) {
            // tslint:disable-next-line
            console.log("[LARASOCKET DEBUG]: onclose -> ", event);
            // tslint:disable-next-line
            console.log("Reconnecting in " + timeout / 1000 + "s");
        }
        if (this.currentTimeout) {
            clearTimeout(this.currentTimeout);
        }
        this.currentTimeout = setTimeout(function () { return _this.reconnect(); }, timeout);
    };
    /**
     * Websocket on error event. Larasocket will close the connection and reconnect.
     *
     * @param event
     */
    LarasocketWebsocket.prototype.onError = function (event) {
        if (this.options.debug) {
            // tslint:disable-next-line
            console.log("[LARASOCKET DEBUG]: onerror -> ", event);
            // tslint:disable-next-line
            console.log("Error encountered. Closing socket.");
        }
        this.close();
    };
    /**
     * Websocket on message event. Routed to the listener after the websocket connection can be linked to Larasocket backend.
     *
     * @param socket
     * @param resolve
     * @param reject
     * @param event
     */
    LarasocketWebsocket.prototype.onMessage = function (socket, resolve, reject, event) {
        if (this.options.debug) {
            // tslint:disable-next-line
            console.log("[LARASOCKET DEBUG]: onmessage -> ", event);
        }
        var rawMessage = event.data;
        try {
            var rawJson = JSON.parse(rawMessage);
            var message = new incoming_message_1.IncomingMessage(rawJson);
            if (message.action === incoming_message_1.IncomingMessageType.LINKED) {
                this.connectionId = message.connectionId;
                this.websocketInstanceReady(socket);
                resolve(socket);
            }
            else {
                this.onMessageListener(message);
            }
        }
        catch (e) {
            reject(e);
        }
    };
    /**
     * Gets the next timeout in milliseconds before the websocket connection should reconnect.
     */
    LarasocketWebsocket.prototype.getTimeout = function () {
        var nextTimeout = Math.min(this.timeout, 10000); // max 10s timeout.
        this.timeout *= 2; // timeout doubles each time.
        return nextTimeout;
    };
    /**
     * Used to link a socket connection to a db connection.
     */
    LarasocketWebsocket.prototype.uuidv4 = function () {
        return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function (c) {
            // tslint:disable-next-line
            var r = (Math.random() * 16) | 0;
            // tslint:disable-next-line
            var v = c === 'x' ? r : (r & 0x3) | 0x8;
            return v.toString(16);
        });
    };
    return LarasocketWebsocket;
}());
exports.LarasocketWebsocket = LarasocketWebsocket;


/***/ }),

/***/ "./node_modules/larasocket-js/dist/util/link-message.js":
/*!**************************************************************!*\
  !*** ./node_modules/larasocket-js/dist/util/link-message.js ***!
  \**************************************************************/
/***/ (function(__unused_webpack_module, exports, __webpack_require__) {

"use strict";

var __extends = (this && this.__extends) || (function () {
    var extendStatics = function (d, b) {
        extendStatics = Object.setPrototypeOf ||
            ({ __proto__: [] } instanceof Array && function (d, b) { d.__proto__ = b; }) ||
            function (d, b) { for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p]; };
        return extendStatics(d, b);
    };
    return function (d, b) {
        extendStatics(d, b);
        function __() { this.constructor = d; }
        d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
    };
})();
Object.defineProperty(exports, "__esModule", ({ value: true }));
exports.LinkMessage = void 0;
var message_1 = __webpack_require__(/*! ./message */ "./node_modules/larasocket-js/dist/util/message.js");
/**
 * LinkMessage
 */
var LinkMessage = /** @class */ (function (_super) {
    __extends(LinkMessage, _super);
    /**
     * Create a new class instance.
     */
    function LinkMessage(token, uuid) {
        var _this = _super.call(this) || this;
        _this.token = token;
        _this.uuid = uuid;
        return _this;
    }
    /**
     *
     */
    LinkMessage.prototype.toNetworkJson = function () {
        return {
            action: 'link',
            token: this.token,
            uuid: this.uuid,
        };
    };
    return LinkMessage;
}(message_1.Message));
exports.LinkMessage = LinkMessage;


/***/ }),

/***/ "./node_modules/larasocket-js/dist/util/message.js":
/*!*********************************************************!*\
  !*** ./node_modules/larasocket-js/dist/util/message.js ***!
  \*********************************************************/
/***/ ((__unused_webpack_module, exports) => {

"use strict";

Object.defineProperty(exports, "__esModule", ({ value: true }));
exports.Message = void 0;
/**
 * SocketMessage
 */
var Message = /** @class */ (function () {
    function Message() {
    }
    return Message;
}());
exports.Message = Message;


/***/ }),

/***/ "./node_modules/larasocket-js/dist/util/outgoing-message.js":
/*!******************************************************************!*\
  !*** ./node_modules/larasocket-js/dist/util/outgoing-message.js ***!
  \******************************************************************/
/***/ (function(__unused_webpack_module, exports, __webpack_require__) {

"use strict";

var __extends = (this && this.__extends) || (function () {
    var extendStatics = function (d, b) {
        extendStatics = Object.setPrototypeOf ||
            ({ __proto__: [] } instanceof Array && function (d, b) { d.__proto__ = b; }) ||
            function (d, b) { for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p]; };
        return extendStatics(d, b);
    };
    return function (d, b) {
        extendStatics(d, b);
        function __() { this.constructor = d; }
        d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
    };
})();
Object.defineProperty(exports, "__esModule", ({ value: true }));
exports.OutgoingMessage = exports.OutgoingMessageType = void 0;
var message_1 = __webpack_require__(/*! ./message */ "./node_modules/larasocket-js/dist/util/message.js");
var OutgoingMessageType;
(function (OutgoingMessageType) {
    OutgoingMessageType["LINK_CONNECTION"] = "link";
    OutgoingMessageType["SUBSCRIBE"] = "subscribe";
    OutgoingMessageType["UNSUBSCRIBE"] = "unsubscribe";
    OutgoingMessageType["WHISPER"] = "whisper";
    OutgoingMessageType["BROADCAST"] = "broadcast";
})(OutgoingMessageType = exports.OutgoingMessageType || (exports.OutgoingMessageType = {}));
/**
 * OutgoingMessage
 */
var OutgoingMessage = /** @class */ (function (_super) {
    __extends(OutgoingMessage, _super);
    /**
     * Create a new class instance.
     */
    function OutgoingMessage(token, action) {
        var _this = _super.call(this) || this;
        _this.token = token;
        _this.action = action;
        return _this;
        // this.connectionId = connectionId;
    }
    /**
     *
     */
    OutgoingMessage.prototype.toNetworkJson = function () {
        var _a;
        return {
            event: this.event,
            token: this.token,
            connection_id: this.connectionId,
            action: this.action,
            payload: this.payload,
            channel: (_a = this.channel) === null || _a === void 0 ? void 0 : _a.name,
        };
    };
    return OutgoingMessage;
}(message_1.Message));
exports.OutgoingMessage = OutgoingMessage;


/***/ }),

/***/ "./node_modules/laravel-echo/dist/echo.js":
/*!************************************************!*\
  !*** ./node_modules/laravel-echo/dist/echo.js ***!
  \************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
function _classCallCheck(instance, Constructor) {
  if (!(instance instanceof Constructor)) {
    throw new TypeError("Cannot call a class as a function");
  }
}

function _defineProperties(target, props) {
  for (var i = 0; i < props.length; i++) {
    var descriptor = props[i];
    descriptor.enumerable = descriptor.enumerable || false;
    descriptor.configurable = true;
    if ("value" in descriptor) descriptor.writable = true;
    Object.defineProperty(target, descriptor.key, descriptor);
  }
}

function _createClass(Constructor, protoProps, staticProps) {
  if (protoProps) _defineProperties(Constructor.prototype, protoProps);
  if (staticProps) _defineProperties(Constructor, staticProps);
  return Constructor;
}

function _extends() {
  _extends = Object.assign || function (target) {
    for (var i = 1; i < arguments.length; i++) {
      var source = arguments[i];

      for (var key in source) {
        if (Object.prototype.hasOwnProperty.call(source, key)) {
          target[key] = source[key];
        }
      }
    }

    return target;
  };

  return _extends.apply(this, arguments);
}

function _inherits(subClass, superClass) {
  if (typeof superClass !== "function" && superClass !== null) {
    throw new TypeError("Super expression must either be null or a function");
  }

  subClass.prototype = Object.create(superClass && superClass.prototype, {
    constructor: {
      value: subClass,
      writable: true,
      configurable: true
    }
  });
  if (superClass) _setPrototypeOf(subClass, superClass);
}

function _getPrototypeOf(o) {
  _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf : function _getPrototypeOf(o) {
    return o.__proto__ || Object.getPrototypeOf(o);
  };
  return _getPrototypeOf(o);
}

function _setPrototypeOf(o, p) {
  _setPrototypeOf = Object.setPrototypeOf || function _setPrototypeOf(o, p) {
    o.__proto__ = p;
    return o;
  };

  return _setPrototypeOf(o, p);
}

function _isNativeReflectConstruct() {
  if (typeof Reflect === "undefined" || !Reflect.construct) return false;
  if (Reflect.construct.sham) return false;
  if (typeof Proxy === "function") return true;

  try {
    Date.prototype.toString.call(Reflect.construct(Date, [], function () {}));
    return true;
  } catch (e) {
    return false;
  }
}

function _assertThisInitialized(self) {
  if (self === void 0) {
    throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
  }

  return self;
}

function _possibleConstructorReturn(self, call) {
  if (call && (typeof call === "object" || typeof call === "function")) {
    return call;
  }

  return _assertThisInitialized(self);
}

function _createSuper(Derived) {
  var hasNativeReflectConstruct = _isNativeReflectConstruct();

  return function () {
    var Super = _getPrototypeOf(Derived),
        result;

    if (hasNativeReflectConstruct) {
      var NewTarget = _getPrototypeOf(this).constructor;

      result = Reflect.construct(Super, arguments, NewTarget);
    } else {
      result = Super.apply(this, arguments);
    }

    return _possibleConstructorReturn(this, result);
  };
}

var Connector = /*#__PURE__*/function () {
  /**
   * Create a new class instance.
   */
  function Connector(options) {
    _classCallCheck(this, Connector);

    /**
     * Default connector options.
     */
    this._defaultOptions = {
      auth: {
        headers: {}
      },
      authEndpoint: '/broadcasting/auth',
      broadcaster: 'pusher',
      csrfToken: null,
      host: null,
      key: null,
      namespace: 'App.Events'
    };
    this.setOptions(options);
    this.connect();
  }
  /**
   * Merge the custom options with the defaults.
   */


  _createClass(Connector, [{
    key: "setOptions",
    value: function setOptions(options) {
      this.options = _extends(this._defaultOptions, options);

      if (this.csrfToken()) {
        this.options.auth.headers['X-CSRF-TOKEN'] = this.csrfToken();
      }

      return options;
    }
    /**
     * Extract the CSRF token from the page.
     */

  }, {
    key: "csrfToken",
    value: function csrfToken() {
      var selector;

      if (typeof window !== 'undefined' && window['Laravel'] && window['Laravel'].csrfToken) {
        return window['Laravel'].csrfToken;
      } else if (this.options.csrfToken) {
        return this.options.csrfToken;
      } else if (typeof document !== 'undefined' && typeof document.querySelector === 'function' && (selector = document.querySelector('meta[name="csrf-token"]'))) {
        return selector.getAttribute('content');
      }

      return null;
    }
  }]);

  return Connector;
}();

/**
 * This class represents a basic channel.
 */
var Channel = /*#__PURE__*/function () {
  function Channel() {
    _classCallCheck(this, Channel);
  }

  _createClass(Channel, [{
    key: "listenForWhisper",

    /**
     * Listen for a whisper event on the channel instance.
     */
    value: function listenForWhisper(event, callback) {
      return this.listen('.client-' + event, callback);
    }
    /**
     * Listen for an event on the channel instance.
     */

  }, {
    key: "notification",
    value: function notification(callback) {
      return this.listen('.Illuminate\\Notifications\\Events\\BroadcastNotificationCreated', callback);
    }
    /**
     * Stop listening for a whisper event on the channel instance.
     */

  }, {
    key: "stopListeningForWhisper",
    value: function stopListeningForWhisper(event, callback) {
      return this.stopListening('.client-' + event, callback);
    }
  }]);

  return Channel;
}();

/**
 * Event name formatter
 */
var EventFormatter = /*#__PURE__*/function () {
  /**
   * Create a new class instance.
   */
  function EventFormatter(namespace) {
    _classCallCheck(this, EventFormatter);

    this.setNamespace(namespace);
  }
  /**
   * Format the given event name.
   */


  _createClass(EventFormatter, [{
    key: "format",
    value: function format(event) {
      if (event.charAt(0) === '.' || event.charAt(0) === '\\') {
        return event.substr(1);
      } else if (this.namespace) {
        event = this.namespace + '.' + event;
      }

      return event.replace(/\./g, '\\');
    }
    /**
     * Set the event namespace.
     */

  }, {
    key: "setNamespace",
    value: function setNamespace(value) {
      this.namespace = value;
    }
  }]);

  return EventFormatter;
}();

/**
 * This class represents a Pusher channel.
 */

var PusherChannel = /*#__PURE__*/function (_Channel) {
  _inherits(PusherChannel, _Channel);

  var _super = _createSuper(PusherChannel);

  /**
   * Create a new class instance.
   */
  function PusherChannel(pusher, name, options) {
    var _this;

    _classCallCheck(this, PusherChannel);

    _this = _super.call(this);
    _this.name = name;
    _this.pusher = pusher;
    _this.options = options;
    _this.eventFormatter = new EventFormatter(_this.options.namespace);

    _this.subscribe();

    return _this;
  }
  /**
   * Subscribe to a Pusher channel.
   */


  _createClass(PusherChannel, [{
    key: "subscribe",
    value: function subscribe() {
      this.subscription = this.pusher.subscribe(this.name);
    }
    /**
     * Unsubscribe from a Pusher channel.
     */

  }, {
    key: "unsubscribe",
    value: function unsubscribe() {
      this.pusher.unsubscribe(this.name);
    }
    /**
     * Listen for an event on the channel instance.
     */

  }, {
    key: "listen",
    value: function listen(event, callback) {
      this.on(this.eventFormatter.format(event), callback);
      return this;
    }
    /**
     * Listen for all events on the channel instance.
     */

  }, {
    key: "listenToAll",
    value: function listenToAll(callback) {
      var _this2 = this;

      this.subscription.bind_global(function (event, data) {
        if (event.startsWith('pusher:')) {
          return;
        }

        var namespace = _this2.options.namespace.replace(/\./g, '\\');

        var formattedEvent = event.startsWith(namespace) ? event.substring(namespace.length + 1) : '.' + event;
        callback(formattedEvent, data);
      });
      return this;
    }
    /**
     * Stop listening for an event on the channel instance.
     */

  }, {
    key: "stopListening",
    value: function stopListening(event, callback) {
      if (callback) {
        this.subscription.unbind(this.eventFormatter.format(event), callback);
      } else {
        this.subscription.unbind(this.eventFormatter.format(event));
      }

      return this;
    }
    /**
     * Stop listening for all events on the channel instance.
     */

  }, {
    key: "stopListeningToAll",
    value: function stopListeningToAll(callback) {
      if (callback) {
        this.subscription.unbind_global(callback);
      } else {
        this.subscription.unbind_global();
      }

      return this;
    }
    /**
     * Register a callback to be called anytime a subscription succeeds.
     */

  }, {
    key: "subscribed",
    value: function subscribed(callback) {
      this.on('pusher:subscription_succeeded', function () {
        callback();
      });
      return this;
    }
    /**
     * Register a callback to be called anytime a subscription error occurs.
     */

  }, {
    key: "error",
    value: function error(callback) {
      this.on('pusher:subscription_error', function (status) {
        callback(status);
      });
      return this;
    }
    /**
     * Bind a channel to an event.
     */

  }, {
    key: "on",
    value: function on(event, callback) {
      this.subscription.bind(event, callback);
      return this;
    }
  }]);

  return PusherChannel;
}(Channel);

/**
 * This class represents a Pusher private channel.
 */

var PusherPrivateChannel = /*#__PURE__*/function (_PusherChannel) {
  _inherits(PusherPrivateChannel, _PusherChannel);

  var _super = _createSuper(PusherPrivateChannel);

  function PusherPrivateChannel() {
    _classCallCheck(this, PusherPrivateChannel);

    return _super.apply(this, arguments);
  }

  _createClass(PusherPrivateChannel, [{
    key: "whisper",

    /**
     * Trigger client event on the channel.
     */
    value: function whisper(eventName, data) {
      this.pusher.channels.channels[this.name].trigger("client-".concat(eventName), data);
      return this;
    }
  }]);

  return PusherPrivateChannel;
}(PusherChannel);

/**
 * This class represents a Pusher private channel.
 */

var PusherEncryptedPrivateChannel = /*#__PURE__*/function (_PusherChannel) {
  _inherits(PusherEncryptedPrivateChannel, _PusherChannel);

  var _super = _createSuper(PusherEncryptedPrivateChannel);

  function PusherEncryptedPrivateChannel() {
    _classCallCheck(this, PusherEncryptedPrivateChannel);

    return _super.apply(this, arguments);
  }

  _createClass(PusherEncryptedPrivateChannel, [{
    key: "whisper",

    /**
     * Trigger client event on the channel.
     */
    value: function whisper(eventName, data) {
      this.pusher.channels.channels[this.name].trigger("client-".concat(eventName), data);
      return this;
    }
  }]);

  return PusherEncryptedPrivateChannel;
}(PusherChannel);

/**
 * This class represents a Pusher presence channel.
 */

var PusherPresenceChannel = /*#__PURE__*/function (_PusherChannel) {
  _inherits(PusherPresenceChannel, _PusherChannel);

  var _super = _createSuper(PusherPresenceChannel);

  function PusherPresenceChannel() {
    _classCallCheck(this, PusherPresenceChannel);

    return _super.apply(this, arguments);
  }

  _createClass(PusherPresenceChannel, [{
    key: "here",

    /**
     * Register a callback to be called anytime the member list changes.
     */
    value: function here(callback) {
      this.on('pusher:subscription_succeeded', function (data) {
        callback(Object.keys(data.members).map(function (k) {
          return data.members[k];
        }));
      });
      return this;
    }
    /**
     * Listen for someone joining the channel.
     */

  }, {
    key: "joining",
    value: function joining(callback) {
      this.on('pusher:member_added', function (member) {
        callback(member.info);
      });
      return this;
    }
    /**
     * Listen for someone leaving the channel.
     */

  }, {
    key: "leaving",
    value: function leaving(callback) {
      this.on('pusher:member_removed', function (member) {
        callback(member.info);
      });
      return this;
    }
    /**
     * Trigger client event on the channel.
     */

  }, {
    key: "whisper",
    value: function whisper(eventName, data) {
      this.pusher.channels.channels[this.name].trigger("client-".concat(eventName), data);
      return this;
    }
  }]);

  return PusherPresenceChannel;
}(PusherChannel);

/**
 * This class represents a Socket.io channel.
 */

var SocketIoChannel = /*#__PURE__*/function (_Channel) {
  _inherits(SocketIoChannel, _Channel);

  var _super = _createSuper(SocketIoChannel);

  /**
   * Create a new class instance.
   */
  function SocketIoChannel(socket, name, options) {
    var _this;

    _classCallCheck(this, SocketIoChannel);

    _this = _super.call(this);
    /**
     * The event callbacks applied to the socket.
     */

    _this.events = {};
    /**
     * User supplied callbacks for events on this channel.
     */

    _this.listeners = {};
    _this.name = name;
    _this.socket = socket;
    _this.options = options;
    _this.eventFormatter = new EventFormatter(_this.options.namespace);

    _this.subscribe();

    return _this;
  }
  /**
   * Subscribe to a Socket.io channel.
   */


  _createClass(SocketIoChannel, [{
    key: "subscribe",
    value: function subscribe() {
      this.socket.emit('subscribe', {
        channel: this.name,
        auth: this.options.auth || {}
      });
    }
    /**
     * Unsubscribe from channel and ubind event callbacks.
     */

  }, {
    key: "unsubscribe",
    value: function unsubscribe() {
      this.unbind();
      this.socket.emit('unsubscribe', {
        channel: this.name,
        auth: this.options.auth || {}
      });
    }
    /**
     * Listen for an event on the channel instance.
     */

  }, {
    key: "listen",
    value: function listen(event, callback) {
      this.on(this.eventFormatter.format(event), callback);
      return this;
    }
    /**
     * Stop listening for an event on the channel instance.
     */

  }, {
    key: "stopListening",
    value: function stopListening(event, callback) {
      this.unbindEvent(this.eventFormatter.format(event), callback);
      return this;
    }
    /**
     * Register a callback to be called anytime a subscription succeeds.
     */

  }, {
    key: "subscribed",
    value: function subscribed(callback) {
      this.on('connect', function (socket) {
        callback(socket);
      });
      return this;
    }
    /**
     * Register a callback to be called anytime an error occurs.
     */

  }, {
    key: "error",
    value: function error(callback) {
      return this;
    }
    /**
     * Bind the channel's socket to an event and store the callback.
     */

  }, {
    key: "on",
    value: function on(event, callback) {
      var _this2 = this;

      this.listeners[event] = this.listeners[event] || [];

      if (!this.events[event]) {
        this.events[event] = function (channel, data) {
          if (_this2.name === channel && _this2.listeners[event]) {
            _this2.listeners[event].forEach(function (cb) {
              return cb(data);
            });
          }
        };

        this.socket.on(event, this.events[event]);
      }

      this.listeners[event].push(callback);
      return this;
    }
    /**
     * Unbind the channel's socket from all stored event callbacks.
     */

  }, {
    key: "unbind",
    value: function unbind() {
      var _this3 = this;

      Object.keys(this.events).forEach(function (event) {
        _this3.unbindEvent(event);
      });
    }
    /**
     * Unbind the listeners for the given event.
     */

  }, {
    key: "unbindEvent",
    value: function unbindEvent(event, callback) {
      this.listeners[event] = this.listeners[event] || [];

      if (callback) {
        this.listeners[event] = this.listeners[event].filter(function (cb) {
          return cb !== callback;
        });
      }

      if (!callback || this.listeners[event].length === 0) {
        if (this.events[event]) {
          this.socket.removeListener(event, this.events[event]);
          delete this.events[event];
        }

        delete this.listeners[event];
      }
    }
  }]);

  return SocketIoChannel;
}(Channel);

/**
 * This class represents a Socket.io private channel.
 */

var SocketIoPrivateChannel = /*#__PURE__*/function (_SocketIoChannel) {
  _inherits(SocketIoPrivateChannel, _SocketIoChannel);

  var _super = _createSuper(SocketIoPrivateChannel);

  function SocketIoPrivateChannel() {
    _classCallCheck(this, SocketIoPrivateChannel);

    return _super.apply(this, arguments);
  }

  _createClass(SocketIoPrivateChannel, [{
    key: "whisper",

    /**
     * Trigger client event on the channel.
     */
    value: function whisper(eventName, data) {
      this.socket.emit('client event', {
        channel: this.name,
        event: "client-".concat(eventName),
        data: data
      });
      return this;
    }
  }]);

  return SocketIoPrivateChannel;
}(SocketIoChannel);

/**
 * This class represents a Socket.io presence channel.
 */

var SocketIoPresenceChannel = /*#__PURE__*/function (_SocketIoPrivateChann) {
  _inherits(SocketIoPresenceChannel, _SocketIoPrivateChann);

  var _super = _createSuper(SocketIoPresenceChannel);

  function SocketIoPresenceChannel() {
    _classCallCheck(this, SocketIoPresenceChannel);

    return _super.apply(this, arguments);
  }

  _createClass(SocketIoPresenceChannel, [{
    key: "here",

    /**
     * Register a callback to be called anytime the member list changes.
     */
    value: function here(callback) {
      this.on('presence:subscribed', function (members) {
        callback(members.map(function (m) {
          return m.user_info;
        }));
      });
      return this;
    }
    /**
     * Listen for someone joining the channel.
     */

  }, {
    key: "joining",
    value: function joining(callback) {
      this.on('presence:joining', function (member) {
        return callback(member.user_info);
      });
      return this;
    }
    /**
     * Listen for someone leaving the channel.
     */

  }, {
    key: "leaving",
    value: function leaving(callback) {
      this.on('presence:leaving', function (member) {
        return callback(member.user_info);
      });
      return this;
    }
  }]);

  return SocketIoPresenceChannel;
}(SocketIoPrivateChannel);

/**
 * This class represents a null channel.
 */

var NullChannel = /*#__PURE__*/function (_Channel) {
  _inherits(NullChannel, _Channel);

  var _super = _createSuper(NullChannel);

  function NullChannel() {
    _classCallCheck(this, NullChannel);

    return _super.apply(this, arguments);
  }

  _createClass(NullChannel, [{
    key: "subscribe",

    /**
     * Subscribe to a channel.
     */
    value: function subscribe() {} //

    /**
     * Unsubscribe from a channel.
     */

  }, {
    key: "unsubscribe",
    value: function unsubscribe() {} //

    /**
     * Listen for an event on the channel instance.
     */

  }, {
    key: "listen",
    value: function listen(event, callback) {
      return this;
    }
    /**
     * Stop listening for an event on the channel instance.
     */

  }, {
    key: "stopListening",
    value: function stopListening(event, callback) {
      return this;
    }
    /**
     * Register a callback to be called anytime a subscription succeeds.
     */

  }, {
    key: "subscribed",
    value: function subscribed(callback) {
      return this;
    }
    /**
     * Register a callback to be called anytime an error occurs.
     */

  }, {
    key: "error",
    value: function error(callback) {
      return this;
    }
    /**
     * Bind a channel to an event.
     */

  }, {
    key: "on",
    value: function on(event, callback) {
      return this;
    }
  }]);

  return NullChannel;
}(Channel);

/**
 * This class represents a null private channel.
 */

var NullPrivateChannel = /*#__PURE__*/function (_NullChannel) {
  _inherits(NullPrivateChannel, _NullChannel);

  var _super = _createSuper(NullPrivateChannel);

  function NullPrivateChannel() {
    _classCallCheck(this, NullPrivateChannel);

    return _super.apply(this, arguments);
  }

  _createClass(NullPrivateChannel, [{
    key: "whisper",

    /**
     * Trigger client event on the channel.
     */
    value: function whisper(eventName, data) {
      return this;
    }
  }]);

  return NullPrivateChannel;
}(NullChannel);

/**
 * This class represents a null presence channel.
 */

var NullPresenceChannel = /*#__PURE__*/function (_NullChannel) {
  _inherits(NullPresenceChannel, _NullChannel);

  var _super = _createSuper(NullPresenceChannel);

  function NullPresenceChannel() {
    _classCallCheck(this, NullPresenceChannel);

    return _super.apply(this, arguments);
  }

  _createClass(NullPresenceChannel, [{
    key: "here",

    /**
     * Register a callback to be called anytime the member list changes.
     */
    value: function here(callback) {
      return this;
    }
    /**
     * Listen for someone joining the channel.
     */

  }, {
    key: "joining",
    value: function joining(callback) {
      return this;
    }
    /**
     * Listen for someone leaving the channel.
     */

  }, {
    key: "leaving",
    value: function leaving(callback) {
      return this;
    }
    /**
     * Trigger client event on the channel.
     */

  }, {
    key: "whisper",
    value: function whisper(eventName, data) {
      return this;
    }
  }]);

  return NullPresenceChannel;
}(NullChannel);

/**
 * This class creates a connector to Pusher.
 */

var PusherConnector = /*#__PURE__*/function (_Connector) {
  _inherits(PusherConnector, _Connector);

  var _super = _createSuper(PusherConnector);

  function PusherConnector() {
    var _this;

    _classCallCheck(this, PusherConnector);

    _this = _super.apply(this, arguments);
    /**
     * All of the subscribed channel names.
     */

    _this.channels = {};
    return _this;
  }
  /**
   * Create a fresh Pusher connection.
   */


  _createClass(PusherConnector, [{
    key: "connect",
    value: function connect() {
      if (typeof this.options.client !== 'undefined') {
        this.pusher = this.options.client;
      } else {
        this.pusher = new Pusher(this.options.key, this.options);
      }
    }
    /**
     * Listen for an event on a channel instance.
     */

  }, {
    key: "listen",
    value: function listen(name, event, callback) {
      return this.channel(name).listen(event, callback);
    }
    /**
     * Get a channel instance by name.
     */

  }, {
    key: "channel",
    value: function channel(name) {
      if (!this.channels[name]) {
        this.channels[name] = new PusherChannel(this.pusher, name, this.options);
      }

      return this.channels[name];
    }
    /**
     * Get a private channel instance by name.
     */

  }, {
    key: "privateChannel",
    value: function privateChannel(name) {
      if (!this.channels['private-' + name]) {
        this.channels['private-' + name] = new PusherPrivateChannel(this.pusher, 'private-' + name, this.options);
      }

      return this.channels['private-' + name];
    }
    /**
     * Get a private encrypted channel instance by name.
     */

  }, {
    key: "encryptedPrivateChannel",
    value: function encryptedPrivateChannel(name) {
      if (!this.channels['private-encrypted-' + name]) {
        this.channels['private-encrypted-' + name] = new PusherEncryptedPrivateChannel(this.pusher, 'private-encrypted-' + name, this.options);
      }

      return this.channels['private-encrypted-' + name];
    }
    /**
     * Get a presence channel instance by name.
     */

  }, {
    key: "presenceChannel",
    value: function presenceChannel(name) {
      if (!this.channels['presence-' + name]) {
        this.channels['presence-' + name] = new PusherPresenceChannel(this.pusher, 'presence-' + name, this.options);
      }

      return this.channels['presence-' + name];
    }
    /**
     * Leave the given channel, as well as its private and presence variants.
     */

  }, {
    key: "leave",
    value: function leave(name) {
      var _this2 = this;

      var channels = [name, 'private-' + name, 'presence-' + name];
      channels.forEach(function (name, index) {
        _this2.leaveChannel(name);
      });
    }
    /**
     * Leave the given channel.
     */

  }, {
    key: "leaveChannel",
    value: function leaveChannel(name) {
      if (this.channels[name]) {
        this.channels[name].unsubscribe();
        delete this.channels[name];
      }
    }
    /**
     * Get the socket ID for the connection.
     */

  }, {
    key: "socketId",
    value: function socketId() {
      return this.pusher.connection.socket_id;
    }
    /**
     * Disconnect Pusher connection.
     */

  }, {
    key: "disconnect",
    value: function disconnect() {
      this.pusher.disconnect();
    }
  }]);

  return PusherConnector;
}(Connector);

/**
 * This class creates a connnector to a Socket.io server.
 */

var SocketIoConnector = /*#__PURE__*/function (_Connector) {
  _inherits(SocketIoConnector, _Connector);

  var _super = _createSuper(SocketIoConnector);

  function SocketIoConnector() {
    var _this;

    _classCallCheck(this, SocketIoConnector);

    _this = _super.apply(this, arguments);
    /**
     * All of the subscribed channel names.
     */

    _this.channels = {};
    return _this;
  }
  /**
   * Create a fresh Socket.io connection.
   */


  _createClass(SocketIoConnector, [{
    key: "connect",
    value: function connect() {
      var _this2 = this;

      var io = this.getSocketIO();
      this.socket = io(this.options.host, this.options);
      this.socket.on('reconnect', function () {
        Object.values(_this2.channels).forEach(function (channel) {
          channel.subscribe();
        });
      });
      return this.socket;
    }
    /**
     * Get socket.io module from global scope or options.
     */

  }, {
    key: "getSocketIO",
    value: function getSocketIO() {
      if (typeof this.options.client !== 'undefined') {
        return this.options.client;
      }

      if (typeof io !== 'undefined') {
        return io;
      }

      throw new Error('Socket.io client not found. Should be globally available or passed via options.client');
    }
    /**
     * Listen for an event on a channel instance.
     */

  }, {
    key: "listen",
    value: function listen(name, event, callback) {
      return this.channel(name).listen(event, callback);
    }
    /**
     * Get a channel instance by name.
     */

  }, {
    key: "channel",
    value: function channel(name) {
      if (!this.channels[name]) {
        this.channels[name] = new SocketIoChannel(this.socket, name, this.options);
      }

      return this.channels[name];
    }
    /**
     * Get a private channel instance by name.
     */

  }, {
    key: "privateChannel",
    value: function privateChannel(name) {
      if (!this.channels['private-' + name]) {
        this.channels['private-' + name] = new SocketIoPrivateChannel(this.socket, 'private-' + name, this.options);
      }

      return this.channels['private-' + name];
    }
    /**
     * Get a presence channel instance by name.
     */

  }, {
    key: "presenceChannel",
    value: function presenceChannel(name) {
      if (!this.channels['presence-' + name]) {
        this.channels['presence-' + name] = new SocketIoPresenceChannel(this.socket, 'presence-' + name, this.options);
      }

      return this.channels['presence-' + name];
    }
    /**
     * Leave the given channel, as well as its private and presence variants.
     */

  }, {
    key: "leave",
    value: function leave(name) {
      var _this3 = this;

      var channels = [name, 'private-' + name, 'presence-' + name];
      channels.forEach(function (name) {
        _this3.leaveChannel(name);
      });
    }
    /**
     * Leave the given channel.
     */

  }, {
    key: "leaveChannel",
    value: function leaveChannel(name) {
      if (this.channels[name]) {
        this.channels[name].unsubscribe();
        delete this.channels[name];
      }
    }
    /**
     * Get the socket ID for the connection.
     */

  }, {
    key: "socketId",
    value: function socketId() {
      return this.socket.id;
    }
    /**
     * Disconnect Socketio connection.
     */

  }, {
    key: "disconnect",
    value: function disconnect() {
      this.socket.disconnect();
    }
  }]);

  return SocketIoConnector;
}(Connector);

/**
 * This class creates a null connector.
 */

var NullConnector = /*#__PURE__*/function (_Connector) {
  _inherits(NullConnector, _Connector);

  var _super = _createSuper(NullConnector);

  function NullConnector() {
    var _this;

    _classCallCheck(this, NullConnector);

    _this = _super.apply(this, arguments);
    /**
     * All of the subscribed channel names.
     */

    _this.channels = {};
    return _this;
  }
  /**
   * Create a fresh connection.
   */


  _createClass(NullConnector, [{
    key: "connect",
    value: function connect() {} //

    /**
     * Listen for an event on a channel instance.
     */

  }, {
    key: "listen",
    value: function listen(name, event, callback) {
      return new NullChannel();
    }
    /**
     * Get a channel instance by name.
     */

  }, {
    key: "channel",
    value: function channel(name) {
      return new NullChannel();
    }
    /**
     * Get a private channel instance by name.
     */

  }, {
    key: "privateChannel",
    value: function privateChannel(name) {
      return new NullPrivateChannel();
    }
    /**
     * Get a presence channel instance by name.
     */

  }, {
    key: "presenceChannel",
    value: function presenceChannel(name) {
      return new NullPresenceChannel();
    }
    /**
     * Leave the given channel, as well as its private and presence variants.
     */

  }, {
    key: "leave",
    value: function leave(name) {} //

    /**
     * Leave the given channel.
     */

  }, {
    key: "leaveChannel",
    value: function leaveChannel(name) {} //

    /**
     * Get the socket ID for the connection.
     */

  }, {
    key: "socketId",
    value: function socketId() {
      return 'fake-socket-id';
    }
    /**
     * Disconnect the connection.
     */

  }, {
    key: "disconnect",
    value: function disconnect() {//
    }
  }]);

  return NullConnector;
}(Connector);

/**
 * This class is the primary API for interacting with broadcasting.
 */

var Echo = /*#__PURE__*/function () {
  /**
   * Create a new class instance.
   */
  function Echo(options) {
    _classCallCheck(this, Echo);

    this.options = options;
    this.connect();

    if (!this.options.withoutInterceptors) {
      this.registerInterceptors();
    }
  }
  /**
   * Get a channel instance by name.
   */


  _createClass(Echo, [{
    key: "channel",
    value: function channel(_channel) {
      return this.connector.channel(_channel);
    }
    /**
     * Create a new connection.
     */

  }, {
    key: "connect",
    value: function connect() {
      if (this.options.broadcaster == 'pusher') {
        this.connector = new PusherConnector(this.options);
      } else if (this.options.broadcaster == 'socket.io') {
        this.connector = new SocketIoConnector(this.options);
      } else if (this.options.broadcaster == 'null') {
        this.connector = new NullConnector(this.options);
      } else if (typeof this.options.broadcaster == 'function') {
        this.connector = new this.options.broadcaster(this.options);
      }
    }
    /**
     * Disconnect from the Echo server.
     */

  }, {
    key: "disconnect",
    value: function disconnect() {
      this.connector.disconnect();
    }
    /**
     * Get a presence channel instance by name.
     */

  }, {
    key: "join",
    value: function join(channel) {
      return this.connector.presenceChannel(channel);
    }
    /**
     * Leave the given channel, as well as its private and presence variants.
     */

  }, {
    key: "leave",
    value: function leave(channel) {
      this.connector.leave(channel);
    }
    /**
     * Leave the given channel.
     */

  }, {
    key: "leaveChannel",
    value: function leaveChannel(channel) {
      this.connector.leaveChannel(channel);
    }
    /**
     * Listen for an event on a channel instance.
     */

  }, {
    key: "listen",
    value: function listen(channel, event, callback) {
      return this.connector.listen(channel, event, callback);
    }
    /**
     * Get a private channel instance by name.
     */

  }, {
    key: "private",
    value: function _private(channel) {
      return this.connector.privateChannel(channel);
    }
    /**
     * Get a private encrypted channel instance by name.
     */

  }, {
    key: "encryptedPrivate",
    value: function encryptedPrivate(channel) {
      return this.connector.encryptedPrivateChannel(channel);
    }
    /**
     * Get the Socket ID for the connection.
     */

  }, {
    key: "socketId",
    value: function socketId() {
      return this.connector.socketId();
    }
    /**
     * Register 3rd party request interceptiors. These are used to automatically
     * send a connections socket id to a Laravel app with a X-Socket-Id header.
     */

  }, {
    key: "registerInterceptors",
    value: function registerInterceptors() {
      if (typeof Vue === 'function' && Vue.http) {
        this.registerVueRequestInterceptor();
      }

      if (typeof axios === 'function') {
        this.registerAxiosRequestInterceptor();
      }

      if (typeof jQuery === 'function') {
        this.registerjQueryAjaxSetup();
      }
    }
    /**
     * Register a Vue HTTP interceptor to add the X-Socket-ID header.
     */

  }, {
    key: "registerVueRequestInterceptor",
    value: function registerVueRequestInterceptor() {
      var _this = this;

      Vue.http.interceptors.push(function (request, next) {
        if (_this.socketId()) {
          request.headers.set('X-Socket-ID', _this.socketId());
        }

        next();
      });
    }
    /**
     * Register an Axios HTTP interceptor to add the X-Socket-ID header.
     */

  }, {
    key: "registerAxiosRequestInterceptor",
    value: function registerAxiosRequestInterceptor() {
      var _this2 = this;

      axios.interceptors.request.use(function (config) {
        if (_this2.socketId()) {
          config.headers['X-Socket-Id'] = _this2.socketId();
        }

        return config;
      });
    }
    /**
     * Register jQuery AjaxPrefilter to add the X-Socket-ID header.
     */

  }, {
    key: "registerjQueryAjaxSetup",
    value: function registerjQueryAjaxSetup() {
      var _this3 = this;

      if (typeof jQuery.ajax != 'undefined') {
        jQuery.ajaxPrefilter(function (options, originalOptions, xhr) {
          if (_this3.socketId()) {
            xhr.setRequestHeader('X-Socket-Id', _this3.socketId());
          }
        });
      }
    }
  }]);

  return Echo;
}();

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (Echo);


/***/ }),

/***/ "./resources/css/app.css":
/*!*******************************!*\
  !*** ./resources/css/app.css ***!
  \*******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = __webpack_modules__;
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/chunk loaded */
/******/ 	(() => {
/******/ 		var deferred = [];
/******/ 		__webpack_require__.O = (result, chunkIds, fn, priority) => {
/******/ 			if(chunkIds) {
/******/ 				priority = priority || 0;
/******/ 				for(var i = deferred.length; i > 0 && deferred[i - 1][2] > priority; i--) deferred[i] = deferred[i - 1];
/******/ 				deferred[i] = [chunkIds, fn, priority];
/******/ 				return;
/******/ 			}
/******/ 			var notFulfilled = Infinity;
/******/ 			for (var i = 0; i < deferred.length; i++) {
/******/ 				var [chunkIds, fn, priority] = deferred[i];
/******/ 				var fulfilled = true;
/******/ 				for (var j = 0; j < chunkIds.length; j++) {
/******/ 					if ((priority & 1 === 0 || notFulfilled >= priority) && Object.keys(__webpack_require__.O).every((key) => (__webpack_require__.O[key](chunkIds[j])))) {
/******/ 						chunkIds.splice(j--, 1);
/******/ 					} else {
/******/ 						fulfilled = false;
/******/ 						if(priority < notFulfilled) notFulfilled = priority;
/******/ 					}
/******/ 				}
/******/ 				if(fulfilled) {
/******/ 					deferred.splice(i--, 1)
/******/ 					result = fn();
/******/ 				}
/******/ 			}
/******/ 			return result;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/jsonp chunk loading */
/******/ 	(() => {
/******/ 		// no baseURI
/******/ 		
/******/ 		// object to store loaded and loading chunks
/******/ 		// undefined = chunk not loaded, null = chunk preloaded/prefetched
/******/ 		// [resolve, reject, Promise] = chunk loading, 0 = chunk loaded
/******/ 		var installedChunks = {
/******/ 			"/js/app": 0,
/******/ 			"css/app": 0
/******/ 		};
/******/ 		
/******/ 		// no chunk on demand loading
/******/ 		
/******/ 		// no prefetching
/******/ 		
/******/ 		// no preloaded
/******/ 		
/******/ 		// no HMR
/******/ 		
/******/ 		// no HMR manifest
/******/ 		
/******/ 		__webpack_require__.O.j = (chunkId) => (installedChunks[chunkId] === 0);
/******/ 		
/******/ 		// install a JSONP callback for chunk loading
/******/ 		var webpackJsonpCallback = (parentChunkLoadingFunction, data) => {
/******/ 			var [chunkIds, moreModules, runtime] = data;
/******/ 			// add "moreModules" to the modules object,
/******/ 			// then flag all "chunkIds" as loaded and fire callback
/******/ 			var moduleId, chunkId, i = 0;
/******/ 			for(moduleId in moreModules) {
/******/ 				if(__webpack_require__.o(moreModules, moduleId)) {
/******/ 					__webpack_require__.m[moduleId] = moreModules[moduleId];
/******/ 				}
/******/ 			}
/******/ 			if(runtime) var result = runtime(__webpack_require__);
/******/ 			if(parentChunkLoadingFunction) parentChunkLoadingFunction(data);
/******/ 			for(;i < chunkIds.length; i++) {
/******/ 				chunkId = chunkIds[i];
/******/ 				if(__webpack_require__.o(installedChunks, chunkId) && installedChunks[chunkId]) {
/******/ 					installedChunks[chunkId][0]();
/******/ 				}
/******/ 				installedChunks[chunkIds[i]] = 0;
/******/ 			}
/******/ 			return __webpack_require__.O(result);
/******/ 		}
/******/ 		
/******/ 		var chunkLoadingGlobal = self["webpackChunk"] = self["webpackChunk"] || [];
/******/ 		chunkLoadingGlobal.forEach(webpackJsonpCallback.bind(null, 0));
/******/ 		chunkLoadingGlobal.push = webpackJsonpCallback.bind(null, chunkLoadingGlobal.push.bind(chunkLoadingGlobal));
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module depends on other loaded chunks and execution need to be delayed
/******/ 	__webpack_require__.O(undefined, ["css/app"], () => (__webpack_require__("./resources/js/app.js")))
/******/ 	var __webpack_exports__ = __webpack_require__.O(undefined, ["css/app"], () => (__webpack_require__("./resources/css/app.css")))
/******/ 	__webpack_exports__ = __webpack_require__.O(__webpack_exports__);
/******/ 	
/******/ })()
;