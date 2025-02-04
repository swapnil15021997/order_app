importScripts("https://www.gstatic.com/firebasejs/8.2.0/firebase-app.js");
         importScripts("https://www.gstatic.com/firebasejs/8.2.0/firebase-messaging.js");  
         var firebaseConfig = {
            apiKey: "AIzaSyDGtmMCnDlvMJZ3G3LG4KPDaDaxEZceJ_Y",
            authDomain: "orderapp-bc2f6.firebaseapp.com",
            projectId: "orderapp-bc2f6",
            storageBucket: "orderapp-bc2f6.firebasestorage.app",
            messagingSenderId: "524963568172",
            appId: "1:524963568172:web:529f3ceebf7708a17b8f89",
            measurementId: "G-VRNHVWS31N"
      };

        // const serviceWorkerRegistration = await navigator
        //     .serviceWorker
        //     .register('/mvco/firebase-messaging-sw.js');

         firebase.initializeApp(firebaseConfig); 
         const messaging=firebase.messaging();


        


         messaging.setBackgroundMessageHandler(function (payload) { 
             console.log(payload);
             const notification=JSON.parse(payload); 
             const notificationOption={
                 body:notification.body,
                 icon:notification.icon 
             };
             return self.registration.showNotification(payload.notification.title,notificationOption); 
         });