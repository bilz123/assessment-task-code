// Give the service worker access to Firebase Messaging.
// Note that you can only use Firebase Messaging here, other Firebase libraries
// are not available in the service worker.
importScripts('https://www.gstatic.com/firebasejs/8.2.1/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.2.1/firebase-messaging.js');

// Initialize Firebase
firebase.initializeApp({
    apiKey: "AIzaSyDCqdmNSAy0eUYO0WI4zPjujRNps9s0DJk",
    authDomain: "northbank-app.firebaseapp.com",
    projectId: "northbank-app",
    storageBucket: "northbank-app.appspot.com",
    messagingSenderId: "333461357205",
    appId: "1:333461357205:web:530c6ed64895424fb4519c",
    measurementId: "G-H3YB4983QT"
});

// Retrieve an instance of Firebase Messaging so that it can handle background messages.
const messaging = firebase.messaging();

messaging.onBackgroundMessage(function (payload) {
    const { title, body } = payload.notification;

    return self.registration.showNotification(title, {
        body,
    });
});
